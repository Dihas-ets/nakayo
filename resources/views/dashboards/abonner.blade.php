@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] bg-gray-50 py-16 px-6">
    <div class="max-w-5xl mx-auto">
        
        <div class="bg-white rounded-[3rem] shadow-xl overflow-hidden border border-gray-100">
            <!-- Header Dashboard Client -->
            <div class="bg-[#FFB75E] p-12 text-[#1B2E58]">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-4xl font-black uppercase italic tracking-tighter">Mon Espace Client</h1>
                        <p class="text-lg font-bold opacity-80 mt-2">Heureux de vous revoir, {{ Auth::user()->nom_complet }} !</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-[#1B2E58] text-white px-8 py-3 rounded-2xl font-black uppercase text-xs tracking-widest hover:scale-105 transition-all">Quitter</button>
                    </form>
                </div>
            </div>

            <!-- Contenu -->
            <div class="p-12 grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Info Profil -->
                <div class="space-y-6">
                    <h3 class="text-xl font-black text-[#1B2E58] uppercase">Mes Informations</h3>
                    <div class="bg-gray-50 p-6 rounded-2xl space-y-4">
                        <p class="text-sm text-gray-500 font-bold uppercase tracking-widest">Email : <span class="text-[#1B2E58] normal-case ml-2">{{ Auth::user()->email }}</span></p>
                        <p class="text-sm text-gray-500 font-bold uppercase tracking-widest">Téléphone : <span class="text-[#1B2E58] ml-2">{{ Auth::user()->telephone }}</span></p>
                        <p class="text-sm text-gray-500 font-bold uppercase tracking-widest">Membre depuis : <span class="text-[#1B2E58] ml-2">{{ Auth::user()->created_at->format('d/m/Y') }}</span></p>
                    </div>
                </div>

                <!-- Actions Client -->
                <div class="space-y-6">
                    <h3 class="text-xl font-black text-[#1B2E58] uppercase">Services Rapides</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <a href="#" class="flex items-center justify-between p-5 bg-gray-50 rounded-2xl hover:bg-[#FFB75E]/10 border border-transparent hover:border-[#FFB75E] transition-all group">
                            <span class="font-bold text-[#1B2E58]">Demander un crédit</span>
                            <i class="fas fa-chevron-right text-[#FFB75E]"></i>
                        </a>
                        <a href="#" class="flex items-center justify-between p-5 bg-gray-50 rounded-2xl hover:bg-[#FFB75E]/10 border border-transparent hover:border-[#FFB75E] transition-all group">
                            <span class="font-bold text-[#1B2E58]">Consulter mes épargnes</span>
                            <i class="fas fa-chevron-right text-[#FFB75E]"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection