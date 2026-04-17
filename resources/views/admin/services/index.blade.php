@extends('layouts.admin')

@section('title', 'Catalogue des Services')

@section('content')
<div x-data="{ 
    showDelete: false, 
    selected: { id: null, titre: '' } 
}" class="space-y-8">

    <!-- ALERTES DE SUCCÈS -->
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-bounce">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-2xl"></i>
                <span class="font-bold text-lg">{{ session('success') }}</span>
            </div>
            <button @click="$el.parentElement.remove()" class="opacity-70 hover:opacity-100"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">Catalogue des Services</h2>
            <p class="text-gray-500 font-medium">Gérez vos prestations et les galeries associées.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg transition-all active:scale-95">
            <i class="fa-solid fa-plus"></i> Nouveau Service
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#00261C] text-white">
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-center w-16">Aperçu</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest">Service</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-center">Statut</th> {{-- NOUVELLE COLONNE --}}
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest">Description</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($services as $service)
                <tr class="hover:bg-gray-50/50 transition-all group">
                    <td class="px-8 py-4 text-center">
                        <div class="w-16 h-10 rounded-lg overflow-hidden border border-gray-100 shadow-sm mx-auto bg-gray-50">
                            @if($service->media)
                                <img src="{{ Storage::url($service->media) }}" class="w-full h-full object-cover">   
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-4 font-black text-[#1B2E58] text-lg">{{ $service->titre }}</td>
                    
                    {{-- CELLULE STATUT --}}
                    <td class="px-8 py-4 text-center">
                        @if($service->status == 'publié')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-600 text-[10px] font-black uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                                Publié
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-400 text-[10px] font-black uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                Brouillon
                            </span>
                        @endif
                    </td>

                    <td class="px-8 py-4 text-gray-500 text-sm italic">{{ Str::limit($service->courte_description, 60) }}</td>
                    <td class="px-8 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.services.show', $service->id_service) }}" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-[#1B2E58] hover:text-white transition-all shadow-sm">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </a>
                            <a href="{{ route('admin.services.edit', $service->id_service) }}" class="w-9 h-9 rounded-xl bg-orange-50 text-[#FF9F29] flex items-center justify-center hover:bg-[#FF9F29] hover:text-white transition-all shadow-sm">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </a>
                            <button @click="selected = { id: {{ $service->id_service }}, titre: '{{ addslashes($service->titre) }}' }; showDelete = true" 
                                    class="w-9 h-9 rounded-xl bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                <i class="fa-solid fa-trash-can text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-20 text-center text-gray-400 italic font-medium">Aucun service trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MODAL DE SUPPRESSION (Inchangé) -->
    <div x-show="showDelete" class="fixed inset-0 z-[120] flex items-center justify-center p-4 bg-[#00261C]/80 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white w-full max-w-md rounded-[3rem] p-12 text-center shadow-2xl relative">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl animate-pulse">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <h3 class="text-2xl font-black text-[#1B2E58] mb-4 tracking-tight">Supprimer le service ?</h3>
            <p class="text-gray-500 mb-10 leading-relaxed font-medium">
                Voulez-vous supprimer l'expertise <span class="text-red-600 font-bold" x-text="selected.titre"></span> ? 
                <br><span class="text-[10px] uppercase font-black text-gray-400">Cela supprimera aussi les photos liées.</span>
            </p>
            <div class="flex gap-4">
                <button @click="showDelete = false" type="button" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition-all">Annuler</button>
                <form :action="'/admin/services/' + selected.id" method="POST" class="flex-1">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold shadow-lg shadow-red-200 hover:bg-red-700 transition-all">Confirmer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection