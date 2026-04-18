{{-- Contenu de la carte partenaire --}}
<div class="flex-shrink-0 w-64 md:w-80 group"> {{-- w-64 à w-80 pour agrandir la largeur --}}
    @php 
        $tag = $partenaire->lien ? 'a' : 'div';
        $attrs = $partenaire->lien ? 'href='.$partenaire->lien.' target=_blank' : '';
    @endphp

    <{{ $tag }} {{ $attrs }} class="relative flex items-center justify-center p-6 w-full h-32 md:h-40 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 overflow-hidden">
        <img 
            src="{{ $partenaire->image ?? 'https://placehold.co/400x400?text=Logo' }}" 
            alt="{{ $partenaire->nom }}" 
            class="max-h-full max-w-full object-contain filter grayscale group-hover:grayscale-0 transition-all duration-500 opacity-80 group-hover:opacity-100"
        >
    </{{ $tag }}>
</div>