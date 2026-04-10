@extends('layouts.admin')

@section('title', 'Détails Produit')

@section('content')
<div class="max-w-6xl mx-auto space-y-10">
    
    <!-- NAVIGATION & ACTIONS -->
    <div class="flex justify-between items-center px-4 md:px-0">
        <a href="{{ route('admin.produits.index') }}" class="inline-flex items-center gap-2 text-gray-400 font-bold text-sm hover:text-[#1B2E58] transition-all group">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> 
            Retour à l'inventaire
        </a>
        <a href="{{ route('admin.produits.edit', $produit->id_produit) }}" class="bg-blue-50 text-[#1B2E58] px-6 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-[#1B2E58] hover:text-white transition-all shadow-sm">
            <i class="fa-solid fa-pen-to-square mr-1"></i> Modifier la fiche
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 px-4 md:px-0">
        
        <!-- COLONNE GAUCHE : VISUEL & DESCRIPTION -->
        <div class="lg:col-span-2 space-y-8">
            {{-- Grande Image --}}
            <div class="bg-white rounded-[3rem] overflow-hidden shadow-sm border border-gray-100 group">
                <div class="relative h-[450px] bg-gray-50 flex items-center justify-center">
                    @if($produit->image)
                        <img src="{{ asset('storage/' . $produit->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    @else
                        <i class="fa-solid fa-box-open text-9xl text-gray-100"></i>
                    @endif
                    <div class="absolute top-8 left-8">
                        <span class="px-4 py-1.5 bg-[#FF9F29] text-white rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg">
                            {{ $produit->service->titre ?? 'Matériel Nakayo' }}
                        </span>
                    </div>
                </div>
                
                <div class="p-12">
                    <h1 class="text-4xl md:text-5xl font-black text-[#1B2E58] mb-8 leading-tight">{{ $produit->nom }}</h1>
                    
                    <h3 class="text-[#1B2E58] font-black uppercase text-xs tracking-widest mb-6 border-b border-gray-50 pb-4 flex items-center gap-2">
                        <i class="fa-solid fa-file-lines text-[#FF9F29]"></i>
                        Description Technique
                    </h3>
                    <div class="text-gray-600 font-medium leading-relaxed text-lg whitespace-pre-line">
                        {{ $produit->description }}
                    </div>
                </div>
            </div>
        </div>

        <!-- COLONNE DROITE : PRIX & STATUT -->
        <div class="space-y-8">
            
            {{-- CARD PRIX --}}
            <div class="bg-[#1B2E58] rounded-[2.5rem] p-10 text-white shadow-xl relative overflow-hidden group text-center">
                <div class="relative z-10">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-4 opacity-60">Tarif unitaire</p>
                    @if($produit->prix)
                        <h2 class="text-5xl font-black tracking-tighter">{{ number_format($produit->prix, 0, ',', ' ') }}</h2>
                        <p class="text-sm font-bold text-[#FF9F29] mt-2">Francs CFA (TTC)</p>
                    @else
                        <h2 class="text-3xl font-black tracking-tighter uppercase italic">Sur Devis</h2>
                        <p class="text-sm font-bold text-[#FF9F29] mt-2">Contactez l'agence</p>
                    @endif
                </div>
                <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-white/5 rounded-full blur-3xl group-hover:scale-125 transition-transform"></div>
            </div>

            {{-- CARD DISPONIBILITÉ --}}
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                <h4 class="text-[11px] font-black uppercase text-gray-300 tracking-widest mb-8 text-center border-b pb-4">Disponibilité</h4>
                
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-gray-500">État du stock</span>
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest
                            {{ $produit->statut == 'disponible' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-600' }}">
                            {{ $produit->statut == 'disponible' ? 'En Stock' : 'Rupture' }}
                        </span>
                    </div>

                    <div class="pt-4 border-t border-gray-50">
                        <p class="text-[10px] font-black text-gray-400 uppercase mb-3 tracking-widest">Contact Commande</p>
                        <div class="flex items-center gap-3 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <i class="fa-brands fa-whatsapp text-emerald-500 text-2xl"></i>
                            <span class="font-black text-[#1B2E58] text-sm">{{ $produit->contact ?? 'Agence Nakayo' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- INFO SYSTÈME --}}
            <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100">
                <div class="space-y-3">
                    <div class="flex justify-between items-center text-[10px]">
                        <span class="font-black text-gray-400 uppercase">ID Produit :</span>
                        <span class="font-bold text-[#1B2E58]">#{{ $produit->id_produit }}</span>
                    </div>
                    <div class="flex justify-between items-center text-[10px]">
                        <span class="font-black text-gray-400 uppercase">Enregistré le :</span>
                        <span class="font-bold text-[#1B2E58]">{{ $produit->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection