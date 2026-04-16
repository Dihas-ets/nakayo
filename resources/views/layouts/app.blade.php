<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- @if(isset($company) && $company->favicon)
    {{-- On ajoute un paramètre de version aléatoire pour forcer le rechargement --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $company->favicon) }}?v={{ time() }}">
@else -->
    <link rel="icon" type="image/png" href="{{ asset('favico.png') }}?v=1">
    <link rel="shortcut icon" href="{{ asset('favico.png') }}?v=1">
<!-- @endif -->

    <title>{{ $company->nom_agence ?? 'Nakayo' }} - @yield('title')</title>

    
    

    <style>
        /* On masque tout le corps par défaut avant le chargement */
        body { visibility: hidden; }
        
        /* On s'assure que le loader est visible dès le départ */
        #preloader { 
            visibility: visible !important; 
            opacity: 1;
            transition: opacity 1s ease-out;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


       <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800;900&family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" href="/build/assets/app.css" as="style">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen flex flex-col">

    <div id="preloader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-[#1B2E58]">
        <div class="flex flex-col items-center text-center">
            
            <img src="{{ asset('images/logo2.png') }}" alt="NAKAYO CORPORATION" class="w-100 h-auto">
            
            <h3 class="text-white font-medium text-xl tracking-wider animate-pulse">
                Bienvenue chez NAKAYO CORPORATION
            </h3>
        </div>
    </div>

    <main class="pt-[0px] lg:pt-[0px]">
        @yield('content')
    </main>

    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        @include('components.footer')
    @endif

    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('preloader');
            
            // Rendre le contenu visible
            document.body.style.visibility = 'visible';
            
            // Masquer le loader avec fondu
            loader.style.opacity = '0';
            
            // Retrait définitif du DOM après transition
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        });
    </script>
</body>
</html>