@extends('layouts.admin')

@section('title', 'Modifier le Produit')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Formulaire de modification avec gestion d'image --}}
    <form action="{{ route('admin.produits.update', $produit->id_produit) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- TOP NAVIGATION & ACTIONS -->
        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.produits.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] shadow-sm transition-all group">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h2 class="text-3xl font-black text-[#1B2E58]">Modifier le Produit</h2>
                    <p class="text-[10px] font-black text-[#FF9F29] uppercase tracking-widest italic text-center md:text-left">Mise à jour de l'inventaire</p>
                </div>
            </div>
            <button type="submit" class="bg-[#1B2E58] text-white px-10 py-3.5 rounded-2xl font-black shadow-xl hover:bg-[#00261C] transition-all text-xs tracking-widest">
                METTRE À JOUR LA FICHE
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- COLONNE GAUCHE : DÉSIGNATION ET DESCRIPTION -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100 min-h-[600px]">
                    <div class="mb-10">
                        <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Nom / Désignation du produit</label>
                        <input type="text" name="nom" value="{{ old('nom', $produit->nom) }}" 
                               class="w-full text-4xl font-black text-[#1B2E58] border-none focus:ring-0 p-0 placeholder:text-gray-100" 
                               placeholder="Ex: Kit Panneau Solaire 300W..." required>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Fiche Descriptive & Technique</label>
                        <textarea name="description" rows="15" 
                                  class="w-full border-2 border-gray-50 rounded-[2rem] p-8 text-gray-600 font-medium focus:border-[#FF9F29] outline-none transition-all" 
                                  placeholder="Décrivez ici les spécificités du produit, ses avantages, etc..." required>{{ old('description', $produit->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- COLONNE DROITE : SIDEBAR TECHNIQUE -->
            <div class="space-y-6">
                
                {{-- VISUEL DU PRODUIT --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 text-center">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-6 text-left border-b border-gray-50 pb-4 tracking-widest">Photo du produit</h3>
                    
                    <div class="relative group rounded-3xl overflow-hidden mb-6 bg-gray-50 border border-gray-100 h-48 flex items-center justify-center">
                        @if($produit->image)
                            <img src="{{ asset('storage/'.$produit->image) }}" class="w-full h-full object-cover">
                        @else
                            <i class="fa-solid fa-box-open text-5xl text-gray-200"></i>
                        @endif
                        
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <label class="cursor-pointer bg-white text-[#1B2E58] px-4 py-2 rounded-xl font-bold text-[10px] uppercase shadow-xl">
                                Remplacer l'image
                                <input type="file" name="image" class="hidden">
                            </label>
                        </div>
                    </div>
                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter italic">Format conseillé : Carré (800x800px)</p>
                </div>

                {{-- CONFIGURATION TECHNIQUE --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 space-y-6">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-2 tracking-widest border-b border-gray-50 pb-4">Paramètres</h3>
                    
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Service Nakayo rattaché</label>
                        <select name="id_service" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                            @foreach(\App\Models\Service::all() as $service)
                                <option value="{{ $service->id_service }}" {{ $produit->id_service == $service->id_service ? 'selected' : '' }}>
                                    {{ $service->titre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Prix de vente (FCFA)</label>
                        <input type="number" name="prix" value="{{ old('prix', $produit->prix) }}" 
                               class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-black text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]" >
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Contact pour commande</label>
                        <input type="text" name="contact" value="{{ old('contact', $produit->contact) }}" 
                               class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]" placeholder="+229...">
                    </div>
                </div>

                {{-- STATUS CARD --}}
                <div class="bg-[#1B2E58] rounded-[2.5rem] p-8 text-white shadow-xl relative overflow-hidden group">
                    <div class="relative z-10">
                        <label class="block text-[10px] font-black uppercase text-white/40 mb-4 tracking-widest">Disponibilité stock</label>
                        <select name="statut" class="w-full bg-white/10 border-none rounded-xl px-4 py-3 font-black text-sm uppercase focus:ring-2 focus:ring-[#FF9F29]">
                            <option value="disponible" class="text-black" {{ $produit->statut == 'disponible' ? 'selected' : '' }}>En Stock</option>
                            <option value="en_rupture" class="text-black" {{ $produit->statut == 'en_rupture' ? 'selected' : '' }}>Rupture de stock</option>
                        </select>
                    </div>
                    {{-- Déco fond Nakayo --}}
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-[#FF9F29] opacity-10 rounded-full blur-3xl transition-all duration-1000 group-hover:scale-150"></div>
                </div>

                {{-- SYSTEM INFO --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-[10px]">
                            <span class="font-black text-gray-300 uppercase">ID Produit :</span>
                            <span class="font-bold text-[#1B2E58]">#{{ $produit->id_produit }}</span>
                        </div>
                        <div class="flex justify-between items-center text-[10px]">
                            <span class="font-black text-gray-300 uppercase">Dernière MAJ :</span>
                            <span class="font-bold text-[#1B2E58]">{{ $produit->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection