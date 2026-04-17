<!-- Wrapper Header Sticky -->
<header x-data="{ mobileMenuOpen: false, servicesMobileOpen: false }" class="sticky top-0 z-[100] w-full shadow-md font-sans">
    
    <!-- 1. TOP BAR (Cachée sur mobile) -->
    <div class="bg-[#002117] text-white py-2 px-6 hidden lg:block w-full">
        <div class="max-w-[1600px] mx-auto flex justify-between items-center text-[12px]">
            <!-- Infos Gauche -->
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-[#FF9F29]"></i>
                    <span class="text-[#FF9F29] font-bold">Localisation:</span>
                    <span class="text-white font-light">{{ $settings->localisation ?? 'Adresse non définie' }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-envelope text-[#FF9F29]"></i>
                    <span class="text-[#FF9F29] font-bold">Email:</span>
                    <a href="mailto:{{ $settings->email }}" class="text-white font-light hover:underline">{{ $settings->email ?? 'contact@domaine.com' }}</a>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-clock text-[#FF9F29]"></i>
                    <span class="text-[#FF9F29] font-bold">Heure d'ouverture:</span>
                    <span class="text-white font-light">{{ $settings->horaires_ouverture ?? 'Non définis' }}</span>
                </div>
            </div>

            <!-- Liens et Réseaux Droite -->
            <div class="flex items-center gap-6">
                <!-- <div class="flex gap-4">
                    <a href="#" class="hover:text-[#FF9F29]">Agence</a>
                    <a href="#" class="hover:text-[#FF9F29]">FAQs</a>
                </div> -->
                <div class="flex items-center gap-2">
                    @if($settings->facebook_link)
                        <a href="{{ $settings->facebook_link }}" target="_blank" class="w-6 h-6 bg-[#FF9F29] rounded-full flex items-center justify-center text-[#002117] text-[10px]"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($settings->linkedin_link)
                        <a href="{{ $settings->linkedin_link }}" target="_blank" class="w-6 h-6 bg-[#FF9F29] rounded-full flex items-center justify-center text-[#002117] text-[10px]"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if($settings->instagram_link)
                        <a href="{{ $settings->instagram_link }}" target="_blank" class="w-6 h-6 bg-[#FF9F29] rounded-full flex items-center justify-center text-[#002117] text-[10px]"><i class="fab fa-instagram"></i></a>
                    @endif
                     @if($settings->tiktok_link)
                        <a href="{{ $settings->tiktok_link }}" target="_blank" class="w-6 h-6 bg-[#FF9F29] rounded-full flex items-center justify-center text-[#002117] text-[10px]"><i class="fab fa-tiktok"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MAIN NAVBAR -->
    <!-- Ajustement hauteur mobile : h-20 au lieu de h-8 pour laisser de la place au logo -->
    <nav class="bg-white h-10 lg:h-14 flex items-stretch w-full relative">
        <div class="flex-1 flex items-center justify-between pl-4 pr-4 lg:pl-0 lg:pr-10">
            <!-- LOGO (Agrandi sur mobile : h-16) -->
            <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                <img src="{{ $settings->logo ? Storage::url($settings->logo) : asset('images/logo-default.png') }}" 
                    alt="{{ $settings->nom_agence }}" 
                    class="h-32 lg:h-48 object-contain">
            </a>

            <!-- DESKTOP MENU -->
            <ul class="hidden lg:flex items-center justify-center flex-1 px-4 text-[#001C8E] font-bold text-[13px] xl:text-[15px] whitespace-nowrap gap-x-4 xl:gap-x-6">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">Accueil</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">À Propos</a></li>

                <!-- Services Dropdown Desktop -->
                <li class="relative py-8" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <div class="flex items-center gap-1 cursor-pointer {{ request()->is('services*') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all font-bold">
                        Nos Services <i class="fas fa-chevron-down text-[8px] opacity-70 ml-1 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </div>

                    @php
                        $allServices = \App\Models\Service::select('id_service', 'titre')->get();
                        $totalServices = $allServices->count();
                        $cols = $totalServices <= 4 ? 1 : ($totalServices <= 8 ? 2 : 3);
                        $colClass = [1 => 'grid-cols-1 w-64', 2 => 'grid-cols-2 w-[500px]', 3 => 'grid-cols-3 w-[720px]'][$cols];
                    @endphp

                    <div x-show="open" x-cloak x-transition
                        class="absolute top-full left-1/2 -translate-x-1/2 border-t-2 border-blue-600 bg-white shadow-2xl rounded-b-xl z-50 overflow-hidden">
                        <div class="grid {{ $colClass }} divide-x divide-gray-100">
                            @foreach($allServices as $srv)
                                <a href="{{ route('services.show', $srv->id_service) }}"
                                class="flex items-center justify-between px-6 py-4 text-sm font-semibold text-[#1B2E58] border-b border-gray-50 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                                    <span class="truncate max-w-[160px]">{{ $srv->titre }}</span>
                                    <span class="ml-3 opacity-0 group-hover:opacity-100 transition text-blue-400 text-xs">↗</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>

                <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">Blog</a></li>
                <li><a href="{{ route('realisations.projets') }}" class="{{ request()->routeIs('realisations.*') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">Projets</a></li>
                <li><a href="{{ route('recrutement') }}" class="{{ request()->routeIs('recrutement') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">Recrutement</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600' }} transition-all">Contact</a></li>
            </ul>

            <!-- BURGER BUTTON -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-[#1B2E58] p-2 focus:outline-none">
                <i :class="mobileMenuOpen ? 'fas fa-times' : 'fas fa-bars'" class="text-3xl"></i>
            </button>
        </div>

        <!-- RIGHT SECTION (Desktop) -->
        <div class="hidden lg:flex bg-[#1B2E58] items-center px-6 text-white min-w-fit lg:min-w-[250px] xl:min-w-[300px]">
            <div class="flex items-center gap-3 whitespace-nowrap">
                @php 
                    $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? ''); 
                @endphp
                <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="relative flex items-center justify-center w-8 h-8">
                    <div class="absolute inset-0 rounded-full border border-green-400 opacity-40 animate-ping"></div>
                    <div class="w-7 h-7 bg-[#FF9F29] rounded-full flex items-center justify-center relative z-10 shadow-lg text-white">
                        <i class="fab fa-whatsapp text-sm"></i>
                    </div>
                </a>
                <div class="flex flex-col">
                    <span class="text-[14px] font-medium opacity-80">Assistance?</span>
                    <span class="text-[16px] font-black tracking-tight leading-none whitespace-nowrap">{{ $settings->telephone_appel ?? '(+229) 00 00 00 00' }}</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- MOBILE MENU SIDEBAR -->
    <div x-show="mobileMenuOpen" x-cloak class="lg:hidden fixed inset-0 z-[150]">
        <div @click="mobileMenuOpen = false" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        <div class="absolute right-0 top-0 h-full w-[85%] max-w-sm bg-[#1B2E58] text-white p-8 overflow-y-auto transition-transform duration-300">
            <div class="flex justify-between items-center mb-10">
                <img src="{{ $settings->logo_sans_fond ? Storage::url($settings->logo_sans_fond) : asset('images/logo-default.png') }}" class="h-60 brightness-200" alt="{{ $settings->nom_agence }}">
                <button @click="mobileMenuOpen = false" class="text-3xl"><i class="fas fa-times"></i></button>
            </div>
            
            <ul class="space-y-6 text-lg font-bold">
                <li><a href="{{ route('home') }}" @click="mobileMenuOpen = false">Accueil</a></li>
                <li><a href="{{ route('about') }}" @click="mobileMenuOpen = false">À Propos</a></li>
                
                <!-- Services Mobile Accordion -->
                <li>
                    <div @click="servicesMobileOpen = !servicesMobileOpen" class="flex items-center justify-between cursor-pointer">
                        <span>Nos Services</span>
                        <i class="fas fa-chevron-down text-sm transition-transform" :class="servicesMobileOpen ? 'rotate-180' : ''"></i>
                    </div>
                    <ul x-show="servicesMobileOpen" x-cloak x-transition class="mt-4 ml-4 space-y-4 border-l border-white/20 pl-4 font-normal text-base text-gray-300">
                        @foreach($allServices as $srv)
                            <li><a href="{{ route('services.show', $srv->id_service) }}" @click="mobileMenuOpen = false">{{ $srv->titre }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li><a href="{{ route('blog.index') }}" @click="mobileMenuOpen = false">Blog</a></li>
                <li><a href="{{ route('realisations.projets') }}" @click="mobileMenuOpen = false">Réalisations</a></li>
                <li><a href="{{ route('pages.investisseurs') }}" @click="mobileMenuOpen = false">Projets</a></li>
                <li><a href="{{ route('recrutement') }}" @click="mobileMenuOpen = false">Recrutement</a></li>
                <li><a href="{{ route('contact') }}" @click="mobileMenuOpen = false">Contact</a></li>
            </ul>

            <div class="mt-12 pt-8 border-t border-white/10">
                <div class="flex items-center gap-4 p-4 bg-white/5 rounded-xl">
                    <i class="fab fa-whatsapp text-2xl text-green-400"></i>
                    <div class="text-left">
                        <p class="text-[10px] uppercase opacity-50">WhatsApp</p>
                        <p class="font-bold text-base">{{ $settings->telephone_whatsapp ?? 'Non défini' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>