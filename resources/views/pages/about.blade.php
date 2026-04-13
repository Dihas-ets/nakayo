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


<section class="bg-[#1B2E58] py-16 font-sans overflow-hidden relative">
    <!-- Texture de fond légère (optionnel) -->
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 L100 0 Z" stroke="white" stroke-width="0.1"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Grille adaptative : 2 colonnes mobile, 3 tablette, 5 desktop -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-y-12 gap-x-4 text-center items-start">

            <!-- 1. CLIENTS -->
            <div x-data="counter(61, 'K+')" x-init="start()" class="flex flex-col items-center group">
                <div class="mb-6 transition-transform duration-500 group-hover:-translate-y-2">
                    <svg width="70" height="70" viewBox="0 0 64 64" fill="none" stroke="white" stroke-width="1.2">
                        <path d="M32 30C38.6274 30 44 24.6274 44 18C44 11.3726 38.6274 6 32 6C25.3726 6 20 11.3726 20 18C20 24.6274 25.3726 30 32 30Z"/>
                        <path d="M12 58C12 46.9543 20.9543 38 32 38C43.0457 38 52 46.9543 52 58" stroke-linecap="round"/>
                        <circle cx="50" cy="20" r="4" fill="#FFB75E" stroke="none"/>
                    </svg>
                </div>
                <div class="text-white text-3xl font-black mb-2 tracking-tighter">
                    <span x-text="displayValue">0</span><span x-text="suffix"></span>
                </div>
                <div class="text-[#FFB75E] text-[10px] font-black uppercase tracking-[0.3em]">Clients</div>
            </div>

            <!-- 2. PRODUITS -->
            <div x-data="counter(25, '+')" x-init="start()" class="flex flex-col items-center group">
                <div class="mb-6 transition-transform duration-500 group-hover:-translate-y-2">
                    <svg width="70" height="70" viewBox="0 0 64 64" fill="none" stroke="white" stroke-width="1.2">
                        <path d="M32 8L54 18V46L32 56L10 46V18L32 8Z"/>
                        <path d="M10 18L32 28L54 18" />
                        <path d="M32 28V56" />
                        <path d="M43 13L43 22" stroke="#FFB75E" stroke-width="2"/>
                    </svg>
                </div>
                <div class="text-white text-3xl font-black mb-2 tracking-tighter">
                    <span x-text="displayValue">0</span><span x-text="suffix"></span>
                </div>
                <div class="text-[#FFB75E] text-[10px] font-black uppercase tracking-[0.3em]">Produits</div>
            </div>

            <!-- 3. FORMATIONS -->
            <div x-data="counter(12, '+')" x-init="start()" class="flex flex-col items-center group">
                <div class="mb-6 transition-transform duration-500 group-hover:-translate-y-2">
                    <svg width="70" height="70" viewBox="0 0 64 64" fill="none" stroke="white" stroke-width="1.2">
                        <path d="M8 24L32 12L56 24L32 36L8 24Z"/>
                        <path d="M16 28V42C16 42 22 48 32 48C42 48 48 42 48 42V28"/>
                        <path d="M56 24V36" />
                        <circle cx="32" cy="24" r="3" fill="#FFB75E" stroke="none"/>
                    </svg>
                </div>
                <div class="text-white text-3xl font-black mb-2 tracking-tighter">
                    <span x-text="displayValue">0</span><span x-text="suffix"></span>
                </div>
                <div class="text-[#FFB75E] text-[10px] font-black uppercase tracking-[0.3em]">Formations</div>
            </div>

            <!-- 4. EMPLOYÉS -->
            <div x-data="counter(300, '+')" x-init="start()" class="flex flex-col items-center group">
                <div class="mb-6 transition-transform duration-500 group-hover:-translate-y-2">
                    <svg width="70" height="70" viewBox="0 0 64 64" fill="none" stroke="white" stroke-width="1.2">
                        <rect x="12" y="20" width="40" height="32" rx="2"/>
                        <path d="M24 20V14C24 12.8954 24.8954 12 26 12H38C39.1046 12 40 12.8954 40 14V20"/>
                        <path d="M12 32H52" />
                        <path d="M32 32V42" stroke="#FFB75E" stroke-width="2"/>
                    </svg>
                </div>
                <div class="text-white text-3xl font-black mb-2 tracking-tighter">
                    <span x-text="displayValue">0</span><span x-text="suffix"></span>
                </div>
                <div class="text-[#FFB75E] text-[10px] font-black uppercase tracking-[0.3em]">Employés</div>
            </div>

            

            <!-- 6. EXPÉRIENCE -->
            <div x-data="counter(15, 'ans')" x-init="start()" class="flex flex-col items-center group">
                <div class="mb-6 transition-transform duration-500 group-hover:-translate-y-2">
                    <svg width="70" height="70" viewBox="0 0 64 64" fill="none" stroke="white" stroke-width="1.2">
                        <circle cx="32" cy="32" r="26"/>
                        <path d="M32 16V32L42 42" stroke="#FFB75E" stroke-width="2" stroke-linecap="round"/>
                        <path d="M32 6V10M32 54V58M58 32H54M10 32H6" />
                    </svg>
                </div>
                <div class="text-white text-3xl font-black mb-2 tracking-tighter">
                    <span x-text="displayValue">0</span><span x-text="suffix"></span>
                </div>
                <div class="text-[#FFB75E] text-[10px] font-black uppercase tracking-[0.3em]">Expérience</div>
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
</script><br><br>


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

<section class="relative w-full h-[550px] md:h-[650px] flex items-center overflow-hidden font-sans bg-gray-100">
    
    <!-- 1. CARTE GOOGLE MAPS (Couleurs standards et lisibles) -->
    <div class="absolute inset-0 z-0">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.148509652131!2d2.417246!3d6.374945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x102355998a449d63%3A0x633512f451f49615!2sCotonou%2C%20Bénin!5e0!3m2!1sfr!2sbj!4v1710000000000!5m2!1sfr!2sbj" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            class="w-full h-full opacity-90 transition-opacity duration-500 hover:opacity-100">
        </iframe>
        <!-- Overlay dégradé léger pour ne pas gêner la lecture mais lier au design -->
        <div class="absolute inset-y-0 left-0 w-full md:w-1/2 bg-gradient-to-r from-white/80 via-white/40 to-transparent pointer-events-none"></div>
    </div>

    <!-- 2. CONTENU (Carte de visite flottante) -->
    <div class="relative z-10 container mx-auto px-6 lg:px-12">
        <div class="max-w-md">
            
            <!-- Badge "Nous trouver" -->
            <div class="inline-flex items-center gap-2 bg-white/90 backdrop-blur-sm text-[#1B2E58] px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-[2px] mb-6 shadow-sm border border-gray-100">
                <i class="fas fa-map-marker-alt text-[#FFB75E]"></i>
                Siège Social Access Finance
            </div>

            <!-- BLOC DE CONTACT -->
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-[0_30px_60px_-15px_rgba(27,46,88,0.2)] border border-gray-50 relative overflow-hidden">
                
                <!-- Décoration d'angle -->
                <div class="absolute top-0 right-0 w-24 h-24 bg-[#FFB75E]/5 rounded-bl-[100px]"></div>

                <h2 class="text-[#1B2E58] text-3xl font-black mb-1">Cotonou</h2>
                <p class="text-[#FFB75E] font-bold text-sm uppercase tracking-widest mb-10">Agence Principale</p>

                <div class="space-y-8">
                    <!-- Adresse -->
                    <div class="flex items-start gap-5 group">
                        <div class="flex-shrink-0 w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center text-[#1B2E58] group-hover:bg-[#1B2E58] group-hover:text-white transition-all">
                            <i class="fas fa-location-arrow"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Adresse</p>
                            <p class="text-[#1B2E58] font-medium leading-relaxed">99CR+4F9 032015 - Littoral<br>Cotonou, Bénin</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-5 group">
                        <div class="flex-shrink-0 w-11 h-11 bg-orange-50 rounded-xl flex items-center justify-center text-[#FFB75E] group-hover:bg-[#FFB75E] group-hover:text-white transition-all">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Email</p>
                            <a href="mailto:accessbeninsa@gmail.com" class="text-[#1B2E58] font-bold hover:underline">accessbeninsa@gmail.com</a>
                        </div>
                    </div>

                    <!-- Téléphone -->
                    <div class="flex items-start gap-5 group">
                        <div class="flex-shrink-0 w-11 h-11 bg-green-50 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Téléphone</p>
                            <a href="tel:+2290121322019" class="text-[#1B2E58] font-black text-lg tracking-tight hover:text-orange-500 transition-colors">+229 0121322019</a>
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