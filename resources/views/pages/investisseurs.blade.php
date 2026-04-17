@extends('layouts.appp')

@section('title', 'Opportunités d\'Investissement')

@section('content')

    <!-- HERO SECTION -->
    <section class="hero-invest">
        <div class="container text-center text-white">
            <h1 class="display-3 fw-bold mb-4" data-aos="fade-down">
                Bâtissons ensemble <span style="color: #FF8C00;">l'économie de demain</span>
            </h1>
            <p class="lead mb-5" data-aos="fade-up" data-aos-delay="200">
                Découvrez des projets à haut potentiel et participez à une aventure entrepreneuriale unique.
            </p>
            <div data-aos="zoom-in" data-aos-delay="400">
                <a href="#projets" class="btn btn-orange btn-lg me-3 rounded-pill px-4">Voir les Projets</a>
                <a href="#" class="btn btn-outline-light btn-lg rounded-pill px-4">Nous Contacter</a>
            </div>
        </div>
    </section>

    <!-- SECTION PROJETS -->
    <section id="projets" class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-title" data-aos="fade-up">Secteurs d'Investissement</h2>
                <p class="text-muted">Sélectionnez un domaine pour découvrir nos opportunités</p>
            </div>

            <div class="row g-4">
                <!-- 1. Immobilier -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="card project-card text-center">
                        <div class="project-img" style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=500');"></div>
                        <div class="card-body">
                            <i class="fa-solid fa-city card-icon"></i>
                            <h4>Immobilier</h4>
                            <p class="text-muted small">construction d'une cité moderne à tori.Investissement minimum de 2.000.000 sur 5ans.</p>
                            <span class="badge-invest">Rentabilité : 12-15%</span>
                            <div class="mt-3"><a href="#" class="btn btn-sm btn-outline-primary rounded-pill">En savoir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- 2. Transport -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card project-card text-center">
                        <div class="project-img" style="background-image: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=500');"></div>
                        <div class="card-body">
                            <i class="fa-solid fa-truck-fast card-icon"></i>
                            <h4>Logistique</h4>
                            <p class="text-muted small">Aquisition de 2 bus pour le trajet Cotonou-Abidjan Abidjan et Cotonou-Nord tanguiéta.Des bus avec deux toilettes pour éviter lles arrets unitiles,sigges Espaces et serie,charge telephone.</p>
                            <span class="badge-invest">Croissance : +20%</span>
                            <div class="mt-3"><a href="#" class="btn btn-sm btn-outline-primary rounded-pill">En savoir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- 3. Piscine -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card project-card text-center">
                        <div class="project-img" style="background-image: url('https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?w=500');"></div>
                        <div class="card-body">
                            <i class="fa-solid fa-person-swimming card-icon"></i>
                            <h4>Piscines de Luxe</h4>
                            <p class="text-muted small">Mise en place d'une unité de conception et de fabrication des piscines avec les conteneurs de 40".</p>
                            <span class="badge-invest">Marché Premium</span>
                            <div class="mt-3"><a href="#" class="btn btn-sm btn-outline-primary rounded-pill">En savoir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- 4. Art & Mode -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="card project-card text-center">
                        <div class="project-img" style="background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=500');"></div>
                        <div class="card-body">
                            <i class="fa-solid fa-palette card-icon"></i>
                            <h4>Art & Mode</h4>
                            <p class="text-muted small">Partenariat et installation dans les universités privé des unités de confection des uniformes des étudiants surplace et au cours de l'année.</p>
                            <span class="badge-invest">Export Inter</span>
                            <div class="mt-3"><a href="#" class="btn btn-sm btn-outline-primary rounded-pill">En savoir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- 5. Ferme -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card project-card text-center">
                        <div class="project-img" style="background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=500');"></div>
                        <div class="card-body">
                            <i class="fa-solid fa-seedling card-icon"></i>
                            <h4>Ferme Moderne</h4>
                            <p class="text-muted small">Construction des fermes pour l'élevage des bovins,caprins,ovins pour améliorer l'alimentation.</p>
                            <span class="badge-invest">Agro-Tech</span>
                            <div class="mt-3"><a href="#" class="btn btn-sm btn-outline-primary rounded-pill">En savoir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- 6. Fournitures -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card project-card text-center">
                        <div class="project-img" style="background-image: url('https://images.unsplash.com/photo-1524234107056-1c1f48f64ab8?w=500');"></div>
                        <div class="card-body">
                            <i class="fa-solid fa-print card-icon"></i>
                            <h4>Fournitures Bureau</h4>
                            <p class="text-muted small">Mise en place d'une unité de fabrication des fournitures scolaires.</p>
                            <span class="badge-invest">Marché Stable</span>
                            <div class="mt-3"><a href="#" class="btn btn-sm btn-outline-primary rounded-pill">En savoir plus</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
<style>
    /* Hero Section */
    .hero-invest {
        background: linear-gradient(135deg, rgba(0,51,102,0.92), rgba(0,51,102,0.75)), 
                    url('https://images.unsplash.com/photo-1579546929518-9e396f3cc809?auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        min-height: 80vh;
        display: flex;
        align-items: center;
    }

    .btn-orange {
        background-color: #FF8C00;
        color: white;
        border: none;
        transition: 0.3s ease;
    }
    .btn-orange:hover {
        background-color: #e67e00;
        color: white;
        transform: translateY(-3px);
    }

    /* Cartes réduites */
    .project-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: 0.3s;
        height: 100%;
    }
    .project-card:hover { transform: translateY(-5px); }

    .project-img { height: 130px; background-size: cover; background-position: center; }

    .card-icon {
        font-size: 1.5rem;
        color: #FF8C00;
        background: white;
        width: 50px;
        height: 50px;
        line-height: 50px;
        border-radius: 50%;
        margin-top: -25px;
        display: inline-block;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-bottom: 10px;
    }

    .badge-invest {
        background-color: #003366;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
    }

    .section-title {
        color: #003366;
        font-weight: 800;
        position: relative;
        padding-bottom: 15px;
        display: inline-block;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0; left: 25%; width: 50%; height: 3px;
        background-color: #FF8C00;
    }
</style>
@endpush