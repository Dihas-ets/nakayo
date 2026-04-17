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
            'id_service' => $s->id_service,
            'title' => $s->titre,
            'subtitle' => $s->courte_description,
            'img' => $s->media ? asset('storage/' . $s->media) : asset('images/default-hero.jpg'),
            // ON GÉNÈRE L'URL ICI :
            'url' => route('services.show', $s->id_service) 
        ];
    })->toJson() }},
    next() { this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1 },
    prev() { this.activeSlide = this.activeSlide === 1 ? this.slides.length : this.activeSlide - 1 },
    init() { if(this.slides.length > 0) { setInterval(() => { this.next() }, 7000) } } 
    }" 
    class="relative w-full h-[500px] overflow-hidden bg-black ">

    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="activeSlide === index + 1" class="absolute inset-0 w-full h-full" x-cloak>
            
            <img :src="slide.img" class="absolute inset-0 w-full h-full object-cover z-0" alt="Hero Image">

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
                        <!-- MODIFICATION ICI : On utilise slide.url directement -->
                        <a :href="slide.url"
                           class="inline-flex items-center gap-4 bg-[#FF9F29] text-[#1B2E58] px-8 py-4 rounded-2xl font-black uppercase text-sm sm:text-base hover:bg-white hover:text-[#FF9F29] transition-all group shadow-2xl">
                            voir plus
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
        
        <!-- EN-TÊTE : Titre centré + Bouton à droite -->
        <div class="relative mb-16 reveal-on-scroll opacity-0 transform -translate-y-10 transition-all duration-1000">
            
            <!-- TITRE (Toujours centré) -->
            <div class="text-center">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-[#1B2E58] uppercase tracking-tighter">
                    Nos Services
                </h2>
                <div class="h-1.5 w-20 bg-[#FF9F29] mx-auto mt-3 rounded-full shadow-sm"></div>
            </div>

            <!-- BOUTON : Masqué si 0 services, affiché si >= 6 -->
            @if($services->count() >= 6)
            <div class="mt-8 md:mt-0 md:absolute md:right-0 md:top-1/2 md:-translate-y-1/2 text-center">
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-3 bg-[#1B2E58] text-white px-6 py-3 rounded-full font-black uppercase text-[10px] tracking-widest hover:bg-[#FF9F29] transition-all shadow-lg group">
                    Voir tous les services
                    <i class="fas fa-plus-circle group-hover:rotate-90 transition-transform"></i>
                </a>
            </div>
            @endif
        </div>

        <!-- GRILLE DYNAMIQUE -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            
            @php
                $colors = [
                    ['from' => '#005C97'], 
                    ['from' => '#1B2E58'], 
                    ['from' => '#CC8B00'], 
                    ['from' => '#D81159'], 
                    ['from' => '#2D5A27'], 
                ];
            @endphp

            {{-- Utilisation de @forelse pour gérer le cas vide --}}
            @forelse($services->take(5) as $index => $service)
                @php 
                    $color = $colors[$index % count($colors)];
                @endphp

                <div class="reveal-on-scroll opacity-0 transform translate-y-20 transition-all duration-1000" 
                     style="transition-delay: {{ ($index + 1) * 100 }}ms">
                    
                    <div class="relative group h-[250px] rounded-[2rem] overflow-hidden border-4 border-gray-100 shadow-sm transition-transform duration-500 hover:scale-[1.02]">
                        
                        <!-- Image Dynamique -->
                        <img src="{{ $service->media ? asset('storage/' . $service->media) : asset('images/default-service.jpg') }}" 
                             alt="{{ $service->titre }}" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 opacity-90 transition-opacity duration-500 group-hover:opacity-100"
                             style="background: linear-gradient(to top, {{ $color['from'] }} 0%, {{ $color['from'] }}4D 70%, transparent 100%);">
                        </div>

                        <!-- Contenu -->
                        <div class="absolute bottom-6 left-6 right-6 text-white z-10">
                            <h3 class="text-lg font-black leading-tight mb-4 uppercase line-clamp-2">
                                {{ $service->titre }}
                            </h3>
                            
                            <a href="{{ route('services.show', $service->id_service) }}" 
                               class="inline-flex items-center gap-2 bg-[#FF9F29] border border-white/30 px-4 py-2 rounded-full font-bold uppercase text-[9px] tracking-widest transition-all hover:bg-white hover:text-[#1B2E58]"
                               style="color: white;">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- MESSAGE SI AUCUN SERVICE -->
                <div class="col-span-full py-20 text-center reveal-on-scroll opacity-0 transition-all duration-1000">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-50 rounded-full mb-6">
                        <i class="fas fa-concierge-bell text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-[#1B2E58] text-xl font-bold mb-2">Aucun service disponible</h3>
                    <p class="text-gray-400 max-w-md mx-auto italic">
                        Nous mettons actuellement à jour nos offres. Revenez très bientôt pour découvrir nos nouvelles prestations.
                    </p>
                </div>
            @endforelse

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

                <div class="absolute -bottom-8 -left-4 lg:-left-8 bg-[#1B2E58] p-4 lg:p-5 shadow-2xl z-20 max-w-[300px]">
                    <p class="text-white text-base lg:text-sm font-medium leading-tight">
                       Devenir un leader panafricain de l'investissement et des services, catalysant le développement économique du Bénin et de l'Afrique.
                    </p>
                </div>
            </div>

            <div class="lg:pl-5 space-y-4">
                <h2 class="text-[#1B2E58] text-lg font-bold leading-snug">
                    NAKAYO CORPORATION Sarl est dirigée par Monsieur FOUSSENI Ahmed Faras, jeune entrepreneur Visionaire qui possède une dizaine d’année d’expériences dans le domaine de l’entrepreuneuriat.
                </h2>

                <p class="text-gray-500 text-base leading-relaxed">
                    Offrir une gamme diversifiée et innovante de services de qualité dans des secteurs clés du développement, en mettant l'accent sur la technologie, la satisfaction client et l'impact social positif
                </p>

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


<!-- nos marques-->
<section class="py-12 font-sans overflow-hidden bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <!-- Titre de la section -->
        <div class="text-center mb-10 reveal-on-scroll opacity-0 transition-all duration-1000 transform translate-y-10">
            <h2 class="text-2xl lg:text-3xl font-black text-[#1B2E58] uppercase tracking-tighter">
                Nos Marques
            </h2>
            <div class="h-1 w-16 bg-[#FF9F29] mx-auto mt-2 rounded-full"></div>
        </div>

        <!-- Grille dynamique -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            
            @forelse($marques as $index => $marque)
                <div class="reveal-on-scroll opacity-0 translate-y-10 transition-all duration-700 ease-out" 
                     style="transition-delay: {{ $index * 100 }}ms">
                    
                    {{-- SI UN SERVICE EST LIÉ : On utilise une balise <a> avec effets de survol --}}
                    @if($marque->id_service)
                        <a href="{{ route('services.show', $marque->id_service) }}" 
                           class="group relative bg-white rounded-[1.5rem] p-6 flex flex-col items-center border border-gray-100 shadow-sm transition-all duration-500 transform hover:-translate-y-2 hover:bg-[#1B2E58] h-full cursor-pointer block">
                    {{-- SINON : On utilise une simple <div> sans effets interactifs --}}
                    @else
                        <div class="relative bg-white rounded-[1.5rem] p-6 flex flex-col items-center border border-gray-50 shadow-sm h-full cursor-default">
                    @endif

                            <!-- Image/Logo de la marque -->
                            <div class="relative z-10 w-20 h-20 bg-[#F8FAFC] rounded-2xl flex items-center justify-center mb-4 transition-all duration-500 @if($marque->id_service) group-hover:bg-white group-hover:scale-110 @endif overflow-hidden p-3">
                                @if($marque->image)
                                    <img src="{{ asset('storage/' . $marque->image) }}" alt="{{ $marque->nom }}" class="w-full h-full object-contain">
                                @else
                                    <i class="fas fa-certificate text-2xl text-gray-300"></i>
                                @endif
                            </div>
                            
                            <!-- Nom de la marque -->
                            <h3 class="relative z-10 text-sm font-black text-[#1B2E58] transition-colors duration-500 @if($marque->id_service) group-hover:text-white @endif uppercase italic text-center tracking-tight">
                                {{ $marque->nom }}
                            </h3>

                    @if($marque->id_service)
                        </a>
                    @else
                        </div>
                    @endif

                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-400 italic">Aucune marque disponible.</p>
                </div>
            @endforelse

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

        <!-- EN-TÊTE -->
        <div class="relative flex items-center justify-center mb-10 reveal-on-scroll">
            <div class="text-center">
                <h2 class="text-2xl lg:text-3xl font-black text-[#1B2E58] uppercase tracking-tighter">
                    Récents articles
                </h2>
                <div class="h-1.5 w-20 bg-[#FF9F29] mx-auto mt-2 rounded-full shadow-sm"></div>
            </div>

            {{-- On n'affiche le lien "Voir tout" que s'il y a au moins un article --}}
            @if($featuredArticle || $recentArticles->count() > 0)
                <div class="absolute right-0 top-1/2 -translate-y-1/2 hidden md:block">
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-[#FF9F29] font-black uppercase text-[11px] tracking-[0.2em] group">
                        Voir tout le blog
                        <i class="fas fa-arrow-right text-[10px] transition-transform group-hover:translate-x-2"></i>
                    </a>
                </div>
            @endif
        </div>

        {{-- CONDITION GLOBALE : Si aucun article n'existe du tout --}}
        @if(!$featuredArticle && $recentArticles->isEmpty())
            
            <div class="py-20 text-center reveal-on-scroll">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-50 rounded-full mb-6">
                    <i class="fas fa-newspaper text-3xl text-gray-300"></i>
                </div>
                <h3 class="text-[#1B2E58] text-xl font-bold mb-2">Aucun article disponible</h3>
                <p class="text-gray-400 max-w-md mx-auto italic">
                    Nos rédacteurs préparent du contenu passionnant pour vous. Revenez très bientôt pour lire nos dernières actualités.
                </p>
                <div class="mt-8">
                    <a href="{{ route('home') }}" class="text-[#FF9F29] text-[10px] font-black uppercase tracking-widest border-b-2 border-[#FF9F29] pb-1 hover:text-[#1B2E58] hover:border-[#1B2E58] transition-all">
                        Retour à l'accueil
                    </a>
                </div>
            </div>

        @else

            {{-- GRILLE : S'affiche s'il y a au moins un article --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

                <!-- BLOC GAUCHE : l'article mis en avant -->
                <div class="lg:col-span-7">
                    @if($featuredArticle)
                        <a href="{{ route('blog.show', $featuredArticle->slug) }}" class="relative group cursor-pointer h-full flex flex-col">

                            <div class="h-[380px] overflow-hidden rounded-[2rem] shadow-lg flex-shrink-0">
                                <img src="{{ asset('storage/' . $featuredArticle->media) }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 bg-gray-100"
                                     alt="{{ $featuredArticle->titre }}">
                            </div>

                            <div class="relative -mt-28 mx-4 lg:mx-8 bg-white rounded-3xl shadow-xl p-6 lg:p-8 border border-gray-50 z-10 transition-transform duration-300 group-hover:-translate-y-2 flex-grow">
                                <div class="absolute -top-3 left-6 bg-[#FF9F29] text-[#1B2E58] px-4 py-1.5 text-[10px] font-black uppercase tracking-widest rounded-md">
                                    {{ $featuredArticle->category_name ?? 'Catégorie' }}
                                </div>

                                <h3 class="text-[#1B2E58] text-xl lg:text-2xl font-black leading-tight mb-4 mt-2 group-hover:text-[#FF9F29] transition-colors">
                                    {{ $featuredArticle->titre }}
                                </h3>

                                <p class="text-gray-500 text-sm leading-relaxed mb-6 opacity-90 line-clamp-3">
                                    {{ Str::limit(strip_tags($featuredArticle->description), 180) }}
                                </p>

                                <div class="flex items-center justify-between text-gray-400 text-[10px] font-bold uppercase tracking-widest border-t border-gray-50 pt-4">
                                    <span class="flex items-center gap-2">
                                        <i class="far fa-calendar-alt text-[#FF9F29]"></i>
                                        {{ \Carbon\Carbon::parse($featuredArticle->created_at)->translatedFormat('d F, Y') }}
                                    </span>
                                    <span class="text-[#1B2E58]/40 italic">Nakayo Group</span>
                                </div>
                            </div>
                        </a>
                    @else
                        {{-- Si pas de featured mais des récents existent --}}
                        <div class="h-full flex items-center justify-center border-2 border-dashed border-gray-200 rounded-[2rem] text-gray-400 italic p-10 text-center">
                            Consultez nos derniers articles dans la liste ci-contre.
                        </div>
                    @endif
                </div>

                <!-- BLOC DROITE : autres articles récents -->
                <div class="lg:col-span-5 flex flex-col">
                    <div class="space-y-6 h-full flex flex-col justify-start">

                        @forelse($recentArticles as $article)
                            <a href="{{ route('blog.show', $article->slug) }}" class="flex gap-5 mb-0 group cursor-pointer items-center p-3 rounded-2xl hover:bg-gray-50 transition-all">

                                <div class="w-28 h-24 flex-shrink-0 overflow-hidden rounded-xl shadow-sm">
                                    <img src="{{ asset('storage/' . $article->media) }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                         alt="{{ $article->titre }}">
                                </div>

                                <div class="flex-1">
                                    <span class="text-[#FF9F29] text-[9px] font-black uppercase tracking-widest mb-1 inline-block">
                                        {{ $article->category_name ?? 'Catégorie' }}
                                    </span>

                                    <h4 class="text-[#1B2E58] text-base font-bold mb-1 leading-snug group-hover:text-[#FF9F29] transition-colors line-clamp-2">
                                        {{ $article->titre }}
                                    </h4>

                                    <div class="text-gray-400 text-[9px] font-bold uppercase italic">
                                        {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F, Y') }}
                                    </div>
                                </div>
                            </a>

                            @if(!$loop->last)
                                <div class="h-px bg-gray-100 mx-3"></div>
                            @endif
                        @empty
                            @if($featuredArticle)
                                <p class="text-gray-400 text-center py-10 italic">Aucun autre article récent pour le moment.</p>
                            @endif
                        @endforelse

                    </div>
                </div>

            </div>
        @endif

    </div>
</section>


<section class="py-12 bg-gray-50 font-sans overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        
        <!-- En-tête -->
        <div class="text-center max-w-3xl mx-auto mb-10">
            <div class="mb-4">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-[#1B2E58] uppercase tracking-tighter">
                    Nos Réalisations
                </h2>
                <div class="h-1.5 w-20 bg-[#FF9F29] mx-auto mt-2 rounded-full"></div>
            </div>
            <p class="text-gray-500 text-sm md:text-base px-4 italic">
                Découvrez l'excellence de Nakayo Corporation à travers nos projets emblématiques.
            </p>
        </div>

        <!-- Grille Dynamique -->
        <!-- La hauteur fixe lg:h-[550px] n'est appliquée que si $projets n'est pas vide -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 lg:grid-rows-2 gap-4 {{ $projets->count() > 0 ? 'lg:h-[450px]' : '' }}">
            
            @forelse($projets->take(4) as $index => $projet)
                @php
                    $gridClasses = '';
                    if ($index == 0) {
                        // GAUCHE : Grand rectangle (2 colonnes de large, 2 lignes de haut)
                        $gridClasses = 'lg:col-span-2 lg:row-span-2 sm:col-span-2';
                    } elseif ($index == 1) {
                        // DROITE HAUT : Rectangle large (2 colonnes de large, 1 ligne de haut)
                        $gridClasses = 'lg:col-span-2 lg:row-span-1 sm:col-span-2';
                    } else {
                        // DROITE BAS : Deux petits carrés (1 colonne de large chacun, 1 ligne de haut)
                        $gridClasses = 'lg:col-span-1 lg:row-span-1 col-span-1';
                    }
                @endphp

                <a href="{{ route('realisations.projets', $projet->id_projet) }}" 
                   class="{{ $gridClasses }} relative group overflow-hidden rounded-2xl shadow-md block cursor-pointer bg-[#1B2E58]">
                    
                    {{-- Image avec overlay progressif --}}
                    <img src="{{ asset('storage/' . $projet->image) }}" 
                         alt="{{ $projet->nom }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-90 group-hover:opacity-100">
                    
                    {{-- Dégradé sombre pour la lisibilité du texte --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1B2E58] via-transparent to-transparent opacity-80"></div>

                    {{-- Contenu texte --}}
                    <div class="absolute inset-0 flex flex-col justify-end p-5 md:p-6 text-white">
                        <span class="text-[#FF9F29] font-bold uppercase text-[10px] tracking-widest mb-1">
                            {{ $projet->service_nom }}
                        </span>
                        
                        <h3 class="{{ $index == 0 ? 'text-xl md:text-2xl' : 'text-lg' }} font-bold leading-tight mb-2">
                            {{ $projet->nom }}
                        </h3>
                        
                        <div class="flex items-center justify-between overflow-hidden">
                            <p class="text-white/80 text-xs flex items-center">
                                <i class="fas fa-map-marker-alt text-[#FF9F29] mr-1.5"></i> {{ $projet->lieu }}
                            </p>
                            
                            {{-- Flèche qui apparaît au survol --}}
                            <span class="transform translate-x-10 group-hover:translate-x-0 transition-transform duration-300">
                                <i class="fas fa-arrow-right text-[#FF9F29]"></i>
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <!-- MESSAGE SI AUCUNE RÉALISATION (Centré) -->
                <div class="col-span-full py-20 flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-project-diagram text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-[#1B2E58] text-xl font-bold mb-2">Aucune réalisation disponible</h3>
                    <p class="text-gray-400 max-w-md mx-auto italic px-6">
                        Nous n'avons pas encore publié de projets pour le moment. Revenez bientôt pour découvrir nos travaux.
                    </p>
                </div>
            @endforelse

        </div>
    </div>
</section>





<!-- SECTION : NOS PARTENAIRES -->

<section class="py-10 font-sans overflow-hidden">
    <div class="max-w-6xl mx-auto px-12">
        <div class="text-center mb-8">
            <h2 class="text-xl lg:text-2xl font-black text-[#1B2E58] uppercase tracking-tighter italic">
                Ils nous font confiance
            </h2>
            <div class="h-1 w-12 bg-[#FF9F29] mx-auto mt-1 rounded-full shadow-sm"></div>
        </div>

        <div class="swiper partner-swiper pb-10">
            <div class="swiper-wrapper">
                @forelse($partenaires as $partenaire)
                    <div class="swiper-slide h-auto flex items-center justify-center">
                        {{-- Si lien existe, on enveloppe tout dans un <a>, sinon un simple <div> --}}
                        @if($partenaire->lien)
                            <a href="{{ $partenaire->lien }}" target="_blank" class="block w-full h-16  transition-all duration-500  hover:opacity-100 cursor-pointer">
                                <img src="{{ asset('storage/' . $partenaire->image) }}" alt="{{ $partenaire->nom }}" class="h-full w-full object-contain">
                            </a>
                        @else
                            <div class="block w-full h-16  ">
                                <img src="{{ asset('storage/' . $partenaire->image) }}" alt="{{ $partenaire->nom }}" class="h-full w-full object-contain">
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="w-full text-center py-5">
                        <p class="text-gray-400 italic text-xs">Aucun partenaire disponible.</p>
                    </div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>




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

<section class="py-6 bg-white font-sans overflow-hidden">
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
        @if(isset($team) && $team->count() > 0)
            {{-- On n'affiche le div animée QUE s'il y a des membres --}}
            <div class="animate-marquee gap-8 py-2 flex">
                {{-- On concatène pour l'effet de boucle infinie --}}
                @foreach($team->concat($team) as $member)
                <div class="w-[240px] group flex-shrink-0">
                    <div class="relative aspect-[3/4] overflow-hidden rounded-[2.5rem] bg-gray-50 mb-4 shadow-sm border border-gray-100">
                        <img src="{{ asset('storage/' . $member->photo) }}" 
                             class="w-full h-full object-cover" 
                             alt="{{ $member->nom_complet }}">
                    </div>

                    <div class="px-2 text-center">
                        <h3 class="text-xl font-black text-[#1B2E58] italic">{{ $member->nom_complet }}</h3>
                        <p class="text-[#FF9F29] font-bold uppercase text-[9px] mt-2 tracking-widest">{{ $member->poste }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            {{-- MESSAGE SI VIDE : Centré, sans animation, sans défilement --}}
            <div class="py-16 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-users-slash text-3xl text-gray-300"></i>
                </div>
                <h3 class="text-[#1B2E58] text-xl font-bold mb-2">Aucun membre disponible</h3>
                <p class="text-gray-400 max-w-md mx-auto italic px-6">
                    Notre équipe est en cours de mise à jour. Revenez bientôt pour découvrir les visages qui font le succès de Nakayo Group.
                </p>
            </div>
        @endif
    </div>
</section>


@php 
                    // Nettoyage du numéro pour le lien WhatsApp (enlever les espaces et parenthèses)
                    $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp); 
                @endphp

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
                    <a href="mailto:{{ $settings->email }}" class="text-gray-500 text-sm font-bold hover:underline mb-4 block break-all">nakayocorporation@gmail.com</a>
                    
                    <div class="text-gray-400 text-[11px] mt-auto">
                        <p class="font-bold text-gray-500 uppercase tracking-widest mb-1">Disponibilité</p>
                        <p>{{ $settings->horaires_ouverture ?? 'Non définis' }}</p>
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
                        
                        <p class="text-[#FF9F29] text-lg font-bold">{{ $settings->telephone_appel ?? '(+229) 00 00 00 00' }}</p>
                    </div>

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp) }}" target="_blank" class="mt-auto bg-[#FF9F29] text-[#1B2E58] px-6 py-2.5 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-white transition-colors">
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
                       {{ $settings->localisation ?? 'Adresse non définie' }}
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
@php 
    // Nettoyage du numéro pour le lien WhatsApp (enlever les espaces et parenthèses)
    $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp); 
@endphp

<section class="py-12 bg-white overflow-hidden font-sans">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
    
        <!-- Titre de la section -->
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
            
            <!-- GAUCHE : Pourquoi nous ? -->
            <div class="space-y-6 reveal-on-scroll opacity-0 transform -translate-x-20 transition-all duration-1000 delay-200">
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold text-[#1B2E58] italic">
                        Pourquoi travailler chez NAKAYO ?
                    </h3>

                    <div>
                        <p class="text-gray-500 text-sm leading-relaxed border-l-4 border-[#FF9F29] pl-4">
                            Devenir le partenaire de référence en Afrique de l'Ouest, reconnu pour notre innovation.
                        </p>
                    </div>
                
                    <!-- Liste des avantages -->
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

                <!-- Zone d'action -->
                <!-- Zone d'action -->
                <div class="bg-gray-50 p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <!-- On utilise grid-cols-1 sur mobile et grid-cols-2 dès le breakpoint 'sm' (tablette/desktop) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- Bouton 1 : Recrutement -->
                        <a href="{{ route('recrutement') }}" 
                        class="flex items-center justify-center bg-[#1B2E58] text-white py-4 rounded-xl font-black uppercase text-[10px] tracking-widest shadow-lg hover:bg-[#FF9F29] transition-all text-center">
                            Voir les offres
                        </a>
                        
                        <!-- Bouton 2 : WhatsApp -->
                        <a href="{{ route('realisations.projets') }}" 
                        target="_blank" 
                        class="flex items-center justify-center bg-white text-[#1B2E58] border-2 border-[#1B2E58] py-4 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-gray-100 transition-all text-center">
                            Partenaire
                        </a>

                    </div>
                </div>
            </div>

            <!-- DROITE : Illustration -->
            <div class="relative reveal-on-scroll opacity-0 transform translate-x-20 transition-all duration-1000 delay-400">
                <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                    <img src="{{ asset('images/deux.webp') }}" alt="Équipe NAKAYO" class="w-full h-[350px] object-cover transition-transform duration-700 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1B2E58] via-transparent to-transparent opacity-60"></div>
                </div>
                
                <!-- Badge collaborateur -->
                <div class="absolute -bottom-4 -left-4 bg-[#FF9F29] p-6 rounded-3xl shadow-xl z-20 hidden md:block max-w-[200px] transform hover:-rotate-2 transition-transform">
                    <p class="text-[#1B2E58] font-black uppercase text-xs leading-tight">
                        Plus de 300 collaborateurs.
                    </p>
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
            <a href="https://wa.me/{{ $whatsappClean }}" class="group relative bg-[#FF9F29] text-white px-8 py-3.5 rounded-xl font-black text-xs uppercase tracking-widest text-center overflow-hidden transition-all duration-300 hover:scale-105 shadow-xl">
                <span class="relative z-10">Devenir Client</span>
                <div class="absolute inset-0 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                <style>
                    .group:hover span { color: #1B2E58; transition: color 0.3s; }
                </style>
            </a>
            
            <!-- Bouton 2 (Passage de py-4 à py-3.5) -->
            <a href="{{ route('realisations.projets') }}" class="bg-transparent border-2 border-[#FF9F29] text-[#FF9F29] px-8 py-3.5 rounded-xl font-black text-xs uppercase tracking-widest text-center hover:bg-[#FF9F29] hover:text-white transition-all duration-300 hover:scale-105 shadow-lg">
                Devenir Partenaire
            </a>
        </div>

    </div>
</section>







