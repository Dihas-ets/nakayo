@extends('layouts.admin')
@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.team.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-[#1B2E58] hover:bg-[#FF9F29] hover:text-white transition-all">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h2 class="text-3xl font-black text-[#1B2E58] uppercase italic">Fiche Collaborateur</h2>
    </div>

    <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 relative overflow-hidden">
        {{-- Décoration orange --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF9F29] rounded-bl-full opacity-10"></div>

        <div class="flex flex-col md:flex-row gap-12 items-center relative z-10">
            <!-- Portrait -->
            <div class="w-48 h-48 rounded-[2.5rem] overflow-hidden border-8 border-gray-50 shadow-xl">
                <img src="{{ url('storage/' . $membre->photo) }}" class="w-full h-full object-cover">
            </div>

            <!-- Infos -->
            <div class="flex-1 space-y-6">
                <div>
                    <h1 class="text-4xl font-black text-[#1B2E58]">{{ $membre->nom_complet }}</h1>
                    <p class="text-[#FF9F29] font-bold uppercase tracking-[0.2em] text-sm mt-1">{{ $membre->poste }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6 border-t border-gray-100">
                    <div>
                        <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest">LinkedIn</p>
                        @if($membre->linkedin)
                            <a href="{{ $membre->linkedin }}" target="_blank" class="text-[#1B2E58] font-bold hover:text-blue-600">Voir le profil <i class="fa-brands fa-linkedin"></i></a>
                        @else
                            <p class="text-gray-300 italic">Non renseigné</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Ordre d'affichage</p>
                        <p class="text-[#1B2E58] font-bold">Rang n°{{ $membre->ordre }}</p>
                    </div>
                </div>

                <div class="pt-8 flex gap-4">
                    <a href="{{ route('admin.team.edit', $membre->id_membre) }}" class="bg-[#1B2E58] text-white px-8 py-4 rounded-2xl font-black uppercase text-xs tracking-widest shadow-lg hover:bg-[#FF9F29] transition-all">
                        Modifier le profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection