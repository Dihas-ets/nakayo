@extends('layouts.app_investisseurs')

@section('title', 'NAKAYO CORPORATION - Investisseurs')


@section('content')

{{-- 1. NAVBAR (Optionnelle si déjà dans layout) --}}
@if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
    <header class="sticky top-0 z-[100] w-full shadow-sm bg-white">
        @include('components.navbar')
    </header>
@endif

<!-- CURSOR -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- NAVBAR ICI -->

<!-- NAVBAR -->
<!-- TICKER -->
<div class="ticker-wrap">
  <div class="ticker text-primary" id="tickerInner">
    <div class="ticker-item">Immobilier Premium <span style="color:var(--nk-gold)">+28% ROI</span></div>
    <div class="ticker-item">Transport & Logistique <span style="color:var(--nk-gold)">+22% ROI</span></div>
    <div class="ticker-item">Construction Piscine <span style="color:var(--nk-gold)">+35% ROI</span></div>
    <div class="ticker-item">Art & Mode <span style="color:var(--nk-gold)">+40% ROI</span></div>
    <div class="ticker-item">Ferme Agricole <span style="color:var(--nk-gold)">+18% ROI</span></div>
    <div class="ticker-item">Fourniture Bureautique <span style="color:var(--nk-gold)">+24% ROI</span></div>
    <div class="ticker-item">Immobilier Premium <span style="color:var(--nk-gold)">+28% ROI</span></div>
    <div class="ticker-item">Transport & Logistique <span style="color:var(--nk-gold)">+22% ROI</span></div>
    <div class="ticker-item">Construction Piscine <span style="color:var(--nk-gold)">+35% ROI</span></div>
    <div class="ticker-item">Art & Mode <span style="color:var(--nk-gold)">+40% ROI</span></div>
    <div class="ticker-item">Ferme Agricole <span style="color:var(--nk-gold)">+18% ROI</span></div>
    <div class="ticker-item">Fourniture Bureautique <span style="color:var(--nk-gold)">+24% ROI</span></div>
  </div>
</div>

<!-- HERO -->
<section class="nk-hero" style="margin-top:-14px;">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
  <div class="hero-orb hero-orb-1"></div>
  <div class="hero-orb hero-orb-2"></div>
  <div class="hero-orb hero-orb-3"></div>

  <div class="container-fluid px-4">
    <div class="row align-items-center" style="min-height:92vh; padding: 80px 0;">
      <div class="col-lg-6">
        <div class="hero-content">
          <div class="hero-badge">Opportunités d'investissement exclusives</div>
          <h1 class="hero-title ">
            Construisez votre <span class="accent">Fortune</span><br>avec Nakayo
          </h1>
          <p class="hero-sub">
            Rejoignez une communauté d'investisseurs visionnaires qui font confiance à Nakayo pour transformer leur capital en richesse durable. Six secteurs. Des rendements exceptionnels. Un avenir radieux.
          </p>
          <div class="hero-cta">
                  @php 
                  $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? '22900000000'); 
              @endphp
                  <a href="#projets" class="btn-primary-nk text-white">Explorer les Projets <i class="fas fa-arrow-right ms-2"></i></a>
                  <a href="{{ route('about') }}" class="btn-outline-nk" style="color: white !important;">
                      En savoir plus sur nous
                  </a>
                </div>
          <div class="hero-stats">
            <div class="stat-item">
              <div class="stat-num"><span class="count-up" data-target="120">0</span><span>M+</span></div>
              <div class="stat-label">Capital Géré (FCFA)</div>
            </div>
            <div class="stat-item">
              <div class="stat-num"><span class="count-up" data-target="6">0</span></div>
              <div class="stat-label">Secteurs Actifs</div>
            </div>
            <div class="stat-item">
              <div class="stat-num"><span class="count-up" data-target="32">0</span><span>%</span></div>
              <div class="stat-label">ROI Moyen Annuel</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="hero-visual ps-lg-5 mt-5 mt-lg-0">
          <div style="position:relative; max-width:600px; margin-left:auto;">
            <div class="floating-badge fb-top">
              <div class="fb-icon orange"><i class="fas fa-chart-line" style="color:var(--nk-orange)"></i></div>
              <div class="fb-text">
                <strong>Rendement Annuel</strong>
                <small>Jusqu'à +40% par projet</small>
              </div>
            </div>
            <div class="video-card">
              <div class="video-inner">
                <div class="video-fallback">
                  <!-- Animated chart visual -->
                  <svg width="100%" height="100%" viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg" style="position:absolute;inset:0;">
                    <defs>
                      <linearGradient id="lineGrad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#FF6B1A" stop-opacity=".4"/>
                        <stop offset="100%" stop-color="#FF6B1A" stop-opacity="0"/>
                      </linearGradient>
                    </defs>
                    <path d="M0,250 C80,230 120,200 160,180 C200,160 220,120 280,90 C340,60 380,80 420,50 C460,20 510,30 600,10" stroke="#FF6B1A" stroke-width="3" fill="none" class="animated-path" opacity=".9"/>
                    <path d="M0,250 C80,230 120,200 160,180 C200,160 220,120 280,90 C340,60 380,80 420,50 C460,20 510,30 600,10 L600,300 L0,300 Z" fill="url(#lineGrad)"/>
                    <path d="M0,280 C100,275 150,250 220,240 C290,230 320,220 380,200 C440,180 500,170 600,150" stroke="rgba(91,154,255,.5)" stroke-width="2" fill="none" stroke-dasharray="8,4"/>
                  </svg>
                  <div style="z-index:1; text-align:center;">
                    <div class="play-btn" onclick="openVideoModal()">
                      <i class="fas fa-play"></i>
                    </div>
                    <div class="video-label mt-3">Voir notre présentation</div>
                  </div>
                </div>
                <div class="video-overlay">
                  <span class="video-tag">Nakayo Invest 2026</span>
                  <p style="font-size:.85rem; margin-top:6px; color:rgba(255,255,255,.6);">Votre partenaire pour un avenir prospère</p>
                </div>
              </div>
            </div>
            <div class="floating-badge fb-bottom">
              <div class="fb-icon blue"><i class="fas fa-shield-halved" style="color:#5B9AFF"></i></div>
              <div class="fb-text">
                <strong>Investissements Sécurisés</strong>
                <small>Portefeuille diversifié & transparent</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PROJECTS -->
<section class="projects-section" id="projets">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-badge">Nos Secteurs d'Investissement</div>
      <h2 class="section-title">Six Piliers de<br><span style="color:var(--nk-orange)">Croissance</span></h2>
      <p class="section-sub">Des secteurs stratégiquement choisis pour leur dynamisme, leur potentiel de rendement et leur impact positif sur le développement économique.</p>
    </div>
    <div class="row g-4">

      <!-- Immobilier -->
      <div class="col-lg-4 col-md-6 reveal">
        <div class="project-card" data-project="immo">
          <div class="project-bg pb-immo" style="background-image:url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=600&q=80');"></div>
          <div class="project-overlay"></div>
          <div class="project-icon-bg">🏢</div>
          <div class="project-content">
            <span class="project-tag">Secteur Phare</span>
            <h3 class="project-title">Immobilier</h3>
            <p class="project-desc">Appartements, villas et bureaux premium dans les zones à forte croissance. Des actifs tangibles qui prennent de la valeur.</p>
            <div class="project-roi">
              <div><div class="roi-label">ROI Annuel</div><div class="roi-val">+28%</div></div>
              <div><div class="roi-label">Durée Min.</div><div class="roi-val" style="font-size:.9rem;color:rgba(255,255,255,.6);">05 ans</div></div>
            </div>
            @php 
                // On nettoie le numéro de téléphone (enlève les espaces et les +)
                $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? '22900000000');
                // On prépare le message automatique
                $message = "Bonjour Nakayo, je souhaite investir dans le projet : Immobilier (ROI +28%).";
            @endphp

            <a href="https://wa.me/{{ $whatsappClean }}?text={{ urlencode($message) }}" 
              target="_blank" 
              class="btn-invest text-white" 
              style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; text-white ">
                <i class="fas fa-arrow-right text-white"></i> Investir dans ce projet
            </a>
           </div>
        </div>
      </div>

      <!-- Transport -->
      <div class="col-lg-4 col-md-6 reveal" style="transition-delay:.1s">
        <div class="project-card" data-project="transport">
          <div class="project-bg pb-transport" style="background-image:url('https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=600&q=80');"></div>
          <div class="project-overlay"></div>
          <div class="project-icon-bg">🚛</div>
          <div class="project-content">
            <span class="project-tag">Croissance Rapide</span>
            <h3 class="project-title">Transport & Logistique</h3>
            <p class="project-desc">Flotte de véhicules, chaînes d'approvisionnement et hubs logistiques au cœur des corridors commerciaux africains.</p>
            <div class="project-roi">
              <div><div class="roi-label">ROI Annuel</div><div class="roi-val">+22%</div></div>
              <div><div class="roi-label">Durée Min.</div><div class="roi-val" style="font-size:.9rem;color:rgba(255,255,255,.6);">05 ans</div></div>
            </div>
           @php 
                // On nettoie le numéro de téléphone (enlève les espaces et les +)
                $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? '22900000000');
                // On prépare le message automatique
                $message = "Bonjour Nakayo, je souhaite investir dans le projet : Immobilier (ROI +28%).";
            @endphp

            <a href="https://wa.me/{{ $whatsappClean }}?text={{ urlencode($message) }}" 
              target="_blank" 
              class="btn-invest" 
              style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; text-white ">
                <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </a>
          </div>
        </div>
      </div>

      <!-- Piscine -->
      <div class="col-lg-4 col-md-6 reveal" style="transition-delay:.2s">
        <div class="project-card" data-project="piscine">
          <div class="project-bg pb-piscine" style="background-image:url('https://images.unsplash.com/photo-1575429198097-0414ec08e8cd?w=600&q=80');"></div>
          <div class="project-overlay"></div>
          <div class="project-icon-bg">🏊</div>
          <div class="project-content">
            <span class="project-tag">Secteur Premium</span>
            <h3 class="project-title">Construction Piscine</h3>
            <p class="project-desc">Design, construction et entretien de piscines haut de gamme pour hôtels, résidences et complexes de luxe.</p>
            <div class="project-roi">
              <div><div class="roi-label">ROI Annuel</div><div class="roi-val">+35%</div></div>
              <div><div class="roi-label">Durée Min.</div><div class="roi-val" style="font-size:.9rem;color:rgba(255,255,255,.6);">05 ans</div></div>
            </div>
            @php 
                // On nettoie le numéro de téléphone (enlève les espaces et les +)
                $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? '22900000000');
                // On prépare le message automatique
                $message = "Bonjour Nakayo, je souhaite investir dans le projet : Immobilier (ROI +28%).";
            @endphp

            <a href="https://wa.me/{{ $whatsappClean }}?text={{ urlencode($message) }}" 
              target="_blank" 
              class="btn-invest" 
              style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; text-white ">
                <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </a>
          </div>
        </div>
      </div>

      <!-- Art & Mode -->
      <div class="col-lg-4 col-md-6 reveal" style="transition-delay:.3s">
        <div class="project-card" data-project="art">
          <div class="project-bg pb-art" style="background-image:url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80');"></div>
          <div class="project-overlay"></div>
          <div class="project-icon-bg">🎨</div>
          <div class="project-content">
            <span class="project-tag">Innovation Créative</span>
            <h3 class="project-title">Art & Mode</h3>
            <p class="project-desc">Collections exclusives, collaborations artistiques et marques de mode à fort potentiel dans un marché africain en plein éveil culturel.</p>
            <div class="project-roi">
              <div><div class="roi-label">ROI Annuel</div><div class="roi-val">+40%</div></div>
              <div><div class="roi-label">Durée Min.</div><div class="roi-val" style="font-size:.9rem;color:rgba(255,255,255,.6);">05 ans</div></div>
            </div>
            @php 
                // On nettoie le numéro de téléphone (enlève les espaces et les +)
                $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? '22900000000');
                // On prépare le message automatique
                $message = "Bonjour Nakayo, je souhaite investir dans le projet : Immobilier (ROI +28%).";
            @endphp

            <a href="https://wa.me/{{ $whatsappClean }}?text={{ urlencode($message) }}" 
              target="_blank" 
              class="btn-invest" 
              style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; text-white ">
                <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </a>
          </div>
        </div>
      </div>

      <!-- Ferme -->
      <div class="col-lg-4 col-md-6 reveal" style="transition-delay:.4s">
        <div class="project-card" data-project="ferme">
          <div class="project-bg pb-ferme" style="background-image:url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=600&q=80');"></div>
          <div class="project-overlay"></div>
          <div class="project-icon-bg">🌾</div>
          <div class="project-content">
            <span class="project-tag">Secteur Durable</span>
            <h3 class="project-title">Ferme Agricole</h3>
            <p class="project-desc">Agriculture moderne, cultures à haute valeur ajoutée et agro-industrie. L'alimentation d'un continent — une opportunité inépuisable.</p>
            <div class="project-roi">
              <div><div class="roi-label">ROI Annuel</div><div class="roi-val">+18%</div></div>
              <div><div class="roi-label">Durée Min.</div><div class="roi-val" style="font-size:.9rem;color:rgba(255,255,255,.6);">05 ans</div></div>
            </div>
            @php 
                // On nettoie le numéro de téléphone (enlève les espaces et les +)
                $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? '22900000000');
                // On prépare le message automatique
                $message = "Bonjour Nakayo, je souhaite investir dans le projet : Immobilier (ROI +28%).";
            @endphp

            <a href="https://wa.me/{{ $whatsappClean }}?text={{ urlencode($message) }}" 
              target="_blank" 
              class="btn-invest" 
              style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; text-white ">
                <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </a>
          </div>
        </div>
      </div>

      <!-- Bureautique -->
      <div class="col-lg-4 col-md-6 reveal" style="transition-delay:.5s">
        <div class="project-card" data-project="bureau">
          <div class="project-bg pb-bureau" style="background-image:url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=600&q=80');"></div>
          <div class="project-overlay"></div>
          <div class="project-icon-bg">🖨️</div>
          <div class="project-content">
            <span class="project-tag">B2B Stratégique</span>
            <h3 class="project-title">Fourniture Bureautique</h3>
            <p class="project-desc">Distribution d'équipements de bureau, consommables et solutions digitales à destination des entreprises, administrations et institutions.</p>
            <div class="project-roi">
              <div><div class="roi-label">ROI Annuel</div><div class="roi-val">+24%</div></div>
              <div><div class="roi-label">Durée Min.</div><div class="roi-val" style="font-size:.9rem;color:rgba(255,255,255,.6);">05 ans</div></div>
            </div>
            @php 
                // On nettoie le numéro de téléphone (enlève les espaces et les +)
                $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? '22900000000');
                // On prépare le message automatique
                $message = "Bonjour Nakayo, je souhaite investir dans le projet : Immobilier (ROI +28%).";
            @endphp

            <a href="https://wa.me/{{ $whatsappClean }}?text={{ urlencode($message) }}" 
              target="_blank" 
              class="btn-invest" 
              style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; text-white ">
                <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- PROCESS -->
<section class="process-section" id="processus">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-badge">Comment Investir</div>
      <h2 class="section-title">Comment devenir<br><span style="color:var(--nk-orange)">Investisseur ?</span></h2>
      <p class="section-sub">Quatre étapes simples pour rejoindre la famille Nakayo et commencer à faire travailler votre capital.</p>
    </div>
    <div class="row g-4 position-relative reveal">
      <div class="col-lg-3 col-sm-6">
        <div class="step-card">
          <div class="step-num">01</div>
          <h5>Inscription Gratuite</h5>
          <p>Explorez nos 6 secteurs d'activité stratégiques. Identifiez les projets qui correspondent à vos ambitions et découvrez le potentiel de croissance que nous offrons</p>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="step-card">
          <div class="step-num">02</div>
          <h5>Choisissez vos Projets</h5>
          <p>Entrez en contact avec notre équipe. Vous serez mis en relation avec un gestionnaire de compte dédié pour discuter de votre stratégie et obtenir des réponses à toutes vos questions.</p>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="step-card">
          <div class="step-num">03</div>
          <h5>Investissez en Toute Sécurité</h5>
          <p>Finalisez les formalités administratives et juridiques en toute sérénité. Un contrat d'investissement sécurisé est établi pour protéger votre capital et définir les modalités de partenariat.</p>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="step-card">
          <div class="step-num">04</div>
          <h5>Percevez vos Rendements</h5>
          <p>Percevez vos rendements sur une période de 5 ans renouvelable. Votre capital travaille pour vous, tandis que vous suivez la concrétisation des projets sur le terrain.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Why Invest Section -->
<section class="nk-section nk-why-section" id="why">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-badge">Nos avantages</span>
            <h2 class="section-title">Pourquoi investir avec Nakayo</h2>
            <p class="section-subtitle">
                Une approche unique et transparente pour securiser et faire fructifier vos investissements.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 nk-reveal">
                <div class="nk-why-card">
                    <div class="nk-why-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3 class="nk-why-title">Selection Rigoureuse</h3>
                    <p class="nk-why-desc">
                        Chaque projet passe par un processus d'analyse approfondi: etude de marche, audit financier, evaluation des risques et verification des equipes.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 nk-reveal">
                <div class="nk-why-card">
                    <div class="nk-why-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h3 class="nk-why-title">Securite Garantie</h3>
                    <p class="nk-why-desc">
                        Vos investissements sont proteges par des mechanisms juridiques solides et un suivi continu de chaque projet. Transparence totale sur l'utilisation des fonds.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 nk-reveal">
                <div class="nk-why-card">
                    <div class="nk-why-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3 class="nk-why-title">Rendements Attractifs</h3>
                    <p class="nk-why-desc">
                        Accedez a des opportunites d'investissement generant des rendements superieurs aux placements traditionnels, avec un ratio risque/rendement optimise.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 nk-reveal">
                <div class="nk-why-card">
                    <div class="nk-why-icon">
                        <i class="bi bi-gear"></i>
                    </div>
                    <h3 class="nk-why-title">Gestion Active</h3>
                    <p class="nk-why-desc">
                        Notre equipe assure un suivi quotidien des projets. Vous recevez des rapports detailles mensuels et un accompagnement personnalise.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 nk-reveal">
                <div class="nk-why-card">
                    <div class="nk-why-icon">
                        <i class="bi bi-diagram-3"></i>
                    </div>
                    <h3 class="nk-why-title">Diversification</h3>
                    <p class="nk-why-desc">
                        Repartissez vos investissements sur plusieurs secteurs pour minimiser les risques et optimiser votre portefeuille global.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 nk-reveal">
                <div class="nk-why-card">
                    <div class="nk-why-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="nk-why-title">Accompagnement</h3>
                    <p class="nk-why-desc">
                        Un conseiller dedie vous guide dans vos decisions d'investissement. Notre equipe reste disponible pour repondre a toutes vos questions.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- CTA -->
<section class="cta-section" id="contact">
  <div class="cta-bg"></div>
  <div class="container">
    <div class="cta-content reveal">
      <div class="section-badge">Rejoignez Nakayo</div>
      <h2 class="cta-title">Votre capital mérite<br>mieux que la stagnation</h2>
      <p class="cta-sub">Inscrivez-vous dès aujourd'hui et recevez notre guide exclusif des opportunités d'investissement 2026. Gratuit, sans engagement.</p>
      <div class="d-flex justify-content-center mt-4">
        @php 
            $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? '22900000000'); 
        @endphp
        
        <a href="https://wa.me/{{ $whatsappClean }}?text=Bonjour, je souhaite recevoir le guide exclusif des opportunités d'investissement ." 
           target="_blank" 
           class="cta-submit d-inline-flex align-items-center justify-content-center gap-3" 
           style="text-decoration: none; min-width: 280px; height: 60px; border-radius: 15px;">
           <i class="fab fa-whatsapp text-white" style="font-size: 1.5rem;"></i>
           <span class="text-white">Démarrer sur WhatsApp</span>
           <i class="fas fa-arrow-right ms-2"></i>
        </a>
      </div>
      <p style="margin-top:20px;font-size:.78rem;">
        <i class="fas fa-lock me-2"></i>Vos données sont protégées. Aucun spam, désinscription en un clic.
      </p>
      <div class="d-flex justify-content-center gap-4 mt-5 flex-wrap">
        <div style="display:flex;align-items:center;gap:10px;">
          <i class="fas fa-shield-halved" style="color:var(--nk-orange);font-size:1.3rem;"></i>
          <span style="font-size:.85rem;">Investissements Sécurisés</span>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
          <i class="fas fa-chart-line" style="color:var(--nk-orange);font-size:1.3rem;"></i>
          <span style="font-size:.85rem;">ROI Garanti & Transparent</span>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
          <i class="fas fa-users" style="color:var(--nk-orange);font-size:1.3rem;"></i>
          <span style="font-size:.85rem;">+280 Investisseurs Satisfaits</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- INVEST MODAL (project detail) -->
<div class="modal fade" id="investModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Investir dans ce projet</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">https://wa.me/{{ $whatsappClean }}</button>
      </div>
      <div class="modal-body">
        <p id="modalDesc" style="color:rgba(255,255,255,.7);margin-bottom:28px;line-height:1.8;"></p>
        <div class="row g-3 mb-4">
          <div class="col-6">
            <div class="perf-item">
              <div class="perf-num" id="modalRoi">+0%</div>
              <div class="perf-label">ROI Annuel Estimé</div>
            </div>
          </div>
          <div class="col-6">
            <div class="perf-item blue">
              <div class="perf-num" id="modalDuration">0</div>
              <div class="perf-label">Durée Minimum (mois)</div>
            </div>
          </div>
        </div>
        <div style="background:var(--nk-glass);border:1px solid var(--nk-border);border-radius:16px;padding:24px;">
          <label style="font-size:.78rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:8px;display:block;">Montant à investir (FCFA)</label>
          <input type="number" placeholder="Ex: 500 000 FCFA" style="width:100%;background:none;border:1px solid var(--nk-border);border-radius:12px;padding:14px 18px;color:#fff;font-size:1rem;outline:none;" id="investAmount" oninput="calcReturn()"/>
          <div id="returnCalc" style="margin-top:14px;padding:14px;background:rgba(255,107,26,.08);border-radius:10px;border:1px solid rgba(255,107,26,.2);display:none;">
            <div style="font-size:.78rem;color:rgba(255,255,255,.4);margin-bottom:4px;">Retour estimé à 12 mois</div>
            <div style="font-family:'Playfair Display',serif;font-size:1.6rem;font-weight:700;color:var(--nk-gold);" id="returnVal">0 FCFA</div>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" style="background:none;border:1px solid var(--nk-border);color:#fff;padding:12px 24px;border-radius:30px;cursor:pointer;" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn-primary-nk">Confirmer l'Investissement <i class="fas fa-arrow-right ms-2"></i></button>
      </div> -->
    </div>
  </div>
</div>

<!-- FOOTER ICI-->

<!-- FOOTER -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
// ── CURSOR ──
const cursor = document.getElementById('cursor');
const ring = document.getElementById('cursorRing');
document.addEventListener('mousemove', e => {
  cursor.style.left = e.clientX + 'px'; cursor.style.top = e.clientY + 'px';
  ring.style.left = e.clientX + 'px'; ring.style.top = e.clientY + 'px';
});

// ── SCROLL REVEAL ──
const reveals = document.querySelectorAll('.reveal');
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) { e.target.classList.add('visible'); } });
}, { threshold: 0.12 });
reveals.forEach(r => obs.observe(r));

// ── COUNT UP ──
const countEls = document.querySelectorAll('.count-up');
const countObs = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      const el = entry.target;
      const target = +el.dataset.target;
      let current = 0;
      const step = target / 60;
      const timer = setInterval(() => {
        current += step;
        if(current >= target) { current = target; clearInterval(timer); }
        el.textContent = Math.floor(current);
      }, 25);
      countObs.unobserve(el);
    }
  });
}, { threshold: 0.5 });
countEls.forEach(el => countObs.observe(el));

// ── ROI CHART ──
const progressBars = document.querySelectorAll('.nk-progress-fill');
const barItems = document.querySelectorAll('.nk-bar');
const counters = document.querySelectorAll('.nk-counter');
const revealElements = document.querySelectorAll('.nk-reveal');
// Intersection Observer for reveal animations
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('nk-visible');
                    }, index * 100);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        revealElements.forEach(el => revealObserver.observe(el));

        // Animate progress bars
        const progressObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const progress = entry.target.getAttribute('data-progress');
                    entry.target.style.width = progress + '%';
                    progressObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        progressBars.forEach(bar => progressObserver.observe(bar));
 // Animate bar chart
        const barChartObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    barItems.forEach((bar, index) => {
                        const height = bar.getAttribute('data-height');
                        setTimeout(() => {
                            bar.style.height = height + 'px';
                        }, index * 150);
                    });
                    barChartObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        if (document.getElementById('barChart')) {
            barChartObserver.observe(document.getElementById('barChart'));
        }

        // ── PROJECT MODAL ──
let currentRoi = 0;
function openModal(title, desc, roi, dur) {
  document.getElementById('modalTitle').textContent = 'Investir — ' + title;
  document.getElementById('modalDesc').textContent = desc;
  document.getElementById('modalRoi').textContent = '+' + roi + '%';
  document.getElementById('modalDuration').textContent = dur + ' mois';
  document.getElementById('returnCalc').style.display = 'none';
  document.getElementById('investAmount').value = '';
  currentRoi = parseInt(roi);
  new bootstrap.Modal(document.getElementById('investModal')).show();
}
function calcReturn() {
  const amt = parseFloat(document.getElementById('investAmount').value);
  const calc = document.getElementById('returnCalc');
  if(amt && amt > 0) {
    const ret = (amt * (1 + currentRoi/100)).toLocaleString('fr-FR') + ' FCFA';
    document.getElementById('returnVal').textContent = ret;
    calc.style.display = 'block';
  } else { calc.style.display = 'none'; }
}
function openVideoModal() {
  window.open('https://www.youtube.com/watch?v=gNoxTd5WhRM&list=RDMM&index=15', '_blank');
}

</script>

@endsection
