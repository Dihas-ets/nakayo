<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NAKAYO — Investissez dans l'Avenir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Manrope:wght@300;400;600;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <style>
    :root {
      --nk-orange: #FF6B1A;
      --nk-orange-light: #FF8C42;
      --nk-orange-glow: rgba(255,107,26,0.25);
      --nk-blue: #0A1F44;
      --nk-blue-mid: #163872;
      --nk-blue-light: #1E4FA0;
      --nk-gold: #F5C842;
      --nk-white: #F8F5F0;
      --nk-glass: rgba(255,255,255,0.06);
      --nk-border: rgba(255,255,255,0.1);
      --nk-primary: #1a365d;
            --nk-primary-light: #2c5282;
            --nk-accent: #ed8936;
            --nk-accent-hover: #dd6b20;
            --nk-accent-glow: rgba(237, 137, 54, 0.4);
            --nk-dark: #0d1321;
            --nk-darker: #070b14;
            --nk-light: #f7fafc;
            --nk-muted: #718096;
            --nk-card-bg: rgba(26, 54, 93, 0.15);
            --nk-border: rgba(237, 137, 54, 0.2);
            --nk-gradient: linear-gradient(135deg, var(--nk-primary) 0%, var(--nk-dark) 100%);
    }

    /* * { margin: 0; padding: 0; box-sizing: border-box; } */

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Manrope', sans-serif;
      overflow-x: hidden;
      cursor: none;
    }
    a {
    color: inherit!important;
    -webkit-text-decoration: inherit;
    text-decoration: inherit!important;
  }

    /* ── CURSOR ── */
    .cursor {
      width: 14px; height: 14px;
      background: var(--nk-orange);
      border-radius: 50%;
      position: fixed; top: 0; left: 0;
      pointer-events: none; z-index: 9999;
      transform: translate(-50%,-50%);
      transition: transform .15s ease, width .2s, height .2s, background .2s;
      mix-blend-mode: normal;
    }
    .cursor-ring {
      width: 40px; height: 40px;
      border: 2px solid var(--nk-orange);
      border-radius: 50%;
      position: fixed; top: 0; left: 0;
      pointer-events: none; z-index: 9998;
      transform: translate(-50%,-50%);
      transition: all .35s cubic-bezier(.23,1,.32,1);
      opacity: .5;
    }
    body:has(a:hover) .cursor, body:has(button:hover) .cursor { width: 22px; height: 22px; }
    body:has(a:hover) .cursor-ring, body:has(button:hover) .cursor-ring { width: 60px; height: 60px; opacity: .3; }

    /* ── HERO ── */
    .nk-hero {
      min-height: 100vh;
      position: relative; overflow: hidden;
      display: flex; align-items: center;
    }
    .hero-bg {
      position: absolute; inset: 0; z-index: 0;
      background:
        radial-gradient(ellipse 80% 60% at 60% 40%, rgba(22,56,114,0.9) 0%, transparent 70%),
        radial-gradient(ellipse 50% 50% at 10% 80%, rgba(255,107,26,0.2) 0%, transparent 60%),
        linear-gradient(135deg, #040D1E 0%, #0A1F44 50%, #0D1B38 100%);
    }
    .hero-grid {
      position: absolute; inset: 0; z-index: 1;
      background-image:
        linear-gradient(rgba(255,107,26,.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,107,26,.05) 1px, transparent 1px);
      background-size: 60px 60px;
      animation: gridShift 20s linear infinite;
    }
    @keyframes gridShift { to { background-position: 60px 60px; } }

    .hero-orb {
      position: absolute; border-radius: 50%;
      filter: blur(80px); animation: orbFloat 8s ease-in-out infinite;
    }
    .hero-orb-1 { width: 500px; height: 500px; background: rgba(255,107,26,.12); top: -100px; right: 10%; animation-delay: 0s; }
    .hero-orb-2 { width: 350px; height: 350px; background: rgba(30,79,160,.25); bottom: 0; left: 5%; animation-delay: -3s; }
    .hero-orb-3 { width: 250px; height: 250px; background: rgba(245,200,66,.08); top: 40%; right: 30%; animation-delay: -5s; }
    @keyframes orbFloat {
      0%,100% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-30px) scale(1.05); }
    }

    .hero-content { position: relative; z-index: 2; padding: 0 6%; }
    .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--nk-glass); border: 1px solid var(--nk-border);
      backdrop-filter: blur(10px); border-radius: 50px;
      padding: 8px 20px; margin-bottom: 28px;
      font-size: .75rem; font-weight: 700; letter-spacing: 2px;
      text-transform: uppercase; color: var(--nk-orange);
      animation: fadeSlideUp .8s ease both;
    }
    .hero-badge::before {
      content: ''; width: 8px; height: 8px;
      background: var(--nk-orange); border-radius: 50%;
      animation: pulse 2s infinite;
    }
    @keyframes pulse { 0%,100%{ opacity:1; transform:scale(1); } 50%{ opacity:.4; transform:scale(1.4); } }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(3rem, 7vw, 6.5rem);
      font-weight: 900; line-height: 1.05;
      margin-bottom: 28px;
      animation: fadeSlideUp .9s .15s ease both;
      color: white;
    }
    .hero-title .accent {
      background: linear-gradient(120deg, var(--nk-orange) 0%, var(--nk-gold) 100%);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .hero-sub {
      font-size: clamp(1rem, 2vw, 1.2rem); font-weight: 300;
      color: rgba(255,255,255,.7); max-width: 560px;
      line-height: 1.8; margin-bottom: 48px;
      animation: fadeSlideUp 1s .3s ease both;
    }
    .hero-cta { display: flex; gap: 18px; flex-wrap: wrap; animation: fadeSlideUp 1s .45s ease both; }
    .btn-primary-nk {
      background: linear-gradient(135deg, var(--nk-orange), var(--nk-orange-light));
      color: #fff; border: none; padding: 16px 40px;
      border-radius: 50px; font-weight: 700; font-size: 1rem;
      cursor: pointer; transition: all .3s; letter-spacing: .5px;
      box-shadow: 0 4px 30px var(--nk-orange-glow);
      text-decoration: none; display: inline-block;
    }
    .btn-primary-nk:hover { transform: translateY(-4px); box-shadow: 0 12px 50px var(--nk-orange-glow); color: #fff; }
    .btn-outline-nk {
      background: transparent;
      color: #fff; border: 2px solid rgba(255,255,255,.3);
      padding: 14px 38px; border-radius: 50px;
      font-weight: 600; font-size: 1rem;
      cursor: pointer; transition: all .3s;
      text-decoration: none; display: inline-flex; align-items: center; gap: 10px;
    }
    .btn-outline-nk:hover { border-color: var(--nk-orange); color: var(--nk-orange); transform: translateY(-4px); }

    .hero-stats {
      display: flex; gap: 50px; margin-top: 70px; flex-wrap: wrap;
      animation: fadeSlideUp 1s .6s ease both;
    }
    .stat-item { border-left: 3px solid var(--nk-orange); padding-left: 16px; }
    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 2.2rem; font-weight: 900;
      color: var(--nk-white); line-height: 1;
    }
    .stat-num span { color: var(--nk-orange); }
    .stat-label { font-size: .75rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; color: rgba(255,255,255,.5); margin-top: 4px; }

    /* Hero video mockup */
    .hero-visual {
      position: relative; z-index: 2;
      animation: fadeSlideIn 1.1s .3s ease both;
    }
    @keyframes fadeSlideIn { from { opacity:0; transform:translateX(40px); } to { opacity:1; transform:translateX(0); } }

    .video-card {
      position: relative; border-radius: 24px; overflow: hidden;
      border: 1px solid var(--nk-border);
      box-shadow: 0 40px 100px rgba(0,0,0,.5), 0 0 60px var(--nk-orange-glow);
    }
    .video-inner {
      width: 100%; aspect-ratio: 16/10;
      background: linear-gradient(135deg, #0a1428 0%, #162242 50%, #1a2d4a 100%);
      display: flex; align-items: center; justify-content: center;
      position: relative; overflow: hidden;
    }
    .video-inner video { width: 100%; height: 100%; object-fit: cover; opacity: .7; }
    .video-fallback {
      position: absolute; inset: 0;
      background: linear-gradient(135deg,#0D1B38,#163872);
      display: flex; align-items: center; justify-content: center;
      flex-direction: column; gap: 20px;
    }
    .play-btn {
      width: 80px; height: 80px; border-radius: 50%;
      background: rgba(255,107,26,.2); border: 2px solid var(--nk-orange);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; transition: all .3s; backdrop-filter: blur(10px);
      animation: playPulse 2s infinite;
    }
    @keyframes playPulse {
      0%,100%{ box-shadow: 0 0 0 0 rgba(255,107,26,.4); }
      50%{ box-shadow: 0 0 0 20px rgba(255,107,26,0); }
    }
    .play-btn:hover { background: var(--nk-orange); transform: scale(1.1); }
    .play-btn i { font-size: 1.8rem; color: var(--nk-orange); margin-left: 5px; }
    .play-btn:hover i { color: #fff; }
    .video-label { font-size: .8rem; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,.5); }
    .video-overlay {
      position: absolute; bottom: 0; left: 0; right: 0;
      padding: 24px;
      background: linear-gradient(transparent, rgba(10,31,68,.95));
    }
    .video-tag { background: var(--nk-orange); color: #fff; font-size: .7rem; font-weight: 700; letter-spacing: 1px; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; }
    .floating-badge {
      position: absolute; background: rgba(255,255,255,.05);
      backdrop-filter: blur(20px); border: 1px solid var(--nk-border);
      border-radius: 16px; padding: 14px 18px;
      display: flex; align-items: center; gap: 12px;
      animation: floatBadge 4s ease-in-out infinite;
    }
    @keyframes floatBadge { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-8px);} }
    .fb-top { top: -70px; right: -10px; animation-delay: -1s; }
    .fb-bottom { bottom: -20px; left: -10px; animation-delay: -2.5s; }
    .fb-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    .fb-icon.orange { background: rgba(255,107,26,.2); }
    .fb-icon.blue { background: rgba(30,79,160,.3); }
    .fb-text strong { display: block; font-size: .85rem; font-weight: 700; color: white;}
    .fb-text small { font-size: .72rem; color: rgba(255,255,255,.5); }

    @keyframes fadeSlideUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }

    /* ── SECTION STYLES ── */
    .section-header { text-align: center; margin-bottom: 70px; }
    .section-badge {
      display: inline-block; background: rgba(255,107,26,.1);
      border: 1px solid rgba(255,107,26,.3); color: var(--nk-orange);
      font-size: .72rem; font-weight: 700; letter-spacing: 2px;
      text-transform: uppercase; padding: 6px 18px; border-radius: 30px; margin-bottom: 16px;
    }
    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 900;
      line-height: 1.15; margin-bottom: 18px;
    }
    .section-sub {font-size: 1.05rem; max-width: 600px; margin: 0 auto; line-height: 1.8; }

    /* ── WHY NAKAYO ── */
    .why-section { padding: 120px 0; position: relative; }
    .why-section::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0;
      height: 1px; background: linear-gradient(90deg, transparent, var(--nk-orange), transparent);
    }
    .why-card {
      background: white; border: 1px solid var(--nk-blue-light);
      border-radius: 24px; padding: 40px 32px;
      position: relative; overflow: hidden;
      transition: all .4s cubic-bezier(.23,1,.32,1);
      height: 100%;
    }
    .why-card::before {
      content: ''; position: absolute; inset: 0;
      background: linear-gradient(135deg, var(--nk-orange-glow), transparent);
      opacity: 0; transition: opacity .4s;
      border-radius: 24px;
    }
    .why-card:hover { transform: translateY(-12px); border-color: var(--nk-orange); box-shadow: 0 30px 80px rgba(0,0,0,.3), 0 0 40px var(--nk-orange-glow); }
    .why-card:hover::before { opacity: 1; }
    .why-icon { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: 24px; position: relative; z-index: 1; }
    .why-icon.org { background: linear-gradient(135deg, rgba(255,107,26,.2), rgba(255,107,26,.05)); color: var(--nk-orange); }
    .why-icon.blue { background: linear-gradient(135deg, rgba(30,79,160,.3), rgba(30,79,160,.05)); color: #5B9AFF; }
    .why-icon.gold { background: linear-gradient(135deg, rgba(245,200,66,.2), rgba(245,200,66,.05)); color: var(--nk-gold); }
    .why-card h5 { font-size: 1.15rem; font-weight: 700; margin-bottom: 12px; position: relative; z-index: 1; }
    .why-card p { font-size: .92rem; line-height: 1.75; position: relative; z-index: 1; }

    /* ── PROJECTS ── */
    .projects-section { padding: 120px 0; background: ghostwhite; }
    .project-card {
      position: relative; border-radius: 28px; overflow: hidden;
      height: 420px; cursor: pointer;
      transition: all .5s cubic-bezier(.23,1,.32,1);
      border: 1px solid var(--nk-border);
    }
    .project-card:hover { transform: translateY(-16px) scale(1.02); box-shadow: 0 40px 100px rgba(0,0,0,.5), 0 0 50px var(--nk-orange-glow); border-color: var(--nk-orange); }
    .project-bg {
      position: absolute; inset: 0;
      background-size: cover; background-position: center;
      transition: transform .8s cubic-bezier(.23,1,.32,1);
    }
    .project-card:hover .project-bg { transform: scale(1.1); }
    .project-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(180deg, rgba(10,31,68,0.2) 0%, rgba(10,31,68,0.95) 100%);
      transition: all .4s;
    }
    .project-card:hover .project-overlay { background: linear-gradient(180deg, rgba(10,31,68,0.3) 0%, rgba(10,31,68,0.98) 100%); }
    .project-content {
      position: absolute; bottom: 0; left: 0; right: 0;
      padding: 32px; transition: all .4s;
    }
    .project-tag {
      background: var(--nk-orange); color: #fff;
      font-size: .65rem; font-weight: 800; letter-spacing: 2px;
      text-transform: uppercase; padding: 5px 14px; border-radius: 30px;
      display: inline-block; margin-bottom: 14px;
    }
    .project-title { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 700; margin-bottom: 8px; color: #fff; }
    .project-desc { color: rgba(255,255,255,.6); font-size: .88rem; line-height: 1.6; margin-bottom: 20px; max-height: 0; overflow: hidden; transition: max-height .5s; }
    .project-card:hover .project-desc { max-height: 100px; }
    .project-roi {
      display: flex; align-items: center; justify-content: space-between;
      background: rgba(255,255,255,.05); border-radius: 12px; padding: 12px 16px;
      border: 1px solid var(--nk-border);
    }
    .roi-label { font-size: .7rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: rgba(255,255,255,.4); }
    .roi-val { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 700; color: var(--nk-gold); }
    .project-icon-bg {
      position: absolute; top: 20px; right: 20px;
      width: 52px; height: 52px; border-radius: 14px;
      background: rgba(255,255,255,.08); backdrop-filter: blur(10px);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.4rem;
    }
    .btn-invest {
      display: flex; align-items: center; gap: 8px;
      background: linear-gradient(135deg, var(--nk-orange), var(--nk-orange-light));
      color: #fff; border: none; padding: 10px 22px; border-radius: 30px;
      font-weight: 700; font-size: .82rem; margin-top: 16px;
      opacity: 0; transform: translateY(10px);
      transition: all .4s .1s; cursor: pointer;
    }
    .project-card:hover .btn-invest { opacity: 1; transform: translateY(0); }

    /* Project BG images using gradient placeholders */
    .pb-immo { background: linear-gradient(135deg, #1a2d4a 0%, #0d3b6e 100%); }
    .pb-transport { background: linear-gradient(135deg, #1a2d1a 0%, #0d3b1a 100%); }
    .pb-piscine { background: linear-gradient(135deg, #0d2b3b 0%, #0a3a5c 100%); }
    .pb-art { background: linear-gradient(135deg, #3b1a2d 0%, #5c0a3b 100%); }
    .pb-ferme { background: linear-gradient(135deg, #1a3b1a 0%, #2d5c0a 100%); }
    .pb-bureau { background: linear-gradient(135deg, #1a1a3b 0%, #0a1a5c 100%); }

    /* ── PROCESS ── */
    .process-section { padding: 120px 0; }
    .process-line {
      position: absolute; top: 50%; left: 0; right: 0; height: 2px;
      background: linear-gradient(90deg, transparent, var(--nk-orange) 20%, var(--nk-orange) 80%, transparent);
    }
    .step-card {
      text-align: center; position: relative; z-index: 1;
    }
    .step-num {
      width: 70px; height: 70px; border-radius: 50%;
      background: var(--nk-blue); border: 3px solid var(--nk-orange);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 900;
      color: var(--nk-orange); margin: 0 auto 24px;
      position: relative; z-index: 2;
      box-shadow: 0 0 30px var(--nk-orange-glow);
      animation: stepGlow 3s ease-in-out infinite;
    }
    @keyframes stepGlow { 0%,100%{ box-shadow: 0 0 30px var(--nk-orange-glow); } 50%{ box-shadow: 0 0 60px rgba(255,107,26,.4); } }
    .step-card:nth-child(2) .step-num { animation-delay: -1s; }
    .step-card:nth-child(3) .step-num { animation-delay: -2s; }
    .step-card:nth-child(4) .step-num { animation-delay: -3s; }
    .step-card h5 { font-size: 1.1rem; font-weight: 700; margin-bottom: 10px; }
    .step-card p {font-size: .88rem; line-height: 1.7; }

    /* ── TESTIMONIALS ── */
    .testimonials-section { padding: 120px 0; background-color: ghostwhite; }
    .testi-card {
      background: var(--nk-blue); border: 1px solid var(--nk-border);
      border-radius: 24px; padding: 40px;
      position: relative; height: 100%;
      transition: all .4s;
    }
    .testi-card:hover { border-color: var(--nk-orange); transform: translateY(-8px); }
    .testi-card::before { content: '"'; font-family: 'Playfair Display', serif; font-size: 8rem; line-height: 1; color: var(--nk-orange); opacity: .12; position: absolute; top: 10px; left: 24px; }
    .testi-stars { color: var(--nk-gold); margin-bottom: 16px; letter-spacing: 3px; }
    .testi-text { font-size: .95rem; line-height: 1.8; color: rgba(255,255,255,.7); margin-bottom: 28px; position: relative; z-index: 1; }
    .testi-author { display: flex; align-items: center; gap: 14px; }
    .testi-avatar { width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, var(--nk-orange), var(--nk-blue-light)); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.1rem; }
    .testi-name { font-weight: 700; font-size: .9rem; color: #fff;}
    .testi-role { font-size: .78rem; color: rgba(255,255,255,.4); }

    /* ── FAQ ── */

    /* Why Invest Section */
        .nk-why-section {
            background: linear-gradient(180deg, transparent 0%, rgba(26, 54, 93, 0.1) 50%, transparent 100%);
        }

        .nk-why-card {
            background: var(--nk-card-bg);
            border: 1px solid rgba(237, 137, 54, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .nk-why-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(237, 137, 54, 0.05) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .nk-why-card:hover::before {
            opacity: 1;
        }

        .nk-why-card:hover {
            transform: translateY(-5px);
            border-color: var(--nk-accent);
        }

        .nk-why-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--nk-accent) 0%, var(--nk-accent-hover) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .nk-why-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: var(--nk-accent);
            border-radius: 16px;
            top: 5px;
            left: 5px;
            z-index: -1;
            opacity: 0.3;
        }

        .nk-why-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .nk-why-desc {
            color: black;
            line-height: 1.7;
        }

         /* Charts Section */
        .nk-charts-section {
            background: linear-gradient(180deg, rgba(26, 54, 93, 0.05) 0%, transparent 100%);
        }

        .nk-chart-card {
            background: var(--nk-card-bg);
            border: 1px solid rgba(237, 137, 54, 0.15);
            border-radius: 20px;
            padding: 2rem;
            height: 100%;
        }

        .nk-chart-card-title {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nk-chart-card-title i {
            color: var(--nk-accent);
        }

        .nk-bar-chart {
            display: flex;
            align-items: flex-end;
            gap: 1rem;
            height: 200px;
            padding-top: 1rem;
        }

        .nk-bar-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .nk-bar {
            width: 100%;
            background: linear-gradient(to top, var(--nk-accent), var(--nk-accent-hover));
            border-radius: 6px 6px 0 0;
            transition: height 1s ease;
            height: 0;
            position: relative;
        }

        .nk-bar::after {
            content: attr(data-value);
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--nk-accent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .nk-bar:hover::after {
            opacity: 1;
        }

        .nk-bar-label {
            font-size: 0.7rem;
            color: var(--nk-muted);
            text-align: center;
        }

        /* Donut Chart */
        .nk-donut-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .nk-donut-chart {
            position: relative;
            width: 200px;
            height: 200px;
        }

        .nk-donut-chart svg {
            transform: rotate(-90deg);
        }

        .nk-donut-segment {
            fill: none;
            stroke-width: 30;
            stroke-linecap: round;
        }

        .nk-donut-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .nk-donut-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--nk-accent);
        }

        .nk-donut-label {
            font-size: 0.75rem;
            color: var(--nk-muted);
        }

        .nk-donut-legend {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .nk-legend-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nk-legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }

        .nk-legend-text {
            font-size: 0.875rem;
            color: var(--nk-muted);
        }

        .nk-legend-value {
            font-weight: 600;
            color: var(--nk-light);
        }

    /* ── CTA SECTION ── */
    .cta-section {
      padding: 140px 0; position: relative; overflow: hidden;
    }
    .cta-bg {
      position: absolute; inset: 0;
      background:
        radial-gradient(ellipse 60% 60% at 50% 50%, rgba(255,107,26,.12) 0%, transparent 70%),
        radial-gradient(ellipse 30% 30% at 80% 20%, rgba(30,79,160,.2) 0%, transparent 50%);
    }
    .cta-content { position: relative; z-index: 1; text-align: center; }
    .cta-title { font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 900; line-height: 1.1; margin-bottom: 24px; }
    .cta-sub {font-size: 1.1rem; max-width: 550px; margin: 0 auto 50px; line-height: 1.8; }
    .cta-form {
      display: flex; gap: 0; max-width: 520px; margin: 0 auto;
      background: light; border: 1px solid var(--nk-border);
      border-radius: 50px; overflow: hidden; backdrop-filter: blur(10px);
    }
    .cta-input {
      flex: 1; background: none; border: none;
      padding: 18px 28px; color: #fff; font-size: .95rem; outline: none;
    }
    .cta-input::placeholder { color: rgba(255,255,255,.3); }
    .cta-submit {
      background: var(--nk-orange); color: #fff; border: none;
      padding: 14px 32px; font-weight: 700; cursor: pointer;
      font-size: .9rem; border-radius: 50px; margin: 4px;
      transition: all .3s; letter-spacing: .5px;
    }
    .cta-submit:hover { background: var(--nk-orange-light); box-shadow: 0 8px 30px var(--nk-orange-glow); }


    /* ── SCROLL REVEAL ── */
    .reveal { opacity: 0; transform: translateY(40px); transition: opacity .8s ease, transform .8s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    /* ── SCROLLBAR ── */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: var(--nk-blue); }
    ::-webkit-scrollbar-thumb { background: var(--nk-orange); border-radius: 3px; }

    /* ── TICKER ── */
    .ticker-wrap { overflow: hidden; background: rgba(255,107,26,.08); border-top: 1px solid rgba(255,107,26,.2); border-bottom: 1px solid rgba(255,107,26,.2); padding: 14px 0; }
    .ticker { display: flex; animation: tickerScroll 30s linear infinite; white-space: nowrap; }
    @keyframes tickerScroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
    .ticker-item { padding: 0 48px; font-size: .78rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--nk-orange); display: inline-flex; align-items: center; gap: 16px; }
    .ticker-item::after { content: '◆'; font-size: .5rem; }

    /* ── MODAL ── */
    .modal-content { background: var(--nk-blue-mid); border: 1px solid var(--nk-border); border-radius: 24px; }
    .modal-header { border-bottom: 1px solid var(--nk-border); padding: 24px 32px; }
    .modal-title { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 700; }
    .modal-body { padding: 32px; }
    .modal-footer { border-top: 1px solid var(--nk-border); padding: 20px 32px; }

    /* ── RESPONSIVE ── */
    @media(max-width:768px) {
      .hero-stats { gap: 28px; }
      .hero-visual { margin-top: 50px; }
      .perf-grid { grid-template-columns: 1fr; }
    }

    /* Number counter animation */
    .count-up { transition: all .1s; }
  </style>
</head>


<body>


@extends('layouts.app')

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
<div class="ticker-wrap"">
  <div class="ticker" id="tickerInner">
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
          <h1 class="hero-title">
            Construisez votre <span class="accent">Fortune</span><br>avec Nakayo
          </h1>
          <p class="hero-sub">
            Rejoignez une communauté d'investisseurs visionnaires qui font confiance à Nakayo pour transformer leur capital en richesse durable. Six secteurs. Des rendements exceptionnels. Un avenir radieux.
          </p>
          <div class="hero-cta">
             @php 
            $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? '22900000000'); 
        @endphp
            <a href="https://wa.me/{{ $whatsappClean }}" class="btn-primary-nk">Explorer les Projets <i class="fas fa-arrow-right ms-2"></i></a>
            <a href="https://wa.me/{{ $whatsappClean }}" class="btn-outline-nk" style="color: white !important;">
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
                  <span class="video-tag">Nakayo Invest 2025</span>
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
            <button class="btn-invest" onclick="openModal('Immobilier','Investissez dans des biens immobiliers de prestige avec des rendements locatifs garantis et une plus-value à la revente.','28','12')">
              <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </button>
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
            <button class="btn-invest" onclick="openModal('Transport & Logistique','Participez à l\'essor du commerce africain grâce à notre flotte moderne et nos solutions logistiques end-to-end.','22','6')">
              <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </button>
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
            <button class="btn-invest" onclick="openModal('Construction Piscine','Un marché luxueux en pleine expansion. Vos fonds alimentent des chantiers à forte marge avec une clientèle solvable.','35','8')">
              <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </button>
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
            <button class="btn-invest" onclick="openModal('Art & Mode','L\'Afrique dicte ses tendances au monde. Investissez dans la créativité africaine et capturez une part de ce marché en explosion.','40','9')">
              <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </button>
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
            <button class="btn-invest" onclick="openModal('Ferme Agricole','Investissez dans l\'avenir alimentaire de l\'Afrique. Des rendements stables, un impact social fort, et des terres qui prennent de la valeur.','18','12')">
              <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </button>
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
            <button class="btn-invest" onclick="openModal('Fourniture Bureautique','Un marché B2B stable et récurrent. Chaque bureau, chaque administration est un client potentiel dans un marché sous-équipé.','24','6')">
              <i class="fas fa-arrow-right"></i> Investir dans ce projet
            </button>
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
      <h2 class="section-title">Votre parcours vers<br><span style="color:var(--nk-orange)">la prospérité</span></h2>
      <p class="section-sub">Quatre étapes simples pour rejoindre la famille Nakayo et commencer à faire travailler votre capital.</p>
    </div>
    <div class="row g-4 position-relative reveal">
      <div class="col-lg-3 col-sm-6">
        <div class="step-card">
          <div class="step-num">01</div>
          <h5>Inscription Gratuite</h5>
          <p>Créez votre compte investisseur en 3 minutes. Aucun engagement, accès immédiat à tous nos projets et analyses.</p>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="step-card">
          <div class="step-num">02</div>
          <h5>Choisissez vos Projets</h5>
          <p>Explorez nos 6 secteurs, consultez les analyses détaillées, et sélectionnez les projets qui correspondent à vos objectifs.</p>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="step-card">
          <div class="step-num">03</div>
          <h5>Investissez en Toute Sécurité</h5>
          <p>Transférez votre capital via des canaux sécurisés. Un contrat clair protège votre investissement à chaque étape.</p>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="step-card">
          <div class="step-num">04</div>
          <h5>Percevez vos Rendements</h5>
          <p>Suivez la croissance de votre capital en temps réel et percevez vos rendements aux échéances convenues.</p>
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
    <div class="cta-content reveal text-center"> <!-- Ajout de text-center ici -->
      <div class="section-badge mx-auto">Rejoignez Nakayo</div> <!-- mx-auto pour centrer le badge -->
      
      <h2 class="cta-title">Votre capital mérite<br>mieux que la stagnation</h2>
      
      <p class="cta-sub mx-auto">Inscrivez-vous dès aujourd'hui et recevez notre guide exclusif des opportunités d'investissement 2025. Gratuit, sans engagement.</p>

      <!-- Bouton WhatsApp Centré -->
      <div class="d-flex justify-content-center mt-4">
        @php 
            $whatsappClean = preg_replace('/[^0-9]/', '', $settings->telephone_whatsapp ?? '22900000000'); 
        @endphp
        
        <a href="https://wa.me/{{ $whatsappClean }}?text=Bonjour, je souhaite recevoir le guide exclusif des opportunités d'investissement 2025." 
           target="_blank" 
           class="cta-submit d-inline-flex align-items-center justify-content-center gap-3" 
           style="text-decoration: none; min-width: 280px; height: 60px; border-radius: 15px;">
           <i class="fab fa-whatsapp" style="font-size: 1.5rem;"></i>
           <span>Démarrer sur WhatsApp</span>
           <i class="fas fa-arrow-right ms-2"></i>
        </a>
      </div>

      <p style="margin-top:20px;font-size:.78rem; color: rgba(255,255,255,0.6);">
        <i class="fas fa-lock me-2"></i>Vos données sont protégées. Discussion directe et sécurisée.
      </p>

      <!-- Badges de confiance -->
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
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
      <div class="modal-footer">
        <button type="button" style="background:none;border:1px solid var(--nk-border);color:#fff;padding:12px 24px;border-radius:30px;cursor:pointer;" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn-primary-nk">Confirmer l'Investissement <i class="fas fa-arrow-right ms-2"></i></button>
      </div>
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

</body>
</html>
