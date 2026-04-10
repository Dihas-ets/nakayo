@extends('layouts.admin')

@section('title', 'Catégories du Blog')

@section('content')
<div x-data="{ 
    showAdd: false, showEdit: false, showDelete: false,
    selected: { id_categorie: null, nom: '', slug: '', status: 1 },
    slugify(text) {
        return text.toString().toLowerCase().trim()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-');
    }
}" class="space-y-8">

    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-bounce">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-check-double text-2xl"></i>
                <span class="font-bold text-lg">{{ session('success') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="opacity-70"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">Gestion des Catégories</h2>
            <p class="text-gray-500 font-medium italic">Organisez vos thématiques pour NAKAYO CORPORATION.</p>
        </div>
        <button type="button" @click="showAdd = true" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg transition-all active:scale-95">
            <i class="fa-solid fa-plus"></i> Nouvelle Catégorie
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#00261C] text-white">
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest w-16 text-center">Icon</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest">Nom</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest text-center">Articles</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest text-center">Statut</th>
                    <th class="px-10 py-6 text-[11px] font-black uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-medium text-[#1B2E58]">
                @forelse($categories as $category)
                <tr class="hover:bg-gray-50/50 transition-all group">
                    <td class="px-10 py-6 text-center">
                        <div class="w-10 h-10 bg-orange-50 text-[#FF9F29] rounded-xl flex items-center justify-center mx-auto">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                    </td>
                    <td class="px-10 py-6">
                        <span class="font-black text-lg block">{{ $category->nom }}</span>
                        <code class="text-[10px] text-gray-400 font-mono italic">/{{ $category->slug }}</code>
                    </td>
                    <td class="px-10 py-6 text-center">
                        <span class="px-4 py-1.5 bg-blue-50 text-[#1B2E58] rounded-full text-[10px] font-black uppercase border border-blue-100">
                            {{ $category->articles_count ?? 0 }} Articles
                        </span>
                    </td>
                    <td class="px-10 py-6 text-center">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $category->status ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-400' }}">
                            {{ $category->status ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class="px-10 py-6 text-right">
                        <div class="flex justify-end gap-2">
                            <button type="button" @click='selected = {{ json_encode($category) }}; showEdit = true' 
                                class="w-10 h-10 rounded-xl bg-orange-50 text-[#FF9F29] hover:bg-[#FF9F29] hover:text-white transition-all flex items-center justify-center">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" @click='selected = {{ json_encode($category) }}; showDelete = true' 
                                class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-20 text-center text-gray-400 italic font-medium">Aucune catégorie enregistrée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div x-show="showAdd" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#00261C]/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showAdd = false" class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-2xl font-black text-[#1B2E58]">Nouvelle Catégorie</h3>
                <button type="button" @click="showAdd = false" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('admin.blog.categories.store') }}" method="POST" x-data="{ nom: '', slug: '' }" class="p-10 space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">Nom de la catégorie</label>
                    <input type="text" name="nom" x-model="nom" @input="slug = slugify(nom)" class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold text-[#1B2E58]" required>
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">URL / Slug</label>
                    <input type="text" name="slug" x-model="slug" readonly class="w-full px-6 py-4 rounded-2xl border border-gray-50 bg-gray-50 text-gray-400 font-mono text-sm outline-none">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1B2E58] mb-2 uppercase opacity-60">Visibilité</label>
                    <select name="status" class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold text-[#1B2E58]">
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-[#FF9F29] text-white py-4 rounded-2xl font-black shadow-xl active:scale-95 transition-all">CRÉER MAINTENANT</button>
            </form>
        </div>
    </div>

    <div x-show="showEdit" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showEdit = false" class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl p-10">
            <h3 class="text-2xl font-black text-[#1B2E58] mb-6">Modifier la catégorie</h3>
            
            <form :action="'{{ route('admin.blog.categories.update', '') }}/' + selected.id_categorie" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1">Nom</label>
                        <input type="text" name="nom" x-model="selected.nom" @input="selected.slug = slugify(selected.nom)" class="w-full px-5 py-4 rounded-2xl border border-gray-100 focus:border-[#FF9F29] outline-none font-bold text-[#1B2E58]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1">Slug (URL)</label>
                        <input type="text" name="slug" x-model="selected.slug" readonly class="w-full px-5 py-4 rounded-2xl border bg-gray-50 text-gray-400 font-mono text-xs">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1">Statut</label>
                        <select name="status" x-model="selected.status" class="w-full px-5 py-4 rounded-2xl border font-bold text-[#1B2E58]">
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-4 mt-8">
                    <button type="button" @click="showEdit = false" class="flex-1 py-4 font-bold text-gray-400">Annuler</button>
                    <button type="submit" class="flex-1 py-4 bg-[#FF9F29] text-white rounded-2xl font-black shadow-xl">METTRE À JOUR</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="showDelete" class="fixed inset-0 z-[120] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div @click.away="showDelete = false" class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl relative border border-gray-100">
            <i class="fa-solid fa-trash-can text-5xl text-red-500 mb-6"></i>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-4">Supprimer ?</h3>
            <p class="text-gray-500 mb-10">Supprimer la catégorie <span class="font-bold text-red-600 uppercase" x-text="selected.nom"></span> ?</p>
            
            <form :action="'{{ route('admin.blog.categories.destroy', '') }}/' + selected.id_categorie" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-4">
                    <button type="button" @click="showDelete = false" class="flex-1 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold">Non</button>
                    <button type="submit" class="flex-1 py-3 bg-red-600 text-white rounded-xl font-bold shadow-lg">Oui, Supprimer</button>
                </div>
            </form>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection