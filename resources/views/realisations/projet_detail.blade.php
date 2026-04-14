@extends('layouts.app')

@section('content')
<section class="py-24 bg-white">
    <div class="max-w-5xl mx-auto px-6">
        <a href="{{ route('projets') }}" class="text-[#1B2E58] font-bold uppercase text-xs tracking-widest mb-8 inline-block">← Retour aux projets</a>
        
        <div class="rounded-[3rem] overflow-hidden mb-12 shadow-2xl">
            <img src="{{ asset('storage/' . $projet->image) }}" class="w-full h-[500px] object-cover">
        </div>

        <span class="text-[#FF9F29] font-black uppercase tracking-[4px] text-sm">{{ $projet->service_nom }}</span>
        <h1 class="text-5xl font-black text-[#1B2E58] mt-4 mb-8 uppercase">{{ $projet->nom }}</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 py-8 border-y border-gray-100">
            <div>
                <span class="block text-gray-400 text-xs uppercase font-bold mb-1">Localisation</span>
                <span class="text-[#1B2E58] font-bold">{{ $projet->lieu }}</span>
            </div>
            <div>
                <span class="block text-gray-400 text-xs uppercase font-bold mb-1">Date</span>
                <span class="text-[#1B2E58] font-bold">{{ $projet->date_realisation }}</span>
            </div>
            <div>
                <span class="block text-gray-400 text-xs uppercase font-bold mb-1">Client</span>
                <span class="text-[#1B2E58] font-bold">{{ $projet->client ?? 'Privé' }}</span>
            </div>
        </div>

        <div class="prose prose-xl max-w-none text-gray-600 italic">
            {!! nl2br(e($projet->description)) !!}
        </div>
    </div>
</section>
@endsection