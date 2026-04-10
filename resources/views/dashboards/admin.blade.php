@extends('layouts.admin')

@section('title', 'Vue d\'ensemble')

@section('content')
<div class="space-y-10">
    
    <!-- 1. HEADER : Accueil personnalisé -->
    <div class="relative overflow-hidden bg-[#1B2E58] rounded-[2.5rem] p-8 md:p-12 text-white shadow-xl">
        <div class="relative z-10">
            <h1 class="text-3xl md:text-5xl font-black tracking-tight">
                Bonjour, <span class="text-white">{{ Auth::user()->nom_complet }}</span> 👋
            </h1>
            <p class="text-blue-100/70 mt-3 font-medium max-w-xl text-lg">
                Ravi de vous revoir. Voici l'état actuel de <span class="font-bold text-white">NAKAYO CORPORATION</span> en temps réel.
            </p>
            
            <div class="flex flex-wrap gap-4 mt-8">
                <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10 text-sm">
                    <span class="opacity-60">Rôle :</span> <span class="font-bold uppercase text-[#FF9F29]">{{ Auth::user()->role }}</span>
                </div>
                <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10 text-sm">
                    <i class="fa-solid fa-calendar-day mr-2 opacity-60"></i>
                    <span class="font-bold">{{ now()->translatedFormat('d F Y') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Décoration abstraite en fond -->
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-[#FF9F29] opacity-10 rounded-full blur-3xl"></div>
    </div>

    <!-- 2. SECTION : Chiffres clés (Top 4) -->
    <div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-black text-[#1B2E58] uppercase tracking-tighter italic">Statistiques Principales</h2>
            <div class="h-1 w-20 bg-[#FF9F29] rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-stat-card title="Articles" value="{{ $stats['articles'] }}" icon="fa-solid fa-newspaper" color="blue" />
            <x-stat-card title="Produits" value="{{ $stats['produits'] }}" icon="fa-solid fa-box-open" color="blue" />
            <x-stat-card title="Clients" value="{{ $stats['clients'] }}" icon="fa-solid fa-users" color="green" />
            <x-stat-card title="Services" value="{{ $stats['services'] }}" icon="fa-solid fa-briefcase" color="blue" />
        </div>
    </div>

    <!-- 3. SECTION : Contenu & Engagements -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Col gauche : Les autres stats -->
        <div class="lg:col-span-3">
            <div class="justify-center">
                <h2 class="text-xl font-black text-[#1B2E58] uppercase tracking-tighter italic"> Activité</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-stat-card title="Formations" value="{{ $stats['formations'] }}" icon="fa-solid fa-graduation-cap" color="orange" />
                {{-- Carte Recrutements liée --}}
                <a href="{{ route('admin.recrutements.index') }}" class="block transform transition hover:scale-105">
                    <x-stat-card 
                        title="Offres d'Emploi" 
                        value="{{ $stats['recrutements'] }}" 
                        icon="fa-solid fa-user-tie" 
                        color="orange" 
                    />
                </a>



                <a href="{{ route('admin.recrutements.index') }}" class="block transform transition hover:scale-105">
                    <x-stat-card 
                        title="Offres d'Emploi" 
                        value="{{ $stats['recrutements'] }}" 
                        icon="fa-solid fa-user-tie" 
                        color="orange" 
                    />
                </a>
                
                
            </div>
        </div>

      

    </div>
@endsection