@extends('layouts.admin')

@section('title', ' Staff Administratif')

@section('content')
{{-- Système CMS Nakayo : List, Add, Edit --}}
<div x-data="{ 
    view: 'list', 
    showDelete: false, 
    selected: { id_user: null, nom_complet: '', email: '', telephone: '', role: '', password: '' },

    openEdit(admin) {
        this.selected = JSON.parse(JSON.stringify(admin));
        this.selected.password = ''; {{-- On vide le mdp pour la modif --}}
        this.view = 'edit';
        window.scrollTo(0,0);
    },

    openAdd() {
        this.selected = { id_user: null, nom_complet: '', email: '', telephone: '', role: 'admin', password: '' };
        this.view = 'add';
        window.scrollTo(0,0);
    }
}" class="space-y-8">

    {{-- ALERTES --}}
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between">
            <div class="flex items-center gap-3 font-bold text-lg">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
            <button @click="$el.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <!-- ==========================================
         VUE 1 : LISTE DES MEMBRES
    =========================================== -->
    <div x-show="view === 'list'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">Le Staff Administratif</h2>
                <p class="text-gray-500 font-medium">Gestion centralisée des collaborateurs Nakayo.</p>
            </div>
            <button @click="openAdd()" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-black flex items-center gap-3 shadow-lg active:scale-95 transition-all">
                <i class="fa-solid fa-plus text-lg"></i> NOUVEAU MEMBRE
            </button>
        </div>

        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-[#00261C] text-white">
                    <tr class="font-black uppercase text-[10px] tracking-widest">
                        <th class="px-10 py-6">Identité & Contact</th>
                        <th class="px-10 py-6 text-center">Téléphone</th>
                        <th class="px-10 py-6 text-center">Rôle</th>
                        <th class="px-10 py-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-medium">
                    @forelse($admins as $admin)
                    <tr class="hover:bg-gray-50/50 transition-all text-[#1B2E58]">
                        <td class="px-10 py-6">
                            <p class="font-black text-lg leading-tight">{{ $admin->nom_complet }}</p>
                            <p class="text-xs text-gray-400 italic">{{ $admin->email }}</p>
                        </td>
                        <td class="px-10 py-6 text-center text-sm font-bold text-gray-600">
                            {{ $admin->telephone ?? 'N/A' }}
                        </td>
                        <td class="px-10 py-6 text-center">
                            <span class="px-4 py-1.5 {{ str_contains(strtolower($admin->role), 'super') ? 'bg-[#1B2E58]' : 'bg-[#FF9F29]' }} text-white rounded-lg text-[9px] font-black uppercase tracking-widest">
                                {{ $admin->role }}
                            </span>
                        </td>
                        <td class="px-10 py-6 text-right">
                            <div class="flex justify-end gap-3">
                                <button @click="openEdit({{ json_encode($admin) }})" class="w-10 h-10 rounded-xl bg-orange-50 text-[#FF9F29] hover:bg-[#FF9F29] hover:text-white transition-all flex items-center justify-center shadow-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button @click="selected = { id_user: {{ $admin->id_user }}, nom_complet: '{{ addslashes($admin->nom_complet) }}' }; showDelete = true" class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-20 text-center text-gray-400 italic uppercase font-bold tracking-widest">Aucun membre dans le staff</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ==========================================
         VUE 2 : PAGE D'AJOUT
    =========================================== -->
    <div x-show="view === 'add'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-12" x-cloak>
        <div class="flex items-center gap-4 mb-8">
            <button @click="view = 'list'" class="w-12 h-12 rounded-2xl bg-white border border-gray-100 text-[#1B2E58] flex items-center justify-center hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <h2 class="text-3xl font-black text-[#1B2E58] italic uppercase">Créer un nouveau profil</h2>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl p-10 md:p-16 border border-gray-50">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <x-input label="Nom Complet" name="nom_complet" placeholder="Ex: Jean Luc Nakayo" required />
                    <div>
                        <label class="block text-[10px] font-black mb-3 uppercase opacity-60 tracking-widest text-[#1B2E58]">Rôle attribué</label>
                        <select name="role" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                            <option value="admin">Administrateur</option>
                            <option value="Super Admin">Super Admin</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <x-input label="Email Professionnel" name="email" type="email" placeholder="email@nakayo.com" required />
                    <x-input label="Numéro de Téléphone" name="telephone" placeholder="+229 00 00 00 00" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <x-input label="Mot de passe" name="password" type="password" required />
                    {{-- Ajout automatique de la confirmation si ton contrôleur le demande --}}
                    <x-input label="Confirmer le mot de passe" name="password_confirmation" type="password" required />
                </div>

                <div class="flex justify-end gap-4 pt-8 border-t border-gray-50">
                    <button type="button" @click="view = 'list'" class="px-10 py-5 font-bold text-gray-400 hover:text-red-500">Annuler</button>
                    <button type="submit" class="bg-[#1B2E58] text-white px-12 py-5 rounded-2xl font-black shadow-2xl hover:bg-[#00261C] transition-all uppercase tracking-widest">
                        Enregistrer le membre
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         VUE 3 : PAGE DE MODIFICATION
    =========================================== -->
    <div x-show="view === 'edit'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-12" x-cloak>
        <div class="flex items-center gap-4 mb-8">
            <button @click="view = 'list'" class="w-12 h-12 rounded-2xl bg-white border border-gray-100 text-[#1B2E58] flex items-center justify-center hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <h2 class="text-3xl font-black text-[#1B2E58] italic uppercase">Édition du profil</h2>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl p-10 md:p-16 border border-orange-100">
            <div class="mb-10 pb-6 border-b border-gray-100 flex items-center gap-4">
                <div class="w-16 h-16 bg-orange-100 text-[#FF9F29] rounded-2xl flex items-center justify-center text-2xl font-black" x-text="selected.nom_complet.charAt(0)"></div>
                <div>
                    <h3 class="text-xl font-black text-[#1B2E58]" x-text="selected.nom_complet"></h3>
                    <p class="text-sm text-gray-400">Modifiez les informations ci-dessous</p>
                </div>
            </div>

            <form :action="'/admin/users/update/' + selected.id_user" method="POST" class="space-y-8">
                @csrf @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Nom Complet</label>
                        <input type="text" name="nom_complet" x-model="selected.nom_complet" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Rôle</label>
                        <select name="role" x-model="selected.role" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                            <option value="admin">Administrateur</option>
                            <option value="Super Admin">Super Admin</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Email (Lecture seule)</label>
                        <input type="email" name="email" x-model="selected.email" readonly class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-100 text-gray-400 outline-none font-bold cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Téléphone</label>
                        <input type="text" name="telephone" x-model="selected.telephone" class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-[#FF9F29] outline-none font-bold transition-all">
                    </div>
                </div>

                <div class="max-w-md bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    <label class="block text-[10px] font-black uppercase opacity-60 mb-3 tracking-widest text-[#1B2E58]">Changer le mot de passe</label>
                    <input type="password" name="password" placeholder="Laisser vide pour ne pas changer" class="w-full px-6 py-4 rounded-xl border border-gray-200 focus:bg-white outline-none font-bold transition-all text-sm">
                </div>

                <div class="flex justify-end gap-4 pt-8 border-t border-gray-50">
                    <button type="button" @click="view = 'list'" class="px-10 py-5 font-bold text-gray-400">Abandonner</button>
                    <button type="submit" class="bg-[#FF9F29] text-white px-12 py-5 rounded-2xl font-black shadow-2xl hover:bg-[#e88d1d] transition-all uppercase tracking-widest">
                        Appliquer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DE SUPPRESSION -->
    <div x-show="showDelete" class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl border border-gray-100">
            <i class="fa-solid fa-user-slash text-5xl text-red-500 mb-6"></i>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-2">Retirer du staff ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">Le compte de <span class="text-red-600 font-bold" x-text="selected.nom_complet"></span> sera désactivé.</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-xl font-bold">Annuler</button>
                <form :action="'/admin/users/destroy/' + selected.id_user" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg shadow-red-100">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection