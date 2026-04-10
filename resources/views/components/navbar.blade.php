<!-- Wrapper Header Sticky -->
<header x-data="{ mobileMenuOpen: false, servicesOpen: false, projsOpen: false }" class="sticky top-0 z-[100] w-full shadow-md font-sans">
    
    <!-- 1. TOP BAR (Visible à partir de LG / 1024px) -->
     <!-- 1. TOP BAR (Strictement identique à l'image) -->
    <div class="bg-[#002117] text-white py-2 px-6 hidden lg:block w-full">
        <div class="max-w-[1600px] mx-auto flex justify-between items-center text-[12px]">
            <!-- Infos Gauche -->
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-[#FF9F29]"></i>
                    <span class="text-[#FF9F29] font-bold">Localisation:</span>
                    <span class="text-white font-light">99CR+4F9 032015 - Littoral Cotonou - Bénin</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-envelope text-[#FF9F29]"></i>
                    <span class="text-[#FF9F29] font-bold">Email:</span>
                    <a href="mailto:accessbeninsa@gmail.com" class="text-white font-light hover:underline">accessbeninsa@gmail.com</a>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-clock text-[#FF9F29]"></i>
                    <span class="text-[#FF9F29] font-bold">Heure d'ouverture:</span>
                    <span class="text-white font-light">Lun-Vendredi 07h30 - 18:00</span>
                </div>
            </div>

            <!-- Liens et Réseaux Droite -->
            <div class="flex items-center gap-6">
                <div class="flex gap-4">
                    <a href="#" class="hover:text-[#FF9F29]">Agence</a>
                    <a href="#" class="hover:text-[#FF9F29]">FAQs</a>
                </div>
                <div class="flex items-center gap-2">
                    <a href="#" class="w-6 h-6 bg-[#FF9F29] rounded-full flex items-center justify-center text-[#002117] text-[10px]"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-6 h-6 bg-[#FF9F29] rounded-full flex items-center justify-center text-[#002117] text-[10px]"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="w-6 h-6 bg-[#FF9F29] rounded-full flex items-center justify-center text-[#002117] text-[10px]"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MAIN NAVBAR -->
    <nav class="bg-white h-8 lg:h-18 flex items-stretch w-full relative">
        <div class="flex-1 flex items-center justify-between pl-0 pr-4 lg:pl-0 lg:pr-10">
            <!-- LOGO -->
            <a href="{{ route('home') }}" class="flex-shrink-0 ">
                <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="h-10 lg:h-48">
            </a>

            <!-- DESKTOP MENU (Visible à partir de LG / 1024px) -->
            <ul class="hidden lg:flex items-center justify-center flex-1 px-4 text-[#001C8E] font-bold text-[13px] xl:text-[15px] whitespace-nowrap gap-x-4 xl:gap-x-6">
                
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">Accueil</a></li>
                
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">À Propos</a></li>

                <!-- Dropdown Services -->
                <li class="relative group py-8" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
    <div class="flex items-center gap-1 cursor-pointer {{ request()->is('services*') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all font-bold">
        Nos Services <i class="fas fa-chevron-down text-[8px] opacity-70 ml-1 transition-transform" :class="open ? 'rotate-180' : ''"></i>
    </div>
    
    <!-- Menu déroulant -->
    <ul x-show="open" x-cloak x-transition 
        class="absolute bg-white shadow-2xl rounded-b-xl py-3 w-72 xl:w-80 top-full left-1/2 -translate-x-1/2 border-t-2 border-blue-600 z-50">
        
        @php $services = ['construction-piscine'=>'Construction Piscine', 'immobilier'=>'NAKAYO Immobilier', 'papeterie'=>'Papeterie & Fournitures', 'savonnerie'=>'Savonnerie', 'agro-industrie'=>'Agro-Industrie']; @endphp
        
        @foreach($services as $slug => $name)
            <li>
                <a href="{{ route('services.show', $slug) }}" 
                   class="block py-3 pl-10 text-left border-b border-gray-50 hover:bg-blue-50 hover:text-blue-600 transition text-sm font-semibold last:border-0">
                    {{ $name }}
                </a>
            </li>
        @endforeach
    </ul>
</li>

                <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">Blog</a></li>

                <!-- Dropdown Réalisations -->
                <li class="relative group py-8" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <div class="flex items-center gap-1 cursor-pointer transition-all {{ request()->routeIs('realisations.*') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }}">
                        Réalisations <i class="fas fa-chevron-down text-[8px] opacity-70 ml-1 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </div>
                    <ul x-show="open" x-cloak x-transition class="absolute bg-white shadow-2xl rounded-b-xl py-3 w-56 top-full left-1/2 -translate-x-1/2 border-t-2 border-blue-600 z-50 text-center">
                        <li><a href="{{ route('realisations.projets') }}" class="block py-3 border-b border-gray-50 hover:bg-blue-50 hover:text-blue-600 transition">Projets réalisés</a></li>
                        <li><a href="{{ route('realisations.galerie') }}" class="block py-3 hover:bg-blue-50 hover:text-blue-600 transition">Galerie Photos</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('recrutement') }}" class="{{ request()->routeIs('recrutement') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">Recrutement</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">Contact</a></li>
            </ul>

            <!-- BURGER BUTTON (Visible sous LG / 1024px) -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-[#1B2E58] p-2 focus:outline-none">
                <i :class="mobileMenuOpen ? 'fas fa-times' : 'fas fa-bars'" class="text-2xl"></i>
            </button>
        </div>

        <!-- RIGHT SECTION (Visible à partir de LG / 1024px) -->
        <div class="hidden lg:flex bg-[#1B2E58] items-center px-6 xl:px-8 text-white min-w-fit lg:min-w-[380px] xl:min-w-[450px]">
            <a href="{{ route('login') }}" class="bg-white text-[#1B2E58] px-5 xl:px-8 py-3 rounded-xl font-bold text-xs xl:text-sm uppercase hover:bg-[#FF9F29] hover:text-white transition-all mr-6 whitespace-nowrap">Connexion</a>
            <div class="flex items-center gap-3 whitespace-nowrap">
                <a href="https://wa.me/2290166556161" target="_blank" class="relative flex items-center justify-center w-9 h-9">
                    <div class="absolute inset-0 rounded-full border border-green-400 opacity-40 animate-ping"></div>
                    <div class="w-7 h-7 bg-[#FF9F29] rounded-full flex items-center justify-center relative z-10 shadow-lg text-white">
                        <i class="fab fa-whatsapp text-sm"></i>
                    </div>
                </a>
                <div class="flex flex-col">
                    <span class="text-[16px]  font-medium">Besoin d'assistance?</span>
                    <span class="text-[19px] font-black tracking-tight leading-none  whitespace-nowrap">(+229) 0121322019</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- MOBILE MENU SIDEBAR (Glissement latéral) -->
    <div x-show="mobileMenuOpen" x-cloak class="lg:hidden fixed inset-0 z-[150]">
        <!-- Backdrop flou -->
        <div @click="mobileMenuOpen = false" x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        
        <!-- Sidebar Content -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" class="absolute right-0 top-0 h-full w-[85%] max-w-sm bg-[#1B2E58] text-white p-8 overflow-y-auto">
            <div class="flex justify-between items-center mb-10">
                <img src="{{ asset('images/logo.png') }}" class="h-10 brightness-200" alt="Logo">
                <button @click="mobileMenuOpen = false" class="text-3xl"><i class="fas fa-times"></i></button>
            </div>

            <ul class="flex flex-col gap-5 text-lg font-bold">
                <li><a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3"><i class="fas fa-home text-sm opacity-50"></i> Accueil</a></li>
                <li><a href="{{ route('about') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3"><i class="fas fa-info-circle text-sm opacity-50"></i> À Propos</a></li>
                
                <!-- Accordéon Services Mobile -->
                <li x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center py-1">
                        <span class="flex items-center gap-3"><i class="fas fa-concierge-bell text-sm opacity-50"></i> Nos Services</span>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <ul x-show="open" x-collapse class="mt-4 ml-8 space-y-4 text-base text-white/70 border-l border-white/10 pl-4">
                        @foreach($services as $slug => $name)
                            <li><a href="{{ route('services.show', $slug) }}">{{ $name }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li><a href="{{ route('blog.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3"><i class="fas fa-newspaper text-sm opacity-50"></i> Blog</a></li>

                <!-- Accordéon Réalisations Mobile -->
                <li x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center py-1">
                        <span class="flex items-center gap-3"><i class="fas fa-images text-sm opacity-50"></i> Réalisations</span>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <ul x-show="open" x-collapse class="mt-4 ml-8 space-y-4 text-base text-white/70 border-l border-white/10 pl-4">
                        <li><a href="{{ route('realisations.projets') }}">Projets réalisés</a></li>
                        <li><a href="{{ route('realisations.galerie') }}">Galerie Photos</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('recrutement') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3"><i class="fas fa-user-plus text-sm opacity-50"></i> Recrutement</a></li>
                <li><a href="{{ route('contact') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3"><i class="fas fa-phone text-sm opacity-50"></i> Contact</a></li>
            </ul>

            <div class="mt-12 pt-8 border-t border-white/10">
                <a href="{{ route('login') }}" class="inline-block w-full bg-[#FF9F29] text-[#1B2E58] py-4 rounded-2xl font-black uppercase text-sm shadow-xl text-center mb-8">Espace Connexion</a>
                <div class="flex items-center justify-center gap-4 p-4 bg-white/5 rounded-xl">
                    <i class="fab fa-whatsapp text-2xl text-green-400"></i>
                    <div class="text-left">
                        <p class="text-[10px] uppercase opacity-50">Assistance WhatsApp</p>
                        <p class="font-bold text-base">(+229) 01 66 55 61 61</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>