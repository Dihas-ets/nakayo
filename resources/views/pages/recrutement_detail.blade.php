@extends('layouts.app')

@section('content')
<section class="py-24 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- Retour --}}
        <a href="{{ route('recrutement') }}" class="inline-flex items-center text-[#1B2E58] font-bold text-sm mb-8 hover:gap-2 transition-all">
            <i class="fas fa-arrow-left mr-2"></i> Voir toutes les offres
        </a>

        <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-gray-100">
            {{-- Header de l'offre --}}
            <div class="p-8 md:p-12 border-b border-gray-50 bg-[#1B2E58] text-white">
                <span class="bg-orange-400 text-white px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">
                    {{ $offre->type }}
                </span>
                <h1 class="text-3xl md:text-5xl font-black mt-4 mb-6 uppercase tracking-tight">
                    {{ $offre->nom }}
                </h1>
                <div class="flex flex-wrap gap-6 text-white/70 text-sm">
                    <span><i class="fas fa-map-marker-alt text-orange-400"></i> {{ $offre->lieu }}</span>
                    <span><i class="fas fa-building text-orange-400"></i> {{ $offre->agence }}</span>
                    <span class="text-orange-300 font-bold">
                        <i class="fas fa-calendar-alt"></i> Expire le : {{ \Carbon\Carbon::parse($offre->date_limite)->format('d/m/Y') }}
                    </span>
                </div>
            </div>

            {{-- Corps de l'offre --}}
            <div class="p-8 md:p-12">
                <div class="prose prose-lg max-w-none text-gray-600 mb-12">
                    <h4 class="text-[#1B2E58] font-black uppercase text-sm tracking-widest mb-4">Description du poste</h4>
                    <p class="leading-relaxed italic">
                        {!! nl2br(e($offre->description)) !!}
                    </p>
                </div>

                {{-- Section Postuler --}}
                <div class="bg-gray-50 rounded-3xl p-8 border border-dashed border-gray-300">
                    <h4 class="text-[#1B2E58] font-black text-center mb-6">Cette offre vous intéresse ?</h4>
                    
                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        {{-- Postuler par Email --}}
                        <a href="mailto:{{ $offre->email_whatsapp }}?subject=Candidature pour le poste : {{ $offre->nom }}" 
                           class="bg-orange-400 text-white px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-[#1B2E58] transition-all text-center shadow-lg">
                            Postuler par Email
                        </a>

                        {{-- Ou via WhatsApp si c'est un numéro --}}
                        @if(is_numeric($offre->email_whatsapp))
                        <a href="https://wa.me/{{ $offre->email_whatsapp }}" 
                           target="_blank"
                           class="bg-green-500 text-white px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-green-600 transition-all text-center shadow-lg">
                            Postuler via WhatsApp
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection