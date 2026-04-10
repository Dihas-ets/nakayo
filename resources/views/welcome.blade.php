@extends('layouts.app')


  {{-- HEADER : Top-bar + Navbar --}}
    {{-- On vérifie que la route actuelle n'est pas dans la liste noire --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky top-0 z-[100] w-full shadow-md">
            
            @include('components.navbar')
        </header>
    @endif
    
@section('content')

 

    <!-- Hero Section -->
<section x-data="{ 
    activeSlide: 1, 
    slides: {{ $services->map(function($s) {
        return [
            'title' => $s->titre,
            'subtitle' => $s->courte_description,
            'img' => $s->media ? asset('storage/' . $s->media) : asset('images/default-hero.jpg')
        ];
    })->toJson() }},
    next() { this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1 },
    prev() { this.activeSlide = this.activeSlide === 1 ? this.slides.length : this.activeSlide - 1 },
    init() { if(this.slides.length > 0) { setInterval(() => { this.next() }, 7000) } } 
}" 
class="relative w-full h-[500px] overflow-hidden bg-black ">

    <template x-for="(slide, index) in slides" :key="index">
        {{-- Suppression des x-transition pour un affichage instantané --}}
        <div x-show="activeSlide === index + 1" 
             class="absolute inset-0 w-full h-full" x-cloak>
            
            <img :src="slide.img" 
                 class="absolute inset-0 w-full h-full object-cover z-0"
                 alt="Hero Image">

            <div class="absolute inset-0 z-10 bg-[#001C8E]/60 lg:w-[120%] mix-blend-multiply" 
                 style="mask-image: radial-gradient(circle at 110% 50%, transparent 55%, black 55%);
                        -webkit-mask-image: radial-gradient(circle at 110% 50%, transparent 55%, black 55%);">
            </div>

            <div class="relative h-full max-w-7xl mx-auto px-6 md:px-16 flex flex-col justify-center z-20">
                <div class="max-w-full sm:max-w-xl lg:max-w-2xl">
                    
                    <div class="mb-6">
                        <h1 class="text-white text-3xl sm:text-4xl lg:text-5xl font-black leading-[1.1] uppercase tracking-tighter"
                            x-text="slide.title"></h1>
                    </div>
                    
                    <div class="h-2 bg-[#FF9F29] rounded-full mb-8 shadow-lg w-32"></div>

                    <div class="mb-10">
                        <p class="text-white/90 text-base sm:text-lg lg:text-xl leading-relaxed font-medium"
                           x-text="slide.subtitle"></p>
                    </div>
                    
                    <div>
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center gap-4 bg-[#FF9F29] text-[#1B2E58] px-8 py-4 rounded-2xl font-black uppercase text-sm sm:text-base hover:bg-white hover:text-[#FF9F29] transition-none group shadow-2xl">
                            Découvrir nos solutions
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <template x-if="slides.length > 1">
        <div class="absolute inset-y-0 left-0 right-0 hidden md:flex justify-between items-center px-8 z-40 pointer-events-none">
            <button @click="prev()" class="pointer-events-auto w-14 h-14 flex items-center justify-center rounded-full bg-white/10 text-white/60 border border-white/10 hover:bg-[#FF9F29] hover:text-[#1B2E58] transition-none backdrop-blur-md">
                <i class="fas fa-chevron-left text-xl"></i>
            </button>
            <button @click="next()" class="pointer-events-auto w-14 h-14 flex items-center justify-center rounded-full bg-white/10 text-white/60 border border-white/10 hover:bg-[#FF9F29] hover:text-[#1B2E58] transition-none backdrop-blur-md">
                <i class="fas fa-chevron-right text-xl"></i>
            </button>
        </div>
    </template>

    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-40 flex items-center gap-3">
        <template x-for="i in slides.length" :key="i">
            <button @click="activeSlide = i" 
                    :class="activeSlide === i ? 'bg-[#FF9F29] w-12' : 'bg-white/20 w-3'"
                    class="h-2.5 rounded-full"></button>
        </template>
    </div>
</section>

    <!--  section de service -->

<section class="py-10 bg-white overflow-hidden">
    <div class="max-w-[1600px] mx-auto px-6 lg:px-12">
        
        <!-- Titre de la section -->
        <div class="text-center mb-12 reveal-on-scroll opacity-0 transform -translate-y-10 transition-all duration-1000">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-[#1B2E58] uppercase tracking-tighter">
                Nos Services
            </h2>
            <div class="h-1 w-20 bg-[#FF9F29] mx-auto mt-3 rounded-full"></div>
        </div>

        <!-- GRILLE DYNAMIQUE -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            
            @php
                // On définit les couleurs de dégradé pour garder ton design varié
                $colors = [
                    ['from' => '#005C97', 'hover' => '#005C97'], // Piscine Style
                    ['from' => '#1B2E58', 'hover' => '#1B2E58'], // Immobilier Style
                    ['from' => '#CC8B00', 'hover' => '#CC8B00'], // Papeterie Style
                    ['from' => '#D81159', 'hover' => '#D81159'], // Savon Style
                    ['from' => '#2D5A27', 'hover' => '#2D5A27'], // Agro Style
                ];
            @endphp

            @foreach($services as $index => $service)
                @php 
                    // On boucle sur les 5 couleurs pour chaque carte
                    $color = $colors[$index % count($colors)];
                    
                    // On génère le slug pour la route (ex: "Construction Piscine" -> "construction-piscine")
                    $slug = Str::slug($service->titre); 
                @endphp

                <div class="reveal-on-scroll opacity-0 transform translate-y-20 transition-all duration-1000" 
                     style="transition-delay: {{ ($index + 1) * 100 }}ms">
                    <div class="relative group h-[250px] rounded-[2rem] overflow-hidden border-4 border-gray-100 shadow-sm transition-transform duration-500 hover:scale-[1.02]">
                        
                        <!-- Image Dynamique -->
                        <img src="{{ $service->media ? asset('storage/' . $service->media) : asset('images/default-service.jpg') }}" 
                             alt="{{ $service->titre }}" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <!-- Overlay avec couleur dynamique -->
                        <div class="absolute inset-0 opacity-90 transition-opacity duration-500 group-hover:opacity-100"
                             style="background: linear-gradient(to top, {{ $color['from'] }} 0%, {{ $color['from'] }}4D 70%, transparent 100%);">
                        </div>

                        <!-- Contenu -->
                        <div class="absolute bottom-6 left-6 right-6 text-white z-10">
                            <h3 class="text-lg font-black leading-tight mb-4 uppercase line-clamp-2">
                                {{ $service->titre }}
                            </h3>
                            
                            {{-- On utilise le titre pour matcher ton mapping dans les routes si tu n'as pas de colonne slug --}}
                            <a href="{{ route('services.show', Str::slug($service->titre)) }}" 
                               class="inline-flex items-center gap-2 bg-[#FF9F29] backdrop-blur-md border border-white/30 px-4 py-2 rounded-full font-bold uppercase text-[9px] tracking-widest transition-all hover:bg-white"
                               style="color: white; --hover-color: {{ $color['from'] }};"
                               onmouseover="this.style.color='{{ $color['from'] }}'"
                               onmouseout="this.style.color='white'">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

<!-- Petite section à propos -->
<section class="py-10 bg-white overflow-hidden ">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <div class="text-center mb-12 reveal-on-scroll opacity-0 transform -translate-y-10 transition-all duration-1000">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-[#1B2E58] uppercase tracking-tighter">
                À propos de nous
            </h2>
            <div class="h-1 w-16 bg-[#FF9F29] mx-auto mt-0 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            
            <div class="relative reveal-on-scroll opacity-0 transform -translate-x-10 transition-all duration-1000">
                <div class="relative">
                    <img src="{{ asset('images/8.jpeg') }}" 
                         alt="Équipe NAKAYO" 
                         class="rounded-sm shadow-sm w-full object-cover h-[400px]">
                </div>

                <div class="absolute -bottom-8 -left-4 lg:-left-8 bg-[#1B2E58] p-8 lg:p-10 shadow-2xl z-20 max-w-[300px]">
                    <p class="text-white text-base lg:text-lg font-medium leading-tight">
                        Des services conçus avec des experts pour vous offrir fiabilité, transparence et performance.
                    </p>
                </div>
            </div>

            <div class="lg:pl-5 space-y-4">
                <h2 class="text-[#1B2E58] text-lg font-bold leading-snug">
                    NAKAYO COORPORATION Sarl est une entreprise privée diversifiée, née de la vision de fédérer des secteurs clés du développement.
                </h2>

                <p class="text-gray-500 text-base leading-relaxed">
                    Nous opérons dans la construction de piscines, l’immobilier, la papeterie, la savonnerie et l’agro-industrie. Notre objectif est d’offrir des services fiables et de qualité.
                </p>

                <div class="pt-2">
                    <a href="{{ route('about') }}" class="inline-flex items-center gap-3 bg-[#1B2E58] text-white px-6 py-3 rounded-lg font-bold text-sm hover:bg-[#FF9F29] transition-all duration-300 shadow-lg">
                        En Savoir Plus
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SCRIPT D'ANIMATION (À copier une seule fois dans ton welcome.blade.php ou layout) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Ajout des classes de visibilité
                    entry.target.classList.remove('opacity-0', '-translate-x-20', 'translate-x-20', '-translate-y-10', 'translate-y-10');
                    entry.target.classList.add('opacity-100', 'translate-x-0', 'translate-y-0');
                } else {
                    // Optionnel : Retirer pour rejouer l'animation en remontant
                    const rect = entry.target.getBoundingClientRect();
                    if (rect.top > 0) { // Si l'élément sort par le bas
                        // On réinitialise les classes selon le type (on peut simplifier en remettant l'opacité)
                        entry.target.classList.add('opacity-0');
                        entry.target.classList.remove('opacity-100');
                        
                        // Note : Pour un effet parfait de va-et-vient, il faudrait remettre 
                        // les translate spécifiques, mais l'opacité seule suffit souvent pour un look propre.
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            observer.observe(el);
        });
    });
</script>


<section class="py-0  font-sans overflow-hidden">
    <div class="max-w-7xl mx-auto px-2 lg:px-12">
        
        <!-- Titre de la section -->
        <div class="text-center mb-12 reveal-on-scroll opacity-0 transition-all duration-1000 transform translate-y-10">
            <h2 class="text-3xl lg:text-4xl font-black text-[#1B2E58] uppercase tracking-tighter ">
                Vous êtes ?
            </h2>
            <div class="h-1.5 w-20 bg-[#FF9F29] mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Carte 1 : Particulier -->
            <div class="reveal-on-scroll opacity-0 translate-y-20 transition-all duration-1000 ease-out">
                <div class="group relative bg-white rounded-[2rem] p-10 flex flex-col items-center border border-gray-100 shadow-sm transition-all duration-500 transform hover:-translate-y-4 hover:bg-[#1B2E58] h-full cursor-pointer">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-10 -mt-10 transition-all duration-500 group-hover:bg-white/10 group-hover:scale-[3]"></div>
                    <div class="relative z-10 w-24 h-24 bg-[#F8FAFC] rounded-2xl flex items-center justify-center mb-8 transition-all duration-500 group-hover:bg-[#FF9F29] group-hover:rotate-[360deg]">
                        <i class="fas fa-user-tie text-5xl text-[#1B2E58] transition-colors duration-500 group-hover:text-white"></i>
                    </div>
                    <h3 class="relative z-10 text-2xl font-black text-[#1B2E58] mb-8 transition-colors duration-500 group-hover:text-white uppercase italic">Particulier</h3>
                    <div class="relative z-10 mt-auto w-full">
                        <a href="https://wa.me/2290166556161" target="_blank" class="inline-block w-full text-center bg-[#FF9F29] text-white px-6 py-4 rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-500 group-hover:bg-white group-hover:text-[#1B2E58] shadow-lg">En savoir plus</a>
                    </div>
                </div>
            </div>

            <!-- Carte 2 : TPE / PME -->
            <div class="reveal-on-scroll opacity-0 translate-y-20 transition-all duration-1000 ease-out delay-150">
                <div class="group relative bg-white rounded-[2rem] p-10 flex flex-col items-center border border-gray-100 shadow-sm transition-all duration-500 transform hover:-translate-y-4 hover:bg-[#1B2E58] h-full cursor-pointer">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-10 -mt-10 transition-all duration-500 group-hover:bg-white/10 group-hover:scale-[3]"></div>
                    <div class="relative z-10 w-24 h-24 bg-[#F8FAFC] rounded-2xl flex items-center justify-center mb-8 transition-all duration-500 group-hover:bg-[#FF9F29] group-hover:rotate-[360deg]">
                        <i class="fas fa-city text-5xl text-[#1B2E58] transition-colors duration-500 group-hover:text-white"></i>
                    </div>
                    <h3 class="relative z-10 text-2xl font-black text-[#1B2E58] mb-8 transition-colors duration-500 group-hover:text-white uppercase italic">TPE / PME</h3>
                    <div class="relative z-10 mt-auto w-full">
                        <a href="https://wa.me/2290166556161" target="_blank" class="inline-block w-full text-center bg-[#FF9F29] text-white px-6 py-4 rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-500 group-hover:bg-white group-hover:text-[#1B2E58] shadow-lg">En savoir plus</a>
                    </div>
                </div>
            </div>

            <!-- Carte 3 : Institution -->
            <div class="reveal-on-scroll opacity-0 translate-y-20 transition-all duration-1000 ease-out delay-300">
                <div class="group relative bg-white rounded-[2rem] p-10 flex flex-col items-center border border-gray-100 shadow-sm transition-all duration-500 transform hover:-translate-y-4 hover:bg-[#1B2E58] h-full cursor-pointer">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-10 -mt-10 transition-all duration-500 group-hover:bg-white/10 group-hover:scale-[3]"></div>
                    <div class="relative z-10 w-24 h-24 bg-[#F8FAFC] rounded-2xl flex items-center justify-center mb-8 transition-all duration-500 group-hover:bg-[#FF9F29] group-hover:rotate-[360deg]">
                        <i class="fas fa-landmark text-5xl text-[#1B2E58] transition-colors duration-500 group-hover:text-white"></i>
                    </div>
                    <h3 class="relative z-10 text-2xl font-black text-[#1B2E58] mb-8 transition-colors duration-500 group-hover:text-white uppercase italic">Institution</h3>
                    <div class="relative z-10 mt-auto w-full">
                        <a href="https://wa.me/2290166556161" target="_blank" class="inline-block w-full text-center bg-[#FF9F29] text-white px-6 py-4 rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-500 group-hover:bg-white group-hover:text-[#1B2E58] shadow-lg">En savoir plus</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SCRIPT D'ANIMATION (Bidirectionnel) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1, // Déclenche dès que 10% de l'élément est visible
            rootMargin: '0px 0px -50px 0px' // Petite marge pour anticiper l'animation
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Quand l'élément entre dans l'écran (en descendant ou montant)
                    entry.target.classList.remove('opacity-0', 'translate-y-20', 'translate-y-10');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                } else {
                    // Quand l'élément sort de l'écran (on le remet en position initiale)
                    // On vérifie le haut de l'élément pour ne pas le faire disparaître trop tôt
                    const rect = entry.target.getBoundingClientRect();
                    if (rect.top > 0) { // Si l'élément sort par le bas de l'écran
                        entry.target.classList.add('opacity-0', 'translate-y-20');
                        entry.target.classList.remove('opacity-100', 'translate-y-0');
                    }
                }
            });
        }, observerOptions);

        // On cible tous les éléments à animer
        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            observer.observe(el);
        });
    });
</script>

<!-- 1. Section avec un padding plus confortable (py-10) -->
<section class="py-10 bg-white font-sans overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <!-- EN-TÊTE : Titre au CENTRE et Lien à DROITE -->
        <div class="relative flex items-center justify-center mb-10 reveal-on-scroll">
            <div class="text-center">
                <h2 class="text-2xl lg:text-3xl font-black text-[#1B2E58] uppercase tracking-tighter">
                    Récents articles
                </h2>
                <div class="h-1.5 w-20 bg-[#FF9F29] mx-auto mt-2 rounded-full shadow-sm"></div>
            </div>

            <!-- Bouton à droite -->
            <div class="absolute right-0 top-1/2 -translate-y-1/2 hidden md:block">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-[#FF9F29] font-black uppercase text-[11px] tracking-[0.2em] group">
                    Voir tout le blog
                    <i class="fas fa-arrow-right text-[10px] transition-transform group-hover:translate-x-2"></i>
                </a>
            </div>
        </div>

        <!-- 2. Grille avec un espacement équilibré (gap-8) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
            
            <!-- BLOC GAUCHE (Article à la une) -->
            <div class="lg:col-span-7">
                <div class="relative group cursor-pointer h-full flex flex-col">
                    <!-- Image agrandie (380px) -->
                    <div class="h-[380px] overflow-hidden rounded-[2rem] shadow-lg flex-shrink-0">
                        <img src="{{ asset('images/3.jpg') }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 bg-gray-100"
                             alt="Expertise">
                    </div>
                    
                    <!-- Carte Texte avec plus de padding -->
                    <div class="relative -mt-28 mx-4 lg:mx-8 bg-white rounded-3xl shadow-xl p-6 lg:p-8 border border-gray-50 z-10 transition-transform duration-300 group-hover:-translate-y-2 flex-grow">
                        <div class="absolute -top-3 left-6 bg-[#FF9F29] text-[#1B2E58] px-4 py-1.5 text-[10px] font-black uppercase tracking-widest rounded-md">
                            Piscines & Loisirs
                        </div>

                        <h3 class="text-[#1B2E58] text-xl lg:text-2xl font-black leading-tight mb-4 mt-2 group-hover:text-[#FF9F29] transition-colors">
                            Expertise Piscine : Sécuriser et entretenir votre bassin
                        </h3>
                        
                        <p class="text-gray-500 text-sm leading-relaxed mb-6 opacity-90 line-clamp-3">
                            La construction d'une piscine est un investissement majeur. Découvrez nos conseils d'experts pour maintenir une eau cristalline tout au long de l'année.
                        </p>

                        <div class="flex items-center justify-between text-gray-400 text-[10px] font-bold uppercase tracking-widest border-t border-gray-50 pt-4">
                            <span class="flex items-center gap-2">
                                <i class="far fa-calendar-alt text-[#FF9F29]"></i> 28 Mars, 2026
                            </span>
                            <span class="text-[#1B2E58]/40 italic">Nakayo Group</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BLOC DROITE (Liste d'articles) -->
            <div class="lg:col-span-5 flex flex-col">
                <!-- 3. Espacement vertical plus large (space-y-6) -->
                <div class="space-y-6 h-full flex flex-col justify-between">
                    
                    <!-- Item 1 (Miniature w-28 h-24) -->
                    <div class="flex gap-5 group cursor-pointer items-center p-3 rounded-2xl hover:bg-gray-50 transition-all">
                        <div class="w-28 h-24 flex-shrink-0 overflow-hidden rounded-xl shadow-sm">
                            <img src="{{ asset('images/6.webp') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="flex-1">
                            <span class="text-[#FF9F29] text-[9px] font-black uppercase tracking-widest mb-1 inline-block">Immobilier</span>
                            <h4 class="text-[#1B2E58] text-base font-bold mb-1 leading-snug group-hover:text-[#FF9F29] transition-colors line-clamp-2">Les 5 zones à fort potentiel pour investir à Cotonou</h4>
                            <div class="text-gray-400 text-[9px] font-bold uppercase italic">24 Mars, 2026</div>
                        </div>
                    </div>

                    <div class="h-px bg-gray-100 mx-3"></div>

                    <!-- Item 2 -->
                    <div class="flex gap-5 group cursor-pointer items-center p-3 rounded-2xl hover:bg-gray-50 transition-all">
                        <div class="w-28 h-24 flex-shrink-0 overflow-hidden rounded-xl shadow-sm">
                            <img src="{{ asset('images/1.jpg') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="flex-1">
                            <span class="text-[#FF9F29] text-[9px] font-black uppercase tracking-widest mb-1 inline-block">Hygiène</span>
                            <h4 class="text-[#1B2E58] text-base font-bold mb-1 leading-snug group-hover:text-[#FF9F29] transition-colors line-clamp-2">Pourquoi privilégier nos savons artisanaux NAKAYO ?</h4>
                            <div class="text-gray-400 text-[9px] font-bold uppercase italic">20 Mars, 2026</div>
                        </div>
                    </div>

                    <div class="h-px bg-gray-100 mx-3"></div>

                    <!-- Item 3 -->
                    <div class="flex gap-5 group cursor-pointer items-center p-3 rounded-2xl hover:bg-gray-50 transition-all">
                        <div class="w-28 h-24 flex-shrink-0 overflow-hidden rounded-xl shadow-sm">
                            <img src="{{ asset('images/9.jpg') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="flex-1">
                            <span class="text-[#FF9F29] text-[9px] font-black uppercase tracking-widest mb-1 inline-block">Agro-industrie</span>
                            <h4 class="text-[#1B2E58] text-base font-bold mb-1 leading-snug group-hover:text-[#FF9F29] transition-colors line-clamp-2">Moderniser l'élevage pour une autonomie alimentaire</h4>
                            <div class="text-gray-400 text-[9px] font-bold uppercase italic">15 Mars, 2026</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-10 bg-white font-sans overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <div class="text-center max-w-3xl mx-auto mb-10 reveal-on-scroll opacity-0 transform -translate-y-10 transition-all duration-1000">
            <div class="text-center mb-4">
                <h2 class="text-2xl lg:text-3xl font-extrabold text-[#1B2E58] uppercase tracking-tighter ">
                    Nos Réalisations
                </h2>
                <div class="h-1 w-16 bg-[#FF9F29] mx-auto mt-2 rounded-full"></div>
            </div>
            <p class="text-gray-500 text-base">
                La preuve de notre savoir-faire à travers nos projets emblématiques au Bénin.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-3 h-auto md:h-[450px]">
            
            <div class="md:col-span-2 md:row-span-2 relative group overflow-hidden rounded-2xl shadow-md reveal-on-scroll opacity-0 transform -translate-x-10 transition-all duration-1000 delay-200 h-[300px] md:h-full">
                <img src="{{ asset('images/3.jpg') }}" alt="Piscine Olympique" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                
                <div class="absolute inset-0 bg-gradient-to-t from-[#1B2E58] via-[#1B2E58]/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
                    <span class="text-[#FF9F29] font-black uppercase text-[10px] tracking-widest mb-1">Construction Piscine</span>
                    <h3 class="text-white text-xl font-bold italic">Résidence Azur - Cotonou</h3>
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-[#1B2E58] mt-3 hover:bg-[#FF9F29] hover:text-white transition-all transform hover:rotate-90">
                        <i class="fas fa-plus text-xs"></i>
                    </a>
                </div>
            </div>

            <div class="md:col-span-2 md:row-span-1 relative group overflow-hidden rounded-2xl shadow-md reveal-on-scroll opacity-0 transform translate-x-10 transition-all duration-1000 delay-400 h-[200px] md:h-full">
                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1200" alt="Villa Moderne" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-[#1B2E58]/90 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-5">
                    <span class="text-[#FF9F29] font-black uppercase text-[9px] tracking-widest">Immobilier</span>
                    <h4 class="text-white text-lg font-bold italic">Complexe Nakayo</h4>
                </div>
            </div>

            <div class="md:col-span-1 md:row-span-1 relative group overflow-hidden rounded-2xl shadow-md reveal-on-scroll opacity-0 transform translate-y-10 transition-all duration-1000 delay-600 h-[200px] md:h-full">
                <img src="https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?q=80&w=800" alt="Ferme Agro" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                <div class="absolute inset-0 bg-[#1B2E58]/80 opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-center items-center text-center p-4">
                    <h4 class="text-white font-bold italic uppercase text-[10px]">Ferme Pilote Ouidah</h4>
                </div>
            </div>

            <div class="md:col-span-1 md:row-span-1 relative group overflow-hidden rounded-2xl shadow-md reveal-on-scroll opacity-0 transform translate-y-10 transition-all duration-1000 delay-800 h-[200px] md:h-full">
                <img src="https://images.unsplash.com/photo-1605264964528-06403738d6dc?q=80&w=800" alt="Unité Savon" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                <div class="absolute inset-0 bg-[#1B2E58]/80 opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-center items-center text-center p-4">
                    <h4 class="text-white font-bold italic uppercase text-[10px]">Production Hygiène</h4>
                </div>
            </div>

        </div>
    </div>
</section>





<section class="bg-[#1B2E58] py-10 font-sans overflow-hidden relative">
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 L100 0 Z" stroke="white" stroke-width="0.1"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-y-8 gap-x-4 text-center items-start">

            <div x-data="counter(61, 'K+')" x-init="start()" class="flex flex-col items-center group">
                <div class="mb-3 transition-transform duration-500 group-hover:-translate-y-1">
                    <svg width="50" height="50" viewBox="0 0 64 64" fill="none" stroke="white" stroke-width="1.2">
                        <path d="M32 30C38.6274 30 44 24.6274 44 18C44 11.3726 38.6274 6 32 6C25.3726 6 20 11.3726 20 18C20 24.6274 25.3726 30 32 30Z"/>
                        <path d="M12 58C12 46.9543 20.9543 38 32 38C43.0457 38 52 46.9543 52 58" stroke-linecap="round"/>
                        <circle cx="50" cy="20" r="4" fill="#FF9F29" stroke="none"/>
                    </svg>
                </div>
                <div class="text-white text-2xl font-black mb-1 tracking-tighter">
                    <span x-text="displayValue">0</span><span x-text="suffix"></span>
                </div>
                <div class="text-[#FF9F29] text-[9px] font-black uppercase tracking-[0.2em]">Clients</div>
            </div>

            <div x-data="counter(25, '+')" x-init="start()" class="flex flex-col items-center group">
                <div class="mb-3 transition-transform duration-500 group-hover:-translate-y-1">
                    <svg width="50" height="50" viewBox="0 0 64 64" fill="none" stroke="white" stroke-width="1.2">
                        <path d="M32 8L54 18V46L32 56L10 46V18L32 8Z"/>
                        <path d="M10 18L32 28L54 18" />
                        <path d="M32 28V56" />
                        <path d="M43 13L43 22" stroke="#FF9F29" stroke-width="2"/>
                    </svg>
                </div>
                <div class="text-white text-2xl font-black mb-1 tracking-tighter">
                    <span x-text="displayValue">0</span><span x-text="suffix"></span>
                </div>
                <div class="text-[#FF9F29] text-[9px] font-black uppercase tracking-[0.2em]">Produits</div>
            </div>

            <div x-data="counter(12, '+')" x-init="start()" class="flex flex-col items-center group">
                <div class="mb-3 transition-transform duration-500 group-hover:-translate-y-1">
                    <svg width="50" height="50" viewBox="0 0 64 64" fill="none" stroke="white" stroke-width="1.2">
                        <path d="M8 24L32 12L56 24L32 36L8 24Z"/>
                        <path d="M16 28V42C16 42 22 48 32 48C42 48 48 42 48 42V28"/>
                        <path d="M56 24V36" />
                        <circle cx="32" cy="24" r="3" fill="#FF9F29" stroke="none"/>
                    </svg>
                </div>
                <div class="text-white text-2xl font-black mb-1 tracking-tighter">
                    <span x-text="displayValue">0</span><span x-text="suffix"></span>
                </div>
                <div class="text-[#FF9F29] text-[9px] font-black uppercase tracking-[0.2em]">Formations</div>
            </div>

            <div x-data="counter(300, '+')" x-init="start()" class="flex flex-col items-center group">
                <div class="mb-3 transition-transform duration-500 group-hover:-translate-y-1">
                    <svg width="50" height="50" viewBox="0 0 64 64" fill="none" stroke="white" stroke-width="1.2">
                        <rect x="12" y="20" width="40" height="32" rx="2"/>
                        <path d="M24 20V14C24 12.8954 24.8954 12 26 12H38C39.1046 12 40 12.8954 40 14V20"/>
                        <path d="M12 32H52" />
                        <path d="M32 32V42" stroke="#FF9F29" stroke-width="2"/>
                    </svg>
                </div>
                <div class="text-white text-2xl font-black mb-1 tracking-tighter">
                    <span x-text="displayValue">0</span><span x-text="suffix"></span>
                </div>
                <div class="text-[#FF9F29] text-[9px] font-black uppercase tracking-[0.2em]">Employés</div>
            </div>

            <div x-data="counter(15, 'ans')" x-init="start()" class="flex flex-col items-center group">
                <div class="mb-3 transition-transform duration-500 group-hover:-translate-y-1">
                    <svg width="50" height="50" viewBox="0 0 64 64" fill="none" stroke="white" stroke-width="1.2">
                        <circle cx="32" cy="32" r="26"/>
                        <path d="M32 16V32L42 42" stroke="#FF9F29" stroke-width="2" stroke-linecap="round"/>
                        <path d="M32 6V10M32 54V58M58 32H54M10 32H6" />
                    </svg>
                </div>
                <div class="text-white text-2xl font-black mb-1 tracking-tighter">
                    <span x-text="displayValue">0</span><span x-text="suffix"></span>
                </div>
                <div class="text-[#FF9F29] text-[9px] font-black uppercase tracking-[0.2em]">Expérience</div>
            </div>

        </div>
    </div>
</section>

<script>
    function counter(target, suffix = '') {
        return {
            displayValue: 0,
            target: target,
            suffix: suffix,
            start() {
                let duration = 2500;
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    this.displayValue = Math.floor(progress * this.target);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }
        }
    }
</script>



<style>
    /* Animation de défilement infini ultra-fluide */
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .animate-marquee {
        display: flex;
        width: max-content;
        animation: marquee 40s linear infinite; /* 40s pour un mouvement très élégant et calme */
    }

    /* Pause au survol */
    .animate-marquee:hover {
        animation-play-state: paused;
    }

    /* Effet de fondu sur les bords de l'écran */
    .mask-edges {
        mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }
</style>

<section class="py-10 bg-white font-sans overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 mb-8 text-center">
        <div class="max-w-2xl mx-auto">
            <div class="mb-4">
                <h2 class="text-3xl lg:text-4xl font-black text-[#1B2E58] uppercase tracking-tighter">
                    L'Équipe
                </h2>
                <div class="h-1 w-16 bg-[#FF9F29] mx-auto mt-2 rounded-full"></div>
            </div>
            <p class="text-gray-500 text-base font-medium leading-relaxed">
                L'excellence au service de vos ambitions.
            </p>
        </div>
    </div>

    <div class="relative mask-edges">
        <div class="animate-marquee gap-8 py-2">
            
            @php
                $team = [
                    ['name' => 'Marc-Antoine K.', 'role' => 'DG', 'img' => asset('images/11.jpg')],
                    ['name' => 'Sarah L. Dossou', 'role' => 'Resp. Immobilier', 'img' => asset('images/5.jpg')],
                    ['name' => 'Jean-Luc Agueh', 'role' => 'Expert Technique', 'img' => asset('images/10.webp')],
                    ['name' => 'Elise B.', 'role' => 'Directrice Agro', 'img' => asset('images/5.jpg')],
                    ['name' => 'Patrice M.', 'role' => 'Logistique', 'img' => asset('images/11.jpg')],
                ];
            @endphp

            @foreach(array_merge($team, $team) as $member)
            <div class="w-[240px] group flex-shrink-0">
                <div class="relative aspect-[3/4] overflow-hidden rounded-[2.5rem] bg-gray-50 mb-4 transition-all duration-500 hover:shadow-lg">
                    
                    <img src="{{ $member['img'] }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                         alt="{{ $member['name'] }}">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1B2E58]/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                        <span class="text-white font-bold text-xs flex items-center gap-2">
                            LinkedIn <span class="text-[#FF9F29]">→</span>
                        </span>
                    </div>
                </div>

                <div class="px-2 text-center">
                    <h3 class="text-xl font-black text-[#1B2E58] italic leading-none">{{ $member['name'] }}</h3>
                    <p class="text-[#FF9F29] font-bold uppercase text-[9px] tracking-[0.2em] mt-2">{{ $member['role'] }}</p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>




<section class="py-10 bg-gray-50 font-sans overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <div class="text-center max-w-3xl mx-auto mb-10 reveal-on-scroll opacity-0 transform -translate-y-10 transition-all duration-1000">
            <div class="text-center mb-4">
                <h2 class="text-2xl lg:text-3xl font-extrabold text-[#1B2E58] uppercase tracking-tighter ">
                    Restons en contact
                </h2>
                <div class="h-1 w-16 bg-[#FF9F29] mx-auto mt-2 rounded-full"></div>
            </div>
            <p class="text-gray-500 text-base font-medium">
                Une question ? Un projet ? Notre équipe est à votre écoute.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="reveal-on-scroll opacity-0 transform translate-y-10 transition-all duration-1000 delay-100">
                <div class="group bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 flex flex-col items-center text-center hover:-translate-y-2 h-full">
                    <div class="w-14 h-14 bg-[#FF9F29] rounded-2xl flex items-center justify-center mb-6 rotate-3 group-hover:rotate-12 transition-transform duration-500 shadow-md">
                        <i class="fas fa-envelope text-white text-xl"></i>
                    </div>
                    
                    <h3 class="text-[#1B2E58] text-xl font-black mb-2 ">Adresse Mail</h3>
                    <a href="mailto:nakayocorporation@gmail.com" class="text-gray-500 text-sm font-bold hover:underline mb-4 block break-all">nakayocorporation@gmail.com</a>
                    
                    <div class="text-gray-400 text-[11px] mt-auto">
                        <p class="font-bold text-gray-500 uppercase tracking-widest mb-1">Disponibilité</p>
                        <p>Lun - Ven : 07h30 à 18h</p>
                    </div>
                </div>
            </div>

            <div class="reveal-on-scroll opacity-0 transform translate-y-10 transition-all duration-1000 delay-300">
                <div class="group bg-[#1B2E58] p-8 rounded-[2rem] shadow-lg hover:shadow-xl transition-all duration-500 flex flex-col items-center text-center hover:-translate-y-2 h-full">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center mb-6 -rotate-3 group-hover:-rotate-12 transition-transform duration-500 shadow-md">
                        <i class="fas fa-phone-alt text-[#1B2E58] text-xl"></i>
                    </div>
                    
                    <h3 class="text-white text-xl font-black mb-2 ">Téléphone</h3>
                    <div class="space-y-1 mb-6">
                        <p class="text-[#FF9F29] text-lg font-bold">(+229) 01 66 55 61 61</p>
                        <p class="text-[#FF9F29] text-lg font-bold">(+229) 01 94 86 61 61</p>
                    </div>

                    <a href="https://wa.me/2290166556161" target="_blank" class="mt-auto bg-[#FF9F29] text-[#1B2E58] px-6 py-2.5 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-white transition-colors">
                        WhatsApp
                    </a>
                </div>
            </div>

            <div class="reveal-on-scroll opacity-0 transform translate-y-10 transition-all duration-1000 delay-500">
                <div class="group bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 flex flex-col items-center text-center hover:-translate-y-2 h-full">
                    <div class="w-14 h-14 bg-[#FF9F29] rounded-2xl flex items-center justify-center mb-6 rotate-3 group-hover:rotate-12 transition-transform duration-500 shadow-md">
                        <i class="fas fa-map-marker-alt text-white text-xl"></i>
                    </div>
                    
                    <h3 class="text-[#1B2E58] text-xl  mb-2 ">Siège Social</h3>
                    <p class="text-gray-500 text-sm font-medium mb-4 leading-relaxed">
                        Hedomey C/SB IMMEUBLE AISSOUN<br>
                        Cotonou, Bénin
                    </p>
                    
                    <a href="#" class="mt-auto text-[#1B2E58] font-black uppercase text-[9px] tracking-widest flex items-center gap-2 hover:text-[#FF9F29] transition-colors">
                        Google Maps <i class="fas fa-arrow-right text-[8px]"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>






<!-- 1. Réduction du padding vertical de py-20 à py-12 -->
<section class="py-12 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
    
        <!-- 2. Réduction de la marge basse mb-20 à mb-10 -->
        <div class="text-center max-w-3xl mx-auto mb-10 reveal-on-scroll opacity-0 transform -translate-y-10 transition-all duration-1000">
            <h2 class="text-3xl lg:text-4xl font-black text-[#1B2E58] uppercase tracking-tighter mb-4">
                Rejoignez l'équipe
            </h2>
            <div class="h-1.5 w-24 bg-[#FF9F29] rounded-full mx-auto mb-6 shadow-md"></div>
            <p class="text-gray-500 text-lg">
                Construisez votre carrière au sein d'un groupe pluridisciplinaire en pleine croissance.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
    
            <!-- GAUCHE : Illustration -->
            <div class="relative reveal-on-scroll opacity-0 transform -translate-x-20 transition-all duration-1000 delay-200">
                <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                    <!-- 3. RÉDUCTION DE LA HAUTEUR DE L'IMAGE de h-[500px] à h-[350px] -->
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200" alt="Équipe NAKAYO" class="w-full h-[350px] object-cover transition-transform duration-700 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1B2E58] via-transparent to-transparent opacity-60"></div>
                </div>
                
                <!-- Ajustement du badge (plus compact) -->
                <div class="absolute -bottom-4 -right-4 bg-[#FF9F29] p-6 rounded-3xl shadow-xl z-20 hidden md:block max-w-[200px] transform hover:rotate-2 transition-transform">
                    <p class="text-[#1B2E58] font-black uppercase text-xs leading-tight">
                        Plus de 300 collaborateurs.
                    </p>
                </div>
            </div>

            <!-- DROITE : Pourquoi nous ? (Réduction des space-y-10 à space-y-6) -->
            <div class="space-y-6">
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold text-[#1B2E58] italic reveal-on-scroll">
                        Pourquoi travailler chez NAKAYO ?
                    </h3>

                    <div class="reveal-on-scroll">
                        <p class="text-gray-500 text-sm leading-relaxed border-l-4 border-[#FF9F29] pl-4">
                            Devenir le partenaire de référence en Afrique de l'Ouest, reconnu pour notre innovation.
                        </p>
                    </div>
                
                    <!-- Liste des avantages (plus serrée) -->
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-chart-line text-blue-600 text-xs"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1B2E58] text-sm">Évolution Rapide</h4>
                                <p class="text-gray-500 text-xs">Promotion interne favorisée.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-orange-50 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-users text-[#FF9F29] text-xs"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1B2E58] text-sm">Environnement Collaboratif</h4>
                                <p class="text-gray-500 text-xs">Esprit d'équipe stimulant.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Zone d'action (plus compacte) -->
                <div class="bg-gray-50 p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('contact') }}" class="bg-[#1B2E58] text-white px-6 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest shadow-lg hover:bg-[#FF9F29] transition-all">
                            Voir les offres
                        </a>
                        <a href="{{ route('contact') }}" class="bg-white text-[#1B2E58] border-2 border-[#1B2E58] px-6 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-gray-100 transition-all">
                            Partenaire
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- 1. Réduction du padding vertical de py-20 à py-12 -->
<section class="bg-[#1B2E58] py-12 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row justify-between items-center gap-8">
        
        <!-- Bloc Texte -->
        <div class="flex flex-col gap-1 text-center lg:text-left reveal-on-scroll opacity-0 transform -translate-x-20 transition-all duration-1000 delay-100">
            <!-- Taille de texte légèrement ajustée pour la compacité -->
            <h4 class="text-[#FF9F29] text-2xl lg:text-3xl font-black uppercase  tracking-tight">
                Un projet, un besoin, une opportunité ?
            </h4>
            <p class="text-white text-base lg:text-lg font-light opacity-90 leading-relaxed">
                Notre équipe pluridisciplinaire est à votre écoute pour concrétiser vos ambitions.
            </p>
        </div>

        <!-- Bloc Boutons -->
        <div class="flex flex-col sm:flex-row gap-4 reveal-on-scroll opacity-0 transform translate-x-20 transition-all duration-1000 delay-300">
            <!-- Bouton 1 (Passage de py-4 à py-3.5 pour réduire la hauteur) -->
            <a href="{{ route('contact') }}" class="group relative bg-[#FF9F29] text-white px-8 py-3.5 rounded-xl font-black text-xs uppercase tracking-widest text-center overflow-hidden transition-all duration-300 hover:scale-105 shadow-xl">
                <span class="relative z-10">Devenir Client</span>
                <div class="absolute inset-0 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                <style>
                    .group:hover span { color: #1B2E58; transition: color 0.3s; }
                </style>
            </a>
            
            <!-- Bouton 2 (Passage de py-4 à py-3.5) -->
            <a href="{{ route('contact') }}" class="bg-transparent border-2 border-[#FF9F29] text-[#FF9F29] px-8 py-3.5 rounded-xl font-black text-xs uppercase tracking-widest text-center hover:bg-[#FF9F29] hover:text-white transition-all duration-300 hover:scale-105 shadow-lg">
                Devenir Partenaire
            </a>
        </div>

    </div>
</section>







