@extends('layouts.admin')

@section('title', 'Gestion des Projets')

@section('content')
<div x-data="{ showDelete: false, selected: {id: null, nom: ''} }" class="space-y-8">

    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-bounce">
            <div class="flex items-center gap-3 font-bold">
                <i class="fa-solid fa-diagram-project text-2xl"></i>
                {{ session('success') }}
            </div>
            <button @click="$el.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase">Portfolio de Réalisations</h2>
            <p class="text-gray-500 font-medium">Gérez les preuves de votre expertise terrain.</p>
        </div>
        <a href="{{ route('admin.projets.create') }}" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg active:scale-95 transition-all">
            <i class="fa-solid fa-plus-circle"></i> Ajouter un Projet
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 w-24">Image</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50">Projet / Client</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 text-center">Service lié</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 text-center">Localisation</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($projets as $projet)
                <tr class="group hover:bg-[#F8FAFC] transition-all">
                    <td class="px-8 py-5 text-center">
                        <img src="{{ asset('storage/'.$projet->image) }}" class="w-14 h-10 rounded-xl object-cover border shadow-sm" onerror="this.src='https://placehold.co/100x100?text=Projet'">
                    </td>
                    <td class="px-8 py-5">
                        <p class="font-black text-[#1B2E58] text-base leading-tight">{{ $projet->nom }}</p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Client: {{ $projet->client ?? 'N/A' }}</p>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="px-3 py-1 bg-blue-50 text-[#1B2E58] rounded-lg text-[10px] font-black uppercase">
                            {{ $projet->service->titre ?? 'Général' }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <p class="text-sm font-black text-[#FF9F29]"><i class="fa-solid fa-location-dot text-[10px] mr-1"></i>{{ $projet->lieu }}</p>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.projets.edit', $projet->id_projet) }}" class="w-9 h-9 rounded-xl bg-gray-50 text-gray-400 hover:bg-[#1B2E58] hover:text-white transition-all flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </a>
                            <button @click="selected = {id: {{ $projet->id_projet }}, nom: '{{ addslashes($projet->nom) }}'}; showDelete = true" class="w-9 h-9 rounded-xl bg-gray-50 text-gray-400 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-trash-can text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-20 text-center text-gray-400 italic">Aucune réalisation enregistrée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MODAL SUPPRIMER -->
    <div x-show="showDelete" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-sm rounded-[3rem] p-12 text-center shadow-2xl relative border border-gray-100">
            <i class="fa-solid fa-folder-minus text-5xl text-red-500 mb-6"></i>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-2 tracking-tight">Supprimer le projet ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">L'œuvre <span class="text-red-600 font-bold" x-text="selected.nom"></span> sera retirée du portfolio.</p>
            <div class="flex gap-4">
                <button @click="showDelete = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold">Annuler</button>
                <form :action="'/admin/projets/' + selected.id" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg shadow-red-200 hover:bg-red-700 transition-all">SUPPRIMER</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection