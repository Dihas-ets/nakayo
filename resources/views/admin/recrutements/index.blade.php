@extends('layouts.admin')

@section('title', 'Gestion des Recrutements')

@section('content')
{{-- Conteneur Alpine.js --}}
<div x-data="{ 
    view: 'list', 
    showDelete: false,
    imagePreview: null,
    selected: { id_recrutement: null, nom: '', description: '', lieu: '', agence: '', type: 'CDI', date_limite: '', email_whatsapp: '', status: 'brouillon', image: null },
    
    handleFile(e) {
        const file = e.target.files[0];
        if (file) {
            this.imagePreview = URL.createObjectURL(file);
        }
    },

    openEdit(offre) {
        this.selected = JSON.parse(JSON.stringify(offre));
        this.imagePreview = offre.image ? '/storage/' + offre.image : null;
        if(this.selected.date_limite) {
            this.selected.date_limite = this.selected.date_limite.split('T')[0];
        }
        this.view = 'edit';
        window.scrollTo(0,0);
    },

    openAdd() {
        this.selected = { id_recrutement: null, nom: '', description: '', lieu: '', agence: '', type: 'CDI', date_limite: '', email_whatsapp: '', status: 'brouillon', image: null };
        this.imagePreview = null;
        this.view = 'add';
        window.scrollTo(0,0);
    }
}" class="space-y-8">

    {{-- Alertes --}}
    @if ($errors->any())
        <div class="bg-red-600 text-white p-5 rounded-2xl mb-8 shadow-xl">
            <ul class="list-disc pl-5 text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ==========================================
         VUE 1 : LISTE DES OFFRES
    =========================================== -->
    <div x-show="view === 'list'" x-transition>
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-black text-[#1B2E58] uppercase italic">Offres d'Emploi</h2>
            </div>
            <button @click="openAdd()" class="bg-[#1B2E58] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3">
                <i class="fa-solid fa-plus"></i> Créer une offre
            </button>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-[#00261C] text-white text-[10px] uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-6">Poste / Agence</th>
                        <th class="px-8 py-6 text-center">Type & Lieu</th>
                        <th class="px-8 py-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($offres as $offre)
                    <tr class="text-[#1B2E58]">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <img src="{{ $offre->image ? url('storage/' . $offre->image) : 'https://placehold.co/100x100?text=Job' }}" class="w-12 h-12 rounded-xl object-cover">
                                <div>
                                    <p class="font-black">{{ $offre->nom }}</p>
                                    <p class="text-[10px] text-[#FF9F29] uppercase">{{ $offre->agence }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center font-bold">{{ $offre->type }} - {{ $offre->lieu }}</td>
                        <td class="px-8 py-5 text-right">
                            <button @click="openEdit({{ json_encode($offre) }})" class="text-orange-500 mr-4 hover:scale-110 transition-transform"><i class="fa-solid fa-pen"></i></button>
                            <button @click="selected = {{ json_encode($offre) }}; showDelete = true" class="text-red-500 hover:scale-110 transition-transform"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ==========================================
         VUE 2 : FORMULAIRE D'AJOUT
    =========================================== -->
    <div x-show="view === 'add'" x-cloak x-transition>
        <div class="bg-white rounded-[3rem] shadow-xl p-10 md:p-16">
            <div class="flex items-center gap-4 mb-8">
                <button @click="view = 'list'" class="text-gray-400 hover:text-[#1B2E58]"><i class="fa-solid fa-arrow-left text-xl"></i></button>
                <h2 class="text-2xl font-black uppercase text-[#1B2E58]">Nouvelle Offre</h2>
            </div>

            <form action="{{ route('admin.recrutements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <x-input label="Titre du poste" name="nom" required />
                    <x-input label="Lieu" name="lieu" required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 text-[#1B2E58]">Type de contrat</label>
                        <select name="type" class="w-full p-4 rounded-xl bg-gray-50 border border-gray-100 font-bold outline-none focus:border-[#FF9F29]">
                            <option value="CDI">CDI</option><option value="CDD">CDD</option><option value="Mission">Mission</option><option value="Stage">Stage</option>
                        </select>
                    </div>
                    <x-input label="Date limite" name="date_limite" type="date" required />
                    <x-input label="Agence / Département" name="agence" placeholder="Ex: Ressources Humaines" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- CHAMP IMAGE --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black uppercase text-[#1B2E58]">Image illustrative</label>
                        <div class="flex items-center gap-4">
                            <input type="file" name="image" @change="handleFile($event)" class="w-full p-3 border-2 border-dashed rounded-2xl text-xs">
                            <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden border shrink-0">
                                <template x-if="imagePreview">
                                    <img :src="imagePreview" class="w-full h-full object-cover">
                                </template>
                            </div>
                        </div>
                    </div>
                    <x-input label="Numéro Whatsapp de réception" name="email_whatsapp" placeholder="22900000000" required />
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase mb-2 text-[#1B2E58]">Description de l'offre</label>
                    <textarea name="description" rows="6" class="w-full p-6 rounded-2xl bg-gray-50 border border-gray-100 outline-none focus:border-[#FF9F29] font-medium" required></textarea>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t">
                    <button type="button" @click="view = 'list'" class="font-bold text-gray-400 uppercase text-xs tracking-widest">Annuler</button>
                    <button type="submit" class="bg-[#1B2E58] text-white px-12 py-4 rounded-2xl font-black shadow-lg hover:bg-[#00261C] transition-all uppercase text-xs tracking-widest">Enregistrer l'offre</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         VUE 3 : FORMULAIRE DE MODIFICATION
    =========================================== -->
    <div x-show="view === 'edit'" x-cloak x-transition>
        <div class="bg-white rounded-[3rem] shadow-xl p-10 md:p-16">
            <div class="flex items-center gap-4 mb-8">
                <button @click="view = 'list'" class="text-gray-400 hover:text-[#1B2E58]"><i class="fa-solid fa-arrow-left text-xl"></i></button>
                <h2 class="text-2xl font-black uppercase text-[#1B2E58]">Modifier l'offre</h2>
            </div>

            <form :action="'/admin/recrutements/' + selected.id_recrutement" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 text-[#1B2E58]">Titre du poste</label>
                        <input type="text" name="nom" x-model="selected.nom" class="w-full p-4 rounded-xl bg-gray-50 border border-gray-100 font-bold outline-none focus:border-[#FF9F29]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 text-[#1B2E58]">Lieu</label>
                        <input type="text" name="lieu" x-model="selected.lieu" class="w-full p-4 rounded-xl bg-gray-50 border border-gray-100 font-bold outline-none focus:border-[#FF9F29]">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 text-[#1B2E58]">Type de contrat</label>
                        <select name="type" x-model="selected.type" class="w-full p-4 rounded-xl bg-gray-50 border border-gray-100 font-bold outline-none focus:border-[#FF9F29]">
                            <option value="CDI">CDI</option><option value="CDD">CDD</option><option value="Mission">Mission</option><option value="Stage">Stage</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 text-[#1B2E58]">Date limite</label>
                        <input type="date" name="date_limite" x-model="selected.date_limite" class="w-full p-4 rounded-xl bg-gray-50 border border-gray-100 font-bold outline-none focus:border-[#FF9F29]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 text-[#1B2E58]">Agence / Département</label>
                        <input type="text" name="agence" x-model="selected.agence" class="w-full p-4 rounded-xl bg-gray-50 border border-gray-100 font-bold outline-none focus:border-[#FF9F29]">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- IMAGE DANS LA MODIFICATION --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black uppercase text-[#1B2E58]">Changer l'image</label>
                        <div class="flex items-center gap-4">
                            <input type="file" name="image" @change="handleFile($event)" class="w-full p-3 border-2 border-dashed rounded-2xl text-xs">
                            <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden border shrink-0">
                                <img :src="imagePreview" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 text-[#1B2E58]">Numéro Whatsapp</label>
                        <input type="text" name="email_whatsapp" x-model="selected.email_whatsapp" class="w-full p-4 rounded-xl bg-gray-50 border border-gray-100 font-bold outline-none focus:border-[#FF9F29]">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase mb-2 text-[#1B2E58]">Description</label>
                    <textarea name="description" x-model="selected.description" rows="6" class="w-full p-6 rounded-2xl bg-gray-50 border border-gray-100 outline-none focus:border-[#FF9F29] font-medium"></textarea>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t">
                    <button type="button" @click="view = 'list'" class="font-bold text-gray-400 uppercase text-xs tracking-widest">Abandonner</button>
                    <button type="submit" class="bg-[#FF9F29] text-white px-12 py-4 rounded-2xl font-black shadow-lg hover:bg-[#e88d1d] transition-all uppercase text-xs tracking-widest">Mettre à jour l'offre</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div x-show="showDelete" class="fixed inset-0 z-[150] flex items-center justify-center bg-black/50 backdrop-blur-sm" x-cloak x-transition>
        <div class="bg-white p-12 rounded-[2rem] text-center max-w-sm border shadow-2xl">
            <h3 class="text-xl font-black mb-4 text-[#1B2E58]">Confirmer la suppression ?</h3>
            <p class="text-gray-500 text-sm mb-8">Cette action est irréversible.</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 p-4 bg-gray-100 rounded-xl font-bold">Non</button>
                <form :action="'/admin/recrutements/' + selected.id_recrutement" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button class="w-full p-4 bg-red-600 text-white rounded-xl font-bold">Oui, supprimer</button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection