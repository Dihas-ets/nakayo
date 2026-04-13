@extends('layouts.admin')
@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row justify-between items-end gap-4">
        <div>
            <h2 class="text-3xl font-black text-[#1B2E58] tracking-tight uppercase italic">L'Équipe NAKAYO</h2>
            <p class="text-gray-500 font-medium">Gestion des collaborateurs sur des pages dédiées.</p>
        </div>
        <!-- LIEN VERS LA PAGE D'AJOUT -->
        <a href="{{ route('admin.team.create') }}" class="bg-[#1B2E58] hover:bg-[#FF9F29] text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg transition-all">
            <i class="fa-solid fa-plus-circle"></i> Ajouter un membre
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-8 py-6 text-[10px] font-black uppercase text-[#1B2E58] opacity-50">Portrait</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase text-[#1B2E58] opacity-50">Collaborateur</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase text-[#1B2E58] opacity-50 text-center">Poste</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase text-[#1B2E58] opacity-50 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($membres as $membre)
                <tr class="group hover:bg-[#F8FAFC]">
                    <td class="px-8 py-5">
                        <img src="{{ asset('storage/' . $membre->photo) }}" class="w-14 h-14 rounded-2xl object-cover shadow-sm">
                    </td>
                    <td class="px-8 py-5">
                        <p class="font-black text-[#1B2E58]">{{ $membre->nom_complet }}</p>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="px-3 py-1 bg-blue-50 text-[#1B2E58] rounded-full text-[10px] font-black uppercase">
                            {{ $membre->poste }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            <!-- BOUTON DÉTAILS (Nouveau) -->
                            <a href="{{ route('admin.team.show', $membre->id_membre) }}" 
                            class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 hover:bg-[#1B2E58] hover:text-white transition-all duration-300 flex items-center justify-center shadow-sm"
                            title="Voir les détails">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </a>

                            <!-- LIEN MODIFIER -->
                            <a href="{{ route('admin.team.edit', $membre->id_membre) }}" 
                            class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-[#FF9F29] hover:text-white flex items-center justify-center transition-all shadow-sm"
                            title="Modifier">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </a>

                            <!-- BOUTON SUPPRIMER -->
                            <form action="{{ route('admin.team.destroy', $membre->id_membre) }}" method="POST" onsubmit="return confirm('Supprimer ce membre ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all shadow-sm" title="Supprimer">
                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection