@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- MODIFICATION : Ajout de enctype="multipart/form-data" --}}
    <form action="{{ isset($offre) ? route('admin.formations.update', $offre->id_formation) : route('admin.formations.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @if(isset($offre)) @method('PUT') @endif

        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.formations.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] shadow-sm transition-all">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h2 class="text-3xl font-black text-[#1B2E58]">{{ isset($offre) ? 'Modifier' : 'Nouveau' }} Formation</h2>
            </div>
            <button type="submit" class="bg-[#1B2E58] text-white px-10 py-3.5 rounded-2xl font-black shadow-xl hover:bg-[#00261C] transition-all">
                {{ isset($offre) ? 'METTRE À JOUR' : 'PUBLIER L\'OFFRE' }}
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- GAUCHE : CONTENU -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100">
                    <div class="mb-8">
                        <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Titre de la formation</label>
                        <input type="text" name="titre" value="{{ $offre->titre ?? '' }}" placeholder="Ex: Maintenance Solaire Niveau 1" class="w-full text-3xl font-black text-[#1B2E58] border-none focus:ring-0 p-0 placeholder:text-gray-100" required>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Description de la formation</label>
                        <textarea name="description" rows="12" class="w-full border-2 border-gray-50 rounded-[2rem] p-8 text-gray-600 font-medium focus:border-[#FF9F29] outline-none transition-all" placeholder="Détaillez le contenu, les prérequis, les objectifs...">{{ $offre->description ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- DROITE : SIDEBAR RÉGLAGES -->
            <div class="space-y-6">
                
                {{-- NOUVEAU CHAMP : IMAGE --}}
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-6 border-b border-gray-50 pb-4 tracking-widest">Visuel de la Formation</h3>
                    
                    @if(isset($offre) && $offre->image)
                        <div class="mb-4 relative group">
                            <img src="{{ url('storage/' . $offre->image) }}" class="w-full h-44 object-cover rounded-2xl border border-gray-100 shadow-sm">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all rounded-2xl flex items-center justify-center">
                                <p class="text-white text-[10px] font-black uppercase">Changer l'image</p>
                            </div>
                        </div>
                    @endif

                    <div class="relative">
                        <input type="file" name="image" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-gray-100 file:text-[#1B2E58] hover:file:bg-[#FF9F29] hover:file:text-white transition-all cursor-pointer" {{ isset($offre) ? '' : 'required' }}>
                    </div>
                    <p class="text-[9px] text-gray-400 mt-3 italic leading-tight">Format : JPG, PNG ou WebP. Max 2Mo.</p>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 space-y-6">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-6 border-b border-gray-50 pb-4 tracking-widest">Fiche Technique</h3>
                    
                    <div>
                        <label class="block text-[10px] font-black text-gray-300 uppercase mb-2">Service Nakayo lié</label>
                        <select name="id_service" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58] focus:ring-2 focus:ring-[#FF9F29]">
                            @foreach($services as $s)
                                <option value="{{ $s->id_service }}" {{ (isset($offre) && $offre->id_service == $s->id_service) ? 'selected' : '' }}>{{ $s->titre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-input label="Lieu" name="lieu" value="{{ $offre->lieu ?? '' }}" placeholder="Ex: Cotonou / En ligne" />
                    <x-input label="Coût (FCFA)" name="cout" type="number" value="{{ $offre->cout ?? '' }}" required />
                    <x-input label="Date Limite" name="date_formation" type="date" value="{{ isset($offre->date_formation) ? \Carbon\Carbon::parse($offre->date_formation)->format('Y-m-d') : '' }}" />
                    <x-input label="Contact Inscription" name="contact" value="{{ $offre->contact ?? '' }}" placeholder="Email ou Whatsapp" />
                    
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
                </div>

                <!-- <div class="bg-[#1B2E58] rounded-[2.5rem] p-10 text-white shadow-xl relative overflow-hidden group">
                    <h3 class="text-xs font-black uppercase tracking-widest mb-6 border-b border-white/10 pb-4">Conseil Admin</h3>
                    <p class="text-xs opacity-60 leading-relaxed italic relative z-10">Assurez-vous de lier la formation au bon pôle d'expertise pour une meilleure visibilité.</p>
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-[#FF9F29] opacity-10 rounded-full blur-3xl transition-all duration-1000 group-hover:scale-150"></div>
                </div> -->
            </div>
        </div>
    </form>
</div>
@endsection