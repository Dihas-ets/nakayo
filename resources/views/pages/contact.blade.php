@extends('layouts.app')

@section('title', 'Contact')

@section('content')


 {{-- 1. HEADER (Déplacé à l'intérieur de la section pour la validité du fichier) --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky top-0 z-[100] w-full shadow-md">
            @include('components.navbar')
        </header>
    @endif

{{-- SECTION 1 : LA CARTE (TOP) --}}
<section class="w-full h-[400px] bg-gray-200">
    @if($settings->google_maps_link)
        <iframe 
            src="https://www.google.com/maps?q={{ urlencode($settings->google_maps_link) }}&output=embed" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    @else
        {{-- Message ou image de remplacement si pas de lien --}}
        <div class="w-full h-full flex items-center justify-center text-gray-500 font-bold italic">
            <i class="fa-solid fa-map-location-dot mr-2"></i> Localisation bientôt disponible
        </div>
    @endif
</section>

{{-- SECTION 2 : TEXTE + FORMULAIRE (BOTTOM) --}}
<section class="py-16 md:py-24 bg-[#F8FAFC] font-sans">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            
            <!-- GAUCHE : TEXTE ET INFOS -->
            <div class="space-y-10">
                <h2 class="text-[#1B2E58] text-4xl md:text-5xl font-black leading-tight">
                    Vous avez une question, un besoin spécifique ou souhaitez en savoir plus sur nos services ?
                </h2>
                <p class="text-gray-500 text-lg leading-relaxed max-w-lg">
                    Notre équipe est à votre écoute et se fera un plaisir de vous accompagner dans toutes vos démarches.
                </p>

                <!-- Liste des contacts -->
                <div class="space-y-6 pt-6">
                    <div class="flex items-center gap-4 group">
                        <i class="fas fa-envelope text-[#FFB75E] text-xl"></i>
                        <p class="text-lg font-bold text-[#1B2E58]">
                            Contact: <span class="text-orange-500 font-medium">{{ $settings->telephone_appel ?? '(+229) 00 00 00 00' }}</span>
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fas fa-map-marker-alt text-[#FFB75E] text-xl"></i>
                        <p class="text-lg font-bold text-[#1B2E58]">
                            Emplacement: <span class="text-gray-500 font-medium">{{ $settings->localisation ?? 'Adresse non définie' }}</span>
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fas fa-clock text-[#FFB75E] text-xl"></i>
                        <p class="text-lg font-bold text-[#1B2E58]">
                            Lun - Ven: <span class="text-gray-500 font-medium">{{ $settings->horaires_ouverture ?? 'Non définis' }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- DROITE : LE FORMULAIRE -->
            <div class="bg-white p-8 md:p-12 rounded-3xl shadow-xl border border-gray-100">
                <h3 class="text-[#1B2E58] text-2xl font-bold mb-4">Envoyez-nous un Message</h3>
                <p class="text-gray-400 text-sm mb-8 leading-relaxed">
                    Veuillez remplir le formulaire ci-dessous pour une demande particulière, et nous vous recontacterons. Vous pouvez également nous appeler. 
                    <span class="text-[#1B2E58] font-bold border-b border-[#1B2E58]">{{ $settings->telephone_appel ?? '(+229) 00 00 00 00' }}</span> et nos spécialistes vous apporteront l'aide nécessaire !
                </p>

                {{-- Message de succès --}}
                @if(session('success'))
                    <div class="bg-emerald-500 text-white p-4 rounded-xl mb-6 font-bold flex items-center gap-3 animate-bounce">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- 1. MESSAGE DE SUCCÈS --}}
@if(session('success'))
    <div class="mb-6 flex items-center p-4 text-emerald-800 border-l-4 border-emerald-500 bg-emerald-50 rounded-r-xl shadow-sm animate-fade-in" role="alert">
        <i class="fas fa-check-circle text-xl mr-3"></i>
        <div class="text-sm font-bold">
            {{ session('success') }}
        </div>
    </div>
@endif

{{-- 2. MESSAGE D'ERREUR GLOBALE (ex: problème serveur) --}}
@if(session('error'))
    <div class="mb-6 flex items-center p-4 text-red-800 border-l-4 border-red-500 bg-red-50 rounded-r-xl shadow-sm" role="alert">
        <i class="fas fa-exclamation-triangle text-xl mr-3"></i>
        <div class="text-sm font-bold">
            {{ session('error') }}
        </div>
    </div>
@endif

                @if(session('success'))
    <div class="p-4 bg-green-100 text-green-700 rounded-xl font-semibold">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="p-4 bg-red-100 text-red-700 rounded-xl font-semibold">
        {{ session('error') }}
    </div>
@endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Nom</label>
                            <input type="text" name="nom" value="{{ old('nom') }}" placeholder="John"
                                class="w-full px-5 py-4 bg-gray-50 border @error('nom') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#1B2E58] outline-none transition">
                            @error('nom')
                                <span class="text-red-500 text-xs mt-1 font-semibold italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom') }}" placeholder="Doe"
                                class="w-full px-5 py-4 bg-gray-50 border @error('prenom') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#1B2E58] outline-none transition">
                            @error('prenom')
                                <span class="text-red-500 text-xs mt-1 font-semibold italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Adresse Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="contact@email.com"
                                class="w-full px-5 py-4 bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#1B2E58] outline-none transition">
                            @error('email')
                                <span class="text-red-500 text-xs mt-1 font-semibold italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Numéro de téléphone"
                                class="w-full px-5 py-4 bg-gray-50 border @error('phone') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#1B2E58] outline-none transition">
                            @error('phone')
                                <span class="text-red-500 text-xs mt-1 font-semibold italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Quel est l'objet de votre demande ?</label>
                        <input type="text" name="objet" value="{{ old('objet') }}" placeholder="Entrez l'objet de votre demande"
                            class="w-full px-5 py-4 bg-gray-50 border @error('objet') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#1B2E58] outline-none transition">
                        @error('objet')
                            <span class="text-red-500 text-xs mt-1 font-semibold italic">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Comment pouvons-nous vous aider ?</label>
                        <textarea name="description" rows="4" placeholder="Votre Message"
                            class="w-full px-5 py-4 bg-gray-50 border @error('description') border-red-500 @else border-gray-200 @enderror rounded-xl outline-none transition focus:ring-2 focus:ring-[#1B2E58]">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-xs mt-1 font-semibold italic">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-[#1B2E58] text-white font-bold py-5 rounded-xl hover:bg-orange-500 transition-all shadow-lg flex items-center justify-center gap-3 group">
                        Soumettre La Demande
                        <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection