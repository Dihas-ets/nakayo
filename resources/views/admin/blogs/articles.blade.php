@extends('layouts.admin')

@section('title', 'Gestion du Blog')

@section('content')
<div x-data="{ 
    showDelete: false, 
    selected: { id_article: null, titre: '' } 
}" class="space-y-8">

    <!-- ALERTES NAKAYO -->
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-in slide-in-from-top duration-500">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-check-double text-2xl"></i>
                <span class="font-bold text-lg">{{ session('success') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="opacity-70 hover:opacity-100">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight">Rédaction & Blog</h2>
            <p class="text-gray-500 font-medium">Suivez l'engagement de vos lecteurs et gérez vos publications.</p>
        </div>
        <a href="{{ route('admin.blog.create') }}" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg transition-all active:scale-95">
            <i class="fa-solid fa-plus text-lg"></i> Écrire un article
        </a>
    </div>

    <!-- TABLEAU DYNAMIQUE -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#00261C] text-white">
                    <th class="px-6 py-6 text-[10px] font-black uppercase tracking-widest text-center w-16">Visuel</th>
                    <th class="px-6 py-6 text-[10px] font-black uppercase tracking-widest">Article & Rédacteur</th>
                    
                    {{-- REMPLACEMENT PAR LE CHAMP COMMENTAIRE (NOMBRE) --}}
                    <th class="px-6 py-6 text-[10px] font-black uppercase tracking-widest text-center">Commentaires</th>
                    
                    <th class="px-6 py-6 text-[10px] font-black uppercase tracking-widest text-center">Audience</th>
                    <th class="px-6 py-6 text-[10px] font-black uppercase tracking-widest text-center">Statut</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($articles as $article)
                <tr class="hover:bg-gray-50/50 transition-all group">
                    {{-- Image --}}
                    <td class="px-6 py-4">
                        <div class="w-16 h-12 rounded-xl overflow-hidden border border-gray-100 bg-gray-50 mx-auto shadow-sm">
                            <img src="{{ url('storage/' . $article->media) }}" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/200x150?text=Nakayo'">
                        </div>
                    </td>

                    {{-- Titre & Auteur --}}
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-black text-[#1B2E58] text-base leading-tight">{{ $article->titre }}</p>
                            <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase italic">
                                <i class="fa-solid fa-user-pen mr-1 text-[#FF9F29]"></i> {{ $article->auteur->nom_complet }}
                            </p>
                        </div>
                    </td>

                    {{-- NOMBRE DE COMMENTAIRES --}}
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-[#1B2E58] rounded-2xl border border-blue-100 shadow-sm">
                            <i class="fa-solid fa-comments text-blue-400 text-[10px]"></i>
                            <span class="font-black text-sm">{{ $article->commentaires_count }}</span>
                        </div>
                    </td>

                    {{-- Audience (Vues / Likes) --}}
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex flex-col items-center">
                            <span class="text-sm font-black text-[#1B2E58]">{{ $article->vue }} <i class="fa-solid fa-eye text-[9px] opacity-30"></i></span>
                            <span class="text-[10px] font-bold text-pink-500">{{ $article->likes }} <i class="fa-solid fa-heart"></i></span>
                        </div>
                    </td>

                    {{-- Statut --}}
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 {{ $article->status == 'publié' ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-500' }} rounded-full text-[9px] font-black uppercase tracking-widest">
                            {{ $article->status }}
                        </span>
                    </td>

                    {{-- Actions --}}
                    <td class="px-8 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.blog.show', $article->id_article) }}" class="w-9 h-9 rounded-xl bg-blue-50 text-[#1B2E58] flex items-center justify-center hover:bg-[#1B2E58] hover:text-white transition-all shadow-sm" title="Détails">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </a>
                            <a href="{{ route('admin.blog.edit', $article->id_article) }}" class="w-9 h-9 rounded-xl bg-orange-50 text-[#FF9F29] flex items-center justify-center hover:bg-[#FF9F29] hover:text-white transition-all shadow-sm" title="Modifier">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </a>
                            <button @click="selected = { id_article: {{ $article->id_article }}, titre: '{{ addslashes($article->titre) }}' }; showDelete = true" 
                                class="w-9 h-9 rounded-xl bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Supprimer">
                                <i class="fa-solid fa-trash-can text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-20 text-center text-gray-400 italic font-medium">Aucun article trouvé dans votre base de données.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MODAL SUPPRESSION -->
    <!-- MODAL SUPPRESSION CORRIGÉE -->
<div x-show="showDelete" 
     class="fixed inset-0 z-[120] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" 
     x-cloak x-transition>
    
    <div class="bg-white w-full max-w-md rounded-[3rem] p-12 text-center shadow-2xl">
        <i class="fa-solid fa-trash-can text-5xl text-red-500 mb-6 animate-bounce"></i>
        
        <h3 class="text-2xl font-black text-[#1B2E58] mb-4 tracking-tight">Confirmer ?</h3>
        
        <p class="text-gray-500 mb-10 leading-relaxed font-medium italic">
            "Voulez-vous supprimer l'article <span x-text="selected.titre" class="text-red-600 font-bold"></span> ?"
        </p>

        <div class="flex gap-4">
            {{-- Bouton Annuler --}}
            <button @click="showDelete = false" type="button" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold transition-all hover:bg-gray-200">
                Annuler
            </button>

            {{-- Formulaire de suppression --}}
            {{-- On utilise les backticks ( ` ) pour construire l'URL proprement en JS --}}
            <form :action="`/admin/blog/articles/${selected.id_article}/supprimer`" method="POST" class="flex-1">
                @csrf 
                @method('DELETE')
                <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg shadow-red-200 hover:bg-red-700 transition-all">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection