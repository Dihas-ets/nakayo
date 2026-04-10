<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Access Finance Benin') }}</title>
    
   @vite(['resources/css/app.css', 'resources/js/app.js'])


<!-- Google Fonts : Poppins et Montserrat -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800;900&family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">   


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />


<style>
    body { font-family: 'Montserrat', sans-serif; }
</style>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen flex flex-col">
   
<main class=" pt-[0px] lg:pt-[0px]">
    @yield('content')
</main>

<!-- 3. FOOTER (EN BAS) -->
@if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
    @include('components.footer')
@endif

</body>
</html>