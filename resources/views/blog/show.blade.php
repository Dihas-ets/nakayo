@extends('layouts.app')

@section('content')


{{-- 1. HEADER (Déplacé à l'intérieur de la section pour la validité du fichier) --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky top-0 z-[100] w-full shadow-md">
            @include('components.navbar')
        </header>
    @endif


<!-- 1. NOUVEAU HERO DESIGN (Spécifique à l'article) -->
<section class="relative h-[500px] flex flex-col items-center justify-center text-white overflow-hidden font-sans">
    
    <!-- IMAGE D'ARRIÈRE-PLAN -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=1920" 
             alt="Background" 
             class="w-full h-full object-cover">
        
        <!-- OVERLAY BLEU/VERT TRANSPARENT -->
        <div class="absolute inset-0 bg-[#00261C]/80 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#1B2E58]/40"></div>
    </div>

    <!-- CONTENU PRINCIPAL -->
    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
        
        <!-- Titre (Taille diminuée) -->
        <h1 class="text-white text-2xl md:text-4xl lg:text-5xl font-black tracking-tight mb-4 leading-tight uppercase">
            Comment booster votre commerce <br class="hidden md:block"> grâce au micro-crédit
        </h1>

        <!-- Description / Meta Infos (Taille diminuée) -->
        <p class="text-white/80 text-sm md:text-base max-w-2xl mx-auto leading-relaxed mb-8 font-medium italic">
            Publié le 24 Mars 2024 par l'équipe rédactionnelle d'Access Finance Bénin.
        </p>

        <!-- Bouton CTA (Taille diminuée) -->
        <div class="flex justify-center mb-8">
            <a href="#" class="inline-flex items-center gap-2 bg-white text-[#1B2E58] px-8 py-3 rounded-xl font-bold text-sm hover:bg-orange-400 hover:text-white transition-all duration-300 shadow-lg group">
                Nous Contactez
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>

    <!-- BREADCRUMBS (Fil d'Ariane) - Taille diminuée (text-xs) -->
    <div class="absolute bottom-8 w-full text-center z-10">
        <nav class="flex justify-center items-center gap-2 text-xs font-semibold uppercase tracking-widest text-white/80">
            <a href="/" class="hover:text-orange-400 transition">Accueil</a>
            <span class="text-white/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
            <a href="{{ route('blog.index') }}" class="hover:text-orange-400 transition">Actualités</a>
            <span class="text-white/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
            <span class="text-white/60">Article</span>
        </nav>
    </div>
</section>

<!-- CONTENU DE L'ARTICLE ET SIDEBAR (Inchangés) -->
<div class="container mx-auto py-20 px-6">
    <div class="flex flex-col lg:flex-row gap-16 items-start">
        
        <!-- ARTICLE COMPLET (Gauche - 2/3) -->
        <article class="w-full lg:w-2/3">
            <!-- Grande Image de l'article -->
            <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=1200" class="w-full h-[500px] object-cover rounded-[40px] mb-12 shadow-2xl" alt="">

            <div class="prose prose-xl max-w-none text-gray-700 leading-relaxed">
                <h2 class="text-4xl font-black text-blue-900 mb-8 uppercase tracking-tighter">L'importance du micro-financement au Bénin</h2>
                <p>Le contenu de votre article ira ici. Vous pouvez mettre du texte long, des citations, et d'autres images...</p>
                
                <blockquote class="border-l-8 border-[#FFB75E] pl-8 py-6 my-10 bg-gray-50 font-bold text-2xl text-blue-900 italic">
                    "Le crédit n'est pas une dette, c'est un levier pour ceux qui osent entreprendre."
                </blockquote>

                <p>Suite du texte avec toutes les informations nécessaires pour vos lecteurs.</p>
            </div>

            <!-- Boutons de partage -->
            <div class="mt-16 pt-8 border-t border-gray-100 flex items-center gap-6">
                <span class="font-black text-blue-900 uppercase text-xs tracking-widest">Partager l'article :</span>
                <div class="flex gap-4">
                    <a href="#" class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center text-blue-900 hover:bg-blue-900 hover:text-white transition-all shadow-sm">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center text-blue-900 hover:bg-blue-900 hover:text-white transition-all shadow-sm">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </article>

        <!-- SIDEBAR (Droite - 1/3) -->
        <aside class="w-full lg:w-1/3 space-y-12 sticky top-24">
            <!-- Widget : Articles Récents -->
            <div class="bg-gray-50 p-8 rounded-[32px] border border-gray-100 shadow-sm">
                <h4 class="text-xl font-black text-blue-900 mb-8 border-b pb-4 uppercase tracking-tighter">Articles Récents</h4>
                <div class="space-y-6">
                    @for($j=1; $j<=3; $j++)
                    <a href="#" class="flex gap-4 group">
                        <div class="w-20 h-20 flex-shrink-0 rounded-2xl overflow-hidden shadow-sm">
                            <img src="https://picsum.photos/200/200?random={{$j}}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div>
                            <h5 class="text-sm font-bold text-blue-900 group-hover:text-[#FFB75E] transition-colors line-clamp-2">Comment épargner efficacement en 2024 ?</h5>
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">20 MARS 2024</span>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>

            <!-- Widget : Newsletter -->
            <div class="bg-blue-900 p-10 rounded-[32px] text-white shadow-2xl relative overflow-hidden">
                <!-- Décoration fond -->
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/5 rounded-full"></div>
                
                <h4 class="text-2xl font-black mb-4 uppercase tracking-tighter">Newsletter</h4>
                <p class="text-blue-200 text-sm mb-8 leading-relaxed">Recevez nos conseils financiers et opportunités directement par mail.</p>
                <div class="space-y-4">
                    <input type="email" placeholder="Votre email professionnel" class="w-full bg-white/10 border border-white/20 p-4 rounded-xl text-white placeholder:text-white/40 focus:outline-none focus:border-[#FFB75E] transition-colors">
                    <button class="w-full bg-[#FFB75E] text-white font-black py-4 rounded-xl uppercase text-xs tracking-widest shadow-lg hover:bg-orange-600 transition-all transform hover:-translate-y-1">S'abonner</button>
                </div>
            </div>
        </aside>

    </div>
</div>
@endsection