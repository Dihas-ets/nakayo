@extends('layouts.admin')
@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    
    <!-- BLOC DE DEBUG / ALERTES -->
    <div class="space-y-4">
        {{-- Affichage des erreurs de validation (Si Laravel bloque le formulaire) --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-5 rounded-2xl shadow-sm">
                <div class="flex items-center gap-3 mb-2 text-red-800">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span class="font-black uppercase text-xs tracking-widest">Erreurs de validation</span>
                </div>
                <ul class="list-disc pl-5 text-red-600 text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Message de succès si la redirection se fait --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-5 rounded-2xl shadow-sm text-green-800 flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-xl"></i>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif
    </div>

    <div class="flex items-center gap-4">
        <a href="{{ route('admin.team.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-[#1B2E58] hover:bg-[#FF9F29] hover:text-white transition-all">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h2 class="text-3xl font-black text-[#1B2E58] uppercase italic">Nouveau Collaborateur</h2>
    </div>

    <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
        {{-- Vérifie bien que l'action pointe vers la bonne route --}}
        <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 ml-4">Nom Complet</label>
                    <input type="text" name="nom_complet" value="{{ old('nom_complet') }}" required class="w-full px-8 py-5 rounded-[2rem] bg-gray-50 border-none focus:ring-2 focus:ring-[#FF9F29] font-bold text-[#1B2E58]">
                </div>
                
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 ml-4">Poste / Fonction</label>
                    <input type="text" name="poste" value="{{ old('poste') }}" required class="w-full px-8 py-5 rounded-[2rem] bg-gray-50 border-none focus:ring-2 focus:ring-[#FF9F29] font-bold text-[#1B2E58]">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 ml-4">Lien LinkedIn</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin') }}" class="w-full px-8 py-5 rounded-[2rem] bg-gray-50 border-none focus:ring-2 focus:ring-[#FF9F29] font-bold text-[#1B2E58]">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 ml-4">Ordre d'affichage</label>
                    <input type="number" name="ordre" value="{{ old('ordre', 0) }}" class="w-full px-8 py-5 rounded-[2rem] bg-gray-50 border-none focus:ring-2 focus:ring-[#FF9F29] font-bold text-[#1B2E58]">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-[#1B2E58] opacity-50 ml-4">Photo de Portrait</label>
                <input type="file" name="photo" required class="w-full px-8 py-5 rounded-[2rem] bg-gray-50 border-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-[#1B2E58] file:text-white hover:file:bg-[#FF9F29]">
            </div>

            <div class="pt-8 flex justify-end">
                <button type="submit" class="bg-[#FF9F29] text-white px-12 py-5 rounded-[2rem] font-black uppercase tracking-widest shadow-lg hover:bg-[#1B2E58] transition-all">
                    Enregistrer le profil
                </button>
            </div>
        </form>
    </div>

    {{-- DEBUG ZONE : Pour voir ce qui est envoyé en temps réel (Visible uniquement en dev) --}}
    @env('local')
    <div class="mt-20 p-6 bg-black text-green-400 rounded-3xl font-mono text-xs overflow-auto">
        <p class="mb-4 text-white uppercase font-bold border-b border-white/20 pb-2">Console de Debug :</p>
        <p>URL Actuelle : {{ request()->url() }}</p>
        <p>Méthode : {{ request()->method() }}</p>
        <p>Champs envoyés au dernier essai :</p>
        <pre class="mt-2 text-blue-300">{{ json_encode(old(), JSON_PRETTY_PRINT) }}</pre>
    </div>
    @endenv

</div>
@endsection