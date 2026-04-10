@extends('layouts.app')
{{--HEADER : Top-bar + Navbar --}}
    {{-- On vérifie que la route actuelle n'est pas dans la liste noire --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky top-0 z-[100] w-full shadow-md">
            
            @include('components.navbar')
        </header>
    @endif
@section('content')
<!-- 1. NOUVEAU HERO DESIGN (Actualités & Médias) -->
@extends('layouts.app')

@section('content')

{{-- 1. HERO SECTION : DESIGN CINÉMATIQUE --}}
<section class="relative h-[500px] md:h-[600px] flex items-center justify-center overflow-hidden font-sans bg-[#0A1128]">
    <!-- Image de fond avec Zoom Ken Burns -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1920" 
             alt="Background" 
             class="w-full h-full object-cover opacity-60">
        <!-- Overlay dégradé complexe -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#0A1128] via-[#0A1128]/80 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#F8FAFC] to-transparent opacity-20"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
        <div class="max-w-3xl reveal-on-scroll opacity-0 transform -translate-x-10 transition-all duration-1000">
            <!-- Badge discret -->
            <span class="inline-block bg-[#FFB75E] text-[#1B2E58] px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-[0.3em] mb-6 shadow-xl">
                Nakayo Insights
            </span>
            
            <h1 class="text-white text-5xl md:text-8xl font-black tracking-tighter leading-[0.9] mb-8 uppercase italic">
                Actualités <br> & <span class="text-[#FFB75E]">Médias</span>
            </h1>

            <p class="text-white/70 text-lg md:text-xl max-w-xl leading-relaxed mb-10 font-medium border-l-2 border-[#FFB75E] pl-6">
                L'expertise de Nakayo décryptée : tendances, innovations et impact socio-économique au cœur du Bénin.
            </p>

            <div class="flex gap-4">
                <a href="#featured" class="bg-white text-[#1B2E58] px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-[#FFB75E] hover:text-white transition-all shadow-2xl">
                    Lire le dernier numéro
                </a>
            </div>
        </div>
    </div>

    <!-- Fil d'Ariane flottant -->
    <nav class="absolute bottom-10 left-6 lg:left-12 flex items-center gap-3 text-white/40 text-[10px] font-bold uppercase tracking-[0.2em] z-20">
        <a href="/" class="hover:text-[#FFB75E] transition">Accueil</a>
        <i class="fas fa-chevron-right text-[7px]"></i>
        <span class="text-white/80">Blog</span>
    </nav>
</section>

{{-- 2. SECTION ARTICLES --}}
<section id="featured" class="py-24 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <!-- Titre de section minimaliste -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-6">
            <div class="reveal-on-scroll opacity-0 transition-all duration-700">
                <h2 class="text-[#1B2E58] text-3xl md:text-5xl font-black uppercase italic tracking-tighter leading-none">
                    À la <span class="text-[#FFB75E]">Une.</span>
                </h2>
                <div class="h-1.5 w-20 bg-[#FFB75E] rounded-full mt-4"></div>
            </div>
            <p class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.3em] mb-2">Nakayo Corporation Sarl</p>
        </div>
        
        {{-- --- ARTICLE FEATURED (MAGAZINE STYLE) --- --}}
        <div class="mb-32 reveal-on-scroll opacity-0 transform translate-y-10 transition-all duration-1000 delay-200">
            <article class="relative flex flex-col lg:flex-row bg-white rounded-[3rem] overflow-hidden shadow-[0_40px_100px_-20px_rgba(27,46,88,0.15)] group border border-gray-100">
                
                <!-- Image -->
                <div class="lg:w-3/5 relative overflow-hidden h-[400px] lg:h-auto">
                    <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=1200" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000" 
                         alt="Featured">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/20 to-transparent"></div>
                </div>

                <!-- Contenu -->
                <div class="lg:w-2/5 p-10 lg:p-16 flex flex-col justify-center relative">
                    <div class="absolute top-10 right-10 text-gray-100 text-6xl font-black italic select-none uppercase">Top</div>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-[#FFB75E] text-[11px] font-black uppercase tracking-widest bg-[#FFB75E]/10 px-3 py-1 rounded-md">Économie</span>
                        <span class="text-gray-300 text-xs font-bold uppercase tracking-widest italic">24 Mars 2024</span>
                    </div>
                    
                    <h2 class="text-[#1B2E58] text-3xl lg:text-4xl font-black leading-tight mb-8 group-hover:text-blue-600 transition-colors">
                        Comment booster votre commerce grâce au micro-crédit
                    </h2>
                    
                    <p class="text-gray-500 text-lg mb-10 leading-relaxed font-medium opacity-80">
                        Plongez au cœur des stratégies financières gagnantes pour dynamiser l'entrepreneuriat local.
                    </p>

                    <div class="flex items-center gap-6 mb-10 text-gray-400">
                        <div class="flex items-center gap-2"><i class="far fa-eye text-[#FFB75E]"></i> <span class="text-xs font-bold uppercase tracking-tighter">2.8k</span></div>
                        <div class="flex items-center gap-2"><i class="far fa-heart text-[#FFB75E]"></i> <span class="text-xs font-bold uppercase tracking-tighter">150</span></div>
                    </div>

                    <a href="#" class="inline-flex items-center gap-3 bg-[#1B2E58] text-white w-fit px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-[#FFB75E] transition-all shadow-xl active:scale-95">
                        Lire l'article <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
        </div>

        {{-- --- GRILLE DES ARTICLES RÉCENTS --- --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-10">
            @for ($i = 1; $i <= 6; $i++)
            <article class="reveal-on-scroll opacity-0 transform translate-y-10 transition-all duration-700 delay-[{{ $i * 100 }}ms] bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col group h-full">
                <!-- Image -->
                <div class="relative h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542222024-c39e2281f121?q=80&w=800" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <!-- Badge de catégorie sur l'image -->
                    <div class="absolute top-6 left-6">
                        <span class="bg-white/90 backdrop-blur-md text-[#1B2E58] px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest shadow-xl">
                            Conseil
                        </span>
                    </div>
                </div>

                <!-- Contenu -->
                <div class="p-10 flex-1 flex flex-col">
                    <div class="text-gray-400 text-[10px] font-bold uppercase tracking-[0.2em] mb-4 flex items-center gap-2">
                        <i class="far fa-calendar-alt text-[#FFB75E]"></i> 24 Mars 2024
                    </div>

                    <h3 class="text-[#1B2E58] text-2xl font-black mb-6 leading-tight group-hover:text-blue-600 transition-colors italic">
                        L'innovation financière au service du digital
                    </h3>

                    <p class="text-gray-500 text-sm mb-10 leading-relaxed font-medium opacity-80 line-clamp-3">
                        Découvrez comment les nouveaux outils numériques transforment la gestion quotidienne de vos finances...
                    </p>

                    <div class="mt-auto pt-6 border-t border-gray-50 flex justify-between items-center">
                        <div class="flex items-center gap-4 text-gray-400">
                            <span class="text-[10px] font-bold tracking-tighter"><i class="far fa-heart mr-1"></i> 24</span>
                        </div>
                        <a href="#" class="text-[#1B2E58] font-black uppercase text-[10px] tracking-[0.2em] flex items-center gap-2 group/btn hover:text-[#FFB75E] transition-all">
                            Voir Plus <i class="fas fa-arrow-right text-[8px] transform group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endfor
        </div>

        <!-- Pagination / Bouton final -->
        <div class="mt-24 text-center">
            <button class="bg-[#1B2E58] text-white px-12 py-5 rounded-2xl font-black uppercase text-[11px] tracking-[0.3em] shadow-2xl hover:bg-[#FFB75E] transition-all hover:scale-105 active:scale-95">
                Charger plus d'articles
            </button>
        </div>
    </div>
</section>

{{-- SCRIPT D'ANIMATION AU SCROLL (Réutilisation de ta logique globale) --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = { threshold: 0.15 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', '-translate-x-10', 'translate-y-10');
                    entry.target.classList.add('opacity-100', 'translate-x-0', 'translate-y-0');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
    });
</script>



<!-- LE RESTE DE LA PAGE RESTE INCHANGÉ -->
<section class="py-20 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-6">

    <!-- Remplacer l'ancienne div du titre par celle-ci -->
<div class="text-center mb-16">
    <h2 class="text-[#1B2E58] text-3xl md:text-4xl font-black mb-4 uppercase tracking-tight">
        Les récentes nouvelles d'Access Finance Bénin
    </h2>
    <!-- mx-auto permet de centrer la barre horizontalement -->
    <div class="w-20 h-1.5 bg-[#FFB75E] rounded-full mx-auto"></div>
</div>
        
        {{-- --- 2. L'ARTICLE FEATURED (MIS EN AVANT) --- --}}
        <div class="mb-20 px-4 lg:px-0">
    <!-- Changement ici : bg-[#1B2E58]/90 et backdrop-blur-md -->
    <article class="relative flex flex-col lg:flex-row bg-[#1B2E58]/95 backdrop-blur-md rounded-[40px] overflow-hidden shadow-2xl group min-h-[500px] border border-white/10">
        
        <!-- Image / Vidéo Featured -->
        <div class="lg:w-1/2 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=1200" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700 opacity-90" 
                 alt="Featured">
            
            <!-- Badge "Featured" -->
            <div class="absolute top-8 left-8">
                <span class="bg-[#FFB75E] text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg">
                    FEATURED
                </span>
            </div>

            <!-- Bouton Play -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-20 h-20 bg-white/20 backdrop-blur-xl rounded-full flex items-center justify-center border border-white/30 group-hover:scale-110 transition-transform duration-500">
                    <span class="text-white text-3xl ml-1">▶</span>
                </div>
            </div>
        </div>

        <!-- Contenu Featured (Le fond bleu est maintenant transparent grâce au parent) -->
        <div class="lg:w-1/2 p-10 lg:p-20 flex flex-col justify-center">
            
            {{-- CATEGORIE ET DATE --}}
            <div class="flex items-center gap-4 mb-4">
                <span class="text-[#FFB75E] text-[11px] font-black uppercase tracking-widest">Économie</span>
                <span class="w-1 h-1 bg-white/30 rounded-full"></span>
                <span class="text-white/50 text-[11px] font-black uppercase tracking-widest">24 Mars 2024</span>
            </div>
            
            <h2 class="text-white text-3xl lg:text-5xl font-black leading-tight mb-6">
                Comment booster votre commerce grâce au micro-crédit
            </h2>
            
            <p class="text-white/70 text-lg mb-10 line-clamp-3 leading-relaxed font-light">
                Découvrez les stratégies gagnantes pour utiliser votre financement de manière optimale et multiplier votre chiffre d'affaires en quelques mois.
            </p>

            {{-- STATISTIQUES --}}
            <div class="flex items-center gap-8 mb-12 text-white/40 border-t border-white/10 pt-8">
                <div class="flex items-center gap-2">
                    <span class="text-xs">👁️</span>
                    <span class="text-xs font-bold tracking-tighter">2.8k vues</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs">❤️</span>
                    <span class="text-xs font-bold tracking-tighter">150 likes</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs">💬</span>
                    <span class="text-xs font-bold tracking-tighter">12 coms</span>
                </div>
            </div>

            <!-- BOUTON LIRE -->
            <a href="/blog-detail" class="inline-flex items-center justify-center bg-white text-[#1B2E58] w-fit px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-[#FFB75E] hover:text-white transition-all shadow-xl active:scale-95">
                Lire l'article complet
            </a>
        </div>
    </article>
</div>

        {{-- --- 3. GRILLE DES ARTICLES RÉCENTS --- --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @for ($i = 1; $i <= 6; $i++)
            <article class="bg-white rounded-[32px] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 flex flex-col group">
                <!-- Image Section -->
                <div class="relative aspect-[16/10] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542222024-c39e2281f121?q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-duration-700">
                    
                    <!-- Badge Statut reste sur l'image -->
                    <div class="absolute top-5 left-5">
                        <div class="bg-blue-900/80 backdrop-blur-md px-3 py-1.5 rounded-full flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                            <span class="text-[9px] font-black text-white uppercase tracking-widest">Publié</span>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-8 flex-1 flex flex-col">
                    
                    {{-- CATEGORIE ET DATE AU DESSUS DU TITRE --}}
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-[#FFB75E] text-[10px] font-black uppercase tracking-widest">Financement</span>
                        <span class="text-gray-300">|</span>
                        <span class="text-gray-400 text-[10px] font-black uppercase tracking-widest">24 Mars 2024</span>
                    </div>

                    <h3 class="text-[#1B2E58] text-xl font-black mb-4 leading-tight group-hover:text-[#FFB75E] transition-colors">
                        Titre de l'article récent numéro {{ $i }}
                    </h3>

                    <p class="text-gray-500 text-sm mb-6 line-clamp-2">
                        Description courte de l'article pour donner envie de cliquer et découvrir le contenu.
                    </p>
                    
                    

                    <!-- Footer Card -->
                    <div class="mt-auto pt-6 border-t border-gray-50 flex justify-between items-center text-gray-400">
                        <div class="flex gap-4">
                            <span class="text-[10px] font-bold">👁️ 150</span>
                            <span class="text-[10px] font-bold">❤️ 24</span>
                        </div>
                        <a href="/blog-detail" class="text-[#1B2E58] font-black uppercase text-[10px] tracking-widest hover:text-[#FFB75E]">
                            Lire <span>↗</span>
                        </a>
                    </div>
                </div>
            </article>
            @endfor
        </div>
    </div>
</section>
@endsection