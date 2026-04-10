@extends('layouts.admin')

@section('title', 'Médiathèque Gallerie')

@section('content')
<div x-data="{ 
    showAdd: false, 
    showDelete: false, 
    selected: { id_gallerie: null },
    type: 'image' 
}" class="space-y-10">

    {{-- ALERTES --}}
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-bounce">
            <div class="flex items-center gap-3 font-bold">
                <i class="fa-solid fa-check-double text-2xl"></i>
                {{ session('success') }}
            </div>
            <button @click="$el.parentElement.remove()" class="opacity-70 hover:opacity-100"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase">Médiathèque de Réalisations</h2>
            <p class="text-gray-500 font-medium">Contenu visuel organisé par pôle d'expertise.</p>
        </div>
        <button @click="showAdd = true" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg transition-all active:scale-95">
            <i class="fa-solid fa-plus-circle text-lg"></i> Ajouter un média
        </button>
    </div>

    <!-- AFFICHAGE GROUPÉ PAR SERVICE -->
    @forelse($mediasGrouped as $serviceId => $medias)
        @php $service = $medias->first()->service; @endphp
        
        <div class="space-y-6">
            {{-- Titre du groupe (Service) --}}
            <div class="flex items-center gap-4 border-b border-gray-100 pb-4">
                <div class="w-10 h-10 bg-orange-50 text-[#FF9F29] rounded-xl flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-briefcase text-sm"></i>
                </div>
                <h3 class="text-xl font-black text-[#1B2E58] uppercase tracking-tighter italic">
                    {{ $service->titre ?? 'Service Non Défini' }}
                </h3>
                <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-full text-[10px] font-black">
                    {{ $medias->count() }} MÉDIAS
                </span>
            </div>

            {{-- Grille de ce service --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($medias as $media)
                    <div class="group bg-white rounded-[2rem] overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl transition-all relative">
                        
                        {{-- Badge Type --}}
                        <div class="absolute top-4 left-4 z-10">
                            <span class="px-3 py-1 bg-[#00261C]/80 backdrop-blur text-white rounded-full text-[8px] font-black uppercase tracking-widest shadow-sm">
                                {{ $media->type_media }}
                            </span>
                        </div>

                        {{-- Action Delete --}}
                        <button @click="selected = { id_gallerie: {{ $media->id_gallerie }} }; showDelete = true" 
                            class="absolute top-4 right-4 z-10 w-8 h-8 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center shadow-lg hover:scale-110">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>

                        {{-- Rendu Visuel (Image ou Vidéo) --}}
                        <div class="aspect-video bg-gray-100 overflow-hidden relative">
                            @if($media->type_media == 'image')
                                <img src="{{ asset('storage/' . $media->image_url) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                @php
                                    $videoId = '';
                                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $media->link, $match)) {
                                        $videoId = $match[1];
                                    }
                                @endphp
                                
                                {{-- Miniature Vidéo --}}
                                @if($videoId)
                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-all">
                                @else
                                    <div class="w-full h-full bg-[#1B2E58] flex items-center justify-center text-white">
                                        <i class="fa-solid fa-video text-3xl opacity-20"></i>
                                    </div>
                                @endif

                                {{-- Overlay Play --}}
                                <a href="{{ $media->link }}" target="_blank" class="absolute inset-0 flex items-center justify-center bg-black/10 group-hover:bg-transparent transition-all">
                                    <div class="w-12 h-12 bg-[#FF9F29] text-white rounded-full flex items-center justify-center shadow-2xl transform scale-90 group-hover:scale-100 transition-all duration-300">
                                        <i class="fa-solid fa-play text-xl ml-1"></i>
                                    </div>
                                </a>
                            @endif
                        </div>

                        {{-- Info Liaison Produit --}}
                        <div class="p-5 bg-white border-t border-gray-50">
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Produit associé</p>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-[#FF9F29]"></div>
                                <p class="font-bold text-[#1B2E58] text-xs truncate">{{ $media->produit->nom ?? 'Produit Inconnu' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-gray-100">
            <i class="fa-solid fa-images text-6xl text-gray-100 mb-4"></i>
            <p class="text-gray-400 font-medium">Aucun contenu multimédia n'a été trouvé.</p>
        </div>
    @endforelse

    <!-- MODAL : AJOUTER UN MÉDIA -->
    <div x-show="showAdd" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showAdd = false" class="bg-white w-full max-w-xl rounded-[3rem] shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-2xl font-black text-[#1B2E58]">Nouveau Média</h3>
                <button @click="showAdd = false" class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>

            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-6">
                @csrf
                
                {{-- Sélecteur Type --}}
                <div class="flex bg-gray-100 p-1 rounded-2xl">
                    <button type="button" @click="type = 'image'" :class="type == 'image' ? 'bg-white shadow-sm text-[#1B2E58]' : 'text-gray-400'" class="flex-1 py-3 rounded-xl font-black text-xs uppercase transition-all">Image</button>
                    <button type="button" @click="type = 'video'" :class="type == 'video' ? 'bg-white shadow-sm text-[#1B2E58]' : 'text-gray-400'" class="flex-1 py-3 rounded-xl font-black text-xs uppercase transition-all">Vidéo</button>
                    <input type="hidden" name="type_media" :value="type">
                </div>

                {{-- Inputs Dynamiques --}}
                <div x-show="type === 'image'" x-transition>
                    <x-input label="Sélectionner l'Image" name="image_url" type="file" />
                </div>
                <div x-show="type === 'video'" x-transition>
                    <x-input label="Lien YouTube de la Vidéo" name="link" placeholder="https://www.youtube.com/watch?v=..." />
                </div>

                {{-- LIAISONS --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase tracking-widest opacity-60">1. Service Technique <span class="text-red-500">*</span></label>
                        <select name="id_service" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold text-sm" required>
                            <option value="" disabled selected>Choisir un service</option>
                            @foreach($services as $s) <option value="{{ $s->id_service }}">{{ $s->titre }}</option> @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase tracking-widest opacity-60">2. Produit lié <span class="text-red-500">*</span></label>
                        <select name="id_produit" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold text-sm" required>
                            <option value="" disabled selected>Choisir un produit</option>
                            @foreach($produits as $p) <option value="{{ $p->id_produit }}">{{ $p->nom }}</option> @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-4 border-t border-gray-50">
                    <button type="button" @click="showAdd = false" class="px-8 py-4 font-bold text-gray-400 hover:text-gray-600 transition">Annuler</button>
                    <button type="submit" class="bg-[#FF9F29] text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-orange-100 active:scale-95 transition-all">
                        ENREGISTRER
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL : SUPPRIMER -->
    <div x-show="showDelete" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl relative">
            <i class="fa-solid fa-trash-can text-5xl text-red-500 mb-6 animate-pulse"></i>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-4 tracking-tight">Supprimer ?</h3>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold transition-all">Annuler</button>
                <form :action="'/admin/galleries/' + selected.id_gallerie" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-3 bg-red-600 text-white rounded-xl font-bold shadow-lg shadow-red-200 hover:bg-red-700 transition-all">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection