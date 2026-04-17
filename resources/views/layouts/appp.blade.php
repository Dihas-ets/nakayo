<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('favico.png') }}?v=1">

    <title>{{ $company->nom_agence ?? 'Nakayo' }} - @yield('title')</title>

    {{-- AJOUT : BOOTSTRAP (nécessaire pour ton site de projets) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { visibility: hidden; }
        #preloader { 
            visibility: visible !important; 
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800;900&family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- TRÈS IMPORTANT : Permet d'injecter le CSS de la page projet --}}
    @stack('styles')

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

    {{-- NAVBAR --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky-top shadow-sm bg-white" style="z-index: 1000;">
            @include('components.navbar')
        </header>
    @endif

    <main>
        @yield('content')
    </main>

    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        @include('components.footer')
    @endif

    {{-- SCRIPTS DE BASE --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('preloader');
            document.body.style.visibility = 'visible';
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
                // Initialisation forcée de AOS après le chargement
                if (typeof AOS !== 'undefined') {
                    AOS.init({ duration: 1000, once: true });
                }
            }, 500);
        });
    </script>

    {{-- TRÈS IMPORTANT : Permet d'injecter les scripts de la page projet --}}
    @stack('scripts')
</body>
</html>