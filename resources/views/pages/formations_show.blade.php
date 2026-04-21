@extends('layouts.app')

@section('title', 'Formations Détails')

@section('content')

{{-- 1. NAVBAR --}}
@if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
    <header class="sticky top-0 z-[100] w-full shadow-md bg-white">
        @include('components.navbar')
    </header>
@endif

{{-- 2. HERO SECTION --}}
<section class="relative h-[450px] flex flex-col items-center justify-center text-white overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=1920" 
             alt="Background" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-[#1B2E58]/85 mix-blend-multiply"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10 text-center">
        <h1 class="text-5xl md:text-6xl font-black mb-6 tracking-tight leading-none uppercase">
            Nos <br> Formations
        </h1>

        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200 leading-relaxed mb-10 font-medium">
            Propulsez votre carrière avec des programmes d'excellence conçus par Nakayo Corporation.
        </p>
    </div>

    {{-- Fil d'ariane --}}
    <div class="absolute bottom-10 w-full text-center z-10">
        <nav class="flex justify-center items-center gap-2 text-sm font-medium text-gray-300">
            <a href="/" class="hover:text-white transition">Accueil</a>
            <span class="text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
            <span class="text-white">Formations</span>
        </nav>
    </div>
</section>

{{-- 3. CONTENU PRINCIPAL --}}
<section class="py-20 bg-[#F8FAFC] min-h-screen flex items-center">
    <div class="max-w-4xl mx-auto px-6">
        
        <!-- LA CARTE UNIQUE -->
        <div class="bg-white rounded-[4rem] shadow-2xl shadow-slate-200/50 border border-gray-100 overflow-hidden">
            
            {{-- 1. HEADER : IMAGE & TITRE --}}
            <div class="relative h-[400px]">
                @if($formation->image)
                    <img src="{{ asset('storage/' . $formation->image) }}" class="w-full h-full object-cover" alt="">
                @else
                    <div class="w-full h-full bg-[#1B2E58] flex items-center justify-center">
                        <i class="fa-solid fa-graduation-cap text-white text-7xl"></i>
                    </div>
                @endif

                {{-- Overlay Dégradé --}}
                <div class="absolute inset-0 bg-gradient-to-t from-[#1B2E58] via-transparent to-transparent opacity-80"></div>

                {{-- Badge Status --}}
                <div class="absolute top-8 left-8">
                    <span class="bg-[#FF9F29] text-white px-6 py-2 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg">
                        {{ $formation->status }}
                    </span>
                </div>

                {{-- Titre sur l'image --}}
                <div class="absolute bottom-10 left-10 right-10">
                    <h1 class="text-white text-3xl md:text-5xl font-black uppercase tracking-tighter leading-tight">
                        {{ $formation->titre }}
                    </h1>
                </div>
            </div>

            {{-- 2. BARRE DE SPÉCIFICATIONS (Icônes) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 border-b border-gray-50">
                <div class="p-8 flex items-center gap-4 border-r border-gray-50">
                    <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-[#FF9F29]">
                        <i class="fa-solid fa-calendar-check text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Date prévue</span>
                        <span class="text-[#1B2E58] font-bold">{{ \Carbon\Carbon::parse($formation->date_formation)->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="p-8 flex items-center gap-4 border-r border-gray-50">
                    <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-[#FF9F29]">
                        <i class="fa-solid fa-location-dot text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Lieu</span>
                        <span class="text-[#1B2E58] font-bold">{{ $formation->lieu }}</span>
                    </div>
                </div>

                <div class="p-8 flex items-center gap-4">
                    <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-[#FF9F29]">
                        <i class="fa-solid fa-wallet text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Coût</span>
                        <span class="text-[#1B2E58] font-bold">{{ number_format($formation->cout, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>
            </div>

            {{-- 3. CONTENU (DESCRIPTION) --}}
            <div class="p-10 md:p-16">
                <div class="prose prose-lg max-w-none text-slate-600 leading-relaxed">
                    <h3 class="text-[#1B2E58] font-black uppercase text-sm tracking-[3px] mb-6 flex items-center gap-4">
                        À propos de la formation
                        <div class="h-[1px] flex-1 bg-gray-100"></div>
                    </h3>
                    {!! $formation->description !!}
                </div>

                {{-- 4. FOOTER : APPEL À L'ACTION (CONTACT) --}}
                <div class="mt-16 p-10 bg-[#1B2E58] rounded-[3rem] flex flex-col md:flex-row items-center justify-between gap-8 border-b-[8px] border-[#FF9F29]">
                    <div class="text-center md:text-left">
                        <span class="text-white/50 text-[10px] font-black uppercase tracking-widest block mb-1">Prêt à nous rejoindre ?</span>
                        <h4 class="text-white text-2xl font-black uppercase tracking-tighter">Réservez votre place</h4>
                    </div>

                    @php $whatsapp = preg_replace('/[^0-9]/', '', $formation->contact); @endphp

                    <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank" 
                           class="bg-[#FF9F29] text-white px-8 py-5 rounded-2xl font-black uppercase text-[11px] tracking-widest shadow-xl hover:scale-105 transition-transform flex items-center gap-3 w-full sm:w-auto justify-center">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                            WhatsApp
                        </a>
                        
                        <div class="text-white flex flex-col items-center md:items-start">
                            <span class="text-[9px] font-black opacity-40 uppercase tracking-widest">Appel direct</span>
                            <span class="font-bold tracking-tight">{{ $formation->contact }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection