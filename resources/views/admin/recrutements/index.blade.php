@extends('layouts.admin')

@section('title', 'Gestion des Recrutements')

@section('content')
{{-- Conteneur Alpine.js --}}
<div x-data="{ 
    showAdd: false, 
    showEdit: false, 
    showDelete: false,
    selected: { id_recrutement: null, nom: '', description: '', lieu: '', agence: '', type: 'CDI', date_limite: '', email_whatsapp: '', status: 'brouillon' } 
}" class="space-y-8">

    {{-- 1. AFFICHAGE DES ERREURS --}}
    @if ($errors->any())
        <div class="bg-red-600 text-white p-5 rounded-2xl mb-8 shadow-xl">
            <ul class="list-disc pl-5 text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 2. ALERTES DE SUCCÈS --}}
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-bounce">
            <div class="flex items-center gap-3 font-bold text-lg">
                <i class="fa-solid fa-briefcase text-2xl"></i>
                {{ session('success') }}
            </div>
            <button @click="$el.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">Offres d'Emploi</h2>
            <p class="text-gray-500 font-medium">Gérez les appels à candidatures de Nakayo.</p>
        </div>
        <button @click="showAdd = true" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg active:scale-95 transition-all">
            <i class="fa-solid fa-user-plus text-lg"></i> Créer une offre
        </button>
    </div>

    <!-- TABLEAU DES OFFRES -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#00261C] text-white font-black uppercase text-[10px] tracking-widest">
                    <th class="px-8 py-6">Poste / Agence</th>
                    <th class="px-8 py-6 text-center">Type & Lieu</th>
                    <th class="px-8 py-6 text-center">Date Limite</th>
                    <th class="px-8 py-6 text-center">Statut</th>
                    <th class="px-8 py-6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-medium">
                @forelse($offres as $offre)
                <tr class="hover:bg-gray-50/50 transition-all group text-[#1B2E58]">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                                <img src="{{ $offre->image ? asset('storage/' . $offre->image) : 'https://placehold.co/100x100?text=Job' }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-black text-lg leading-tight">{{ $offre->nom }}</p>
                                <p class="text-[10px] text-[#FF9F29] font-black uppercase">{{ $offre->agence ?? 'Nakayo Corp' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="px-3 py-1 bg-blue-50 text-[#1B2E58] rounded-lg text-[10px] font-black uppercase">{{ $offre->type }}</span>
                        <p class="text-xs text-gray-400 mt-1"><i class="fa-solid fa-location-dot"></i> {{ $offre->lieu }}</p>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <p class="font-black text-sm">{{ \Carbon\Carbon::parse($offre->date_limite)->format('d M Y') }}</p>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest 
                            {{ $offre->status == 'publié' ? 'bg-emerald-100 text-emerald-700' : ($offre->status == 'brouillon' ? 'bg-orange-100 text-orange-600' : 'bg-gray-100 text-gray-500') }}">
                            {{ $offre->status }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            {{-- BOUTON MODIFIER --}}
                            <button @click="
                                selected = {{ json_encode($offre) }}; 
                                selected.date_limite = '{{ \Carbon\Carbon::parse($offre->date_limite)->format('Y-m-d') }}'; 
                                showEdit = true" 
                                class="w-9 h-9 rounded-xl bg-orange-50 text-[#FF9F29] hover:bg-[#FF9F29] hover:text-white transition-all flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            {{-- BOUTON SUPPRIMER --}}
                            <button @click="selected = { id_recrutement: {{ $offre->id_recrutement }}, nom: '{{ addslashes($offre->nom) }}' }; showDelete = true" class="w-9 h-9 rounded-xl bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-20 text-center text-gray-400 italic">Aucune offre trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ==========================================
         MODAL 1 : AJOUTER UNE OFFRE
    =========================================== -->
    <div x-show="showAdd" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showAdd = false" class="bg-white w-full max-w-3xl rounded-[3rem] shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-2xl font-black text-[#1B2E58]">Nouvelle Offre</h3>
                <button @click="showAdd = false" class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <form action="{{ route('admin.recrutements.store') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input label="Titre du poste" name="nom" required />
                    <x-input label="Lieu" name="lieu" placeholder="Ex: Cotonou" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[10px] font-black mb-2 uppercase opacity-60">Type de contrat</label>
                        <select name="type" class="w-full px-5 py-3 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold">
                            <option value="CDI">CDI</option><option value="CDD">CDD</option><option value="Mission">Mission</option><option value="Stage">Stage</option><option value="Freelance">Freelance</option>
                        </select>
                    </div>
                    <x-input label="Date limite" name="date_limite" type="date" required />
                    <x-input label="Agence/Département" name="agence" placeholder="Ex: Marketing" />
                </div>
                <x-input label="Image illustrative" name="image" type="file" />
                <x-input label="Email / Whatsapp de réception" name="email_whatsapp" placeholder="recrutement@nakayo.bj" required />
                <div>
                    <label class="block text-[10px] font-black mb-2 uppercase opacity-60">Description détaillée</label>
                    <textarea name="description" rows="5" class="w-full px-6 py-4 rounded-3xl border border-gray-100 outline-none focus:border-[#FF9F29] font-medium" required></textarea>
                </div>
                <div class="flex justify-end gap-4 pt-4 border-t">
                    <button type="button" @click="showAdd = false" class="px-8 py-4 font-bold text-gray-400">Annuler</button>
                    <button type="submit" class="bg-[#1B2E58] text-white px-10 py-4 rounded-2xl font-black shadow-xl active:scale-95 transition-all">PUBLIER L'OFFRE</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         MODAL 2 : MODIFIER UNE OFFRE (FIXÉE)
    =========================================== -->
    <div x-show="showEdit" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showEdit = false" class="bg-white w-full max-w-3xl rounded-[3rem] shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-2xl font-black text-[#1B2E58]">Modifier l'offre</h3>
                <button @click="showEdit = false" class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            
            <form :action="'/admin/recrutements/' + selected.id_recrutement" method="POST" enctype="multipart/form-data" class="p-10 space-y-6 text-[#1B2E58]">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-2">Titre du poste</label>
                        <input type="text" name="nom" x-model="selected.nom" class="w-full px-5 py-3 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-2">Lieu</label>
                        <input type="text" name="lieu" x-model="selected.lieu" class="w-full px-5 py-3 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-2">Type</label>
                        <select name="type" x-model="selected.type" class="w-full px-5 py-3 rounded-2xl border border-gray-100 outline-none font-bold">
                            <option value="CDI">CDI</option><option value="CDD">CDD</option><option value="Mission">Mission</option><option value="Stage">Stage</option><option value="Freelance">Freelance</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-2">Date limite</label>
                        <input type="date" name="date_limite" x-model="selected.date_limite" class="w-full px-5 py-3 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-2">Statut</label>
                        <select name="status" x-model="selected.status" class="w-full px-5 py-3 rounded-2xl border border-gray-100 outline-none font-bold">
                            <option value="brouillon">Brouillon</option>
                            <option value="publié">Publié</option>
                            <option value="cloturé">Clôturé</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase opacity-60 mb-2">Description</label>
                    <textarea name="description" x-model="selected.description" rows="5" class="w-full px-6 py-4 rounded-3xl border border-gray-100 outline-none focus:border-[#FF9F29] font-medium"></textarea>
                </div>
                
                <div class="flex justify-end gap-4 pt-4 border-t">
                    <button type="button" @click="showEdit = false" class="px-8 py-4 font-bold text-gray-400">Annuler</button>
                    <button type="submit" class="bg-[#FF9F29] text-white px-10 py-4 rounded-2xl font-black shadow-xl active:scale-95 transition-all">
                        METTRE À JOUR
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 3 : SUPPRIMER UNE OFFRE -->
    <div x-show="showDelete" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl relative">
            <i class="fa-solid fa-trash-can text-5xl text-red-500 mb-6 animate-pulse"></i>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-2 tracking-tight">Supprimer ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">L'offre <span class="text-red-600 font-bold" x-text="selected.nom"></span> sera définitivement retirée.</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-xl font-bold">Annuler</button>
                <form :action="'/admin/recrutements/' + selected.id_recrutement" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg shadow-red-200 hover:bg-red-700 transition-all">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection