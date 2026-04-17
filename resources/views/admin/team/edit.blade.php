@extends('layouts.admin')
@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.team.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-[#1B2E58] hover:bg-[#FF9F29] hover:text-white transition-all">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h2 class="text-3xl font-black text-[#1B2E58] uppercase italic">Modifier Profil</h2>
    </div>

    <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Preview Photo Actuelle -->
        <div class="text-center space-y-4">
            <p class="text-[10px] font-black uppercase opacity-50">Photo actuelle</p>
            <div class="w-full aspect-square rounded-[2rem] overflow-hidden border-4 border-gray-50 shadow-inner">
                <img src="{{ url('storage/' . $membre->photo) }}" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Formulaire -->
        <div class="lg:col-span-2">
            <form action="{{ route('admin.team.update', $membre->id_membre) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')
                
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase opacity-50 ml-4">Nom Complet</label>
                    <input type="text" name="nom_complet" value="{{ $membre->nom_complet }}" required class="w-full px-8 py-4 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FF9F29] font-bold text-[#1B2E58]">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase opacity-50 ml-4">Poste</label>
                    <input type="text" name="poste" value="{{ $membre->poste }}" required class="w-full px-8 py-4 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FF9F29] font-bold text-[#1B2E58]">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase opacity-50 ml-4">LinkedIn</label>
                        <input type="url" name="linkedin" value="{{ $membre->linkedin }}" class="w-full px-8 py-4 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FF9F29] font-bold text-[#1B2E58]">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase opacity-50 ml-4">Ordre</label>
                        <input type="number" name="ordre" value="{{ $membre->ordre }}" class="w-full px-8 py-4 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FF9F29] font-bold text-[#1B2E58]">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase opacity-50 ml-4">Remplacer la photo (optionnel)</label>
                    <input type="file" name="photo" class="w-full px-8 py-4 rounded-2xl bg-gray-50 border-none">
                </div>

                <div class="pt-8">
                    <button type="submit" class="w-full bg-[#1B2E58] text-white py-5 rounded-2xl font-black uppercase tracking-widest shadow-lg hover:bg-[#FF9F29] transition-all">
                        Mettre à jour le collaborateur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection