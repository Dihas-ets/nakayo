@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <form action="{{ route('admin.projets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.projets.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] shadow-sm"><i class="fa-solid fa-arrow-left"></i></a>
                <h2 class="text-3xl font-black text-[#1B2E58]">Nouveau Projet</h2>
            </div>
            <button type="submit" class="bg-[#1B2E58] text-white px-10 py-3.5 rounded-2xl font-black shadow-xl hover:bg-[#00261C]">PUBLIER LE PROJET</button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100">
                    <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Désignation du projet</label>
                    <input type="text" name="nom" placeholder="Ex: Centrale Solaire d'Abomey-Calavi..." class="w-full text-3xl font-black text-[#1B2E58] border-none focus:ring-0 p-0 mb-8" required>

                    <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Description des travaux</label>
                    <textarea name="description" rows="12" class="w-full border-2 border-gray-50 rounded-[2rem] p-6 text-gray-500 font-medium focus:border-[#FF9F29] outline-none" placeholder="Décrivez les détails de la réalisation..."></textarea>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 space-y-6">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-6 border-b border-gray-50 pb-4">Détails Techniques</h3>
                    
                    <div>
                        <label class="block text-[10px] font-black text-gray-300 uppercase mb-2">Expertise associée</label>
                        <select name="id_service" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58]" required>
                            @foreach(\App\Models\Service::all() as $s) <option value="{{ $s->id_service }}">{{ $s->titre }}</option> @endforeach
                        </select>
                    </div>

                    <x-input label="Lieu de réalisation" name="lieu" placeholder="Ville ou Quartier" required />
                    <x-input label="Nom du Client" name="client" placeholder="Entreprise ou Particulier" />
                    <x-input label="Date de fin" name="date_realisation" type="date" />
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 text-center">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-6 text-left">Visuel principal</h3>
                    <input type="file" name="image" class="w-full text-xs">
                </div>
            </div>
        </div>
    </form>
</div>
@endsection