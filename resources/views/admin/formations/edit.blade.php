@extends('layouts.admin')

@section('title', 'Modifier la Formation')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Le formulaire pointe vers la route update avec l'ID de la formation --}}
    <form action="{{ route('admin.formations.update', $offre->id_formation) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- TOP NAVIGATION & ACTIONS -->
        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.formations.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] shadow-sm transition-all group">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h2 class="text-3xl font-black text-[#1B2E58]">Modifier le Programme</h2>
                    <p class="text-[10px] font-black text-[#FF9F29] uppercase tracking-widest italic">Édition de l'offre de formation</p>
                </div>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.formations.show', $offre->id_formation) }}" class="bg-blue-50 text-[#1B2E58] px-6 py-3.5 rounded-2xl font-black hover:bg-blue-100 transition-all text-xs tracking-widest">
                    VOIR L'APERÇU
                </a>
                <button type="submit" class="bg-[#1B2E58] text-white px-10 py-3.5 rounded-2xl font-black shadow-xl hover:bg-[#00261C] transition-all text-xs tracking-widest">
                    METTRE À JOUR
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- COLONNE GAUCHE : CONTENU ÉDITORIAL -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100 min-h-[600px]">
                    <div class="mb-10">
                        <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Titre de la formation</label>
                        <input type="text" name="titre" value="{{ $offre->titre }}" 
                               class="w-full text-4xl font-black text-[#1B2E58] border-none focus:ring-0 p-0 placeholder:text-gray-100" 
                               placeholder="Ex: Expertise en Énergie Solaire..." required>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Description détaillée du programme</label>
                        <textarea name="description" rows="15" 
                                  class="w-full border-2 border-gray-50 rounded-[2rem] p-8 text-gray-600 font-medium focus:border-[#FF9F29] outline-none transition-all" 
                                  placeholder="Décrivez les objectifs, le public cible, les prérequis...">{{ $offre->description }}</textarea>
                    </div>
                </div>
            </div>

            <!-- COLONNE DROITE : SIDEBAR TECHNIQUE -->
            <div class="space-y-6">
                
                {{-- FICHE TECHNIQUE --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 space-y-6">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-2 tracking-widest border-b border-gray-50 pb-4">Configuration</h3>
                    
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Service Nakayo rattaché</label>
                        <select name="id_service" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                            @foreach($services as $service)
                                <option value="{{ $service->id_service }}" {{ $offre->id_service == $service->id_service ? 'selected' : '' }}>
                                    {{ $service->titre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Coût de la formation (FCFA)</label>
                        <input type="number" name="cout" value="{{ $offre->cout }}" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Lieu / Plateforme</label>
                        <input type="text" name="lieu" value="{{ $offre->lieu }}" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Date de l'événement</label>
                        {{-- Formatage Carbon pour l'input date HTML --}}
                        <input type="date" name="date_formation" value="{{ $offre->date_formation ? \Carbon\Carbon::parse($offre->date_formation)->format('Y-m-d') : '' }}" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Contact Inscriptions</label>
                        <input type="text" name="contact" value="{{ $offre->contact }}" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                    </div>
                </div>

                {{-- STATUS CARD --}}
                <div class="bg-[#1B2E58] rounded-[2.5rem] p-8 text-white shadow-xl relative overflow-hidden group">
                    <div>
    <label class="block text-[10px] font-black text-gray-300 uppercase mb-2">Disponibilité</label>
    <select name="status" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
        <option value="disponible" {{ (isset($offre) && $offre->status == 'disponible') ? 'selected' : '' }}>
            ✅ Disponible
        </option>
        <option value="non disponible" {{ (isset($offre) && $offre->status == 'non disponible') ? 'selected' : '' }}>
            ❌ Non disponible
        </option>
    </select>
</div>
                    {{-- Déco fond --}}
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-[#FF9F29] opacity-10 rounded-full blur-3xl transition-all duration-1000 group-hover:scale-150"></div>
                </div>

                {{-- SYSTEM INFO --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <h4 class="text-[10px] font-black text-gray-300 uppercase mb-4 tracking-widest">Informations Système</h4>
                    <div class="space-y-2">
                        <p class="text-xs text-[#1B2E58] font-bold">ID Formation : <span class="text-gray-400">#{{ $offre->id_formation }}</span></p>
                        <p class="text-xs text-[#1B2E58] font-bold">Créée le : <span class="text-gray-400">{{ $offre->created_at->format('d/m/Y') }}</span></p>
                        <p class="text-xs text-[#1B2E58] font-bold">Mise à jour : <span class="text-gray-400">{{ $offre->updated_at->format('d/m/Y H:i') }}</span></p>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection