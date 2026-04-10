@extends('layouts.admin')

@section('title', 'Gestion de l\'Équipe')

@section('content')
<div x-data="{ 
    showAdd: false, 
    showEdit: false, 
    showDelete: false,
    selected: { id_membre: null, nom_complet: '', poste: '', linkedin: '', ordre: 0 } 
}" class="space-y-8">

    {{-- 1. ALERTES DE SUCCÈS NAKAYO --}}
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-in slide-in-from-top duration-500">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-users-check text-2xl"></i>
                <span class="font-bold text-lg">{{ session('success') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="opacity-70 hover:opacity-100 transition-all">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- 2. HEADER & ACTION -->
    <div class="flex flex-col md:flex-row justify-between items-end gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">L'Équipe NAKAYO</h2>

            @if ($errors->any())
    <div class="bg-red-600 text-white p-4 rounded-2xl mb-6 shadow-lg">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <p class="text-gray-500 font-medium">Gérez les visages et les rôles stratégiques de l'entreprise.</p>
        </div>
        <button @click="showAdd = true" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg transition-all active:scale-95">
            <i class="fa-solid fa-plus-circle text-lg"></i> Ajouter un membre
        </button>
    </div>

    <!-- 3. TABLEAU MODERN PREMIUM -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 text-center w-20">Portrait</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50">Collaborateur</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 text-center">Poste</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 text-center">Ordre</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($membres as $membre)
                <tr class="group hover:bg-[#F8FAFC] transition-all">
                    {{-- Avatar --}}
                    <td class="px-8 py-5">
                        <div class="w-14 h-14 rounded-2xl overflow-hidden border-2 border-white shadow-md group-hover:border-[#FF9F29] transition-all duration-300 mx-auto bg-gray-100">
                            @if($membre->photo)
                                <img src="{{ asset('storage/' . $membre->photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[#1B2E58] font-black text-xl">
                                    {{ substr($membre->nom_complet, 0, 1) }}
                                </div>
                            @endif
                        </div>
                    </td>

                    {{-- Nom & LinkedIn --}}
                    <td class="px-8 py-5">
                        <p class="font-black text-[#1B2E58] text-base leading-tight">{{ $membre->nom_complet }}</p>
                        @if($membre->linkedin)
                            <a href="{{ $membre->linkedin }}" target="_blank" class="text-[10px] text-blue-600 font-bold hover:underline">
                                <i class="fa-brands fa-linkedin mr-1"></i> Profil Professionnel
                            </a>
                        @else
                            <span class="text-[10px] text-gray-300 font-medium italic">Pas de lien social</span>
                        @endif
                    </td>

                    {{-- Poste --}}
                    <td class="px-8 py-5 text-center">
                        <span class="inline-flex px-3 py-1.5 bg-blue-50 text-[#1B2E58] rounded-full text-[10px] font-black uppercase tracking-widest border border-blue-100">
                            {{ $membre->poste }}
                        </span>
                    </td>

                    {{-- Ordre --}}
                    <td class="px-8 py-5 text-center font-black text-gray-400">
                        #{{ $membre->ordre }}
                    </td>

                    {{-- Actions --}}
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            <button @click="selected = {{ json_encode($membre) }}; showEdit = true" 
                                class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-[#1B2E58] hover:text-white transition-all duration-300 flex items-center justify-center">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </button>
                            <button @click="selected = { id_membre: {{ $membre->id_membre }}, nom_complet: '{{ addslashes($membre->nom_complet) }}' }; showDelete = true" 
                                class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-red-500 hover:text-white transition-all duration-300 flex items-center justify-center">
                                <i class="fa-solid fa-trash-can text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-20 text-center text-gray-400 italic">Aucun membre dans l'équipe.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ==========================================
         MODAL : AJOUTER UN MEMBRE
    =========================================== -->
    <div x-show="showAdd" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showAdd = false" class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-2xl font-black text-[#1B2E58]">Nouveau Membre</h3>
                <button @click="showAdd = false" class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-input label="Nom Complet" name="nom_complet" required />
                <x-input label="Poste / Fonction" name="poste" placeholder="Ex: Directeur Technique" required />
                <x-input label="Photo de profil" name="photo" type="file" required />
                
                <div class="grid grid-cols-2 gap-4">
                    <x-input label="Lien LinkedIn" name="linkedin" placeholder="https://linkedin.com/in/..." />
                    <x-input label="Ordre d'affichage" name="ordre" type="number" value="0" />
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-50">
                    <button type="button" @click="showAdd = false" class="px-8 py-4 font-bold text-gray-400 hover:text-gray-600 transition">Annuler</button>
                    <button type="submit" class="bg-[#1B2E58] text-white px-10 py-4 rounded-2xl font-black shadow-xl uppercase text-xs tracking-widest">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         MODAL : MODIFIER UN MEMBRE
    =========================================== -->
    <div x-show="showEdit" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showEdit = false" class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-2xl font-black text-[#1B2E58]">Modifier Profil</h3>
                <button @click="showEdit = false" class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <form :action="'/admin/equipe/' + selected.id_membre" method="POST" enctype="multipart/form-data" class="p-10 space-y-5">
                @csrf @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60 tracking-widest">Nom Complet</label>
                        <input type="text" name="nom_complet" x-model="selected.nom_complet" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold text-[#1B2E58]">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60 tracking-widest">Poste</label>
                        <input type="text" name="poste" x-model="selected.poste" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold text-[#1B2E58]">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-input label="Lien LinkedIn" name="linkedin" x-model="selected.linkedin" />
                        <x-input label="Ordre" name="ordre" type="number" x-model="selected.ordre" />
                    </div>
                    <x-input label="Changer la photo (optionnel)" name="photo" type="file" />
                </div>
                <div class="flex justify-end gap-4 pt-6 border-t">
                    <button type="button" @click="showEdit = false" class="px-8 py-4 font-bold text-gray-400">Annuler</button>
                    <button type="submit" class="bg-[#FF9F29] text-white px-10 py-4 rounded-2xl font-black shadow-xl uppercase text-xs tracking-widest">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         MODAL : SUPPRIMER UN MEMBRE
    =========================================== -->
    <div x-show="showDelete" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl relative">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl animate-bounce">
                <i class="fa-solid fa-user-minus"></i>
            </div>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-2 tracking-tight">Retirer ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">Voulez-vous retirer <span class="text-red-600 font-bold" x-text="selected.nom_complet"></span> de l'équipe officielle ?</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold">Annuler</button>
                <form :action="'/admin/equipe/destroy/' + selected.id_membre" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg shadow-red-200 hover:bg-red-700 transition-all uppercase text-[10px] tracking-widest">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection