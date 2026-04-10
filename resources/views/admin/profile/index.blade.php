@extends('layouts.admin')

@section('title', 'Mon Profil')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">
    
    <!-- HEADER -->
    <div>
        <h2 class="text-3xl font-black text-[#1B2E58]">Paramètres du compte</h2>
        <p class="text-gray-500 font-medium">Gérez vos informations personnelles et la sécurité de votre accès.</p>
    </div>

    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-4 rounded-2xl shadow-lg flex items-center gap-3">
            <i class="fa-solid fa-circle-check"></i>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- COLONNE GAUCHE : INFOS GÉNÉRALES -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-blue-50 text-[#1B2E58] rounded-2xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#1B2E58]">Informations personnelles</h3>
                </div>

                <form action="{{ route('admin.profile.info') }}" method="POST" class="space-y-6">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-input label="Nom Complet" name="nom_complet" :value="$user->nom_complet" required />
                        <x-input label="Téléphone" name="telephone" :value="$user->telephone" />
                    </div>
                    <x-input label="Adresse Email" name="email" type="email" :value="$user->email" required />
                    
                    <div class="pt-4">
                        <button type="submit" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-10 py-4 rounded-2xl font-bold transition-all shadow-lg">
                            Mettre à jour mes infos
                        </button>
                    </div>
                </form>
            </div>

            <!-- SÉCURITÉ : MOT DE PASSE -->
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-orange-50 text-[#FF9F29] rounded-2xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-shield-lock"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#1B2E58]">Sécurité du compte</h3>
                </div>

                <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-6">
                    @csrf @method('PUT')
                    <x-input label="Mot de passe actuel" name="current_password" type="password" required />
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-input label="Nouveau mot de passe" name="new_password" type="password" required />
                        <x-input label="Confirmer le mot de passe" name="new_password_confirmation" type="password" required />
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="bg-[#FF9F29] hover:bg-[#e88f24] text-white px-10 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-orange-100">
                            Changer mon mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- COLONNE DROITE : RÉCAPITULATIF STATUT -->
        <div class="space-y-8">
            <div class="bg-[#00261C] rounded-[2.5rem] p-10 text-white shadow-xl relative overflow-hidden">
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-white/10 rounded-full flex items-center justify-center text-4xl font-black italic mb-6 border-4 border-white/20">
                        {{ substr($user->nom_complet, 0, 1) }}
                    </div>
                    <h4 class="text-xl font-black">{{ $user->nom_complet }}</h4>
                    <span class="px-4 py-1 bg-[#FF9F29] text-white rounded-full text-[10px] font-black uppercase mt-3 tracking-widest">
                        {{ $user->role }}
                    </span>
                    
                    <div class="w-full mt-10 pt-10 border-t border-white/10 space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="opacity-60">ID Utilisateur</span>
                            <span class="font-bold">#{{ $user->id_user }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="opacity-60">Membre depuis</span>
                            <span class="font-bold">{{ $user->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
                <!-- Déco fond -->
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/5 rounded-full"></div>
            </div>
        </div>

    </div>
</div>
@endsection