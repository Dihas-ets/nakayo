@extends('layouts.app')

@section('title', 'Détails de l\'offre')

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
                <div class="bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-xl text-center">
                    <h4 class="text-[#1B2E58] text-xl font-black uppercase tracking-tighter mb-2">Prêt à nous rejoindre ?</h4>
                    <p class="text-gray-500 text-sm mb-8 font-medium">Cliquez sur le bouton ci-dessous pour envoyer votre candidature directement via WhatsApp.</p>
                    
                    <div class="flex justify-center">
                        @php
                            // Nettoyage du numéro (enlève les espaces, +, etc.)
                            $whatsappNum = preg_replace('/[^0-9]/', '', $offre->email_whatsapp);
                            // Message pré-rempli pour le recruteur
                            $text = "Bonjour, je souhaite postuler à l'offre : " . $offre->nom;
                        @endphp

                        <a href="https://wa.me/{{ $whatsappNum }}?text={{ urlencode($text) }}" 
                        target="_blank"
                        class="inline-flex items-center gap-4 bg-[#1B2E58] text-white px-12 py-5 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-[#128C7E] transition-all shadow-2xl shadow-green-100">
                            <i class="fa-brands fa-whatsapp text-2xl"></i>
                            Postuler via WhatsApp
                        </a>
                    </div>

                    <p class="mt-6 text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                        Réponse rapide garantie
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection