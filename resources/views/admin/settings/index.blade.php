@extends('layouts.admin')

@section('title', 'Infos Entreprise')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">
    
    <div>
        <h2 class="text-3xl font-black text-[#1B2E58]">Configuration Nakayo</h2>
        <p class="text-gray-500 font-medium">Gérez l'identité et les coordonnées publiques de l'entreprise.</p>
    </div>

    @if(session('success'))
        <div class="bg-[#FF9F29] text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center gap-3 animate-bounce">
            <i class="fa-solid fa-building-circle-check text-2xl"></i>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- SECTION 1 : IDENTITÉ -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6">
                <div class="flex items-center gap-3 mb-4 text-[#1B2E58]">
                    <i class="fa-solid fa-id-card text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest">Identité & Fiscalité</h3>
                </div>
                <x-input label="Nom de l'agence / Siège" name="nom_agence" :value="$settings->nom_agence" />
                <x-input label="Numéro IFU" name="ifu" :value="$settings->ifu" />
                <x-input label="Heures de disponibilité" name="availability_hours" :value="$settings->availability_hours" placeholder="Ex: Lun - Ven : 08h00 - 18h00" />
            </div>

            <!-- SECTION 2 : CONTACTS -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6">
                <div class="flex items-center gap-3 mb-4 text-[#1B2E58]">
                    <i class="fa-solid fa-phone-volume text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest">Contacts directs</h3>
                </div>
                <x-input label="Email de contact" name="email" type="email" :value="$settings->email" />
                <x-input label="Téléphone (Appels)" name="telephone_appel" :value="$settings->telephone_appel" />
                <x-input label="Numéro WhatsApp" name="telephone_whatsapp" :value="$settings->telephone_whatsapp" />
            </div>

            <!-- SECTION 3 : LOCALISATION -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6 md:col-span-2">
                <div class="flex items-center gap-3 mb-4 text-[#1B2E58]">
                    <i class="fa-solid fa-map-location-dot text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest">Localisation géographique</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input label="Adresse physique" name="localisation" :value="$settings->localisation" placeholder="Cotonou, quartier..." />
                    <x-input label="Lien Google Maps (Embed/URL)" name="google_maps_link" :value="$settings->google_maps_link" />
                </div>
            </div>

            <!-- SECTION 4 : RÉSEAUX SOCIAUX -->
            <div class="bg-[#1B2E58] p-10 rounded-[2.5rem] shadow-xl space-y-6 md:col-span-2 text-white">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fa-solid fa-share-nodes text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest">Présence digitale (Liens)</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 opacity-60">Facebook</label>
                        <input type="text" name="facebook_link" value="{{ $settings->facebook_link }}" class="w-full bg-white/10 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#FF9F29]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 opacity-60">Instagram</label>
                        <input type="text" name="instagram_link" value="{{ $settings->instagram_link }}" class="w-full bg-white/10 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#FF9F29]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 opacity-60">LinkedIn</label>
                        <input type="text" name="linkedin_link" value="{{ $settings->linkedin_link }}" class="w-full bg-white/10 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#FF9F29]">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center pt-10">
            <button type="submit" class="bg-[#FF9F29] hover:bg-[#e88f24] text-white px-12 py-4 rounded-[2rem] font-black text-lg shadow-xl shadow-orange-200 transition-all active:scale-95">
                ENREGISTRER TOUTES LES INFOS
            </button>
        </div>
    </form>
</div>
@endsection