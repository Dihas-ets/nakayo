@extends('layouts.admin')

@section('title', 'Gestion des Partenaires')

@section('content')
{{-- Conteneur Alpine.js pour la gestion CMS --}}
<div x-data="{ 
    view: 'list', 
    showDelete: false,
    selected: { id_partenaire: null, nom: '', lien: '', image: '' },
    
    openEdit(partenaire) {
        this.selected = JSON.parse(JSON.stringify(partenaire));
        this.view = 'edit';
        window.scrollTo(0,0);
    },

    openAdd() {
        this.selected = { id_partenaire: null, nom: '', lien: '', image: '' };
        this.view = 'add';
        window.scrollTo(0,0);
    }
}" class="space-y-8">

    {{-- Alertes d'erreurs --}}
    @if ($errors->any())
        <div class="bg-red-600 text-white p-5 rounded-2xl mb-8 shadow-xl">
            <ul class="list-disc pl-5 text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Alertes de succès --}}
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-fade-in">
            <div class="flex items-center gap-3 font-bold text-lg">
                <i class="fa-solid fa-handshake text-2xl"></i>
                {{ session('success') }}
            </div>
            <button @click="$el.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <!-- ==========================================
         VUE 1 : LISTE DES PARTENAIRES
    =========================================== -->
    <div x-show="view === 'list'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">Partenaires</h2>
                <p class="text-gray-500 font-medium">Gérez les entreprises et institutions partenaires.</p>
            </div>
            <button @click="openAdd()" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg active:scale-95 transition-all">
                <i class="fa-solid fa-plus text-lg"></i> Ajouter un partenaire
            </button>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#00261C] text-white font-black uppercase text-[10px] tracking-widest">
                        <th class="px-8 py-6">Logo</th>
                        <th class="px-8 py-6">Nom du Partenaire</th>
                        <th class="px-8 py-6 text-center">Lien Site Web</th>
                        <th class="px-8 py-6 text-center">Date d'ajout</th>
                        <th class="px-8 py-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-medium">
                    @forelse($partenaires as $partenaire)
                    <tr class="hover:bg-gray-50/50 transition-all group text-[#1B2E58]">
                        <td class="px-8 py-5">
                            <div class="w-16 h-16 rounded-xl overflow-hidden border border-gray-100 bg-white p-2 shadow-sm">
                                <!-- <img src="{{ $partenaire->image ?? 'https://placehold.co/200x200?text=Logo' }}" 
                                    class="w-full h-full object-contain" 
                                    alt="{{ $partenaire->nom }}"> -->

                                    <!-- <img src="{{ $partenaire->image_url }}" alt="{{ $partenaire->nom }}"> -->
                                     {{-- On force l'utilisation du disque 'public' même si le défaut est 'cloudinary' --}}
                                     <img src="{{ $partenaire->image_url }}" alt="{{ $partenaire->nom }}">
                        </td>
                        <td class="px-8 py-5">
                            <p class="font-black text-lg leading-tight uppercase">{{ $partenaire->nom }}</p>
                        </td>
                        <td class="px-8 py-5 text-center">
                            @if($partenaire->lien)
                                <a href="{{ $partenaire->lien }}" target="_blank" class="text-blue-500 hover:underline text-sm font-bold">
                                    <i class="fa-solid fa-link mr-1"></i> Visiter le site
                                </a>
                            @else
                                <span class="text-gray-300 italic text-xs">Aucun lien</span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-center font-black text-sm text-gray-400">
                            {{ $partenaire->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="openEdit({{ json_encode($partenaire) }})" 
                                    class="w-10 h-10 rounded-xl bg-orange-50 text-[#FF9F29] hover:bg-[#FF9F29] hover:text-white transition-all flex items-center justify-center shadow-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button @click="selected = { id_partenaire: {{ $partenaire->id_partenaire }}, nom: '{{ addslashes($partenaire->nom) }}' }; showDelete = true" 
                                    class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-20 text-center text-gray-400 italic">Aucun partenaire enregistré.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ==========================================
         VUE 2 : FORMULAIRE D'AJOUT
    =========================================== -->
    <div x-show="view === 'add'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-12" x-cloak>
        <div class="flex items-center gap-4 mb-8">
            <button @click="view = 'list'" class="w-12 h-12 rounded-2xl bg-white border border-gray-100 text-[#1B2E58] flex items-center justify-center hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <h2 class="text-3xl font-black text-[#1B2E58] italic uppercase">Nouveau Partenaire</h2>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl border border-gray-50 overflow-hidden">
            <form action="{{ route('admin.partenaires.store') }}" method="POST" enctype="multipart/form-data" class="p-10 md:p-16 space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black mb-3 uppercase opacity-60 tracking-widest text-[#1B2E58]">Nom de l'entreprise</label>
                        <input type="text" name="nom" required placeholder="Ex: Google, MTN..." class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black mb-3 uppercase opacity-60 tracking-widest text-[#1B2E58]">Lien du site (Optionnel)</label>
                        <input type="url" name="lien" placeholder="https://www.partenaire.com" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black mb-3 uppercase opacity-60 tracking-widest text-[#1B2E58]">Logo du partenaire</label>
                    <div class="relative group w-full">
                        <input type="file" name="image" required class="w-full px-6 py-12 border-2 border-dashed border-gray-200 rounded-[2rem] text-center cursor-pointer hover:border-[#FF9F29] transition-all file:hidden">
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none text-gray-400 group-hover:text-[#FF9F29]">
                            <i class="fa-solid fa-cloud-arrow-up text-3xl mb-2"></i>
                            <span class="font-bold">Cliquez pour uploader le logo</span>
                            <span class="text-[10px] uppercase">Format: PNG, JPG ou SVG (Max: 2Mo)</span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-8 border-t border-gray-50">
                    <button type="button" @click="view = 'list'" class="px-10 py-5 font-bold text-gray-400 hover:text-red-500 transition-all">Annuler</button>
                    <button type="submit" class="bg-[#1B2E58] text-white px-12 py-5 rounded-2xl font-black shadow-2xl hover:bg-[#00261C] active:scale-95 transition-all uppercase tracking-widest">
                        Ajouter le partenaire
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         VUE 3 : FORMULAIRE DE MODIFICATION
    =========================================== -->
    <div x-show="view === 'edit'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-12" x-cloak>
        <div class="flex items-center gap-4 mb-8">
            <button @click="view = 'list'" class="w-12 h-12 rounded-2xl bg-white border border-gray-100 text-[#1B2E58] flex items-center justify-center hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <h2 class="text-3xl font-black text-[#1B2E58] italic uppercase">Modifier Partenaire</h2>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl border border-orange-100 overflow-hidden">
            <form :action="'/admin/partenaires/' + selected.id_partenaire" method="POST" enctype="multipart/form-data" class="p-10 md:p-16 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black mb-3 uppercase opacity-60 tracking-widest text-[#1B2E58]">Nom de l'entreprise</label>
                        <input type="text" name="nom" x-model="selected.nom" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black mb-3 uppercase opacity-60 tracking-widest text-[#1B2E58]">Lien du site</label>
                        <input type="url" name="lien" x-model="selected.lien" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-8 items-center bg-gray-50 p-8 rounded-[2rem]">
                    <div class="w-32 h-32 rounded-2xl bg-white border border-gray-100 p-4 shadow-sm flex-shrink-0">
                        <img :src="selected.image ? '/storage/' + selected.image : 'https://placehold.co/200x200'" class="w-full h-full object-contain">
                    </div>
                    <div class="flex-1">
                        <label class="block text-[10px] font-black mb-3 uppercase opacity-60 tracking-widest text-[#1B2E58]">Changer le logo (Optionnel)</label>
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:bg-[#1B2E58] file:text-white hover:file:bg-orange-500">
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-8 border-t border-gray-50">
                    <button type="button" @click="view = 'list'" class="px-10 py-5 font-bold text-gray-400 hover:text-red-500 transition-all">Abandonner</button>
                    <button type="submit" class="bg-[#FF9F29] text-white px-12 py-5 rounded-2xl font-black shadow-2xl hover:bg-[#e88d1d] active:scale-95 transition-all uppercase tracking-widest">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DE SUPPRIMER (Confirmation) -->
    <div x-show="showDelete" class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl">
            <i class="fa-solid fa-trash-can text-5xl text-red-500 mb-6"></i>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-2">Supprimer ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">Le partenaire <span class="text-red-600 font-bold" x-text="selected.nom"></span> sera retiré de la liste.</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-xl font-bold">Annuler</button>
                <form :action="'/admin/partenaires/' + selected.id_partenaire" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection