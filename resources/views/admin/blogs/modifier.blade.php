@extends('layouts.admin')

@section('title', 'Modifier l\'article')

@section('content')
<div class="max-w-7xl mx-auto" x-data="editArticleHandler()">
    {{-- Formulaire de mise à jour --}}
    <form action="{{ route('admin.blog.update', $article->id_article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- TOP NAVIGATION -->
        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.blog.articles') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] shadow-sm transition-all group">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h2 class="text-3xl font-black text-[#1B2E58]">Modifier l'article</h2>
                    <p class="text-[10px] font-black text-[#FF9F29] uppercase tracking-widest italic">ID: #{{ $article->id_article }}</p>
                </div>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.blog.show', $article->id_article) }}" target="_blank" class="bg-blue-50 text-[#1B2E58] px-6 py-3.5 rounded-2xl font-black hover:bg-blue-100 transition-all text-xs">
                    VOIR L'APERÇU
                </a>
                <button type="submit" class="bg-[#1B2E58] text-white px-10 py-3.5 rounded-2xl font-black shadow-xl hover:bg-[#00261C] transition-all text-xs">
                    METTRE À JOUR
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- COLONNE GAUCHE : RÉDACTION -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100 min-h-[700px]">
                    {{-- Titre --}}
                    <input type="text" name="titre" x-model="title" @input="genSlug()" 
                           class="w-full text-5xl font-black border-none focus:ring-0 p-0 mb-4 text-[#1B2E58] placeholder:text-gray-100" required>
                    
                    {{-- Slug Dynamique --}}
                    <div class="flex items-center gap-2 mb-8 bg-blue-50 px-4 py-2 rounded-lg w-fit">
                        <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Lien :</span>
                        <input type="text" name="slug" x-model="slug" class="text-[11px] font-mono text-blue-600 bg-transparent border-none focus:ring-0 p-0 min-w-[300px]">
                    </div>

                    {{-- Éditeur de texte --}}
                    <div class="prose max-w-none">
                        <textarea id="editor" name="description" rows="15" 
                                  class="w-full border-none focus:ring-0 text-gray-500 text-lg leading-relaxed">{{ $article->description }}</textarea>
                    </div>
                    
                    {{-- CHAMP COMMENTAIRE (RÉSUMÉ) --}}
                    <div class="mt-12 pt-10 border-t border-gray-50">
                        <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest italic">Commentaire interne / Résumé SEO</label>
                        <textarea name="commentaire" rows="3" class="w-full bg-gray-50 rounded-[2rem] p-6 border-none text-sm focus:ring-2 focus:ring-[#FF9F29] text-gray-600 font-medium">{{ $article->commentaire }}</textarea>
                    </div>
                </div>
            </div>

            <!-- COLONNE DROITE : PARAMÈTRES -->
            <div class="space-y-6">
                {{-- IMAGE DE COUVERTURE --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <h3 class="text-[11px] font-black uppercase text-[#1B2E58] tracking-widest mb-6 border-b border-gray-50 pb-4 text-center">Couverture</h3>
                    <div class="relative group border-2 border-dashed border-gray-100 rounded-[2rem] p-4 text-center hover:border-[#FF9F29] transition-all bg-gray-50">
                        <input type="file" name="media" class="absolute inset-0 opacity-0 cursor-pointer z-10" @change="handleImagePreview($event)">
                        
                        {{-- Image actuelle ou nouvelle --}}
                        <div class="h-48 w-full rounded-2xl overflow-hidden mb-4 shadow-inner">
                            <img :src="imageUrl ? imageUrl : '{{ url('storage/'.$article->media) }}'" 
                                 class="w-full h-full object-cover" onerror="this.src='https://placehold.co/400x300?text=Nakayo+Blog'">
                        </div>
                        
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest group-hover:text-[#FF9F29] transition-colors">Cliquer pour changer l'image</p>
                    </div>
                </div>

                {{-- CATÉGORIE & VISIBILITÉ --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 space-y-8">
                    <div>
                        <label class="block text-[10px] font-black text-gray-300 uppercase mb-3">Catégorie</label>
                        <select name="id_categorie" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id_categorie }}" {{ $article->id_categorie == $cat->id_categorie ? 'selected' : '' }}>{{ $cat->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-300 uppercase mb-3">Mettre à la une (Featured)</label>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                            <span class="text-[11px] font-black text-[#1B2E58] uppercase">Prioritaire</span>
                            <input type="checkbox" name="featured" value="1" {{ $article->featured ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#FF9F29] focus:ring-[#FF9F29]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-300 uppercase mb-3">Statut de publication</label>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                            <span class="font-black text-[#1B2E58] text-[11px] uppercase" x-text="isPublished ? 'Publié' : 'Brouillon'"></span>
                            <div class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="status" value="publié" class="sr-only peer" x-model="isPublished">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-[#1B2E58] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- SCRIPT POUR L'ÉDITEUR ET ALPINE --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    function editArticleHandler() {
        return {
            title: '{{ addslashes($article->titre) }}',
            slug: '{{ $article->slug }}',
            isPublished: {{ $article->status == 'publié' ? 'true' : 'false' }},
            imageUrl: null,

            genSlug() {
                this.slug = this.title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/[^a-z0-9]/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
            },

            handleImagePreview(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => this.imageUrl = e.target.result;
                    reader.readAsDataURL(file);
                }
            },

            init() {
                ClassicEditor.create(document.querySelector('#editor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
                }).catch(error => console.error(error));
            }
        }
    }
</script>

<style>
    .ck-editor__editable { min-height: 500px; border: none !important; }
    .ck.ck-toolbar { border: none !important; background: transparent !important; }
</style>
@endsection