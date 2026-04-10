@extends('layouts.admin')

@section('title', 'Gestion des Produits')

@section('content')
<div x-data="{ 
    showDelete: false, 
    selected: {id_produit: null, nom: ''} 
}" class="space-y-8">

    {{-- 1. AFFICHAGE DES ERREURS DE VALIDATION --}}
    @if ($errors->any())
        <div class="bg-red-600 text-white p-5 rounded-2xl mb-8 shadow-xl animate-in fade-in">
            <p class="font-black uppercase text-xs tracking-widest mb-2">Erreur de saisie :</p>
            <ul class="list-disc pl-5 text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 2. ALERTES DE SUCCÈS NAKAYO --}}
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-bounce">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-box-check text-2xl"></i>
                <span class="font-bold text-lg">{{ session('success') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="opacity-70 hover:opacity-100"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">Inventaire Produits</h2>
            <p class="text-gray-500 font-medium mt-1">Gérez vos stocks, prix et fiches techniques.</p>
        </div>
        <a href="{{ route('admin.produits.create') }}" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg transition-all active:scale-95">
            <i class="fa-solid fa-plus text-lg"></i> Ajouter un Produit
        </a>
    </div>

    <!-- TABLEAU PREMIUM -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#00261C] text-white font-black uppercase text-[10px] tracking-widest">
                    <th class="px-8 py-6 text-center w-24">Visuel</th>
                    <th class="px-8 py-6">Désignation & Service</th>
                    <th class="px-8 py-6 text-center">Prix (FCFA)</th>
                    <th class="px-8 py-6 text-center">Statut</th>
                    <th class="px-8 py-6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-medium text-[#1B2E58]">
                @forelse($produits as $produit)
                <tr class="hover:bg-gray-50/50 transition-all group">
                    <td class="px-8 py-5">
                        <div class="w-14 h-14 rounded-xl overflow-hidden border border-gray-100 shadow-sm mx-auto bg-gray-50">
                            <img src="{{ asset('storage/' . $produit->image) }}" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/100x100?text=Produit'">
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <p class="font-black text-lg leading-tight">{{ $produit->nom }}</p>
                        <span class="text-[10px] font-bold text-[#FF9F29] uppercase">
                            <i class="fa-solid fa-link mr-1"></i> {{ $produit->service->titre ?? 'Pole Expertise' }}
                        </span>
                    </td>
                    
                    <td class="px-8 py-5 text-center font-black">
                        @if($produit->prix)
                            {{ number_format($produit->prix, 0, ',', ' ') }}
                        @else
                            <span class="text-[10px] text-gray-400 font-bold uppercase italic">Sur Devis</span>
                        @endif
                    </td>

                    <td class="px-8 py-5 text-center">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest 
                            {{ $produit->statut == 'disponible' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-600' }}">
                            {{ $produit->statut == 'disponible' ? 'Disponible' : 'Non disponible' }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            {{-- 👁️ BOUTON DÉTAIL (Ajouté) --}}
                            <a href="{{ route('admin.produits.show', $produit->id_produit) }}" 
                               class="w-9 h-9 rounded-xl bg-blue-50 text-[#1B2E58] hover:bg-[#1B2E58] hover:text-white transition-all shadow-sm flex items-center justify-center" 
                               title="Voir la fiche complète">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </a>

                            {{-- ✏️ BOUTON MODIFIER --}}
                            <a href="{{ route('admin.produits.edit', $produit->id_produit) }}" 
                               class="w-9 h-9 rounded-xl bg-orange-50 text-[#FF9F29] hover:bg-[#FF9F29] hover:text-white transition-all shadow-sm flex items-center justify-center" 
                               title="Modifier">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </a>

                            {{-- 🗑️ BOUTON SUPPRIMER --}}
                            <button @click="selected = { id_produit: {{ $produit->id_produit }}, nom: '{{ addslashes($produit->nom) }}' }; showDelete = true" 
                                    class="w-9 h-9 rounded-xl bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-all shadow-sm flex items-center justify-center" 
                                    title="Supprimer">
                                <i class="fa-solid fa-trash-can text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-20 text-center text-gray-400 italic">Aucun produit trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MODAL SUPPRESSION (Confirmation) -->
    <div x-show="showDelete" class="fixed inset-0 z-[120] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-md rounded-[3rem] p-12 text-center shadow-2xl">
            <i class="fa-solid fa-trash-can text-5xl text-red-500 mb-6 animate-pulse"></i>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-4 tracking-tight">Supprimer ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium italic">"Voulez-vous retirer <span x-text="selected.nom" class="text-red-600 font-bold"></span> définitivement ?"</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold transition-all">Annuler</button>
                <form :action="'/admin/produits/' + selected.id_produit" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg shadow-red-200 hover:bg-red-700 transition-all">Confirmer</button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection