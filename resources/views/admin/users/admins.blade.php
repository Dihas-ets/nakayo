@extends('layouts.admin')

@section('title', 'Staff Administratif')

@section('content')
{{-- Gestion de l'état avec Alpine.js --}}
<div x-data="{ 
    showAdd: false, 
    showEdit: false, 
    showDelete: false, 
    selected: { id_user: null, nom_complet: '', email: '', telephone: '', role: '' } 
}" class="space-y-8">

    {{-- ALERTES DE SUCCÈS NAKAYO --}}
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-bounce">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-shield-check text-2xl"></i>
                <span class="font-bold text-lg">{{ session('success') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="opacity-70 hover:opacity-100"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight text-center md:text-left">Liste du staff administratif</h2>
            <p class="text-gray-500 font-medium italic mt-1 text-center md:text-left">Gérez les accès et les permissions de l'équipe interne.</p>
        </div>
        <button @click="showAdd = true" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-3.5 rounded-2xl font-bold flex items-center gap-3 shadow-lg transition-all active:scale-95">
            <i class="fa-solid fa-plus"></i> Ajouter un Staff
        </button>
    </div>

    {{-- TABLEAU --}}
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#00261C]">
                <tr class="text-white border-b border-gray-100">
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest">Identité</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest">Téléphone</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest text-center">Rôle</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest text-center">Date</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($admins as $admin)
                <tr class="hover:bg-gray-50/50 transition-all group">
                    <td class="px-10 py-6">
                        <p class="font-black text-[#1B2E58] text-lg leading-tight">{{ $admin->nom_complet }}</p>
                        <p class="text-xs text-gray-400 font-medium italic">{{ $admin->email }}</p>
                    </td>
                    <td class="px-10 py-6 text-sm font-bold text-gray-600">{{ $admin->telephone ?? 'N/A' }}</td>
                    <td class="px-10 py-6 text-center">
                        <span class="px-4 py-1.5 {{ str_contains(strtolower($admin->role), 'super') ? 'bg-[#1B2E58] text-white' : 'bg-[#FF9F29] text-white' }} rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm">
                            {{ $admin->role }}
                        </span>
                    </td>
                    <td class="px-10 py-6 text-center text-sm text-gray-500 font-medium">
                        {{ $admin->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-10 py-6 text-right">
                        <div class="flex justify-end gap-3 text-gray-300">
                            {{-- MODIFIER --}}
                            <button @click="selected = {{ json_encode($admin) }}; showEdit = true" class="w-9 h-9 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all flex items-center justify-center">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            {{-- SUPPRIMER --}}
                            <button @click="selected = { id_user: {{ $admin->id_user }}, nom_complet: '{{ addslashes($admin->nom_complet) }}' }; showDelete = true" class="w-9 h-9 rounded-xl hover:bg-red-50 hover:text-red-500 transition-all flex items-center justify-center">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                            
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-20 text-center text-gray-400 italic">Aucun membre du staff trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ==========================================
         MODAL : AJOUTER STAFF
    =========================================== -->
    <div x-show="showAdd" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showAdd = false" class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-2xl font-black text-[#1B2E58]">Nouveau Staff</h3>
                <button @click="showAdd = false" class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="p-10 space-y-5">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <x-input label="Nom Complet" name="nom_complet" required />
                    <div>
                        <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">Rôle</label>
                        <select name="role" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold">
                            <option value="admin">Administrateur</option>
                            <option value="Super Admin">Super Admin</option>
                        </select>
                    </div>
                </div>
                <x-input label="Email Professionnel" name="email" type="email" required />
                <x-input label="Téléphone" name="telephone" placeholder="+229..." />
                <x-input label="Mot de passe provisoire" name="password" type="password" required />
                
                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" @click="showAdd = false" class="px-8 py-4 text-gray-500 font-bold hover:text-gray-800">Annuler</button>
                    <button type="submit" class="bg-[#1B2E58] text-white px-10 py-4 rounded-2xl font-bold shadow-xl">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         MODAL : MODIFIER STAFF
    =========================================== -->
    <div x-show="showEdit" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showEdit = false" class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-2xl font-black text-[#1B2E58]">Modifier Staff</h3>
                <button @click="showEdit = false" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <form :action="'/admin/users/update/' + selected.id_user" method="POST" class="p-10 space-y-5">
                @csrf @method('PUT')
                <div>
                    <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">Nom Complet</label>
                    <input type="text" name="nom_complet" x-model="selected.nom_complet" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">Téléphone</label>
                        <input type="text" name="telephone" x-model="selected.telephone" class="w-full px-5 py-4 rounded-2xl border border-gray-100 outline-none font-bold">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">Rôle</label>
                        <select name="role" x-model="selected.role" class="w-full px-5 py-4 rounded-2xl border border-gray-100 outline-none font-bold">
                            <option value="admin">Admin</option>
                            <option value="Super Admin">Super Admin</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" @click="showEdit = false" class="px-8 py-4 font-bold text-gray-400">Annuler</button>
                    <button type="submit" class="bg-[#FF9F29] text-white px-10 py-4 rounded-2xl font-bold shadow-xl">Appliquer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         MODAL : SUPPRIMER STAFF
    =========================================== -->
    <div x-show="showDelete" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl relative">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl animate-bounce">
                <i class="fa-solid fa-user-xmark"></i>
            </div>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-2">Retirer du staff ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">Vous allez supprimer l'accès de <span class="text-red-600 font-bold" x-text="selected.nom_complet"></span>.</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold transition-all hover:bg-gray-200">Annuler</button>
                <form :action="'/admin/users/destroy/' + selected.id_user" method="POST" class="flex-1">
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