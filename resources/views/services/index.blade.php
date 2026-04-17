@extends('layouts.app')

@section('content')

{{-- 1. NAVBAR --}}
<header class="sticky top-0 z-[100] w-full shadow-md bg-white">
    @include('components.navbar')
</header>



    {{-- 1. HERO SECTION --}}
    <section class="relative bg-[#1B2E58] py-20 lg:py-32 overflow-hidden">
        {{-- Décoration d'arrière-plan --}}
        <div class="absolute top-0 right-0 w-1/3 h-full opacity-10 pointer-events-none">
            <svg viewBox="0 0 500 500" class="w-full h-full fill-white">
                <path d="M50,100 Q150,50 250,100 T450,100" fill="none" stroke="currentColor" stroke-width="2"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <nav class="flex mb-4 text-orange-400 text-xs font-bold uppercase tracking-widest">
                    <a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a>
                    <span class="mx-2">/</span>
                    <span class="text-white/60">Nos Services</span>
                </nav>
                <h1 class="text-4xl lg:text-6xl font-black text-white uppercase italic leading-tight tracking-tighter">
                    Expertise & Solutions <span class="text-[#FF9F29]">Sur-Mesure</span>
                </h1>
                <p class="mt-6 text-xl text-white/80 leading-relaxed">
                    Nakayo Corporation intervient dans plusieurs secteurs stratégiques pour accompagner votre développement au Bénin et à l'international.
                </p>
            </div>
        </div>
    </section>

    {{-- 2. GRILLE DES SERVICES --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            @if($services->isEmpty())
                <div class="text-center py-20 bg-white rounded-[3rem] shadow-sm">
                    <i class="fas fa-layer-group text-6xl text-gray-200 mb-6"></i>
                    <h2 class="text-2xl font-bold text-[#1B2E58]">Aucun service publié pour le moment</h2>
                    <p class="text-gray-500 mt-2">Revenez très bientôt pour découvrir nos offres.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($services as $index => $service)
                        <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col border border-gray-100 h-full">
                            
                            {{-- Image du service --}}
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $service->media ? asset('storage/' . $service->media) : asset('images/default-service.jpg') }}" 
                                     alt="{{ $service->titre }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                
                                {{-- Badge flottant --}}
                                <div class="absolute top-6 right-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-2xl shadow-lg">
                                    <span class="text-[#1B2E58] font-black text-[10px] uppercase tracking-widest">
                                        Pôle Expert
                                    </span>
                                </div>
                            </div>

                            {{-- Contenu du service --}}
                            <div class="p-8 lg:p-10 flex flex-col flex-1">
                                <h3 class="text-2xl font-black text-[#1B2E58] uppercase italic leading-tight mb-4 group-hover:text-[#FF9F29] transition-colors">
                                    {{ $service->titre }}
                                </h3>
                                
                                <p class="text-gray-500 leading-relaxed mb-8 line-clamp-3">
                                    {{ $service->courte_description }}
                                </p>

                                {{-- Lien et icône --}}
                                <div class="mt-auto flex items-center justify-between pt-6 border-t border-gray-50">
                                    <a href="{{ route('services.show', $service->id_service) }}" 
                                       class="text-[#1B2E58] font-black uppercase text-xs tracking-widest flex items-center gap-2 hover:gap-4 transition-all">
                                        En savoir plus
                                        <i class="fas fa-arrow-right text-[#FF9F29]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- 3. SECTION CTA (Appel à l'action) --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-[#FF9F29] rounded-[3rem] p-10 lg:p-20 flex flex-col lg:flex-row items-center justify-between gap-10 shadow-2xl shadow-orange-200">
                <div class="text-center lg:text-left text-[#1B2E58]">
                    <h2 class="text-3xl lg:text-4xl font-black uppercase italic leading-tight">
                        Un projet spécifique <br class="hidden lg:block"> en tête ?
                    </h2>
                    <p class="mt-4 text-lg font-medium opacity-80">
                        Nos experts sont prêts à concevoir une solution adaptée à vos besoins.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
                    <a href="{{ route('contact') }}" class="bg-[#1B2E58] text-white px-10 py-5 rounded-2xl font-black uppercase tracking-widest text-center shadow-xl hover:bg-white hover:text-[#1B2E58] transition-all">
                        Demander un devis
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection