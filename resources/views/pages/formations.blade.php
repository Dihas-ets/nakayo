@extends('layouts.app')

@section('title', 'Formations')

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

{{-- 3. LISTE DES FORMATIONS --}}
<section class="py-20 bg-[#F8FAFC] min-h-screen">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <div class="text-center mb-16">
            <h2 class="text-[#1B2E58] text-3xl md:text-4xl font-black uppercase tracking-tighter mb-4">
                Découvrez nos programmes
            </h2>
            <div class="h-1.5 w-20 bg-[#FF9F29] mx-auto mb-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($formations as $formation)
                <div class="group bg-white rounded-[2.5rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                    
                    <div class="relative h-56 overflow-hidden">
                       
                        <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full">
                            <span class="text-[#1B2E58] text-[10px] font-black uppercase tracking-widest">
                                Expertise
                            </span>
                        </div>
                    </div>

                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="text-xl font-black text-[#1B2E58] mb-4 uppercase tracking-tighter leading-tight group-hover:text-[#FF9F29] transition-colors">
                            {{ $formation->titre }}
                        </h3>

                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-8 italic">
                            "{{ $formation->description_courte ?? 'Description à venir...' }}"
                        </p>

                        <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Investissement</span>
                                <span class="text-lg font-black text-[#1B2E58]">{{ number_format($formation->prix ?? 0, 0, ',', ' ') }} FCFA</span>
                            </div>

                            {{-- CORRECTION ICI : Le nom de la route doit correspondre à celui dans web.php --}}
                            <a href="{{ route('pages.formations_show', $formation->id_formation) }}" 
                            class="w-12 h-12 bg-gray-50 text-[#1B2E58] rounded-full flex items-center justify-center hover:bg-[#1B2E58] hover:text-white transition-all shadow-sm">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-400 font-bold uppercase tracking-widest">Aucune formation disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection