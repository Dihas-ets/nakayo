<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-[#1B2E58] transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0 flex flex-col h-screen overflow-hidden">
    
    <!-- 1. LOGO (Design Cercle Orange) -->
    <div class="flex flex-col items-center py-10 flex-shrink-0">
        <div class="relative w-20 h-20 bg-[#FF9F29] rounded-full flex items-center justify-center shadow-2xl border-4 border-white/10">
            {{-- Le "P" ou logo de Nakayo --}}
            <div class="w-10 h-10 border-[5px] border-white rounded-full"></div>
            <div class="absolute bottom-3 right-3 w-5 h-5 bg-[#FF9F29] rotate-45"></div>
        </div>
    </div>

    <!-- 2. NAVIGATION (Scrollable) -->
    <nav class="flex-1 overflow-y-auto custom-scrollbar py-4">
        
        {{-- Tableau de bord (Lien simple) --}}
        <x-nav-item 
            title="Tableau de bord" 
            icon="fa-solid fa-table-cells-large" 
            route="{{ route('admin.dashboard') }}" 
            :active="request()->routeIs('admin.dashboard')" 
        />

        {{-- Utilisateurs (Dropdown) --}}
        <x-nav-item type="dropdown" title="Gestion des utilisateurs" icon="fa-solid fa-users-gear" :active="request()->is('admin/users*')">
            <a href="#" class="block py-2 px-8 text-sm text-white/60 hover:text-white transition">Administrateurs</a>
            <a href="#" class="block py-2 px-8 text-sm text-white/60 hover:text-white transition">Rôles & Permissions</a>
        </x-nav-item>

        {{-- Services --}}
        <x-nav-item type="dropdown" title="Gestion des services" icon="fa-solid fa-briefcase" :active="request()->is('admin/services*')">
            <a href="#" class="block py-2 px-8 text-sm text-white/60 hover:text-white">Liste des services</a>
            <a href="#" class="block py-2 px-8 text-sm text-white/60 hover:text-white">Demandes</a>
        </x-nav-item>

        {{-- Blogs (Design actif de ton image) --}}
        <x-nav-item type="dropdown" title="Gestion des Blogs" icon="fa-solid fa-user-group" :active="request()->is('admin/blogs*')">
            <a href="#" class="block py-2 px-8 text-white font-bold">Articles</a>
            <a href="#" class="block py-2 px-8 text-sm text-white/60 hover:text-white">Catégories</a>
            <a href="#" class="block py-2 px-8 text-sm text-white/60 hover:text-white">Avis</a>
            <a href="#" class="block py-2 px-8 text-sm text-white/60 hover:text-white">Étiquettes</a>
        </x-nav-item>

    </nav>

    <!-- 3. BADGE "N" (Bas de page) -->
    <div class="p-6 flex-shrink-0">
        <div class="w-12 h-12 bg-black/40 border border-white/10 rounded-full flex items-center justify-center group cursor-pointer hover:bg-[#FF9F29] transition-all duration-300">
            <span class="text-white font-black text-xl italic group-hover:scale-110 transition">N</span>
        </div>
    </div>
</aside>

<style>
    /* Pour un scroll invisible et moderne */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    [x-cloak] { display: none !important; }
</style>