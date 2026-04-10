@extends('layouts.app')

@section('content')

{{-- 1. NAVBAR --}}
<header class="sticky top-0 z-[100] w-full shadow-md bg-white">
    @include('components.navbar')
</header>

{{-- Initialisation Alpine.js pour le Modal --}}
<div x-data="{ openModal: false, selectedProduct: {} }">

    {{-- 2. HERO SECTION --}}
    <section class="relative h-[400px] flex flex-col items-center justify-center text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1920" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-[#061e24]/90 mix-blend-multiply"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-5xl md:text-6xl font-black mb-4 uppercase tracking-tighter">
                Catalogue <span class="text-orange-500">{{ $service->titre }}</span>
            </h1>
            <p class="text-gray-300 max-w-2xl mx-auto">Découvrez l'ensemble de nos équipements et produits disponibles pour le service {{ $service->titre }}.</p>
        </div>
    </section>

    {{-- 3. GRILLE DE TOUS LES PRODUITS --}}
    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-6">
            
            <!-- Retour -->
            <a href="{{ route('services.show', $slug) }}" class="inline-flex items-center gap-2 text-blue-900 font-bold mb-10 hover:text-orange-500 transition">
                ← Retour aux détails du service
            </a>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($service->produits as $prod)
                    <div class="bg-white border border-gray-100 rounded-sm group hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col">
                        
                        <!-- Image du produit (Ouvre le modal au clic) -->
                        <div class="relative h-64 overflow-hidden bg-gray-100 cursor-pointer" 
                             @click="selectedProduct = {{ json_encode($prod) }}; selectedProduct.image_url = '{{ $prod->image ? asset('storage/' . $prod->image) : 'https://placehold.co/600x400?text=NAKAYO' }}'; openModal = true">
                            <img src="{{ $prod->image ? asset('storage/' . $prod->image) : 'https://placehold.co/600x400?text=NAKAYO' }}" 
                                 alt="{{ $prod->nom }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity text-white font-bold text-xs uppercase tracking-widest">Voir détails</div>
                        </div>

                        <div class="p-6 flex-grow flex flex-col">
                            <span class="text-[10px] font-black text-orange-500 uppercase tracking-widest mb-2">{{ $service->titre }}</span>
                            
                            <!-- Titre (Ouvre le modal au clic) -->
                            <h4 class="text-xl font-black text-blue-950 mb-4 leading-tight uppercase cursor-pointer hover:text-orange-500 transition"
                                @click="selectedProduct = {{ json_encode($prod) }}; selectedProduct.image_url = '{{ $prod->image ? asset('storage/' . $prod->image) : 'https://placehold.co/600x400?text=NAKAYO' }}'; openModal = true">
                                {{ $prod->nom }}
                            </h4>
                            
                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-50">
                                <div>
                                    {{-- CONDITION PRIX : On n'affiche rien si pas de prix --}}
                                    @if($prod->prix && $prod->prix > 0)
                                        <span class="block text-[10px] text-gray-400 font-bold uppercase italic">Prix</span>
                                        <span class="text-xl font-black text-blue-900">{{ number_format($prod->prix, 0, ',', '.') }} <small class="text-xs">CFA</small></span>
                                    @endif
                                </div>
                                
                                {{-- BOUTON WHATSAPP (+229 01 66 55 61 61) --}}
                                <a href="https://wa.me/2290166556161?text=Bonjour, je souhaite commander le produit : {{ $prod->nom }} (Catalogue {{ $service->titre }})" 
                                   target="_blank"
                                   class="bg-blue-900 text-white px-4 py-2 rounded-sm text-xs font-bold hover:bg-orange-500 transition">
                                   Commander
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <p class="text-gray-400 text-xl italic">Aucun produit n'est actuellement listé dans ce catalogue.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- 4. MODAL DE DÉTAIL DU PRODUIT --}}
    <div x-show="openModal" 
         class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak>
        
        <div class="bg-white w-full max-w-4xl rounded-sm overflow-hidden shadow-2xl relative flex flex-col md:flex-row max-h-[90vh]" @click.away="openModal = false">
            
            <!-- Bouton fermer -->
            <button @click="openModal = false" class="absolute top-4 right-4 z-10 bg-white/80 w-10 h-10 rounded-full flex items-center justify-center hover:bg-orange-500 hover:text-white transition">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Image Modal -->
            <div class="w-full md:w-1/2 bg-gray-100">
                <img :src="selectedProduct.image_url" class="w-full h-full object-cover">
            </div>

            <!-- Contenu Modal -->
            <div class="w-full md:w-1/2 p-8 md:p-12 overflow-y-auto">
                <span class="text-xs font-black text-orange-500 uppercase tracking-[0.2em] mb-4 block">{{ $service->titre }}</span>
                <h3 class="text-3xl font-black text-blue-950 uppercase tracking-tighter mb-6" x-text="selectedProduct.nom"></h3>
                
                <div class="prose prose-sm text-gray-600 mb-8">
                    <p x-text="selectedProduct.description || 'Aucune description détaillée disponible.'"></p>
                </div>

                <div class="flex items-center justify-between border-t pt-8">
                    <div x-show="selectedProduct.prix > 0">
                        <span class="block text-[10px] text-gray-400 font-bold uppercase italic">Prix unitaire</span>
                        <span class="text-3xl font-black text-blue-900" x-text="new Intl.NumberFormat('fr-FR').format(selectedProduct.prix) + ' CFA'"></span>
                    </div>

                    <a :href="'https://wa.me/2290166556161?text=Bonjour, je souhaite commander : ' + selectedProduct.nom" 
                       target="_blank"
                       class="bg-orange-500 text-white px-8 py-4 rounded-sm font-black uppercase text-xs tracking-widest hover:bg-blue-950 transition shadow-lg">
                       Commander via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>

@endsection