@extends('layouts.app')

@section('content')

{{-- 1. NAVBAR --}}
@if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
    <header class="sticky top-0 z-[100] w-full shadow-md bg-white">
        @include('components.navbar')
    </header>
@endif



<!-- 1. HERO SECTION COMMUN -->
<section class="relative h-[600px] flex flex-col items-center justify-center text-white overflow-hidden">
    <!-- Image de fond dynamique (Image du service en base de données) -->
    <div class="absolute inset-0 z-0">
        {{-- On affiche l'image du service ou une image par défaut si vide --}}
        <img src="{{ $service->media ? asset('storage/' . $service->media) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1920' }}" 
             class="w-full h-full object-cover">
        
        <!-- Overlay "Deep Teal" (Bleu-Vert sombre) comme sur ton image -->
        <!-- Le "mix-blend-multiply" est ce qui donne l'effet professionnel de l'image -->
        <div class="absolute inset-0 bg-[#061e24]/85 mix-blend-multiply"></div>
        
        <!-- Dégradé noir subtil en bas pour faire ressortir le fil d'ariane -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/40"></div>
    </div>

    <!-- Contenu Central -->
    <div class="container mx-auto px-6 relative z-10 text-center">
        <!-- Titre : Très large et extra-gras (font-black) -->
        <h1 class="text-5xl md:text-7xl font-black mb-6 tracking-tight leading-tight uppercase text-[#FF9F29]">
            {{ $service->titre }}
        </h1>

        <!-- Sous-titre : Texte gris clair aéré -->
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-300 font-medium mb-10 leading-relaxed">
            {{ $service->courte_description }}
        </p>

        <!-- Bouton Blanc Style Image -->
        <div class="flex justify-center">
            <a href="#" class="bg-white text-[#061e24] px-10 py-4 rounded-xl font-bold flex items-center gap-3 hover:bg-gray-100 transition-all shadow-2xl group transform hover:-translate-y-1">
                Nous Contacter
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Fil d'ariane (Breadcrumbs) : Positionné en bas au centre -->
    <div class="absolute bottom-12 w-full text-center z-10">
        <nav class="flex justify-center items-center gap-3 text-sm font-semibold tracking-wide uppercase">
            <a href="/" class="text-gray-400 hover:text-white transition">Accueil</a>
            
            <span class="text-gray-500 text-xs">
                <i class="fa-solid fa-chevron-right"></i>
            </span>
            
            <span class="text-gray-400">Services</span>

            <span class="text-gray-500 text-xs">
                <i class="fa-solid fa-chevron-right"></i>
            </span>
            
            <span class="text-white">{{ $service->titre }}</span>
        </nav>
    </div>
</section>

<div class="container mx-auto px-6 py-16">
    <div class="flex flex-col lg:flex-row gap-12 items-start">
        
        <!-- 2. SIDEBAR GAUCHE (STICKY) -->
        <!-- "lg:sticky lg:top-24" permet de bloquer le menu au défilement -->
        <aside class="w-full lg:w-1/3 lg:sticky lg:top-24 space-y-8">
            <div class="bg-gray-50 p-8 rounded-sm shadow-sm">
                <h3 class="text-2xl font-bold text-blue-900 mb-6 border-b pb-4">Nos Services</h3>
                <ul class="space-y-3">
            @foreach(\App\Models\Service::select('id_service', 'titre')->get() as $srv)
            <li>
                <a href="{{ route('services.show', $srv->id_service) }}"
                   class="flex justify-between items-center px-6 py-4 font-bold transition-all
                          {{ $service->id_service == $srv->id_service ? 'bg-blue-900 text-white shadow-lg' : 'bg-white text-blue-900 hover:bg-blue-50' }}">
                    {{ $srv->titre }}
                    <span>↗</span>
                </a>
            </li>
            @endforeach
        </ul>
            </div>

           <!-- BOITE ORANGE CONTACT DYNAMIQUE -->
        <div class="bg-[#FF9F29] p-8 text-white rounded-sm shadow-lg">
            <h4 class="text-2xl font-black mb-4 leading-tight text-white uppercase tracking-tighter">
                Un accès à <br> {{ $settings->nom_agence ?? 'NAKAYO' }} !
            </h4>
            
            <p class="text-sm opacity-90 mb-6 font-medium">
                {{ $settings->availability_hours ?? 'Service client disponible pour tous vos besoins au Bénin.' }}
            </p>

            <div class="space-y-4 mb-8">
                {{-- Téléphone d'appel --}}
                @if($settings->telephone_appel)
                    <a href="tel:{{ str_replace(' ', '', $settings->telephone_appel) }}" class="flex items-center gap-3 group">
                        <span class="bg-white/20 w-8 h-8 flex items-center justify-center rounded-full group-hover:bg-white/40 transition">📞</span>
                        <p class="font-bold underline decoration-white/30">{{ $settings->telephone_appel }}</p>
                    </a>
                @endif

                {{-- Localisation --}}
                @if($settings->localisation)
                    <div class="flex items-center gap-3">
                        <span class="bg-white/20 w-8 h-8 flex items-center justify-center rounded-full">📍</span>
                        <p class="font-bold underline decoration-white/30">{{ $settings->localisation }}</p>
                    </div>
                @endif

                {{-- Email --}}
                @if($settings->email)
                    <a href="mailto:{{ $settings->email }}" class="flex items-center gap-3 group">
                        <span class="bg-white/20 w-8 h-8 flex items-center justify-center rounded-full group-hover:bg-white/40 transition">✉️</span>
                        <p class="font-bold underline decoration-white/30">{{ $settings->email }}</p>
                    </a>
                @endif
            </div>

            {{-- Lien WhatsApp --}}
            <a href="https://wa.me/{{ str_replace(' ', '', $settings->telephone_whatsapp ?? '2290166556161') }}" 
            target="_blank"
            class="block w-full text-center bg-white text-[#1B2E58] py-4 font-black uppercase text-xs tracking-widest hover:bg-gray-100 transition shadow-md">
            Contactez l'Équipe ↗
            </a>
        </div>

        <!-- PDF DOWNLOAD (Statique ou à ajouter en DB) -->
        <div class="bg-gray-50 p-6 border-l-4 border-[#1B2E58] group hover:bg-gray-100 transition">
            <p class="font-black text-[#1B2E58] mb-4 uppercase text-[10px] tracking-widest">Documentation Officielle</p>
            <a href="{{ asset('assets/documents/brochure-nakayo.pdf') }}" download class="flex items-center justify-between bg-[#1B2E58] text-white p-5 hover:bg-[#FF9F29] transition-all duration-300">
                <div class="flex items-center gap-4">
                    <i class="fa-solid fa-file-pdf text-2xl"></i>
                    <span class="font-black text-xs uppercase tracking-tighter">Brochure {{ $settings->nom_agence ?? 'Nakayo' }}</span>
                </div>
                <i class="fa-solid fa-download animate-bounce"></i>
            </a>
        </div>
        </aside>

        <!-- 3. SECTION DROITE (CONTENU DYNAMIQUE) -->
        <main class="w-full lg:w-2/3">
            <h2 class="text-4xl font-black text-blue-950 mb-8 uppercase tracking-tighter">{{ $service['title'] }}</h2>

            
            <!-- SECTION NOS PRODUITS PHARES -->
           <div class="mb-16">
            <!-- 1. TITRE DU SERVICE -->
            <h2 class="text-4xl md:text-5xl font-black text-blue-950 uppercase tracking-tighter mb-2">
                {{ $service->titre }}
            </h2>

            <!-- 2. SOUS-TITRE PRODUITS PHARES -->
            <div class="flex items-center justify-between mb-8 border-b border-gray-100 pb-4">
                <h3 class="text-xl font-bold text-[#FF9F29] uppercase tracking-widest">
                    Produits <span class="text-blue-900">Phares</span>
                </h3>
                {{-- Ce lien mène vers la page catalogue qui affiche TOUT --}}
                <a href="{{ route('services.products', $service->id_service) }}" ...>
                    Voir tous les produits ({{ $service->produits->count() }})
                </a>
            </div>

            {{-- Grille de produits : On utilise ->take(4) pour limiter l'affichage --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                @forelse($service->produits->take(4) as $prod)
                    <div class="bg-white border border-gray-100 rounded-sm group hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col">
                        <!-- Image du produit -->
                        <div class="relative h-64 overflow-hidden bg-gray-100">
                            <img src="{{ $prod->image ? asset('storage/' . $prod->image) : 'https://placehold.co/600x400?text=NAKAYO' }}" 
                                alt="{{ $prod->nom }}" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <div class="absolute top-4 left-4 bg-blue-900 text-white text-[10px] font-black px-3 py-1 uppercase tracking-widest">
                                {{ $service->titre }}
                            </div>
                        </div>

                        <!-- Infos produit -->
                        <div class="p-6 flex-grow flex flex-col">
                            <h4 class="text-xl font-black text-blue-950 mb-4 leading-tight uppercase group-hover:text-[#FF9F29] transition-colors">
                                {{ $prod->nom }}
                            </h4>
                            
                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-50">
                                <!-- PRIX CONDITIONNEL -->
                                <div>
                                    @if($prod->prix && $prod->prix > 0)
                                        <span class="block text-[10px] text-gray-400 font-bold uppercase italic">Prix indicatif</span>
                                        <span class="text-2xl font-black text-blue-900">
                                            {{ number_format($prod->prix, 0, ',', '.') }} 
                                            <small class="text-[10px]">CFA</small>
                                        </span>
                                    @else
                                        <span class="block text-[10px] text-gray-400 font-bold uppercase italic">Tarif</span>
                                        <span class="text-sm font-bold text-[#FF9F29] uppercase italic">Prix sur demande</span>
                                    @endif
                                </div>
                                
                                <!-- LIEN WHATSAPP +229 01 66 55 61 61 -->
                                <a href="https://wa.me/2290166556161?text=Bonjour Nakayo, je souhaite avoir des informations sur le produit : {{ $prod->nom }} (Catégorie : {{ $service->titre }})" 
                                target="_blank"
                                class="w-14 h-14 bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center rounded-full hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                    <i class="fa-brands fa-whatsapp text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-100">
                        <p class="text-gray-400 italic">Aucun produit disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>

            {{-- Petit bouton "Charger plus" en bas si vous avez plus de 4 produits --}}
            @if($service->produits->count() > 4)
                <div class="mt-12 text-center">
                    <a href="{{ route('services.products', $service->id_service) }}" ...>
                        Afficher les {{ $service->produits->count() - 4 }} autres produits
                    </a>
                </div>
            @endif
        </div>

            <!-- DESCRIPTION TEXTE -->
            <div class="prose max-w-none text-gray-600 mb-12 leading-relaxed">
                <p>Nous collaborons avec des centaines de partenaires à travers le monde, notamment des revendeurs, des distributeurs, des installateurs et bien d'autres. Devenir partenaire est simple : nous proposons une gamme de solutions adaptée à votre modèle d'entreprise.</p>
            </div>

            

       <div class="mt-16">
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h3 class="text-3xl font-black text-blue-950 uppercase tracking-tighter">Galerie Réalisations</h3>
                        <div class="w-20 h-1.5 bg-[#FF9F29] mt-2"></div>
                    </div>
                </div>

                {{-- Mise en page Masonry : columns-2 sur mobile/tablette, columns-3 sur desktop --}}
                <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4">
                    @forelse ($service->galleries->take(6) as $media)
                        <div class="relative group overflow-hidden rounded-2xl break-inside-avoid shadow-sm hover:shadow-xl transition-all duration-500">
                            
                            {{-- CAS 1 : IMAGE --}}
                            @if($media->type_media == 'image')
                                <img src="{{ asset('storage/' . $media->image_url) }}" 
                                    alt="Réalisation Nakayo"
                                    class="w-full h-auto object-cover transition duration-700 group-hover:scale-110">
                                
                                {{-- Overlay épuré (sans carte) --}}
                                <div class="absolute inset-0 bg-[#061e24]/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center backdrop-blur-[2px]">
                                    <a href="{{ asset('storage/' . $media->image_url) }}" 
                                    class="glightbox w-14 h-14 bg-white text-[#061e24] rounded-full flex items-center justify-center shadow-2xl transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                        <i class="fa-solid fa-plus text-xl"></i>
                                    </a>
                                </div>

                            {{-- CAS 2 : VIDÉO --}}
                            @else
                                <div class="relative">
                                    {{-- On utilise une icône ou une image générique pour le fond vidéo --}}
                                    <div class="w-full aspect-video bg-[#061e24] flex flex-col items-center justify-center">
                                        <i class="fa-solid fa-play text-4xl text-[#FF9F29] animate-pulse"></i>
                                        <span class="mt-4 text-[9px] font-black text-white/50 uppercase tracking-widest">Voir la vidéo</span>
                                    </div>
                                    
                                    {{-- Overlay Vidéo --}}
                                    <div class="absolute inset-0 bg-black/20 group-hover:bg-[#FF9F29]/20 transition-all duration-500 flex items-center justify-center">
                                        <a href="{{ $media->link }}" 
                                        class="glightbox w-16 h-16 bg-[#FF9F29] text-white rounded-full flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all duration-500"
                                        data-glightbox="type: video; width: 900; height: auto;">
                                            <i class="fa-solid fa-play text-xl ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-200 rounded-3xl">
                            <p class="text-gray-400 italic">Aucune photo dans la galerie.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Bouton VOIR PLUS si plus de 6 médias --}}
                @if($service->galleries->count() > 6)
                    <div class="mt-12 text-center">
                        <a href="#" class="inline-flex items-center gap-3 px-10 py-4 bg-[#1B2E58] text-white font-black text-xs uppercase tracking-[0.2em] rounded-sm hover:bg-[#FF9F29] transition-all shadow-lg group">
                            Voir toute la galerie
                            <i class="fa-solid fa-arrow-right transition-transform group-hover:translate-x-2"></i>
                        </a>
                    </div>
                @endif
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const lightbox = GLightbox({
                        selector: '.glightbox',
                        touchNavigation: true,
                        loop: true,
                        autoplayVideos: true
                    });
                });
            </script>
                    </div>
                    </main>
                </div>
</div>

<!-- SCRIPTS & CSS EXTERNES -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<script>
    // 1. Gestion Vidéo
    const video = document.getElementById('myVideo');
    const btn = document.getElementById('videoBtn');
    btn.addEventListener('click', () => {
        if (video.paused) { video.play(); btn.style.display = 'none'; }
    });

    // 2. Swiper Carousel (2 par 2)
    const swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 20,
        pagination: { el: ".swiper-pagination", clickable: true },
        autoplay: { delay: 3000 },
        breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 2 }
        }
    });

    // 3. Lightbox (Effet zoom sur toutes les images)
    const lightbox = GLightbox({ selector: '.glightbox' });
</script>

<style>
    /* Personnalisation Pagination */
    .swiper-pagination-bullet-active { background: #1e3a8a !important; }
</style>
@endsection