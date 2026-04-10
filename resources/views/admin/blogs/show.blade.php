@extends('layouts.admin')

@section('title', 'Détails Article')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Retour -->
    <a href="{{ route('admin.blog.articles') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#1B2E58] font-bold text-sm mb-8 transition-all">
        <i class="fa-solid fa-arrow-left"></i> Retour à la liste
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- ARTICLE -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[3rem] overflow-hidden shadow-sm border border-gray-100">
                <img src="{{ asset('storage/' . $article->media) }}" class="w-full h-[400px] object-cover" onerror="this.src='https://placehold.co/800x400'">
                <div class="p-12">
                    <h1 class="text-5xl font-black text-[#1B2E58] mb-8 leading-tight">{{ $article->titre }}</h1>
                    
                </div>
            </div>
        </div>

        <!-- INFOS SIDEBAR (Fidèle à l'image 1) -->
        <div class="space-y-8">
            <!-- Card Informations -->
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                <h3 class="text-xs font-black text-[#1B2E58] uppercase tracking-[0.2em] mb-8 border-b border-gray-50 pb-4">Informations</h3>
                
                <div class="space-y-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-[#1B2E58] rounded-2xl flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase">Auteur</p>
                            <p class="font-black text-[#1B2E58]">{{ $article->auteur->nom_complet }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-50 text-[#FF9F29] rounded-2xl flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase">Date</p>
                            <p class="font-black text-[#1B2E58]">{{ $article->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase">Catégorie</p>
                            <p class="font-black text-[#1B2E58]">{{ $article->categorie->nom }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 pt-10 border-t border-gray-50">
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-4">Étiquettes</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $article->tag) as $tag)
                            <span class="px-3 py-1 bg-gray-50 text-[#1B2E58] rounded-full text-[10px] font-bold">#{{ trim($tag) }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Card Performances (Fidèle à l'image 2) -->
            <div class="bg-[#1B2E58] rounded-[2.5rem] p-10 text-white shadow-xl relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-8">
                        <i class="fa-solid fa-chart-line text-[#FF9F29]"></i>
                        <h3 class="text-xs font-black uppercase tracking-widest">Performances</h3>
                    </div>
                    
                </div>
                <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-[#FF9F29] opacity-10 rounded-full blur-2xl"></div>
            </div>
        </div>
    </div>
</div>
@endsection