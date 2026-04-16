@extends('layouts.admin')

@section('title', 'Gestion des Recrutements')

@section('content')
{{-- Conteneur Alpine.js avec gestion de vues : 'list', 'add', 'edit' --}}
<div x-data="{ 
    view: 'list', 
    showDelete: false,
    selected: { id_recrutement: null, nom: '', description: '', lieu: '', agence: '', type: 'CDI', date_limite: '', email_whatsapp: '', status: 'brouillon' },
    
    // Fonction pour charger la modification
    openEdit(offre) {
        this.selected = JSON.parse(JSON.stringify(offre));
        // Formatage de la date pour l'input type date
        if(this.selected.date_limite) {
            this.selected.date_limite = this.selected.date_limite.split('T')[0];
        }
        this.view = 'edit';
        window.scrollTo(0,0);
    },

    openAdd() {
        this.selected = { id_recrutement: null, nom: '', description: '', lieu: '', agence: '', type: 'CDI', date_limite: '', email_whatsapp: '', status: 'brouillon' };
        this.view = 'add';
        window.scrollTo(0,0);
    }
}" class="space-y-8">

    {{-- 1. ALERTES --}}
    @if ($errors->any())
        <div class="bg-red-600 text-white p-5 rounded-2xl mb-8 shadow-xl">
            <ul class="list-disc pl-5 text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between">
            <div class="flex items-center gap-3 font-bold text-lg">
                <i class="fa-solid fa-briefcase text-2xl"></i>
                {{ session('success') }}
            </div>
            <button @click="$el.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <!-- ==========================================
         VUE 1 : LISTE DES OFFRES
    =========================================== -->
    <div x-show="view === 'list'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">
        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">Offres d'Emploi</h2>
                <p class="text-gray-500 font-medium">Gérez les appels à candidatures de Nakayo.</p>
            </div>
            <button @click="openAdd()" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg active:scale-95 transition-all">
                <i class="fa-solid fa-plus text-lg"></i> Créer une offre
            </button>
        </div>

        <!-- TABLEAU -->
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
                        <td class="px-8 py-5 text-center font-black text-sm">
                            {{ \Carbon\Carbon::parse($offre->date_limite)->format('d M Y') }}
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest 
                                {{ $offre->status == 'publié' ? 'bg-emerald-100 text-emerald-700' : ($offre->status == 'brouillon' ? 'bg-orange-100 text-orange-600' : 'bg-gray-100 text-gray-500') }}">
                                {{ $offre->status }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="openEdit({{ json_encode($offre) }})" 
                                    class="w-9 h-9 rounded-xl bg-orange-50 text-[#FF9F29] hover:bg-[#FF9F29] hover:text-white transition-all flex items-center justify-center shadow-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button @click="selected = { id_recrutement: {{ $offre->id_recrutement }}, nom: '{{ addslashes($offre->nom) }}' }; showDelete = true" 
                                    class="w-9 h-9 rounded-xl bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center shadow-sm">
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
    </div>

    <!-- ==========================================
         VUE 2 : FORMULAIRE D'AJOUT (CMS PAGE)
    =========================================== -->
    <div x-show="view === 'add'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-12" x-cloak>
        <div class="flex items-center gap-4 mb-8">
            <button @click="view = 'list'" class="w-12 h-12 rounded-2xl bg-white border border-gray-100 text-[#1B2E58] flex items-center justify-center hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <h2 class="text-3xl font-black text-[#1B2E58] italic uppercase">Nouvelle Offre</h2>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl border border-gray-50 overflow-hidden">
            <form action="{{ route('admin.recrutements.store') }}" method="POST" enctype="multipart/form-data" class="p-10 md:p-16 space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <x-input label="Titre du poste" name="nom" required />
                    <x-input label="Lieu" name="lieu" placeholder="Ex: Cotonou" required />
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-[10px] font-black mb-3 uppercase opacity-60 tracking-widest text-[#1B2E58]">Type de contrat</label>
                        <select name="type" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                            <option value="CDI">CDI</option><option value="CDD">CDD</option><option value="Mission">Mission</option><option value="Stage">Stage</option><option value="Freelance">Freelance</option>
                        </select>
                    </div>
                    <x-input label="Date limite" name="date_limite" type="date" required />
                    <x-input label="Agence/Département" name="agence" placeholder="Ex: Marketing" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <x-input label="Image illustrative" name="image" type="file" />
                    <x-input label="Email / Whatsapp de réception" name="email_whatsapp" placeholder="recrutement@nakayo.bj" required />
                </div>

                <div>
                    <label class="block text-[10px] font-black mb-3 uppercase opacity-60 tracking-widest text-[#1B2E58]">Description détaillée</label>
                    <textarea name="description" rows="8" class="w-full px-8 py-6 rounded-[2rem] border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-medium text-lg transition-all" required></textarea>
                </div>

                <div class="flex justify-end gap-4 pt-8 border-t border-gray-50">
                    <button type="button" @click="view = 'list'" class="px-10 py-5 font-bold text-gray-400 hover:text-red-500 transition-all">Annuler</button>
                    <button type="submit" class="bg-[#1B2E58] text-white px-12 py-5 rounded-2xl font-black shadow-2xl hover:bg-[#00261C] active:scale-95 transition-all uppercase tracking-widest">
                        Enregistrer l'offre
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         VUE 3 : FORMULAIRE DE MODIFICATION (CMS PAGE)
    =========================================== -->
    <div x-show="view === 'edit'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-12" x-cloak>
        <div class="flex items-center gap-4 mb-8">
            <button @click="view = 'list'" class="w-12 h-12 rounded-2xl bg-white border border-gray-100 text-[#1B2E58] flex items-center justify-center hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <h2 class="text-3xl font-black text-[#1B2E58] italic uppercase">Modifier l'offre</h2>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl border border-orange-100 overflow-hidden">
            <div class="bg-orange-50/30 px-10 py-4 border-b border-orange-50">
                <p class="text-[#FF9F29] font-bold text-sm uppercase tracking-widest">Édition de : <span x-text="selected.nom"></span></p>
            </div>
            
            <form :action="'/admin/recrutements/' + selected.id_recrutement" method="POST" enctype="multipart/form-data" class="p-10 md:p-16 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Titre du poste</label>
                        <input type="text" name="nom" x-model="selected.nom" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Lieu</label>
                        <input type="text" name="lieu" x-model="selected.lieu" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Type</label>
                        <select name="type" x-model="selected.type" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                            <option value="CDI">CDI</option><option value="CDD">CDD</option><option value="Mission">Mission</option><option value="Stage">Stage</option><option value="Freelance">Freelance</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Date limite</label>
                        <input type="date" name="date_limite" x-model="selected.date_limite" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Statut</label>
                        <select name="status" x-model="selected.status" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                            <option value="brouillon">Brouillon</option>
                            <option value="publié">Publié</option>
                            <option value="cloturé">Clôturé</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Description</label>
                    <textarea name="description" x-model="selected.description" rows="8" class="w-full px-8 py-6 rounded-[2rem] border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-medium text-lg transition-all"></textarea>
                </div>
                
                <div class="flex justify-end gap-4 pt-8 border-t border-gray-50">
                    <button type="button" @click="view = 'list'" class="px-10 py-5 font-bold text-gray-400 hover:text-red-500 transition-all">Abandonner</button>
                    <button type="submit" class="bg-[#FF9F29] text-white px-12 py-5 rounded-2xl font-black shadow-2xl hover:bg-[#e88d1d] active:scale-95 transition-all uppercase tracking-widest">
                        Mettre à jour l'offre
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DE CONFIRMATION (Garder en modal car action destructrice rapide) -->
    <div x-show="showDelete" class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl">
            <i class="fa-solid fa-trash-can text-5xl text-red-500 mb-6"></i>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-2">Supprimer ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">L'offre <span class="text-red-600 font-bold" x-text="selected.nom"></span> sera définitivement retirée.</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-xl font-bold">Annuler</button>
                <form :action="'/admin/recrutements/' + selected.id_recrutement" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
    /* Optionnel : cacher la barre latérale ou ajuster le padding quand on est en mode édition pour plus d'espace CMS */
</style>
@endsection