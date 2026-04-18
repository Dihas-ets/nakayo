@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12 px-4">
    
    <!-- Ajout du Logo ou lien retour -->
    <a href="/">
            <!-- <img src="{{ $settings->logo ? Storage::url($settings->logo) : url('images/logo-default.png') }}" 
        alt="{{ $settings->nom_agence }}" 
        class="h-42 w-auto object-contain"> -->

        <img src="{{ $settings->logo_url }}" alt="{{ $settings->nom_agence }}" class="h-42 w-auto object-contain">
    </a>

    <div class="max-w-md w-full bg-white p-10 rounded-[2.5rem] shadow-2xl border border-gray-100">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-[#1B2E58] uppercase italic tracking-tighter">Connexion</h2>
            <div class="h-1.5 w-12 bg-[#FFB75E] mx-auto mt-2 rounded-full"></div>
            <p class="text-gray-400 mt-4 text-sm font-medium">Accédez à votre espace sécurisé</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-xl mb-6 text-sm font-bold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-2">Adresse Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#1B2E58] outline-none transition-all" 
                       placeholder="exemple@mail.com">
            </div>
            <div>
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-2">Mot de passe</label>
                <input type="password" name="password" required 
                       class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#1B2E58] outline-none transition-all" 
                       placeholder="••••••••">
            </div>

            <button type="submit" class="w-full py-5 bg-[#1B2E58] rounded-2xl text-white font-black uppercase tracking-widest shadow-xl hover:bg-[#FFB75E] hover:scale-[1.02] active:scale-95 transition-all duration-300">
                Se connecter
            </button>
        </form>

        <!-- <div class="text-center mt-10 flex flex-col gap-2">
            <p class="text-gray-400 text-sm font-medium">
                Pas encore client ? 
                <a href="{{ route('register') }}" class="text-[#FFB75E] font-bold hover:underline ml-1">Créer un compte</a>
            </p>
            <a href="/" class="text-xs text-gray-400 hover:text-[#1B2E58] transition-colors mt-4 italic underline">← Retour au site</a>
        </div> -->
    </div>
</div>
@endsection