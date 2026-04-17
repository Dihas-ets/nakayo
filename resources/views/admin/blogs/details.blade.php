@extends('layouts.admin')

@section('title', 'Aperçu Article')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    {{-- Bouton Retour --}}
    <a href="{{ route('admin.blog.articles') }}" class="inline-flex items-center gap-2 text-gray-400 font-bold text-sm hover:text-[#1B2E58] transition-all group">
        <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> 
        Retour à la liste
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- COLONNE GAUCHE : CONTENU & COMMENTAIRES -->
        <div class="lg:col-span-2 space-y-10">
            
            {{-- Bloc Article --}}
            <div class="bg-white rounded-[3rem] overflow-hidden shadow-sm border border-gray-100">
                <div class="relative h-96">
                    <img src="{{ url('storage/' . $article->media) }}" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/800x400?text=Nakayo+Blog'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute bottom-8 left-8">
                        <span class="px-4 py-1.5 bg-[#FF9F29] text-white rounded-full text-[10px] font-black uppercase tracking-widest">
                            {{ $article->categorie->nom }}
                        </span>
                    </div>
                </div>
                
                <div class="p-12">
                    <h1 class="text-5xl font-black text-[#1B2E58] mb-8 leading-tight">{{ $article->titre }}</h1>
                    <div class="rich-text-content">
                        {!! clean($article->description) !!}
                    </div>
                </div>
            </div>

            {{-- SECTION DES COMMENTAIRES (LIAISON TABLE COMMENTAIRES) --}}
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-black text-[#1B2E58]">Commentaires ({{ $article->commentaires_count }})</h3>
                    <div class="h-1 w-20 bg-[#FF9F29] rounded-full"></div>
                </div>

                <div class="space-y-4">
                    @forelse($article->commentaires as $commentaire)
                        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#1B2E58] flex items-center justify-center font-black">
                                        {{ substr($commentaire->nom_auteur, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-[#1B2E58]">{{ $commentaire->nom_auteur }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $commentaire->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                {{-- Badge Statut du commentaire --}}
                                <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest 
                                    {{ $commentaire->statut == 'approuvé' ? 'bg-emerald-100 text-emerald-600' : 'bg-orange-100 text-orange-600' }}">
                                    {{ $commentaire->statut }}
                                </span>
                            </div>
                            <div class="pl-16">
                                <p class="text-gray-600 leading-relaxed italic text-sm">"{{ $commentaire->contenu }}"</p>
                                <p class="text-[10px] text-gray-400 mt-4 font-medium italic">{{ $commentaire->email_auteur }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-50/50 border-2 border-dashed border-gray-100 rounded-[2.5rem] p-12 text-center">
                            <i class="fa-solid fa-comments-slash text-4xl text-gray-200 mb-4"></i>
                            <p class="text-gray-400 font-medium">Aucun commentaire n'a encore été publié pour cet article.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- COLONNE DROITE : SIDEBAR INFOS -->
        <div class="space-y-8">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                <h3 class="text-[11px] font-black text-[#1B2E58] uppercase tracking-[0.2em] mb-10 border-b border-gray-50 pb-4">Informations</h3>
                
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
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase">Publié le</p>
                            <p class="font-black text-[#1B2E58]">{{ $article->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-tags"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase">Mots-clés</p>
                            <div class="flex flex-wrap gap-1 mt-1">
                                @foreach(explode(',', $article->tag) as $tag)
                                    <span class="text-[10px] font-bold text-[#1B2E58]">#{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PERFORMANCES -->
            <div class="bg-[#1B2E58] rounded-[2.5rem] p-10 text-white shadow-xl relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-[11px] font-black uppercase tracking-widest mb-10 flex items-center gap-2">
                        <i class="fa-solid fa-chart-simple text-[#FF9F29]"></i> Statistiques
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/10 p-6 rounded-3xl text-center backdrop-blur-sm border border-white/5">
                            <p class="text-3xl font-black">{{ $article->vue }}</p>
                            <p class="text-[10px] font-bold uppercase opacity-60 tracking-tighter">Vues</p>
                        </div>
                        <div class="bg-white/10 p-6 rounded-3xl text-center backdrop-blur-sm border border-white/5">
                            <p class="text-3xl font-black text-[#FF9F29]">{{ $article->commentaires_count }}</p>
                            <p class="text-[10px] font-bold uppercase opacity-60 tracking-tighter">Messages</p>
                        </div>
                    </div>
                </div>
                {{-- Décoration --}}
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-[#FF9F29] opacity-5 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
            </div>
        </div>
    </div>
</div>
@endsection