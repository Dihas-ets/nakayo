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
        <div class="bg-white rounded-[3rem] overflow-hidden shadow-sm border border-gray-100">
            
            {{-- 1. IMAGE DE LA FORMATION (Bord à bord) --}}
            <div class="h-80 w-full overflow-hidden relative border-b border-gray-50">
                @if($offre->image)
                    <img src="{{ url('storage/' . $offre->image) }}" 
                         alt="{{ $offre->titre }}" 
                         class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                @else
                    <div class="w-full h-full bg-gray-50 flex flex-col items-center justify-center text-gray-200">
                        <i class="fa-solid fa-image text-7xl mb-4"></i>
                        <span class="text-xs font-black uppercase tracking-widest">Aucune image illustrative</span>
                    </div>
                @endif

                {{-- Overlay Badge flottant sur l'image --}}
                <div class="absolute top-6 right-6">
                    <span class="bg-[#1B2E58]/80 backdrop-blur-md text-white px-5 py-2 rounded-full text-[9px] font-black uppercase tracking-widest shadow-xl">
                        ID: #00{{ $offre->id_formation }}
                    </span>
                </div>
            </div>

            {{-- 2. CONTENU TEXTUEL (Avec padding) --}}
            <div class="p-10 md:p-12">
                <div class="flex items-center gap-3 mb-6">
                    <span class="px-4 py-1.5 bg-orange-50 text-[#FF9F29] rounded-full text-[10px] font-black uppercase tracking-widest">
                        Programme Officiel
                    </span>
                    <span class="px-4 py-1.5 bg-blue-50 text-[#1B2E58] rounded-full text-[10px] font-black uppercase tracking-widest">
                        {{ $offre->service->titre ?? 'Pôle Expertise' }}
                    </span>
                </div>

                <h1 class="text-4xl font-black text-[#1B2E58] mb-8 leading-tight uppercase tracking-tighter">{{ $offre->titre }}</h1>
                
                <div class="space-y-6">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest border-b border-gray-50 pb-4">
                        Description du programme
                    </h3>
                    <div class="text-gray-600 leading-relaxed font-medium text-lg whitespace-pre-line">
                        {{ $offre->description ?? 'Aucune description détaillée fournie.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- COLONNE DROITE : RÉCAPITULATIF -->
    <div class="space-y-8">
        <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
            <h3 class="text-[11px] font-black text-[#1B2E58] uppercase tracking-[0.2em] mb-10 border-b border-gray-50 pb-4">Fiche d'Information</h3>
            
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
                        <p class="text-[10px] font-black text-gray-300 uppercase">Date de début</p>
                        <p class="font-black text-[#1B2E58]">{{ $offre->date_formation ? \Carbon\Carbon::parse($offre->date_formation)->format('d M Y') : 'À définir' }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-address-book"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-300 uppercase">Contact Direct</p>
                        <p class="font-black text-[#1B2E58]">{{ $offre->contact }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-10 border-t border-gray-50 text-center">
                <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-4">Investissement Requis</p>
                <p class="text-3xl font-black text-[#1B2E58]">
                    {{ number_format($offre->cout, 0, ',', ' ') }} 
                    <span class="text-sm font-bold opacity-40">FCFA</span>
                </p>
                
                {{-- Badge de Statut --}}
                <div class="mt-6">
                    <span class="px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-[0.1em] {{ $offre->status == 'disponible' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-600' }}">
                        {{ $offre->status == 'disponible' ? '✓ Inscriptions Ouvertes' : '✗ Session Complète' }}
                    </span>
                </div>
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