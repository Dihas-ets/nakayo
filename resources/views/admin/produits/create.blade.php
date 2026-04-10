@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <form action="{{ route('admin.produits.store') }}" method="POST" enctype="multipart/form-data">
        @csrf


        @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded-2xl mb-6 shadow-lg font-bold">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.produits.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1B2E58] transition-all"><i class="fa-solid fa-arrow-left"></i></a>
                <h2 class="text-3xl font-black text-[#1B2E58]">Ajouter un Produit</h2>
            </div>
            <button type="submit" class="bg-[#1B2E58] text-white px-10 py-3.5 rounded-2xl font-black shadow-xl hover:bg-[#00261C]">ENREGISTRER LE PRODUIT</button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- GAUCHE : DESCRIPTION --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100">
                    <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Nom / Désignation</label>
                    <input type="text" name="nom" placeholder="Ex: Kit Panneau Solaire Premium..." class="w-full text-3xl font-black text-[#1B2E58] border-none focus:ring-0 p-0 mb-8 placeholder:text-gray-100" required>

                    <label class="block text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Fiche Descriptive</label>
                    <textarea name="description" rows="12" class="w-full border-2 border-gray-50 rounded-[2rem] p-6 text-gray-500 font-medium focus:border-[#FF9F29] outline-none" placeholder="Décrivez les caractéristiques techniques..."></textarea>
                </div>
            </div>

            {{-- DROITE : SIDEBAR --}}
            <div class="space-y-6">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 space-y-6">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-6 border-b pb-4">Configuration</h3>
                    
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Service Nakayo rattaché</label>
                        <select name="id_service" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58]" required>
                            @foreach(\App\Models\Service::all() as $s) <option value="{{ $s->id_service }}">{{ $s->titre }}</option> @endforeach
                        </select>
                    </div>

                    <x-input label="Prix Public (FCFA)" name="prix" type="number"  />
                    
                    <div>
                        <label class="block text-[10px] font-black text-gray-300 uppercase mb-2">Statut Stock</label>
                        <select name="statut" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 font-bold text-[#1B2E58]">
                            <option value="disponible">disponible</option>
                            <option value="en_rupture">non disponible</option>
                        </select>
                    </div>

                    <x-input label="Contact commande" name="contact" placeholder="+229..." />
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 text-center">
                    <h3 class="text-xs font-black uppercase text-[#1B2E58] mb-6 text-left">Photo du produit</h3>
                    <input type="file" name="image" class="w-full text-xs">
                </div>
            </div>
        </div>
    </form>
</div>
@endsection