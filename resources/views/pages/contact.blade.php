@extends('layouts.app')

@section('content')


 {{-- 1. HEADER (Déplacé à l'intérieur de la section pour la validité du fichier) --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky top-0 z-[100] w-full shadow-md">
            @include('components.navbar')
        </header>
    @endif

{{-- SECTION 1 : LA CARTE (TOP) --}}
<section class="w-full h-[400px] bg-gray-200">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15860.590509652131!2d2.417246!3d6.374945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x102355998a449d63%3A0x633512f451f49615!2sCotonou%2C%20Bénin!5e0!3m2!1sfr!2sbj!4v1711900000000!5m2!1sfr!2sbj" 
        width="100%" 
        height="100%" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy">
    </iframe>
</section>

{{-- SECTION 2 : TEXTE + FORMULAIRE (BOTTOM) --}}
<section class="py-16 md:py-24 bg-[#F8FAFC] font-sans">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            
            <!-- GAUCHE : TEXTE ET INFOS -->
            <div class="space-y-10">
                <h2 class="text-[#1B2E58] text-4xl md:text-5xl font-black leading-tight">
                    Vous avez une question, un besoin spécifique ou souhaitez en savoir plus sur nos services ?
                </h2>
                <p class="text-gray-500 text-lg leading-relaxed max-w-lg">
                    Notre équipe est à votre écoute et se fera un plaisir de vous accompagner dans toutes vos démarches.
                </p>

                <!-- Liste des contacts -->
                <div class="space-y-6 pt-6">
                    <div class="flex items-center gap-4 group">
                        <i class="fas fa-envelope text-[#FFB75E] text-xl"></i>
                        <p class="text-lg font-bold text-[#1B2E58]">
                            Contact: <span class="text-orange-500 font-medium">(229) 01061245741</span>
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fas fa-map-marker-alt text-[#FFB75E] text-xl"></i>
                        <p class="text-lg font-bold text-[#1B2E58]">
                            Emplacement: <span class="text-gray-500 font-medium">Littoral Cotonou - Bénin</span>
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fas fa-clock text-[#FFB75E] text-xl"></i>
                        <p class="text-lg font-bold text-[#1B2E58]">
                            Lun - Ven: <span class="text-gray-500 font-medium">7:30 am - 17:00</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- DROITE : LE FORMULAIRE -->
            <div class="bg-white p-8 md:p-12 rounded-3xl shadow-xl border border-gray-100">
                <h3 class="text-[#1B2E58] text-2xl font-bold mb-4">Envoyez-nous un Message</h3>
                <p class="text-gray-400 text-sm mb-8 leading-relaxed">
                    Veuillez remplir le formulaire ci-dessous pour une demande particulière, et nous vous recontacterons. Vous pouvez également nous appeler. 
                    <span class="text-[#1B2E58] font-bold border-b border-[#1B2E58]">+229 01161145741</span> et nos spécialistes vous apporteront l'aide nécessaire !
                </p>

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Nom</label>
                            <input type="text" placeholder="John" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1B2E58] focus:border-transparent outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Prénom</label>
                            <input type="text" placeholder="Doe" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1B2E58] focus:border-transparent outline-none transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Adresse Email</label>
                            <input type="email" placeholder="contact@email.com" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1B2E58] focus:border-transparent outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Phone</label>
                            <input type="text" placeholder="Numéro de téléphone" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1B2E58] focus:border-transparent outline-none transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Quel est l'objet de votre demande ?</label>
                        <select class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl outline-none appearance-none cursor-pointer">
                            <option>Crédit</option>
                            <option>Épargne</option>
                            <option>Conseil</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#1B2E58] uppercase mb-2">Comment pouvons-nous vous aider ?</label>
                        <textarea rows="4" placeholder="Votre Message" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl outline-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-[#1B2E58] text-white font-bold py-5 rounded-xl hover:bg-orange-500 transition-all shadow-lg flex items-center justify-center gap-3 group">
                        Soumettre La Demande
                        <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection