@extends('layouts.admin')

@section('title', 'Infos Entreprise')

@section('content')
<div class="max-w-5xl mx-auto space-y-8 pb-10">
    
    <div>
        <h2 class="text-3xl font-black text-[#1B2E58]">Configuration Nakayo</h2>
        <p class="text-gray-500 font-medium">Gérez l'identité visuelle, légale et les coordonnées de l'entreprise.</p>
    </div>

    {{-- Alertes Erreurs / Succès --}}
    @if ($errors->any())
        <div class="bg-red-500 text-white p-5 rounded-2xl mb-8 shadow-xl flex items-start gap-3">
            <i class="fa-solid fa-triangle-exclamation text-2xl mt-1"></i>
            <div>
                <span class="font-bold block mb-1">Attention, certaines données sont incorrectes :</span>
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-500 text-white p-5 rounded-2xl mb-8 shadow-xl flex items-center gap-3 animate-pulse">
            <i class="fa-solid fa-circle-check text-2xl"></i>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- IDENTITÉ VISUELLE --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6 md:col-span-2">
                <div class="flex items-center gap-3 mb-4 text-[#1B2E58]">
                    <i class="fa-solid fa-palette text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest">Identité Visuelle</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black uppercase opacity-60">Logo Principal</label>
                        @if($settings->logo)
                            <div class="mb-2 p-3 bg-gray-50 rounded-xl border border-dashed flex justify-center">
                                <img src="{{ asset('storage/' . $settings->logo) }}" class="h-16 object-contain">
                            </div>
                        @endif
                        <input type="file" name="logo" class="text-xs w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[10px] font-black uppercase opacity-60">Logo sans fond (PNG)</label>
                        @if($settings->logo_sans_fond)
                            <div class="mb-2 p-3 bg-[#1B2E58] rounded-xl flex justify-center shadow-inner">
                                <img src="{{ asset('storage/' . $settings->logo_sans_fond) }}" class="h-16 object-contain">
                            </div>
                        @endif
                        <input type="file" name="logo_sans_fond" class="text-xs w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[10px] font-black uppercase opacity-60">Favicon (Onglet)</label>
                        @if($settings->favicon)
                            <div class="mb-2 p-3 bg-gray-50 rounded-xl border border-dashed flex justify-center">
                                <img src="{{ asset('storage/' . $settings->favicon) }}" class="w-8 h-8 object-contain shadow-sm">
                            </div>
                        @endif
                        <input type="file" name="favicon" class="text-xs w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        <p class="text-[9px] text-gray-400 italic">Format carré (32x32px recommandé)</p>
                    </div>
                </div>
            </div>

            {{-- IDENTITÉ & FISCALITÉ --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6">
                <div class="flex items-center gap-3 mb-4 text-[#1B2E58]">
                    <i class="fa-solid fa-id-card text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest">Identité & Fiscalité</h3>
                </div>
                <x-input label="Nom de l'agence / Siège" name="nom_agence" :value="$settings->nom_agence" />
                <div class="grid grid-cols-2 gap-4">
                    <x-input label="Statut Juridique" name="statut_juridique" :value="$settings->statut_juridique" placeholder="Ex: SARL" />
                    
                </div>
                <x-input label="Numéro IFU" name="ifu" :value="$settings->ifu" />
                <x-input label="Numéro RCCM" name="numero_rccm" :value="$settings->numero_rccm" />
            </div>

            {{-- CONTACTS DIRECTS --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6">
                <div class="flex items-center gap-3 mb-4 text-[#1B2E58]">
                    <i class="fa-solid fa-phone-volume text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest">Contacts directs</h3>
                </div>
                <x-input label="Email de contact" name="email" type="email" :value="$settings->email" />
                <x-input label="Téléphone (Appels)" name="telephone_appel" :value="$settings->telephone_appel" />
                <x-input label="Numéro WhatsApp" name="telephone_whatsapp" :value="$settings->telephone_whatsapp" />
            </div>

            {{-- SECTION LOCALISATION & MAPS (NOUVEAU) --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6 md:col-span-2">
                <div class="flex items-center gap-3 mb-4 text-[#1B2E58]">
                    <i class="fa-solid fa-map-location-dot text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest">Localisation & Itinéraire</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input label="Adresse physique détaillée" name="localisation" :value="$settings->localisation" placeholder="Ex: Zogbo Yénawa Lot 1887..." />
                    <div>
                        <x-input label="Lien Google Maps (Iframe ou URL)" name="google_maps_link" :value="$settings->google_maps_link" placeholder="Zogbo Yénawa Lot 1887  “G” Maison AMOUSSOU Benoit" />
                        <p class="text-[9px] text-gray-400 mt-1 italic leading-tight">Collez ici le lien d'intégration (iframe) ou l'URL de partage de votre position Google Maps.</p>
                    </div>
                </div>
            </div>

            {{-- DESCRIPTION FOOTER --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-4 md:col-span-2">
                <div class="flex items-center gap-3 mb-2 text-[#1B2E58]">
                    <i class="fa-solid fa-quote-left text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest">Description Footer</h3>
                </div>
                <label class="block text-[10px] font-black uppercase opacity-60 ml-1">Présentation courte de l'entreprise</label>
                <textarea name="description_footer" rows="4" 
                    class="w-full border-gray-200 rounded-3xl p-5 focus:ring-[#FF9F29] focus:border-[#FF9F29] text-gray-700 shadow-inner bg-gray-50/50" 
                    placeholder="Écrivez ici le texte qui apparaîtra en bas de page...">{{ old('description_footer', $settings->description_footer) }}</textarea>
            </div>

            {{-- HORAIRES --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6 md:col-span-2">
                <div class="flex items-center gap-3 mb-4 text-[#1B2E58]">
                    <i class="fa-solid fa-clock text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest">Horaires & Disponibilité</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-input label="Jours d'ouverture" name="jours_ouverture" :value="$settings->jours_ouverture" placeholder="Ex: Lundi au Vendredi" />
                    <x-input label="Horaires d'ouverture" name="horaires_ouverture" :value="$settings->horaires_ouverture" placeholder="Ex: 08h - 19h" />
                    <x-input label="Texte Disponibilité" name="availability_hours" :value="$settings->availability_hours" />
                </div>
            </div>

            {{-- PRÉSENCE DIGITALE --}}
            <div class="bg-[#1B2E58] p-10 rounded-[2.5rem] shadow-xl space-y-8 md:col-span-2 text-white">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fa-solid fa-share-nodes text-xl text-[#FF9F29]"></i>
                    <h3 class="font-black uppercase text-sm tracking-widest text-white">Présence digitale</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 opacity-60">Facebook</label>
                        <input type="text" name="facebook_link" value="{{ $settings->facebook_link }}" class="w-full bg-white/10 border-none rounded-xl px-4 py-3 text-sm text-white focus:ring-2 focus:ring-[#FF9F29]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 opacity-60">Instagram</label>
                        <input type="text" name="instagram_link" value="{{ $settings->instagram_link }}" class="w-full bg-white/10 border-none rounded-xl px-4 py-3 text-sm text-white focus:ring-2 focus:ring-[#FF9F29]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 opacity-60">LinkedIn</label>
                        <input type="text" name="linkedin_link" value="{{ $settings->linkedin_link }}" class="w-full bg-white/10 border-none rounded-xl px-4 py-3 text-sm text-white focus:ring-2 focus:ring-[#FF9F29]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-2 opacity-60">TikTok</label>
                        <input type="text" name="tiktok_link" value="{{ $settings->tiktok_link }}" class="w-full bg-white/10 border-none rounded-xl px-4 py-3 text-sm text-white focus:ring-2 focus:ring-[#FF9F29]">
                    </div>
                </div>
            </div>
        </div>

        {{-- BOUTON SOUMISSION --}}
        <div class="flex justify-center pt-12">
            <button type="submit" class="group relative bg-[#FF9F29] hover:bg-[#1B2E58] text-white px-16 py-5 rounded-[2.5rem] font-black text-xl shadow-2xl shadow-orange-200 transition-all duration-300 transform active:scale-95">
                <span class="flex items-center gap-3">
                    <i class="fa-solid fa-floppy-disk"></i>
                    METTRE À JOUR LA CONFIGURATION
                </span>
            </button>
        </div>
    </form>
</div>
@endsection