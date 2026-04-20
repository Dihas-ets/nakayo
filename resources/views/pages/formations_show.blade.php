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
<section class="py-20 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- GAUCHE : DESCRIPTION -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-[3.5rem] p-10 md:p-16 shadow-sm border border-gray-100">
                    <h2 class="text-3xl font-black text-[#1B2E58] uppercase tracking-tighter mb-10 flex items-center gap-6">
                        <span class="w-12 h-1.5 bg-[#FF9F29] rounded-full"></span>
                        Présentation du programme
                    </h2>
                    
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed font-medium">
                        {!! $formation->description !!}
                    </div>

                    {{-- Points forts pour rassurer sans donner de chiffres --}}
                    <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-8 rounded-[2.5rem] bg-[#F8FAFC] border border-gray-50 flex items-center gap-6">
                            <i class="fa-solid fa-certificate text-[#FF9F29] text-3xl"></i>
                            <div>
                                <h4 class="text-[#1B2E58] font-black uppercase text-xs mb-1">Expertise</h4>
                                <p class="text-[10px] text-gray-400 font-bold uppercase">Formation certifiante</p>
                            </div>
                        </div>
                        <div class="p-8 rounded-[2.5rem] bg-[#F8FAFC] border border-gray-50 flex items-center gap-6">
                            <i class="fa-solid fa-user-tie text-[#FF9F29] text-3xl"></i>
                            <div>
                                <h4 class="text-[#1B2E58] font-black uppercase text-xs mb-1">Coaching</h4>
                                <p class="text-[10px] text-gray-400 font-bold uppercase">Suivi personnalisé</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DROITE : SIDEBAR D'INSCRIPTION -->
            <div class="lg:w-1/3">
                <div class="sticky top-32">
                    <div class="bg-[#1B2E58] rounded-[3.5rem] p-12 shadow-2xl relative overflow-hidden text-center border-b-[12px] border-[#FF9F29]">
                        {{-- Décoration background --}}
                        <div class="absolute -right-16 -top-16 w-48 h-48 bg-white/5 rounded-full"></div>

                        <h3 class="text-white text-2xl font-black uppercase mb-4 relative z-10 tracking-tighter">S'inscrire à ce programme</h3>
                        <p class="text-white/50 text-xs mb-10 relative z-10 leading-relaxed font-medium">
                            Vous souhaitez obtenir plus de détails sur les prochaines sessions ou les modalités d'inscription ?
                        </p>
                        
                        @php 
                            $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? ''); 
                        @endphp
                        
                        <a href="https://wa.me/{{ $whatsappClean }}?text=Bonjour, je souhaite en savoir plus sur la formation : {{ $formation->titre }}" 
                            target="_blank"
                            class="inline-flex items-center justify-center gap-3 w-full bg-[#FF9F29] text-white font-black uppercase text-[11px] tracking-[2px] py-6 rounded-2xl hover:bg-white hover:text-[#1B2E58] transition-all duration-500 shadow-xl group">
                                
                                <!-- Ajout de fa-fw pour une largeur fixe et alignement vertical -->
                                <i class="fa-brands fa-whatsapp text-2xl fa-fw"></i>
                                
                                <!-- On force le texte à ne pas avoir de hauteur de ligne parasite -->
                                <span class="leading-none pt-1">Contact via WhatsApp</span>
                            </a>

                        <div class="mt-10 pt-10 border-t border-white/10">
                            <span class="text-white/30 text-[9px] font-black uppercase tracking-[3px] block mb-2">Conseiller dédié</span>
                            <span class="text-white font-black text-xl tracking-tight">{{ $settings->telephone_whatsapp ?? '+229 00 00 00 00' }}</span>
                        </div>
                    </div>

                    {{-- Badge de réassurance --}}
                    <div class="mt-8 flex items-center gap-4 p-6 justify-center">
                        <i class="fa-solid fa-shield-check text-[#FF9F29]"></i>
                        <span class="text-[10px] font-black text-[#1B2E58] uppercase tracking-widest">Accompagnement garanti</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection