<header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-40">
    
    <!-- GAUCHE : BURGER & TITRE -->
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="lg:hidden text-[#00261C] hover:text-[#FF9F29] transition-colors">
            <i class="fa-solid fa-bars text-2xl"></i>
        </button>
        <h1 class="text-xl font-black text-[#1B2E58] tracking-tight uppercase italic">
            @yield('title', 'Tableau de bord')
        </h1>
    </div>

    <!-- DROITE : NOTIFICATIONS & PROFIL -->
    <div class="flex items-center gap-6">
        
        <!-- 1. SECTION NOTIFICATIONS (Dynamique) -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="relative p-2 text-gray-400 hover:text-[#FF9F29] transition-all focus:outline-none">
                <i class="fa-solid fa-bell text-xl"></i>
                {{-- Badge rouge dynamique --}}
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="absolute top-1.5 right-1.5 w-4 h-4 bg-red-500 text-white text-[9px] font-black rounded-full border-2 border-white flex items-center justify-center">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </button>

            {{-- Dropdown Notifications --}}
            <div x-show="open" @click.away="open = false" x-cloak 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-2xl border border-gray-50 z-50 overflow-hidden">
                <div class="p-4 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                    <span class="text-xs font-black text-[#1B2E58] uppercase tracking-widest">Notifications</span>
                </div>
                <div class="max-h-64 overflow-y-auto custom-scrollbar">
                    @forelse(auth()->user()->unreadNotifications as $notification)
                        <div class="p-4 border-b border-gray-50 hover:bg-gray-50 transition-colors">
                            <p class="text-xs font-bold text-[#1B2E58]">{{ $notification->data['title'] ?? 'Alerte Système' }}</p>
                            <p class="text-[10px] text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-400 text-xs italic">Aucune nouvelle notification</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- 2. SECTION PROFIL -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center gap-3 group focus:outline-none">
                <div class="w-10 h-10 rounded-full bg-blue-50 border-2 border-gray-100 flex items-center justify-center text-[#1B2E58] font-black transition-all group-hover:border-[#FF9F29]">
                    {{-- Affiche l'initiale du nom --}}
                    {{ substr(auth()->user()->nom_complet, 0, 1) }}
                </div>
                <div class="text-left hidden md:block">
                    <p class="text-sm font-black text-[#1B2E58] group-hover:text-[#FF9F29] transition-colors">
                        {{ auth()->user()->nom_complet }}
                    </p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ auth()->user()->role }}</p>
                </div>
                <i class="fa-solid fa-chevron-down text-[10px] text-gray-300 transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </button>

            {{-- Dropdown Profil --}}
            <div x-show="open" @click.away="open = false" x-cloak 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="absolute right-0 mt-3 w-52 bg-white rounded-2xl shadow-2xl border border-gray-50 py-2 z-50 overflow-hidden">
                
                <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 hover:text-[#1B2E58] transition-colors">
                    <i class="fa-solid fa-circle-user opacity-50"></i>
                    <span class="font-bold">Mon profil</span>
                </a>
                
                <div class="border-t border-gray-50 my-1"></div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                        <i class="fa-solid fa-power-off opacity-70"></i>
                        <span class="font-black uppercase text-[11px] tracking-widest">Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>