<footer class="relative bg-[#020C1B] text-white pt-16 lg:pt-20 pb-10 overflow-hidden font-sans">
    <!-- Motif topographique en arrière-plan (SVG) -->
    <div class="absolute top-0 right-0 w-full md:w-1/3 h-full opacity-10 pointer-events-none z-0">
        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" class="w-full h-full stroke-white fill-none">
            <path d="M100,50 Q150,20 200,50 T300,50 T400,50" stroke-width="1"/>
            <path d="M80,100 Q140,70 210,100 T320,100 T430,100" stroke-width="1"/>
            <path d="M120,150 Q180,120 250,150 T360,150 T470,150" stroke-width="1"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Grille responsive -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
            
            <!-- Colonne 1 : À Propos -->
            <div class="flex flex-col">
                <h3 class="text-xl font-bold mb-6 lg:mb-8 italic uppercase tracking-tighter">À Propos De Nous</h3>
                <p class="text-gray-400 text-[14px] lg:text-[15px] leading-relaxed mb-8 text-justify">
                    NAKAYO COORPORATION Sarl est une entreprise privée diversifiée, née de la vision de fédérer des secteurs clés du développement. Avec une approche innovante et un engagement sans faille, nous construisons des ponts entre les besoins du marché et des solutions concrètes.
                </p>
                <!-- Icônes Sociales -->
                <div class="flex gap-4">
                    <a href="#" class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center hover:bg-[#FF9F29] hover:border-[#FF9F29] transition-all duration-300">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center hover:bg-[#FF9F29] hover:border-[#FF9F29] transition-all duration-300">
                        <i class="fab fa-linkedin-in text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center hover:bg-[#FF9F29] hover:border-[#FF9F29] transition-all duration-300">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Colonne 2 : Liens Utiles -->
            <div class="sm:pl-10">
                <h3 class="text-xl font-bold mb-6 lg:mb-8 italic uppercase tracking-tighter">Liens Utiles</h3>
                <ul class="space-y-4 text-gray-400 text-[14px] lg:text-[15px]">
                    <li><a href="{{ route('about') }}" class="hover:text-[#FF9F29] transition-colors">Qui sommes-nous</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-[#FF9F29] transition-colors">Blog & Actualités</a></li>
                    <li><a href="{{ route('recrutement') }}" class="hover:text-[#FF9F29] transition-colors">Recrutement</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[#FF9F29] transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Colonne 3 : Nos Produits -->
            <div>
                <h3 class="text-xl font-bold mb-6 lg:mb-8 italic uppercase tracking-tighter">Nos Produits</h3>
                <ul class="space-y-4 text-gray-400 text-[14px] lg:text-[15px]">
                    <li><a href="#" class="hover:text-[#FF9F29] transition-colors">Crédit Commerce</a></li>
                    <li><a href="#" class="hover:text-[#FF9F29] transition-colors">Crédit Agricole</a></li>
                    <li><a href="#" class="hover:text-[#FF9F29] transition-colors">Financement TPE/PME</a></li>
                    <li><a href="#" class="hover:text-[#FF9F29] transition-colors">Microcrédit</a></li>
                    <li><a href="#" class="hover:text-[#FF9F29] transition-colors">Épargne et Placement</a></li>
                    <li><a href="#" class="hover:text-[#FF9F29] transition-colors">Assurances</a></li>
                </ul>
            </div>

            <!-- Colonne 4 : Contacts Rapides -->
            <div>
                <h3 class="text-xl font-bold mb-6 lg:mb-8 italic uppercase tracking-tighter">Contacts Rapides</h3>
                <p class="text-gray-400 text-[14px] mb-6">
                    Pour toute question, n'hésitez pas à nous contacter.
                </p>
                <div class="space-y-5">
                    <div class="flex items-center gap-4 group">
                        <i class="fas fa-envelope text-[#FF9F29] text-lg"></i>
                        <a href="mailto:nakayocorporation@gmail.com" class="text-[#FF9F29] font-bold text-[14px] lg:text-[16px] hover:underline break-all">
                            nakayocorporation@gmail.com
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fas fa-phone-alt text-[#FF9F29] text-lg"></i>
                        <span class="text-[#FF9F29] font-bold text-[14px] lg:text-[16px] tracking-wider">+229 66 55 61 61</span>
                    </div>
                    <div class="flex items-start gap-4">
                        <i class="fas fa-map-marker-alt text-[#FF9F29] text-lg mt-1"></i>
                        <span class="text-gray-400 text-[14px] leading-relaxed">
                            Zogbo Yénawa Lot 1887  “G” Maison AMOUSSOU Benoit,<br class="hidden lg:block"> Cotonou, Bénin
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barre orange et bouton Haut de page -->
    <div class="relative mt-16 lg:mt-20 border-t-4 border-[#FF9F29]">
        <div class="absolute -top-[2px] left-1/2 -translate-x-1/2 -translate-y-1/2">
            <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="bg-[#020C1B] px-6 lg:px-10 py-3 border-x border-b border-[#FF9F29] flex flex-col items-center group transition-all">
                <i class="fas fa-arrow-up text-[#FF9F29] text-sm mb-1 group-hover:-translate-y-1 transition-transform duration-300"></i>
                <span class="text-white text-[10px] lg:text-[11px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Haut de page</span>
            </button>
        </div>
    </div>
</footer>

<!-- 2. SECTION SUB-FOOTER (Copyright) -->
<div class="bg-white py-8 font-sans border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <!-- Liens sub-footer -->
        <div class="flex flex-wrap justify-center items-center gap-4 text-[#1B2E58] text-[12px] font-bold uppercase tracking-wider mb-4">
            <a href="#" class="hover:text-[#FF9F29] transition-colors">Confidentialité</a>
            <span class="text-gray-300 hidden sm:inline">-</span>
            <a href="#" class="hover:text-[#FF9F29] transition-colors">Conditions</a>
            <span class="text-gray-300 hidden sm:inline">-</span>
            <a href="#" class="hover:text-[#FF9F29] transition-colors">Cookies</a>
            <span class="text-gray-300 hidden sm:inline">-</span>
            <a href="#" class="hover:text-[#FF9F29] transition-colors">Plan du site</a>
        </div>
        
        <!-- Copyright -->
        <p class="text-gray-400 text-[12px] font-medium uppercase tracking-tight">
            © {{ date('Y') }} NAKAYO COORPORATION Sarl, conçu et designé par <span class="text-green-600 font-bold italic">diha's.</span>
        </p>
    </div>
</div>