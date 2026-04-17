@extends('layouts.admin')

@section('title', isset($article) ? 'Modifier l\'article' : 'Nouvel Article')

@section('content')
<div class="max-w-7xl mx-auto" x-data="{ 
    nom: '{{ $article->titre ?? '' }}', 
    slug: '{{ $article->slug ?? '' }}',
    generateSlug() {
        this.slug = this.nom.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/[^a-z0-9]/g, '-').replace(/-+/g, '-');
    }
}">
    <form action="{{ isset($article) ? route('admin.blog.update', $article->id_article) : route('admin.blog.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($article)) @method('PUT') @endif

        <!-- TOPBAR FORM -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.blog.articles') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] shadow-sm transition-all">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-black text-[#1B2E58]">{{ isset($article) ? 'Modifier l\'article' : 'Nouvel Article' }}</h2>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest italic">Outil de rédaction Premium</p>
                </div>
            </div>
            <button type="submit" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-3 rounded-2xl font-bold shadow-xl transition-all flex items-center gap-3">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                {{ isset($article) ? 'Mettre à jour' : 'Publier l\'article' }}
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- COLONNE GAUCHE : CONTENU -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <!-- Titre -->
                    <input type="text" name="titre" x-model="nom" @input="generateSlug()" 
                           placeholder="Le titre de votre article..." 
                           class="w-full text-4xl font-black text-[#1B2E58] placeholder:text-gray-200 border-none focus:ring-0 p-0 mb-4" required>
                    
                    <div class="flex items-center gap-2 mb-8">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">URL :</span>
                        <input type="text" name="slug" x-model="slug" class="text-[10px] font-mono text-blue-500 bg-blue-50 px-2 py-1 rounded border-none focus:ring-0 w-full">
                    </div>

                    <!-- Fausse barre d'outils WYSIWYG (Design uniquement) -->
                    <div class="flex items-center gap-4 py-3 border-y border-gray-50 mb-6 text-gray-400">
                        <button type="button" class="hover:text-[#FF9F29]"><i class="fa-solid fa-bold"></i></button>
                        <button type="button" class="hover:text-[#FF9F29]"><i class="fa-solid fa-italic"></i></button>
                        <button type="button" class="hover:text-[#FF9F29]"><i class="fa-solid fa-link"></i></button>
                        <button type="button" class="hover:text-[#FF9F29]"><i class="fa-solid fa-list-ul"></i></button>
                        <div class="h-4 w-[1px] bg-gray-100 mx-2"></div>
                        <button type="button" class="hover:text-[#FF9F29]"><i class="fa-solid fa-image"></i></button>
                    </div>

                    <!-- Description Principale -->
                    <textarea name="description" rows="15" placeholder="Rédigez votre contenu ici..." 
                              class="w-full border-none focus:ring-0 text-gray-600 leading-relaxed font-medium" required>{{ $article->description ?? '' }}</textarea>
                </div>

                <!-- Nouveau Champ Commentaire (Résumé) -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <label class="block text-xs font-black text-[#1B2E58] mb-4 uppercase tracking-widest opacity-60">Commentaire / Résumé de l'article</label>
                    <textarea name="commentaire" rows="3" class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-medium text-sm">{{ $article->commentaire ?? '' }}</textarea>
                </div>
            </div>

            <!-- COLONNE DROITE : RÉGLAGES (SIDEBAR) -->
            <div class="space-y-6">
                <!-- Image de couverture -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <label class="block text-xs font-black text-[#1B2E58] mb-6 uppercase tracking-widest">Image de couverture</label>
                    <div class="relative group cursor-pointer border-2 border-dashed border-gray-100 rounded-[2rem] p-4 text-center hover:border-[#FF9F29] transition-all">
                        <input type="file" name="media" class="absolute inset-0 opacity-0 cursor-pointer">
                        @if(isset($article) && $article->media)
                            <img src="{{ url('storage/' . $article->media) }}" class="rounded-2xl h-40 w-full object-cover mb-4">
                        @else
                            <div class="py-12">
                                <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-200 group-hover:text-[#FF9F29] transition-colors"></i>
                            </div>
                        @endif
                        <p class="text-[10px] font-black text-gray-400 uppercase">Cliquer pour uploader</p>
                    </div>
                </div>

                <!-- Étiquettes -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center gap-2 mb-6">
                        <i class="fa-solid fa-tag text-[#FF9F29]"></i>
                        <label class="block text-xs font-black text-[#1B2E58] uppercase tracking-widest">Étiquettes</label>
                    </div>
                    <input type="text" name="tag" value="{{ $article->tag ?? '' }}" placeholder="Ajouter un tag..." 
                           class="w-full px-5 py-3 rounded-xl border border-gray-100 focus:border-[#FF9F29] outline-none text-sm mb-4">
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-gray-50 text-[#1B2E58] rounded-full text-[10px] font-bold">#Expertise</span>
                        <span class="px-3 py-1 bg-gray-50 text-[#1B2E58] rounded-full text-[10px] font-bold">#Tuto</span>
                    </div>
                </div>

                <!-- Catégorie & Statut -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 space-y-6">
                    <div>
                        <label class="block text-xs font-black text-gray-400 mb-2 uppercase tracking-widest">Catégorie</label>
                        <select name="id_categorie" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold text-[#1B2E58]">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id_categorie }}" {{ (isset($article) && $article->id_categorie == $cat->id_categorie) ? 'selected' : '' }}>
                                    {{ $cat->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 mb-2 uppercase tracking-widest">Statut de l'article</label>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                            <span class="text-sm font-black text-[#1B2E58]">Publié</span>
                            <div class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="status" value="publié" class="sr-only peer" {{ (!isset($article) || $article->status == 'publié') ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-[#1B2E58] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection