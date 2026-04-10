@extends('layouts.admin')

@section('title', 'Gestion des Formations')

@section('content')
<div class="space-y-8">
    {{-- ALERTES --}}
    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center justify-between animate-bounce">
            <div class="flex items-center gap-3 font-bold text-lg">
                <i class="fa-solid fa-graduation-cap text-2xl"></i>
                {{ session('success') }}
            </div>
            <button @click="$el.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">Programmes de Formation</h2>
            <p class="text-gray-500 font-medium">Gérez vos offres de formation et expertises Nakayo.</p>
        </div>
        <a href="{{ route('admin.formations.create') }}" class="bg-[#1B2E58] hover:bg-[#00261C] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg transition-all active:scale-95">
            <i class="fa-solid fa-plus"></i> Nouveau Programme
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#00261C] text-white font-black uppercase text-[10px] tracking-widest">
                    <th class="px-8 py-6">Formation / Service</th>
                    <th class="px-8 py-6 text-center">Lieu & Date</th>
                    <th class="px-8 py-6 text-center">Coût (FCFA)</th>
                    <th class="px-8 py-6 text-center">Statut</th>
                    <th class="px-8 py-6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-medium text-[#1B2E58]">
                @forelse($offres as $offre)
                <tr class="hover:bg-gray-50/50 transition-all group">
                    <td class="px-8 py-5">
                        <p class="font-black text-lg leading-tight">{{ $offre->titre }}</p>
                        <span class="text-[10px] font-bold text-[#FF9F29] uppercase">
                             <i class="fa-solid fa-layer-group mr-1"></i> {{ $offre->service->titre ?? 'Pole Technique' }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <p class="text-sm font-bold text-gray-700">{{ $offre->lieu }}</p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $offre->date_formation ? \Carbon\Carbon::parse($offre->date_formation)->format('d M Y') : 'A définir' }}</p>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="px-4 py-1.5 bg-blue-50 text-[#1B2E58] rounded-xl font-black text-sm">
                            {{ number_format($offre->cout, 0, ',', ' ') }}
                        </span>
                    </td>
                    {{-- Dans le <td> du Statut --}}
                    <td class="px-8 py-5 text-center">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest 
                            {{ $offre->status == 'disponible' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-600' }}">
                            {{ $offre->status }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2" x-data="{ showDelete: false }">
                            <a href="{{ route('admin.formations.show', $offre->id_formation) }}" class="w-9 h-9 rounded-xl bg-blue-50 text-[#1B2E58] flex items-center justify-center hover:bg-[#1B2E58] hover:text-white transition-all shadow-sm"><i class="fa-solid fa-eye text-sm"></i></a>
                            <a href="{{ route('admin.formations.edit', $offre->id_formation) }}" class="w-9 h-9 rounded-xl bg-orange-50 text-[#FF9F29] flex items-center justify-center hover:bg-[#FF9F29] hover:text-white transition-all shadow-sm"><i class="fa-solid fa-pen-to-square text-sm"></i></a>
                            
                            {{-- Bouton Supprimer --}}
                            <form action="{{ route('admin.formations.destroy', $offre->id_formation) }}" method="POST" onsubmit="return confirm('Supprimer ce programme ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-xl bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-20 text-center text-gray-400 italic">Aucune formation trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection