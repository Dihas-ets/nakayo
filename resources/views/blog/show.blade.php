@extends('layouts.app')

@section('content')
<section class="py-14 bg-white">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">

        <!-- TITRE -->
        <div class="mb-10">
            <a href="{{ route('blog.index') }}" class="text-[#FF9F29] font-bold text-sm uppercase">
                ← Retour au blog
            </a>

            <h1 class="text-3xl lg:text-5xl font-black text-[#1B2E58] mt-4 leading-tight">
                {{ $article->titre }}
            </h1>

            <div class="flex items-center gap-4 mt-4 text-gray-500 text-sm">
                <span class="bg-[#FF9F29] text-[#1B2E58] px-4 py-1 rounded-full font-bold text-[11px] uppercase tracking-widest">
                    {{ $article->category_name ?? 'Catégorie' }}
                </span>

                <span>
                    {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}
                </span>
            </div>
        </div>

        <!-- IMAGE -->
        <div class="overflow-hidden rounded-[2rem] shadow-lg mb-10">
            <img src="{{ asset('storage/' . $article->media) }}"
                 alt="{{ $article->titre }}"
                 class="w-full h-[450px] object-cover">
        </div>

        <!-- CONTENU -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <!-- TEXTE -->
            <div class="lg:col-span-8">
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! $article->description !!}
                </div>
            </div>

            <!-- SIDEBAR -->
            <div class="lg:col-span-4">
                <div class="sticky top-24 bg-gray-50 rounded-3xl p-6 shadow-sm border border-gray-100">

                    <h3 class="text-[#1B2E58] font-black uppercase tracking-widest text-sm mb-6">
                        Articles récents
                    </h3>

                    <div class="space-y-5">
                        @foreach($recentArticles as $item)
                            <a href="{{ route('blog.show', $item->slug) }}" class="flex gap-4 group">
                                <div class="w-20 h-16 overflow-hidden rounded-xl flex-shrink-0">
                                    <img src="{{ asset('storage/' . $item->media) }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         alt="{{ $item->titre }}">
                                </div>

                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-[#1B2E58] group-hover:text-[#FF9F29] transition-colors line-clamp-2">
                                        {{ $item->titre }}
                                    </h4>

                                    <p class="text-gray-400 text-[10px] uppercase font-bold mt-1">
                                        {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
@endsection