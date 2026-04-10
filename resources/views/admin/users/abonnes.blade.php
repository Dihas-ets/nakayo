@extends('layouts.admin')

@section('title', 'Gestion des Abonnés')

@section('content')
{{-- On définit toutes les variables nécessaires dans x-data --}}
<div x-data="{ 
    showAdd: false, 
    showEdit: false, 
    showDelete: false, 
    selected: { id_user: null, nom_complet: '', email: '', telephone: '', role: 'abonné' } 
}" class="space-y-8">

    {{-- MESSAGE DE SUCCÈS (Orange Nakayo) --}}
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-bounce">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-2xl"></i>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="opacity-70"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-4xl font-black text-[#1B2E58] tracking-tight">Gestion des Abonnés</h2>
            <p class="text-gray-500 font-medium italic mt-1">Supervisez les utilisateurs (Abonnés) de la plateforme.</p>
        </div>
        {{-- BOUTON AJOUTER --}}
        <button @click="showAdd = true" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg transition-all active:scale-95">
            <i class="fa-solid fa-user-plus"></i> Ajouter un Abonné
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#00261C]">
                <tr class="text-white border-b border-gray-100">
                    <th class="px-8 py-4">Nom Complet</th>
                    <th class="px-8 py-4">Email / Tel</th>
                    <th class="px-8 py-4 text-center">Statut</th>
                    <th class="px-8 py-4 text-center">Inscription</th>
                    <th class="px-8 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($abonnes as $abonne)
                <tr class="group hover:bg-gray-50/50 transition-all">
                    <td class="px-8 py-6">
                        <span class="font-black text-[#1B2E58] text-lg">{{ $abonne->nom_complet }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-gray-600 font-medium">{{ $abonne->email }}</p>
                        <p class="text-[10px] text-gray-400 font-bold">{{ $abonne->telephone ?? 'Pas de numéro' }}</p>
                    </td>
                    <td class="px-8 py-6 text-center">
                        {{-- Logique de statut basée sur ton SQL (par défaut abonné est actif ici) --}}
                        <span class="px-4 py-1.5 bg-emerald-100 text-emerald-600 rounded-full text-[10px] font-black uppercase">
                            Actif
                        </span>
                    </td>
                    <td class="px-8 py-6 text-center text-gray-400 font-medium text-sm">
                        {{ $abonne->created_at->format('d M Y') }}
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            {{-- BOUTON MODIFIER --}}
                            <button @click="selected = {{ json_encode($abonne) }}; showEdit = true" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all flex items-center justify-center">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            {{-- BOUTON SUPPRIMER --}}
                            <button @click="selected = { id_user: {{ $abonne->id_user }}, nom_complet: '{{ addslashes($abonne->nom_complet) }}' }; showDelete = true" class="w-9 h-9 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-20 text-center text-gray-400 italic">Aucun abonné trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ==========================================
         MODAL : AJOUTER UN CLIENT
    =========================================== -->
    <div x-show="showAdd" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showAdd = false" class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-2xl font-black text-[#1B2E58]">Nouveau Abonné</h3>
                <button @click="showAdd = false" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="p-10 space-y-5">
                @csrf
                <input type="hidden" name="role" value="abonné">
                <x-input label="Nom Complet" name="nom_complet" required />
                <x-input label="Email" name="email" type="email" required />
                <x-input label="Téléphone" name="telephone" />
                <x-input label="Mot de passe" name="password" type="password" required />
                
                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" @click="showAdd = false" class="px-8 py-4 font-bold text-gray-400">Annuler</button>
                    <button type="submit" class="bg-[#1B2E58] text-white px-10 py-4 rounded-2xl font-bold shadow-xl">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         MODAL : MODIFIER LE CLIENT
    =========================================== -->
    <div x-show="showEdit" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showEdit = false" class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-2xl font-black text-[#1B2E58]">Modifier Profil</h3>
                <button @click="showEdit = false" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <form :action="'/admin/users/update/' + selected.id_user" method="POST" class="p-10 space-y-5">
                @csrf @method('PUT')
                <input type="hidden" name="role" value="abonné">
                <div>
                    <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">Nom Complet</label>
                    <input type="text" name="nom_complet" x-model="selected.nom_complet" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">Email</label>
                    <input type="email" name="email" x-model="selected.email" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold">
                </div>
                <x-input label="Nouveau mot de passe (laisser vide si inchangé)" name="password" type="password" />

                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" @click="showEdit = false" class="px-8 py-4 font-bold text-gray-400">Annuler</button>
                    <button type="submit" class="bg-[#FF9F29] text-white px-10 py-4 rounded-2xl font-bold shadow-xl">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         MODAL : SUPPRIMER
    =========================================== -->
    <div x-show="showDelete" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl relative">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl animate-bounce">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-2">Supprimer l'abonné ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">L'accès de <span class="text-red-600 font-bold" x-text="selected.nom_complet"></span> sera définitivement supprimé.</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold">Annuler</button>
                <form :action="'/admin/users/destroy/' + selected.id_user" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg shadow-red-200">Confirmer</button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection