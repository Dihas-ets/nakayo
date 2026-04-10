@extends('layouts.admin')

@section('title', 'Modifier le Projet')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Formulaire de modification --}}
    <form action="{{ route('admin.projets.update', $projet->id_projet) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- TOP NAVIGATION -->
        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.projets.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] shadow-sm transition-all">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="text-3xl font-black text-[#1B2E58]">Modifier le Projet</h2>
                    <p class="text-[10px] font-black text-[#FF9F29] uppercase tracking-widest italic">Mise à jour du portfolio</p>
                </div>
            </div>
            <button type="submit" class="bg-[#1B2E58] text-white px-10 py-3.5 rounded-2xl font-black shadow-xl hover:bg-[#00261C] transition-all">
                ENREGISTRER LES MODIFICATIONS
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- COLONNE GAUCHE : DÉTAILS DU PROJET -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100 min-h-[600px]">
                    <div class="mb-8">
                        <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Désignation du projet</label>
                        <input type="text" name="nom" value="{{ $projet->nom }}" 
                               class="w-full text-4xl font-black text-[#1B2E58] border-none focus:ring-0 p-0 placeholder:text-gray-100" required>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Description des travaux réalisés</label>
                        <textarea name="description" rows="15" 
                                  class="w-full border-2 border-gray-50 rounded-[2rem] p-8 text-gray-600 font-medium focus:border-[#FF9F29] outline-none transition-all" 
                                  placeholder="Décrivez ici les détails du chantier, les défis relevés..." required>{{ $projet->description }}</textarea>
                    </div>
                </div>
            </div>

            <!-- COLONNE DROITE : SIDEBAR DE RÉGLAGES -->
            <div class="space-y-6">
                
                {{-- VISUEL PRINCIPAL --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-6 border-b border-gray-50 pb-4">Image du Projet</h3>
                    <div class="relative group border-2 border-dashed border-gray-100 rounded-[2rem] p-4 text-center hover:border-[#FF9F29] transition-all">
                        <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer">
                        @if($projet->image)
                            <img src="{{ asset('storage/'.$projet->image) }}" class="rounded-2xl h-48 w-full object-cover mb-4 shadow-sm">
                            <p class="text-[9px] font-black text-[#FF9F29] uppercase tracking-widest">Cliquer pour changer l'image</p>
                        @else
                            <div class="py-10">
                                <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-200 group-hover:text-[#FF9F29] mb-4 transition-colors"></i>
                                <p class="text-[10px] font-bold text-gray-300 uppercase">Ajouter une photo</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- INFOS TECHNIQUES --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 space-y-6">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-2 tracking-widest border-b border-gray-50 pb-4">Fiche Technique</h3>
                    
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Expertise associée</label>
                        <select name="id_service" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                            @foreach($services as $s)
                                <option value="{{ $s->id_service }}" {{ $projet->id_service == $s->id_service ? 'selected' : '' }}>
                                    {{ $s->titre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Localisation</label>
                        <input type="text" name="lieu" value="{{ $projet->lieu }}" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Client</label>
                        <input type="text" name="client" value="{{ $projet->client }}" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Date de livraison</label>
                        <input type="date" name="date_realisation" value="{{ $projet->date_realisation }}" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                    </div>
                </div>

                {{-- STATUS CARD --}}
                <div class="bg-[#1B2E58] rounded-[2.5rem] p-8 text-white shadow-xl relative overflow-hidden">
                    <div class="relative z-10">
                        <label class="block text-[10px] font-black uppercase text-white/40 mb-4 tracking-widest">Visibilité publique</label>
                        <select name="status" class="w-full bg-white/10 border-none rounded-xl px-4 py-3 font-black text-sm uppercase">
                            <option value="publié" class="text-black" {{ $projet->status == 'publié' ? 'selected' : '' }}>En ligne</option>
                            <option value="brouillon" class="text-black" {{ $projet->status == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection