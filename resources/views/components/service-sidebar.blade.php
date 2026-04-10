

@php
    // Liste exacte de vos services
    $navServices = [
        'Construction Piscine' => 'construction-piscine',
        'NAKAYO Immobilier' => 'immobilier',
        'Papeterie et fournitures bureautiques' => 'papeterie',
        'Savonnerie' => 'savonnerie',
        'Agro industrie' => 'agro-industrie'
    ];
@endphp

<!-- Le "h-fit" est CRUCIAL pour que le sticky fonctionne : il dit que la sidebar ne prend que la hauteur de son contenu -->
<aside class="sticky top-28 h-fit space-y-8">
    
    <!-- Bloc Menu Services -->
    <div class="bg-[#F9F9F7] p-8 shadow-sm">
        <h3 class="text-[#1A2B49] text-xl font-bold mb-6">Nos services</h3>
        <div class="flex flex-col gap-3">
            @foreach($navServices as $name => $slug)
                @php
                    // Vérifie si l'URL actuelle contient le slug du service
                    $isActive = request()->is('services/' . $slug);
                @endphp
                
                <a href="{{ route('services.show', $slug) }}" 
                   class="flex justify-between items-center p-4 font-semibold transition-all duration-300 {{ $isActive ? 'bg-[#1A2B49] text-white translate-x-2' : 'bg-white text-[#1A2B49] border border-gray-100 hover:bg-gray-50' }}">
                    {{ $name }} 
                    <span class="text-sm">{{ $isActive ? '→' : '↗' }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Carte Orange (Reste aussi dans le bloc sticky) -->
    <div class="bg-[#E69B12] p-10 text-white relative shadow-md">
        <h3 class="text-2xl font-bold mb-4 uppercase leading-tight">Un accès à <br> NAKAYO Finance !</h3>
        <p class="text-xs mb-8 opacity-90 leading-relaxed">Nos experts vous accompagnent dans tous vos projets financiers et immobiliers au Bénin.</p>
        <button class="w-full bg-white text-[#1A2B49] py-4 rounded-sm font-bold uppercase text-xs hover:bg-gray-100 transition">
            Contactez Notre Équipe ↗
        </button>
    </div>

    <!-- Téléchargement -->
    <div class="bg-[#F9F9F7] p-8">
        <h3 class="text-[#1A2B49] text-lg font-bold mb-4">Documents utiles</h3>
        <a href="#" class="flex items-center bg-[#0B0E37] text-white rounded group">
            <div class="bg-white/10 p-4 border-r border-white/10 group-hover:bg-red-600 transition">PDF</div>
            <span class="px-4 font-bold text-xs uppercase">Brochure de la société</span>
        </a>
    </div>
</aside>