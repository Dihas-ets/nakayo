<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-[#00261C] transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0 flex flex-col h-screen overflow-hidden shadow-2xl">
    
    <div class="flex flex-col items-center py-10 flex-shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="relative w-24 h-24 bg-[#FF9F29] rounded-full flex items-center justify-center shadow-2xl border-4 border-white/10 group transition-all hover:scale-105">
            <img src="{{ asset('images/logo2.svg') }}" 
                 alt="Nakayo Logo" 
                 class="w-16 h-16 object-contain"
            >
        </a>
    </div>

    <nav class="flex-1 overflow-y-auto custom-scrollbar py-4">
        
        {{-- 1. TABLEAU DE BORD --}}
        <x-nav-item title="Tableau de bord" icon="fa-solid fa-table-cells-large" route="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')" />

        {{-- 2. GESTION DES UTILISATEURS --}}
        <x-nav-item type="dropdown" title="Gestion des utilisateurs" icon="fa-solid fa-users" :active="request()->is('admin/users*')">
            <a href="{{ route('admin.users.admins') }}" class="block py-2 px-8 text-sm {{ request()->routeIs('admin.users.admins') ? 'text-white font-bold' : 'text-white/60 hover:text-white' }}">Administrateur</a>
            <a href="{{ route('admin.users.redacteurs') }}" class="block py-2 px-8 text-sm {{ request()->routeIs('admin.users.redacteurs') ? 'text-white font-bold' : 'text-white/60 hover:text-white' }}">Rédacteur</a>
            <a href="{{ route('admin.users.abonnes') }}" class="block py-2 px-8 text-sm {{ request()->routeIs('admin.users.abonnes') ? 'text-white font-bold' : 'text-white/60 hover:text-white' }}">Abonné</a>
        </x-nav-item>

        {{-- 3. GESTION DES SERVICES --}}
        <x-nav-item type="dropdown" title="Gestion des Services" icon="fa-solid fa-briefcase" 
            :active="request()->is('admin/services*') || request()->is('admin/produits*') || request()->is('admin/galleries*') || request()->is('admin/categories*')">
          
            <a href="{{ route('admin.services.index') }}" 
               class="block py-2 px-8 text-sm {{ request()->routeIs('admin.services.*') ? 'text-white font-bold' : 'text-white/60 hover:text-white' }} transition">
               Services
            </a>

            <a href="{{ route('admin.produits.index') }}" 
               class="block py-2 px-8 text-sm {{ request()->routeIs('admin.produits.*') ? 'text-white font-bold' : 'text-white/60 hover:text-white' }} transition">
               Produits
            </a>

            <a href="{{ route('admin.galleries.index') }}" 
               class="block py-2 px-8 text-sm {{ request()->routeIs('admin.galleries.*') ? 'text-white font-bold' : 'text-white/60 hover:text-white' }} transition">
               Galerie
            </a>
        </x-nav-item>

        {{-- 4. GESTION DES BLOGS (NETTOYÉ) --}}
        <x-nav-item type="dropdown" title="Gestion des Blogs" icon="fa-solid fa-newspaper" :active="request()->is('admin/blog*')">
            <a href="{{ route('admin.blog.articles') }}" class="block py-2 px-8 text-sm {{ request()->routeIs('admin.blog.articles') ? 'text-white font-bold' : 'text-white/60 hover:text-white' }}">Articles</a>
            <a href="{{ route('admin.blog.categories') }}" class="block py-2 px-8 text-sm {{ request()->routeIs('admin.blog.categories') ? 'text-white font-bold' : 'text-white/60 hover:text-white' }}">Catégories</a>
        </x-nav-item>

        {{-- 5. RECRUTEMENTS & FORMATIONS --}}
        <x-nav-item title="Formations" icon="fa-solid fa-graduation-cap" route="{{ route('admin.formations.index') }}" :active="request()->routeIs('admin.formations.*')" />
        <x-nav-item title="Recrutements" icon="fa-solid fa-user-tie" route="{{ route('admin.recrutements.index') }}" :active="request()->routeIs('admin.recrutements.*')" />

        {{-- 6. INFOS ENTREPRISE --}}
        <x-nav-item title="Infos Entreprise" icon="fa-solid fa-building" route="{{ route('admin.settings.index') }}" :active="request()->routeIs('admin.settings.*')" />

        <x-nav-item 
            title="Équipe NAKAYO" 
            icon="fa-solid fa-users-gear" 
            route="{{ route('admin.team.index') }}" 
            :active="request()->routeIs('admin.team.*')" 
        />

        <x-nav-item 
            title="Projets réalisés" 
            icon="fa-solid fa-diagram-project" 
            route="{{ route('admin.projets.index') }}" 
            :active="request()->routeIs('admin.projets.*')" 
        />

    </nav>

    <div class="p-6 flex-shrink-0">
        <div class="w-12 h-12 bg-black/30 border border-white/5 rounded-full flex items-center justify-center group cursor-pointer hover:bg-[#FF9F29] transition-all duration-300">
            <span class="text-white font-black text-xl italic group-hover:scale-110 transition">N</span>
        </div>
    </div>
</aside>