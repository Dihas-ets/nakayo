@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto" x-data="{ 
    title: '{{ $article->titre ?? '' }}', 
    slug: '{{ $article->slug ?? '' }}',
    genSlug() { this.slug = this.title.toLowerCase().replace(/[^a-z0-9]/g, '-').replace(/-+/g, '-'); } 
}">
    <form action="{{ isset($article) ? route('admin.blog.update', $article->id_article) : route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($article)) @method('PUT') @endif

        <!-- TOP NAVIGATION -->
        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.blog.articles') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] transition-all">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h2 class="text-3xl font-black text-[#1B2E58]">{{ isset($article) ? 'Modifier' : 'Nouvel Article' }}</h2>
            </div>
            <button type="submit" class="bg-[#1B2E58] text-white px-10 py-3.5 rounded-2xl font-black shadow-xl hover:bg-[#00261C] transition-all">
                {{ isset($article) ? 'ENREGISTRER' : 'PUBLIER L\'ARTICLE' }}
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- GAUCHE : ÉDITEUR -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100 min-h-[700px]">
                    
                    <!-- Titre -->
                    <input type="text" name="titre" x-model="title" @input="genSlug()" placeholder="Le titre de votre article..." class="w-full text-5xl font-black border-none focus:ring-0 p-0 mb-8 text-[#1B2E58] placeholder:text-gray-100">
                    <input type="hidden" name="slug" :value="slug">

                    <!-- L'Éditeur CKEditor -->
                    <div class="ck-custom-editor">
                        <textarea name="description" id="editor">{!! old('description', $article->description ?? '') !!}</textarea>
                    </div>
                    
                    <!-- Champ Commentaire -->
                    <div class="mt-12 pt-10 border-t border-gray-50">
                        <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Note interne / Commentaire</label>
                        <textarea name="commentaire" rows="3" class="w-full bg-gray-50 rounded-[2rem] p-6 border-none text-sm focus:ring-2 focus:ring-[#FF9F29]" placeholder="Ajoutez un résumé ou une note pour ce contenu...">{{ $article->commentaire ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- DROITE : SIDEBAR -->
            <!-- DROITE : SIDEBAR -->
<div class="space-y-6">
    <!-- Bloc Image -->
    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
        <h3 class="text-[11px] font-black uppercase text-[#1B2E58] tracking-widest mb-6 border-b border-gray-50 pb-4">Image de couverture</h3>
        <div class="relative group border-2 border-dashed border-gray-100 rounded-[2rem] p-10 text-center hover:border-[#FF9F29] transition-all">
            <input type="file" name="media" class="absolute inset-0 opacity-0 cursor-pointer">
            @if(isset($article) && $article->media)
                <img src="{{ url('storage/'.$article->media) }}" class="rounded-xl h-32 w-full object-cover">
            @else
                <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-100 group-hover:text-[#FF9F29] mb-4 transition-colors"></i>
                <p class="text-[10px] font-bold text-gray-300 uppercase">Cliquer pour uploader</p>
            @endif
        </div>
    </div>

    <!-- Bloc Paramètres -->
    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 space-y-8">
        <!-- Catégorie -->
        <div>
            <label class="block text-[10px] font-black text-gray-300 uppercase mb-3">Catégorie</label>
            <select name="id_categorie" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id_categorie }}" {{ (isset($article) && $article->id_categorie == $cat->id_categorie) ? 'selected' : '' }}>{{ $cat->nom }}</option>
                @endforeach
            </select>
        </div>

        <!-- Mise en avant (featured) -->
        <div>
            <label class="block text-[10px] font-black text-gray-300 uppercase mb-3">Visibilité Accueil</label>
            <div class="flex items-center justify-between p-4 bg-orange-50/50 rounded-2xl border border-orange-100">
                <div class="flex flex-col">
                    <span class="font-black text-[#1B2E58] text-sm">Mise à la une</span>
                    <span class="text-[9px] text-gray-400 font-bold uppercase italic">Article principal</span>
                </div>
                <div class="relative inline-flex items-center cursor-pointer">
                    <!-- On envoie 1 si coché, sinon 0 via le contrôleur -->
                    <input type="checkbox" name="featured" value="1" class="sr-only peer" {{ (isset($article) && $article->featured) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-[#FF9F29] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                </div>
            </div>
        </div>

        <!-- Statut de publication -->
        <div>
            <label class="block text-[10px] font-black text-gray-300 uppercase mb-3">Statut de publication</label>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                <span class="font-black text-[#1B2E58] text-sm">Publié</span>
                <div class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="status" value="publié" class="sr-only peer" {{ (!isset($article) || $article->status == 'publié') ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-[#1B2E58] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </form>
</div>

{{-- SCRIPTS POUR L'ÉDITEUR --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [
                'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 
                'imageUpload', 'insertTable', '|', 'undo', 'redo'
            ],
            ckfinder: {
                // Route Laravel pour l'upload d'image
                uploadUrl: "{{ route('admin.blog.upload', ['_token' => csrf_token()]) }}",
            }
        })
        .then(editor => {
            editor.editing.view.change(writer => {
                writer.setStyle('min-height', '500px', editor.editing.view.document.getRoot());
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>

<style>
    /* Custom Styling pour CKEditor pour coller à ton design */
    .ck-editor__editable_inline { padding: 0 20px !important; }
    .ck.ck-editor__main>.ck-editor__editable {
        border: none !important;
        box-shadow: none !important;
        font-family: 'Montserrat', sans-serif;
    }
    .ck.ck-toolbar {
        border: none !important;
        border-bottom: 1px solid #f3f4f6 !important;
        background: transparent !important;
        padding-bottom: 20px !important;
        margin-bottom: 30px !important;
    }
    .ck.ck-button:hover { background: #f9fafb !important; }
    .ck.ck-button.ck-on { background: #fff7ed !important; color: #ff9f29 !important; }
</style>



@endsection