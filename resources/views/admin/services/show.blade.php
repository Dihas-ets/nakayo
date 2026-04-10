@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-12">
    <!-- NAVIGATION -->
    <div class="flex justify-between items-center px-4 md:px-0">
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 text-gray-400 font-bold text-sm hover:text-[#1B2E58] transition-all group">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> 
            Retour au catalogue
        </a>
        <div class="flex gap-4">
            <a href="{{ route('admin.services.edit', $service->id_service) }}" class="bg-blue-50 text-[#1B2E58] px-6 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-[#1B2E58] hover:text-white transition-all shadow-sm">
                <i class="fa-solid fa-pen-to-square mr-1"></i> Modifier
            </a>
        </div>
    </div>

    <!-- 1. HERO SECTION : IMAGE PRINCIPALE & TITRE -->
    <div class="relative h-[500px] rounded-[4rem] overflow-hidden shadow-2xl border-8 border-white bg-gray-100 mx-4 md:mx-0">
        @if($service->media)
            <img src="{{ asset('storage/' . $service->media) }}" class="w-full h-full object-cover">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#00261C] via-[#00261C]/20 to-transparent opacity-90"></div>
        <div class="absolute bottom-16 left-16 right-16">
            <span class="px-5 py-2 bg-[#FF9F29] text-white rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-6 inline-block shadow-lg">
                Fiche Technique Nakayo
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-white leading-tight tracking-tighter">{{ $service->titre }}</h1>
        </div>
    </div>

    <!-- 2. SECTION INFORMATIONS (TEXTE & SIDEBAR) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 px-4 md:px-0">
        <!-- GAUCHE : CONTENU ÉDITORIAL -->
        <div class="lg:col-span-2 space-y-10">
            <div class="bg-white p-12 rounded-[3rem] shadow-sm border border-gray-100">
                <h3 class="text-[#FF9F29] font-black uppercase text-xs tracking-widest mb-6 flex items-center gap-2">
                    <span class="w-8 h-1 bg-[#FF9F29] rounded-full"></span>
                    Résumé de l'expertise
                </h3>
                <p class="text-3xl font-bold text-[#1B2E58] italic leading-relaxed mb-10">
                    "{{ $service->courte_description }}"
                </p>
                
                <h3 class="text-[#1B2E58] font-black uppercase text-xs tracking-widest mb-6 border-b border-gray-50 pb-4">
                    Description détaillée
                </h3>
                <div class="text-gray-500 font-medium leading-relaxed text-lg whitespace-pre-line">
                    {{ $service->description }}
                </div>
            </div>
        </div>

        <!-- DROITE : INFOS SYSTÈME -->
        <div class="space-y-8">
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
                <h4 class="text-[11px] font-black uppercase text-gray-300 tracking-[0.2em] mb-10 text-center">Récapitulatif</h4>
                
                <div class="space-y-8">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 bg-blue-50 text-[#1B2E58] rounded-2xl flex items-center justify-center shadow-sm border border-blue-100">
                            <i class="fa-solid fa-hashtag text-xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-tighter">ID Interne</p>
                            <p class="font-black text-[#1B2E58] text-lg">#{{ $service->id_service }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 bg-orange-50 text-[#FF9F29] rounded-2xl flex items-center justify-center shadow-sm border border-orange-100">
                            <i class="fa-solid fa-calendar-check text-xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-tighter">Date Publication</p>
                            <p class="font-black text-[#1B2E58] text-lg">{{ $service->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>

    <!-- 3. SECTION GALERIE (TOUT EN BAS) -->
    <div class="space-y-8 px-4 md:px-0 pb-20">
        <div class="flex items-center gap-4 border-b border-gray-100 pb-6">
            <div class="w-14 h-14 bg-[#00261C] text-white rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fa-solid fa-images text-2xl"></i>
            </div>
            <div>
                <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase">Médiathèque du projet</h2>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Photos & Vidéos de réalisation</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- SOUS-SECTION PHOTOS -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center gap-3">
                    <span class="text-[10px] font-black bg-orange-50 text-[#FF9F29] px-3 py-1 rounded-lg uppercase">
                        {{ $service->galleries->where('type_media', 'image')->count() }} Photos
                    </span>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse($service->galleries->where('type_media', 'image') as $img)
                        <div class="aspect-square rounded-[3rem] overflow-hidden border-4 border-white shadow-xl hover:scale-105 transition-transform duration-500 bg-gray-50">
                            <img src="{{ asset('storage/' . $img->image_url) }}" class="w-full h-full object-cover shadow-inner">
                        </div>
                    @empty
                        <div class="col-span-full py-16 bg-white rounded-[3rem] border-2 border-dashed border-gray-100 text-center">
                            <i class="fa-solid fa-camera-retro text-gray-200 text-4xl mb-4"></i>
                            <p class="text-gray-400 font-medium italic">Aucune photo dans la galerie.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- SOUS-SECTION VIDÉOS -->
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <span class="text-[10px] font-black bg-blue-50 text-[#1B2E58] px-3 py-1 rounded-lg uppercase">
                        {{ $service->galleries->where('type_media', 'video')->count() }} Vidéos
                    </span>
                </div>

                <div class="space-y-6">
                    @forelse($service->galleries->where('type_media', 'video') as $vid)
                        @if(!empty($vid->link))
                            @php
                                $videoId = '';
                                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $vid->link, $match)) {
                                    $videoId = $match[1];
                                }
                            @endphp

                            <div class="group relative rounded-[2.5rem] overflow-hidden shadow-xl aspect-video border-4 border-white">
                                @if($videoId)
                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-all duration-500">
                                @else
                                    <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                                        <i class="fa-solid fa-video text-white/20 text-3xl"></i>
                                    </div>
                                @endif
                                
                                <a href="{{ $vid->link }}" target="_blank" class="absolute inset-0 flex items-center justify-center bg-black/10 group-hover:bg-black/0 transition-all">
                                    <div class="w-16 h-16 bg-[#FF9F29] text-white rounded-full flex items-center justify-center shadow-2xl transform scale-90 group-hover:scale-100 transition-all duration-500">
                                        <i class="fa-solid fa-play text-2xl ml-1"></i>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @empty
                        <div class="py-16 bg-[#1B2E58]/5 rounded-[3rem] border-2 border-dashed border-[#1B2E58]/10 text-center">
                            <p class="text-[#1B2E58]/40 text-xs font-bold uppercase">Aucune vidéo</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection