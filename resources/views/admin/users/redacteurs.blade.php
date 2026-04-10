@extends('layouts.admin')

@section('title', 'Gestion des Rédacteurs')

@section('content')
{{-- Alpine.js State Management --}}
<div x-data="{ 
    showAdd: false, 
    showEdit: false, 
    showDelete: false, 
    selected: { id_user: null, nom_complet: '', email: '', telephone: '' } 
}" class="space-y-8">
    
    {{-- ALERTES NAKAYO ORANGE --}}
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-bounce">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-user-check text-2xl"></i>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="opacity-70"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight">Équipe de Rédaction</h2>
            <p class="text-gray-500 font-medium italic">Gérez les contributeurs de votre blog et leurs performances.</p>
        </div>
        <button @click="showAdd = true" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-3.5 rounded-2xl font-bold flex items-center gap-3 shadow-lg shadow-blue-900/10 transition-all active:scale-95">
            <i class="fa-solid fa-user-pen"></i>
            Ajouter un rédacteur
        </button>
    </div>

    <!-- TABLEAU RÉDACTEURS -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#00261C] text-white">
                <tr class="border-b border-white/10">
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest">Rédacteur</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest text-center">Articles rédigés</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest text-center">Date d'adhésion</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest text-center">Statut</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($redacteurs as $redacteur)
                <tr class="hover:bg-gray-50/50 transition-all group">
                    {{-- Profil --}}
                    <td class="px-10 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#1B2E58] flex items-center justify-center font-black text-xl group-hover:bg-[#FF9F29] group-hover:text-white transition-all shadow-sm">
                                {{ substr($redacteur->nom_complet, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-black text-[#1B2E58] text-lg leading-tight">{{ $redacteur->nom_complet }}</p>
                                <p class="text-xs text-gray-400 font-medium">{{ $redacteur->email }}</p>
                            </div>
                        </div>
                    </td>

                    {{-- Articles Count (Si tu as la relation articles_count) --}}
                    <td class="px-10 py-6 text-center">
                        <div class="inline-flex items-center gap-2 px-5 py-2 bg-gray-100 rounded-xl">
                            <i class="fa-solid fa-newspaper text-[#FF9F29]"></i>
                            <span class="font-black text-[#1B2E58]">{{ $redacteur->articles_count ?? 0 }}</span>
                        </div>
                    </td>

                    {{-- Date d'adhésion --}}
                    <td class="px-10 py-6 text-center text-sm font-bold text-gray-500">
                        {{ $redacteur->created_at->format('d M Y') }}
                    </td>

                    {{-- Statut --}}
                    <td class="px-10 py-6 text-center">
                        <span class="px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-widest">
                            Actif
                        </span>
                    </td>

                    {{-- BOUTONS D'ACTIONS --}}
                    <td class="px-10 py-6 text-right">
                        <div class="flex justify-end gap-3 text-gray-300">
                            {{-- MODIFIER --}}
                            <button @click="selected = {{ json_encode($redacteur) }}; showEdit = true" 
                                class="w-10 h-10 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all flex items-center justify-center">
                                <i class="fa-solid fa-pen-to-square text-lg"></i>
                            </button>
                            {{-- SUPPRIMER --}}
                            <button @click="selected = { id_user: {{ $redacteur->id_user }}, nom_complet: '{{ addslashes($redacteur->nom_complet) }}' }; showDelete = true" 
                                class="w-10 h-10 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all flex items-center justify-center">
                                <i class="fa-solid fa-trash-can text-lg"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-20 text-center text-gray-400 italic font-medium">Aucun rédacteur enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ==========================================
         MODAL 1 : AJOUTER RÉDACTEUR
    =========================================== -->
    <div x-show="showAdd" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showAdd = false" class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-2xl font-black text-[#1B2E58]">Nouveau Rédacteur</h3>
                <button @click="showAdd = false" class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="p-10 space-y-6">
                @csrf
                <input type="hidden" name="role" value="rédacteur">
                <x-input label="Nom Complet" name="nom_complet" required />
                <x-input label="Adresse Email" name="email" type="email" required />
                <x-input label="Téléphone" name="telephone" placeholder="+229..." />
                <x-input label="Mot de passe" name="password" type="password" required />
                
                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" @click="showAdd = false" class="px-8 py-4 text-gray-500 font-bold hover:text-gray-800">Annuler</button>
                    <button type="submit" class="bg-[#1B2E58] text-white px-10 py-4 rounded-2xl font-bold shadow-xl">Inscrire</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         MODAL 2 : MODIFIER RÉDACTEUR
    =========================================== -->
    <div x-show="showEdit" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showEdit = false" class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-2xl font-black text-[#1B2E58]">Modifier Rédacteur</h3>
                <button @click="showEdit = false" class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <form :action="'/admin/users/update/' + selected.id_user" method="POST" class="p-10 space-y-6">
                @csrf @method('PUT')
                <input type="hidden" name="role" value="rédacteur">
                <div>
                    <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">Nom Complet</label>
                    <input type="text" name="nom_complet" x-model="selected.nom_complet" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">Email</label>
                    <input type="email" name="email" x-model="selected.email" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold">
                </div>
                <x-input label="Nouveau mot de passe (laisser vide)" name="password" type="password" />

                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" @click="showEdit = false" class="px-8 py-4 text-gray-400">Annuler</button>
                    <button type="submit" class="bg-[#FF9F29] text-white px-10 py-4 rounded-2xl font-bold shadow-xl">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         MODAL 3 : SUPPRIMER RÉDACTEUR
    =========================================== -->
    <div x-show="showDelete" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl relative">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl animate-bounce">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-2">Supprimer le rédacteur ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">L'accès de <span class="text-red-600 font-bold" x-text="selected.nom_complet"></span> sera définitivement supprimé.</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold">Annuler</button>
                <form :action="'/admin/users/destroy/' + selected.id_user" method="POST" class="flex-1">
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