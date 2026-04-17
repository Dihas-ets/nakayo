@extends('layouts.app')


  {{-- HEADER : Top-bar + Navbar --}}
    {{-- On vérifie que la route actuelle n'est pas dans la liste noire --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky top-0 z-[100] w-full shadow-md">
            
            @include('components.navbar')
        </header>
    @endif
    
@section('content')

<section class="relative w-full h-[450px] md:h-[550px] flex items-center justify-center overflow-hidden font-sans">
    
    <!-- IMAGE D'ARRIÈRE-PLAN -->
    <!-- J'ai choisi une image de bureau moderne et pro chez Unsplash -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1920" 
             alt="Background" 
             class="w-full h-full object-cover">
        
        <!-- OVERLAY BLEU TRANSPARENT (Comme sur ton image) -->
        <!-- mix-blend-multiply permet d'avoir ce rendu profond vert/bleu sombre -->
        <div class="absolute inset-0 bg-[#00261C]/80 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#1B2E58]/40"></div>
    </div>

    <!-- CONTENU PRINCIPAL -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
        
        <!-- Titre -->
        <h1 class="text-white text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-tight mb-6">
            A Propos de nous
        </h1>

        <!-- Description -->
        <p class="text-white/90 text-sm md:text-lg lg:text-xl max-w-4xl mx-auto leading-relaxed mb-10 font-medium">
            Découvrez l'histoire, la mission et les valeurs qui font de NAKAYO un leader dans les services 
        </p>

        <!-- Bouton CTA -->
        <div class="flex justify-center mb-12">
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-3 bg-white text-[#1B2E58] px-8 py-4 rounded-xl font-bold text-base hover:bg-orange-400 hover:text-white transition-all duration-300 shadow-lg group">
                Nous Contactez
                <i class="fas fa-arrow-right text-sm group-hover:rotate-45 transition-transform"></i>
            </a>
        </div>

        <!-- BREADCRUMBS (Fil d'Ariane) -->
        <nav class="absolute bottom-[-40px] md:bottom-[-60px] left-1/2 -translate-x-1/2 flex items-center gap-3 text-white text-sm font-semibold">
            <a href="/" class="hover:text-orange-400 transition">Accueil</a>
            <span class="text-white/50">
                <i class="fas fa-chevron-right text-[10px]"></i>
            </span>
            <span class="text-white/70">A Propos</span>
        </nav>
    </div>

</section>


<section class="py-16 md:py-24 bg-[#F8FAFC] font-sans">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <!-- Titre de la section -->
        <h2 class="text-center text-[#1B2E58] text-2xl md:text-4xl font-extrabold uppercase tracking-wide mb-12 md:mb-20">
            À Propos de 
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <!-- BLOC GAUCHE : IMAGE -->
            <div class="relative group">
                <div class="overflow-hidden rounded-2xl shadow-2xl">
                    <!-- Remplace par ton image réelle {{ asset('images/equipe.jpg') }} -->
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200" 
                         alt="Équipe Access Finance" 
                         class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700">
                </div>
                <!-- Petit élément décoratif discret -->
                <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#FFB75E]/10 rounded-full -z-10"></div>
            </div>

            <!-- BLOC DROIT : TEXTE -->
            <div class="flex flex-col space-y-6">
                <!-- Premier paragraphe en gras -->
                <p class="text-[#1B2E58] text-lg md:text-xl font-bold leading-relaxed">
                    NAKAYO COORPORATION Sarl est une entreprise privée diversifiés, née de la vision fédérer des secteurs clés du développement. Avec une approche innovante et un engagementsans faille envers la qualité,nous construisons des ponts entre les besoins du marché et des solutions concrètes ,de la fabrication à la prestation de service d'envergure 
                
                </p>

                <!-- Deuxième paragraphe -->
                <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                    Nous opérons notamment dans la construction et l’entretien de piscines, l’immobilier et l’investissement, la papeterie et les fournitures, la fabrication et la formation en savonnerie, ainsi que dans l’agro-industrie et l’élevage. Notre objectif est d’offrir des services fiables, accessibles et de qualité, adaptés aux réalités locales et aux besoins spécifiques de chaque client.
                </p>

                <!-- Troisième paragraphe -->
                <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                    Chez NAKAYO COORPORATION, nous mettons l’accent sur le professionnalisme, l’innovation et la satisfaction client, afin de bâtir des relations durables basées sur la confiance
                </p>
            </div>

        </div>
    </div>
</section>


<!-- SECTION : NOS PARTENAIRES -->
<section class="py-10 font-sans overflow-hidden">
    <div class="max-w-6xl mx-auto px-12">
        <div class="text-center mb-8">
            <h2 class="text-2xl lg:text-3xl font-black text-[#1B2E58] uppercase tracking-tighter ">
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


<!-- les membres -->

<style>
    /* Animation de défilement infini ultra-fluide */
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .animate-marquee {
        display: flex;
        width: max-content;
        animation: marquee 40s linear infinite;
    }

    .animate-marquee:hover {
        animation-play-state: paused;
    }

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
        <div class="animate-marquee gap-8 py-2 flex">
            @if(isset($team) && $team->count() > 0)
                {{-- On concatène la collection avec elle-même pour l'effet de boucle infinie sans saut --}}
                @foreach($team->concat($team) as $member)
                <div class="w-[240px] group flex-shrink-0">
                    <div class="relative aspect-[3/4] overflow-hidden rounded-[2.5rem] bg-gray-100 mb-4 shadow-sm border border-gray-50">
                        
                        {{-- Affichage de la photo à partir du dossier storage --}}
                        @if($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                                 alt="{{ $member->nom_complet }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                        @endif

                        {{-- Lien LinkedIn dynamique s'il existe --}}
                        @if($member->linkedin)
                        <a href="{{ $member->linkedin }}" target="_blank" 
                           class="absolute inset-0 bg-gradient-to-t from-[#1B2E58]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                            <span class="text-white font-bold text-xs flex items-center gap-2">
                                <i class="fab fa-linkedin"></i> LinkedIn →
                            </span>
                        </a>
                        @endif
                    </div>

                    <div class="px-2 text-center">
                        <h3 class="text-xl font-black text-[#1B2E58] italic leading-tight">
                            {{ $member->nom_complet }}
                        </h3>
                        <p class="text-[#FF9F29] font-bold uppercase text-[10px] tracking-widest mt-2">
                            {{ $member->poste }}
                        </p>
                    </div>
                </div>
                @endforeach
            @else
                <div class="w-full text-center py-10">
                    <p class="text-gray-400 italic">Aucun membre d'équipe n'est disponible pour le moment.</p>
                </div>
            @endif
        </div>
    </div>
</section>


<!-- SECTION 1 : MISSION & VISION -->
<section class="py-16 bg-gray-50 font-sans">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <!-- Titre avec barre orange -->
        <div class="text-center mb-16">
            <h2 class="text-[#1B2E58] text-3xl md:text-4xl font-extrabold mb-4">Notre Mission & Vision</h2>
            <div class="w-16 h-1 bg-orange-500 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
            <!-- Carte Mission -->
            <div class="bg-white p-8 md:p-12 rounded-xl shadow-sm border-t-4 border-[#1B2E58] flex flex-col items-center text-center hover:shadow-md transition-shadow">
                <h3 class="text-[#1B2E58] text-2xl font-bold mb-6">Notre Mission</h3>
                <p class="text-gray-500 leading-relaxed text-sm md:text-base">
                    Faciliter l'accès aux services financiers pour tous les acteurs économiques du Bénin, 
                    en particulier les populations exclues du système bancaire traditionnel, en proposant 
                    des solutions de financement innovantes, adaptées et accessibles qui contribuent à 
                    l'autonomisation économique et au développement durable de nos communautés.
                </p>
            </div>

            <!-- Carte Vision -->
            <div class="bg-white p-8 md:p-12 rounded-xl shadow-sm border-t-4 border-[#1B2E58] flex flex-col items-center text-center hover:shadow-md transition-shadow">
                <h3 class="text-[#1B2E58] text-2xl font-bold mb-6">Notre Vision</h3>
                <p class="text-gray-500 leading-relaxed text-sm md:text-base">
                    Être l'institution de microfinance de référence au Bénin, reconnue pour notre impact 
                    positif sur l'inclusion financière, l'entrepreneuriat local et le développement 
                    économique durable, en nous appuyant sur l'innovation, la proximité et l'excellence de nos services.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2 : NOS VALEURS -->
<section class="py-16 bg-white font-sans">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <!-- Titre avec barre orange -->
        <div class="text-center mb-16">
            <h2 class="text-[#1B2E58] text-3xl md:text-4xl font-extrabold mb-4">Nos Valeurs</h2>
            <div class="w-16 h-1 bg-orange-500 mx-auto"></div>
        </div>

        <!-- Grille des valeurs (Responsive : 1 col sur mobile, 2 sur tablette, 3 sur PC) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            
            <!-- Intégrité -->
            <div class="bg-white p-8 rounded-xl border border-gray-50 shadow-sm flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 mb-6 flex items-center justify-center">
                    <i class="fas fa-check-circle text-blue-500 text-4xl"></i>
                </div>
                <h4 class="text-[#1B2E58] text-xl font-bold mb-4">Intégrité</h4>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Nous agissons avec honnêteté, transparence et éthique dans toutes nos relations avec nos clients, partenaires et collaborateurs.
                </p>
            </div>

            <!-- Proximité -->
            <div class="bg-white p-8 rounded-xl border border-gray-50 shadow-sm flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 mb-6 flex items-center justify-center">
                    <i class="fas fa-users text-[#FF9F29] text-4xl"></i>
                </div>
                <h4 class="text-[#1B2E58] text-xl font-bold mb-4">Proximité</h4>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Nous sommes à l'écoute de nos clients et nous nous engageons à comprendre leurs besoins spécifiques pour leur offrir des solutions personnalisées.
                </p>
            </div>

            <!-- Innovation -->
            <div class="bg-white p-8 rounded-xl border border-gray-50 shadow-sm flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 mb-6 flex items-center justify-center">
                    <i class="far fa-lightbulb text-yellow-500 text-4xl"></i>
                </div>
                <h4 class="text-[#1B2E58] text-xl font-bold mb-4">Innovation</h4>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Nous développons constamment de nouveaux produits et services pour répondre efficacement à l'évolution des besoins de nos clients.
                </p>
            </div>

            <!-- Solidarité -->
            <div class="bg-white p-8 rounded-xl border border-gray-50 shadow-sm flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 mb-6 flex items-center justify-center">
                    <i class="fas fa-hand-holding-heart text-orange-400 text-4xl"></i>
                </div>
                <h4 class="text-[#1B2E58] text-xl font-bold mb-4">Solidarité</h4>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Nous croyons en la force du collectif et nous nous engageons pour le développement économique et social de nos communautés.
                </p>
            </div>

            <!-- Efficacité -->
            <div class="bg-white p-8 rounded-xl border border-gray-50 shadow-sm flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 mb-6 flex items-center justify-center">
                    <i class="fas fa-bolt text-yellow-600 text-4xl"></i>
                </div>
                <h4 class="text-[#1B2E58] text-xl font-bold mb-4">Efficacité</h4>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Nous nous efforçons de fournir des services de qualité, rapides et adaptés aux réalités de nos clients.
                </p>
            </div>

            <!-- Durabilité -->
            <div class="bg-white p-8 rounded-xl border border-gray-50 shadow-sm flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 mb-6 flex items-center justify-center">
                    <i class="fas fa-leaf text-green-500 text-4xl"></i>
                </div>
                <h4 class="text-[#1B2E58] text-xl font-bold mb-4">Durabilité</h4>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Nous intégrons les principes de développement durable dans nos activités pour contribuer à un avenir meilleur pour tous.
                </p>
            </div>

        </div>
    </div>
</section>


 <!-- 1. CARTE GOOGLE MAPS (Couleurs standards et lisibles) -->

<section class="relative w-full h-[550px] md:h-[650px] flex items-center overflow-hidden font-sans bg-gray-100">
    
   
    <div class="absolute inset-0 z-0">
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
        <!-- Overlay dégradé léger pour ne pas gêner la lecture mais lier au design -->
        <div class="absolute inset-y-0 left-0 w-full md:w-1/2 bg-gradient-to-r from-white/80 via-white/40 to-transparent pointer-events-none"></div>
    </div>

    <!-- 2. CONTENU (Carte de visite flottante) -->
    <div class="relative z-10 container mx-auto px-6 lg:px-12">
        <div class="max-w-md">
            
            <!-- Badge "Nous trouver" -->
            <!-- <div class="inline-flex items-center gap-2 bg-white/90 backdrop-blur-sm text-[#1B2E58] px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-[2px] mb-6 shadow-sm border border-gray-100">
                <i class="fas fa-map-marker-alt text-[#FFB75E]"></i>
                Siège Social Access Finance
            </div> -->

            <!-- BLOC DE CONTACT -->
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-[0_30px_60px_-15px_rgba(27,46,88,0.2)] border border-gray-50 relative overflow-hidden">
                
                <!-- Décoration d'angle -->
                <div class="absolute top-0 right-0 w-24 h-24 bg-[#FFB75E]/5 rounded-bl-[100px]"></div>

                

                <div class="space-y-8">
                    <!-- Adresse -->
                    <div class="flex items-start gap-5 group">
                        <div class="flex-shrink-0 w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center text-[#1B2E58] group-hover:bg-[#1B2E58] group-hover:text-white transition-all">
                            <i class="fas fa-location-arrow"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Adresse</p>
                            <p class="text-[#1B2E58] font-medium leading-relaxed">{{ $settings->localisation ?? 'Adresse non définie' }}</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-5 group">
                        <div class="flex-shrink-0 w-11 h-11 bg-orange-50 rounded-xl flex items-center justify-center text-[#FFB75E] group-hover:bg-[#FFB75E] group-hover:text-white transition-all">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Email</p>
                            <a href="mailto:accessbeninsa@gmail.com" class="text-[#1B2E58] font-bold hover:underline">{{ $settings->email ?? 'contact@domaine.com' }}</a>
                        </div>
                    </div>

                    <!-- Téléphone -->
                    <div class="flex items-start gap-5 group">
                        <div class="flex-shrink-0 w-11 h-11 bg-green-50 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Téléphone</p>
                            <a href="{{ $settings->telephone_appel ?? '(+229) 00 00 00 00' }}" class="text-[#1B2E58] font-black text-lg tracking-tight hover:text-orange-500 transition-colors">{{ $settings->telephone_appel ?? '(+229) 00 00 00 00' }}</a>
                        </div>
                    </div>
                </div>

                <!-- Bouton d'action -->
                <div class="mt-12">
                    <a href="{{ route('contact') }}" class="flex items-center justify-center gap-3 bg-[#1B2E58] text-white py-4 px-8 rounded-2xl font-bold hover:bg-[#00261C] transition-all shadow-lg hover:shadow-xl active:scale-95">
                        <span>Prendre rendez-vous</span>
                        <i class="fas fa-calendar-alt text-sm opacity-60"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>