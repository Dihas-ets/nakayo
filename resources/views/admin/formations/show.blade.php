@extends('layouts.admin')

@section('title', 'Détails de la Formation')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">
    <!-- Retour -->
    <a href="{{ route('admin.formations.index') }}" class="inline-flex items-center gap-2 text-gray-400 font-bold text-sm hover:text-[#1B2E58] transition-all group">
        <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> 
        Retour à la liste
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- COLONNE GAUCHE : DÉTAILS -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[3rem] overflow-hidden shadow-sm border border-gray-100 p-12">
                <div class="flex items-center gap-3 mb-6">
                    <span class="px-4 py-1.5 bg-orange-50 text-[#FF9F29] rounded-full text-[10px] font-black uppercase tracking-widest">
                        Programme Officiel
                    </span>
                    <span class="px-4 py-1.5 bg-blue-50 text-[#1B2E58] rounded-full text-[10px] font-black uppercase tracking-widest">
                        {{ $offre->service->titre }}
                    </span>
                </div>

                <h1 class="text-4xl font-black text-[#1B2E58] mb-8 leading-tight">{{ $offre->titre }}</h1>
                
                <div class="space-y-6">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest border-b pb-2">Description du programme</h3>
                    <div class="text-gray-600 leading-relaxed font-medium text-lg whitespace-pre-line">
                        {{ $offre->description ?? 'Aucune description détaillée fournie.' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- COLONNE DROITE : RÉCAPITULATIF -->
        <div class="space-y-8">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                <h3 class="text-[11px] font-black text-[#1B2E58] uppercase tracking-[0.2em] mb-10 border-b border-gray-50 pb-4">Informations</h3>
                
                <div class="space-y-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-[#1B2E58] rounded-2xl flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase">Lieu</p>
                            <p class="font-black text-[#1B2E58]">{{ $offre->lieu }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-50 text-[#FF9F29] rounded-2xl flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase">Date</p>
                            <p class="font-black text-[#1B2E58]">{{ $offre->date_formation ? \Carbon\Carbon::parse($offre->date_formation)->format('d M Y') : 'À définir' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-address-book"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase">Contact</p>
                            <p class="font-black text-[#1B2E58]">{{ $offre->contact }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 pt-10 border-t border-gray-50 text-center">
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-4">Coût de la formation</p>
                    <p class="text-3xl font-black text-[#1B2E58]">{{ number_format($offre->cout, 0, ',', ' ') }} <span class="text-sm font-bold opacity-40">FCFA</span></p>
                </div>
            </div>

            <!-- BOUTON ÉDITION RAPIDE -->
            <a href="{{ route('admin.formations.edit', $offre->id_formation) }}" class="flex items-center justify-center gap-3 w-full py-5 bg-[#1B2E58] text-white rounded-[2rem] font-black shadow-xl hover:bg-[#00261C] transition-all uppercase text-xs tracking-widest">
                <i class="fa-solid fa-pen-to-square"></i> Modifier la fiche
            </a>
        </div>
    </div>
</div>
@endsection