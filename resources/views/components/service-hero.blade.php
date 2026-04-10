@props(['title', 'description', 'breadcrumb'])

<section class="relative bg-slate-900 text-white py-20 px-6 overflow-hidden">
    <!-- Image de fond avec overlay dégradé -->
    <div class="absolute inset-0 opacity-40">
        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80" class="w-full h-full object-cover">
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 to-transparent"></div>

    <div class="relative container mx-auto z-10">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 tracking-tight">{{ $title }}</h1>
        <p class="max-w-2xl text-lg text-gray-200 mb-10 leading-relaxed">
            {{ $description }}
        </p>

        <div class="flex flex-wrap gap-4 mb-12">
            <a href="#" class="bg-white text-blue-900 px-8 py-3 rounded font-bold flex items-center gap-2 hover:bg-gray-100 transition">
                Contactez-Nous <span class="text-xl">↗</span>
            </a>
            <a href="#" class="border-2 border-white text-white px-8 py-3 rounded font-bold hover:bg-white hover:text-blue-900 transition">
                À Propos De Nous
            </a>
        </div>

        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-300 gap-2">
            <a href="/" class="hover:text-white">Accueil</a> 
            <span>&gt;</span> 
            <a href="#" class="hover:text-white font-semibold">Produits</a> 
            <span>&gt;</span> 
            <span class="text-white">{{ $breadcrumb }}</span>
        </nav>
    </div>
</section>