<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>NCIE | Nodo de Creatividad, Innovación y Emprendimiento</title>
  <meta name="description" content="NCIE — Plataforma académica del TecNM Campus Ciudad Juárez para el desarrollo de proyectos, formación tecnológica y vinculación empresa-academia.">
  <meta name="keywords" content="NCIE, innovación, emprendimiento, cursos tecnología, TecNM, Ciudad Juárez, IOT, inteligencia artificial, impresión 3D, manufactura">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <!-- Tailwind CSS (via Vite, tw- prefix) -->
  @vite(['resources/css/tailwind.css'])

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
</head>

<body class="index-page">

<header id="header" class="header sticky-top">

  <div class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="topbar-logos d-none d-lg-flex align-items-center gap-3">
        <img src="{{ asset('assets/img/sirma-educacion-logo1.png') }}" alt="SEP" class="img-fluid" style="max-height: 40px;">
        <img src="{{ asset('assets/img/sirma-educacion-logo2.png') }}" alt="TecNM" class="img-fluid" style="max-height: 40px;">
        <img src="{{ asset('assets/img/sirma-educacion-logo3.png') }}" alt="Gobierno" class="img-fluid" style="max-height: 40px;">
      </div>
      <div class="topbar-content d-flex flex-grow-1 flex-lg-grow-0 justify-content-center justify-content-lg-end align-items-center gap-4">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center">
            <a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a>
            <span class="mx-2 opacity-50">|</span>
            <a href="mailto:ncie@cdjuarez.tecnm.mx">ncie@cdjuarez.tecnm.mx</a>
          </i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="https://www.facebook.com/ncie.itcj" class="facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/ncie.itcj/" class="instagram" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-lg-4">
        <img src="{{ asset('assets/img/logo.png') }}" class="me-2 img-fluid" alt="Logo NCIE" style="max-height: 36px;">
        <h1 class="sitename">NCIE</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#inicio" class="active">Inicio</a></li>
          <li><a href="#about">Nosotros</a></li>
          <li><a href="#areas">Áreas</a></li>
          <li><a href="#gestores">Gestores</a></li>
          <li><a href="#galeria">Galería</a></li>
          <li><a href="#contact">Contacto</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="cta-btn" href="{{ url('login') }}">Ingresar</a>
    </div>
  </div>

</header>

<main class="main">

  <!-- Hero Section -->
  <section id="inicio" class="hero section">
    <img src="{{ asset('assets/img/nodo.png') }}" alt="NCIE" data-aos="fade-in">
    <div class="hero-overlay"></div>

    <!-- Animated gradient orbs -->
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="hero-orb hero-orb-3"></div>

    <div class="container position-relative">
      <div class="row align-items-center g-4 g-lg-5">

        <!-- Left: Content -->
        <div class="col-lg-6 hero-content-col" data-aos="fade-right" data-aos-delay="100">
          <h1>Arquitectos del Futuro.<br><span class="hero-highlight" id="hero-cycling-word">Emprende.</span></h1>
          <p class="hero-subtitle">
            El NCIE es tu espacio para desarrollar proyectos reales, adquirir habilidades tecnológicas de vanguardia y conectar con la industria.
          </p>
          <div class="hero-btns">
            <a href="{{ url('/register') }}" class="btn-hero-primary">
              <i class="bi bi-person-plus me-2"></i>Únete al NCIE
            </a>
          </div>
        </div>

        <!-- Right: Visual card -->
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="250">
          <div class="hero-visual">
            <div class="hero-ring hero-ring-1"></div>
            <div class="hero-ring hero-ring-2"></div>
            <div class="hero-visual-card">
              <img src="{{ asset('assets/img/nodo2.jpg') }}" alt="NCIE Instalaciones">
            </div>
            <div class="hero-chip hero-chip-1">
              <i class="bi bi-cpu-fill"></i> IoT
            </div>
            <div class="hero-chip hero-chip-2">
              <i class="bi bi-robot"></i> IA
            </div>
            <div class="hero-chip hero-chip-3">
              <i class="bi bi-printer-fill"></i> Impresión 3D
            </div>
            <div class="hero-chip hero-chip-4">
              <i class="bi bi-lightbulb-fill"></i> Innovación
            </div>
          </div>
        </div>

      </div>

    </div>

  </section>

  <!-- About Section -->
  <section id="about" class="about section animated-gradient bg-gradient-about">
    <div class="container">
      <div class="row gy-5 align-items-center">
        <div class="col-lg-5" data-aos="fade-right">
          <div class="about-image-wrapper">
            <img src="{{ asset('assets/img/nodo2.jpg') }}" class="img-fluid rounded-4 about-main-img" alt="NCIE Instalaciones">
            <div class="about-experience-badge">
              <span class="exp-number">8+</span>
              <span class="exp-text">Años de<br>Innovación</span>
            </div>
            <a href="{{ asset('assets/img/videonodo.mp4') }}" class="glightbox pulsating-play-btn">
              <i class="bi bi-play-fill"></i>
            </a>
          </div>

        </div>
        
        <div class="col-lg-7" data-aos="fade-left">
          <div class="about-content">
            <span class="section-badge">Sobre nosotros</span>
            <h2 class="display-5 fw-bold mt-3 mb-4">Un espacio para crear,<br><span class="text-accent">innovar y emprender</span></h2>
            <p class="lead text-muted mb-4">
              El Nodo de Creatividad, Innovación y Emprendimiento (NCIE) es el epicentro donde las ideas cobran vida. Somos una plataforma dual academia-empresa que impulsa el talento tecnológico hacia el mundo real.
            </p>

            <!-- Institutional Strengths moved to balance the layout -->
            <div class="row g-3 mt-5 about-strengths">
              <div class="col-md-6">
                <div class="strength-item d-flex align-items-center">
                  <div class="strength-icon bg-indigo-soft">
                    <i class="bi bi-building"></i>
                  </div>
                  <span class="strength-text">Programa Dual desde 2016</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="strength-item d-flex align-items-center">
                  <div class="strength-icon bg-cyan-soft">
                    <i class="bi bi-shield-check"></i>
                  </div>
                  <span class="strength-text">Infraestructura de vanguardia</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="strength-item d-flex align-items-center">
                  <div class="strength-icon bg-purple-soft">
                    <i class="bi bi-grid-3x3-gap"></i>
                  </div>
                  <span class="strength-text">7 Áreas Tecnológicas</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="strength-item d-flex align-items-center">
                  <div class="strength-icon bg-emerald-soft">
                    <i class="bi bi-briefcase"></i>
                  </div>
                  <span class="strength-text">Residencias y Servicio Social</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Innovation Pillars (The new additions) -->
      <div class="row g-4 mt-5 pt-3 about-pillars" data-aos="fade-up">
        <div class="col-lg-4 col-md-6">
          <div class="pillar-item h-100 p-4">
            <div class="pillar-icon bg-indigo mb-3 mx-auto mx-md-0">
              <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div class="pillar-text text-center text-md-start">
              <h4>Programas de Formación</h4>
              <p>Cursos de vanguardia técnica diseñados para la industria 4.0.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="pillar-item h-100 p-4">
            <div class="pillar-icon bg-cyan mb-3 mx-auto mx-md-0">
              <i class="bi bi-cpu-fill"></i>
            </div>
            <div class="pillar-text text-center text-md-start">
              <h4>Proyectos con Impacto</h4>
              <p>Desarrollamos soluciones tecnológicas reales para empresas locales.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="pillar-item h-100 p-4">
            <div class="pillar-icon bg-purple mb-3 mx-auto mx-md-0">
              <i class="bi bi-people-fill"></i>
            </div>
            <div class="pillar-text text-center text-md-start">
              <h4>Ecosistema Colaborativo</h4>
              <p>Una red dinámica de alumnos, académicos y sector empresarial.</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Areas Section -->
  <section id="areas" class="departments section animated-gradient bg-gradient-areas">
    <div class="container section-title" data-aos="fade-up">
      <h2>Áreas tecnológicas</h2>
      <p>Elige tu área de especialización y comienza a desarrollar tus habilidades</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-3">
          <ul class="nav nav-tabs flex-column">
            <li class="nav-item">
              <a class="nav-link active show" data-bs-toggle="tab" href="#departments-tab-1">
                <i class="bi bi-wifi me-2"></i>IOT
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-3">
                <i class="bi bi-robot me-2"></i>Inteligencia Artificial
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-5">
                <i class="bi bi-printer me-2"></i>Impresión 3D
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-6">
                <i class="bi bi-gear me-2"></i>Manufactura
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-7">
                <i class="bi bi-briefcase me-2"></i>Gestión Tecnológica
              </a>
            </li>
          </ul>
        </div>

        <div class="col-lg-9 mt-4 mt-lg-0">
          <div class="tab-content">

            <div class="tab-pane active show" id="departments-tab-1">
              <div class="details-header" data-aos="fade-up">
                <span class="section-badge-small">Área de Innovación</span>
                <h3>Internet de las Cosas (IOT)</h3>
                <p>Conectando dispositivos físicos al mundo digital para crear sistemas inteligentes y automatizados.</p>
              </div>
              <div class="row align-items-center gy-4">
                <div class="col-lg-7 details order-2 order-lg-1">
                  <div class="dept-features-grid">
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="100">
                      <div class="feature-icon bg-indigo-soft"><i class="bi bi-broadcast"></i></div>
                      <span class="feature-text">Monitoreo de condiciones</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="200">
                      <div class="feature-icon bg-cyan-soft"><i class="bi bi-cpu"></i></div>
                      <span class="feature-text">Diseño electrónico</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="300">
                      <div class="feature-icon bg-purple-soft"><i class="bi bi-pci-card"></i></div>
                      <span class="feature-text">Protocolos de comunicación</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="400">
                      <div class="feature-icon bg-emerald-soft"><i class="bi bi-node-plus"></i></div>
                      <span class="feature-text">Dispositivos IoT</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 text-center order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                  <div class="dept-img-wrapper">
                    <img src="{{ asset('assets/img/areaN-1.jpg') }}" alt="IOT" class="img-fluid dept-img">
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="departments-tab-3">
              <div class="details-header" data-aos="fade-up">
                <span class="section-badge-small">Área de Inteligencia Cognitiva</span>
                <h3>Inteligencia Artificial</h3>
                <p>Desarrollo de sistemas inteligentes, visión por computadora y soluciones de software avanzadas.</p>
              </div>
              <div class="row align-items-center gy-4">
                <div class="col-lg-7 details order-2 order-lg-1">
                  <div class="dept-features-grid">
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="100">
                      <div class="feature-icon bg-indigo-soft"><i class="bi bi-database-gear"></i></div>
                      <span class="feature-text">Análisis de Datos</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="200">
                      <div class="feature-icon bg-cyan-soft"><i class="bi bi-eye"></i></div>
                      <span class="feature-text">Visión por Computadora</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="300">
                      <div class="feature-icon bg-purple-soft"><i class="bi bi-code-slash"></i></div>
                      <span class="feature-text">Desarrollo de Software</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="400">
                      <div class="feature-icon bg-emerald-soft"><i class="bi bi-controller"></i></div>
                      <span class="feature-text">Desarrollo de Videojuegos</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="500">
                      <div class="feature-icon bg-indigo-soft"><i class="bi bi-unity"></i></div>
                      <span class="feature-text">Realidad Virtual y Aumentada</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 text-center order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                  <div class="dept-img-wrapper">
                    <img src="{{ asset('assets/img/areaN-3.jpg') }}" alt="IA" class="img-fluid dept-img">
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="departments-tab-5">
              <div class="details-header" data-aos="fade-up">
                <span class="section-badge-small">Área de Manufactura Aditiva</span>
                <h3>Impresión 3D</h3>
                <p>Prototipado rápido y fabricación aditiva para dar vida a tus ideas en el mundo físico.</p>
              </div>
              <div class="row align-items-center gy-4">
                <div class="col-lg-7 details order-2 order-lg-1">
                  <div class="dept-features-grid">
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="100">
                      <div class="feature-icon bg-indigo-soft"><i class="bi bi-printer"></i></div>
                      <span class="feature-text">Tecnologías de Impresión 3D</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="200">
                      <div class="feature-icon bg-cyan-soft"><i class="bi bi-bounding-box"></i></div>
                      <span class="feature-text">Diseño y modelado digital</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="300">
                      <div class="feature-icon bg-purple-soft"><i class="bi bi-lightning-charge"></i></div>
                      <span class="feature-text">Prototipado rápido</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="400">
                      <div class="feature-icon bg-emerald-soft"><i class="bi bi-hammer"></i></div>
                      <span class="feature-text">Maker & Fabricación</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 text-center order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                  <div class="dept-img-wrapper">
                    <img src="{{ asset('assets/img/areaN-5.jpg') }}" alt="Impresión 3D" class="img-fluid dept-img">
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="departments-tab-6">
              <div class="details-header" data-aos="fade-up">
                <span class="section-badge-small">Área de Producción Avanzada</span>
                <h3>Manufactura</h3>
                <p>Procesos de fabricación y manufactura avanzada integrando robótica y automatización industrial.</p>
              </div>
              <div class="row align-items-center gy-4">
                <div class="col-lg-7 details order-2 order-lg-1">
                  <div class="dept-features-grid">
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="100">
                      <div class="feature-icon bg-indigo-soft"><i class="bi bi-tools"></i></div>
                      <span class="feature-text">Retro Acondicionamiento</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="200">
                      <div class="feature-icon bg-cyan-soft"><i class="bi bi-layers"></i></div>
                      <span class="feature-text">Fabricación de Filamento</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="300">
                      <div class="feature-icon bg-purple-soft"><i class="bi bi-robot"></i></div>
                      <span class="feature-text">Robótica</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="400">
                      <div class="feature-icon bg-emerald-soft"><i class="bi bi-gear-wide-connected"></i></div>
                      <span class="feature-text">Procesos de Manufactura</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 text-center order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                  <div class="dept-img-wrapper">
                    <img src="{{ asset('assets/img/areaN-6.jpg') }}" alt="Manufactura" class="img-fluid dept-img">
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="departments-tab-7">
              <div class="details-header" data-aos="fade-up">
                <span class="section-badge-small">Área de Estrategia Digital</span>
                <h3>Gestión Tecnológica</h3>
                <p>Administración de proyectos tecnológicos y vinculación entre academia, empresa y sociedad.</p>
              </div>
              <div class="row align-items-center gy-4">
                <div class="col-lg-7 details order-2 order-lg-1">
                  <div class="dept-features-grid">
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="100">
                      <div class="feature-icon bg-indigo-soft"><i class="bi bi-brightness-high"></i></div>
                      <span class="feature-text">Asesoría técnica especializada</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="200">
                      <div class="feature-icon bg-cyan-soft"><i class="bi bi-clipboard-check"></i></div>
                      <span class="feature-text">Seguimiento de proyectos</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="300">
                      <div class="feature-icon bg-purple-soft"><i class="bi bi-bar-chart-steps"></i></div>
                      <span class="feature-text">Administración de recursos</span>
                    </div>
                    <div class="dept-feature-item" data-aos="fade-up" data-aos-delay="400">
                      <div class="feature-icon bg-emerald-soft"><i class="bi bi-house-gear"></i></div>
                      <span class="feature-text">Administración del Centro</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 text-center order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                  <div class="dept-img-wrapper">
                    <img src="{{ asset('assets/img/areaN-7.jpg') }}" alt="Gestión Tecnológica" class="img-fluid dept-img">
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gestores Section -->
  <section id="gestores" class="section animated-gradient bg-gradient-gestores">
    <div class="container section-title" data-aos="fade-up">
      <h2>Atención de gestores</h2>
      <p>Consulta la disponibilidad de nuestros gestores por área tecnológica</p>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="gestores-wrapper">
        <div class="gestores-controls-card px-4 py-4 mb-4" data-aos="fade-right">
          <div class="row align-items-end g-4">
            <div class="col-lg-8">
              <div class="d-flex align-items-center gap-3 mb-2">
                <div class="gestores-icon-badge">
                  <i class="bi bi-calendar-check"></i>
                </div>
                <h4 class="mb-0 fw-800 tracking-tight text-slate-900">Calendario de atención</h4>
              </div>
              <p class="text-muted small mb-0 ps-1">Consulta los horarios de disponibilidad de nuestros gestores especializados.</p>
            </div>
            <div class="col-lg-4">
              <div class="area-selector-group">
                <label for="area_select" class="form-label fs-12 fw-800 text-uppercase tracking-wider text-accent opacity-75 mb-2">Área Tecnológica</label>
                <div class="custom-select-wrapper">
                  <select name="area_id" id="area_select" class="form-select select-modern px-4 py-2">
                    @foreach($areas as $area)
                      <option value="{{ $area->id }}" {{ $area->id == $selectedAreaId ? 'selected' : '' }}>
                        {{ $area->nombre }}
                      </option>
                    @endforeach
                  </select>
                  <i class="bi bi-layers flex-shrink-0 select-icon"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="gestores-results-container">
          <div id="area_info" class="transition-all-area">
            <!-- Cargando... -->
            <div class="text-center py-5 gestor-loading d-none">
              <div class="spinner-border text-accent" role="status">
                <span class="visually-hidden">Cargando...</span>
              </div>
              <p class="mt-3 text-muted">Actualizando horarios...</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section id="galeria" class="gallery section animated-gradient bg-gradient-gallery">
    <div class="container section-title" data-aos="fade-up">
      <h2>Galería</h2>
      <p>Conoce nuestras instalaciones y proyectos en acción</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row g-4">
        @foreach(['galeria-1.jpg','galeria-2.jpg','galeria-3.jpg','galeria-4.jpg','galeria-5.jpg','galeria-6.jpg','galeria-7.jpg','galeria-8.jpg'] as $index => $img)
        <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="{{ 100 * ($index + 1) }}">
          <div class="gallery-item-enhanced group">
            <a href="{{ asset('assets/img/gallery/' . $img) }}" class="glightbox" data-gallery="images-gallery">
              <img src="{{ asset('assets/img/gallery/' . $img) }}" alt="NCIE Galería" class="img-fluid gallery-img">
              <div class="gallery-hover-overlay">
                <div class="overlay-details">
                  <div class="zoom-icon-circle">
                    <i class="bi bi-zoom-in"></i>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact section animated-gradient bg-gradient-contact">
    <div class="container section-title" data-aos="fade-up">
      <h2>Contáctanos</h2>
      <p>¿Tienes preguntas o sugerencias? Estamos aquí para ayudarte</p>
    </div>

    <div class="container mb-5" data-aos="fade-up" data-aos-delay="200">
      <div class="contact-map-container">
        <iframe style="border:0; width: 100%; height: 350px;"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3365.258715579593!2d-106.4239507!3d31.7200523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86e75dc249fd3e4b%3A0x58a769357165487b!2sTecNM%20-%20Campus%20Cd.%20Ju%C3%A1rez!5e0!3m2!1ses!2smx!4v1719762345678!5m2!1ses!2smx"
          allowfullscreen loading="lazy"></iframe>
      </div>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <div class="col-lg-4">
          <div class="contact-info-column d-flex flex-column gap-3">
            <div class="contact-card" data-aos="fade-up" data-aos-delay="300">
              <div class="contact-icon-box bg-indigo-soft">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="contact-details">
                <h3>Ubicación</h3>
                <p>Av. Tecnológico No. 1340 Fracc. El Crucero C.P. 32500<br>Ciudad Juárez, Chih. México</p>
              </div>
            </div>

            <div class="contact-card" data-aos="fade-up" data-aos-delay="400">
              <div class="contact-icon-box bg-cyan-soft">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="contact-details">
                <h3>Correo</h3>
                <p><a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a></p>
                <p><a href="mailto:ncie@cdjuarez.tecnm.mx">ncie@cdjuarez.tecnm.mx</a></p>
              </div>
            </div>

            <div class="contact-card" data-aos="fade-up" data-aos-delay="500">
              <div class="contact-icon-box bg-purple-soft">
                <i class="bi bi-share"></i>
              </div>
              <div class="contact-details">
                <h3>Redes Sociales</h3>
                <div class="social-links-minimal d-flex gap-2 mt-1">
                  <a href="https://www.facebook.com/ncie.itcj" target="_blank" class="fb"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/ncie.itcj/" target="_blank" class="ig"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="contact-form-wrapper" data-aos="fade-left" data-aos-delay="300">
            <form id="sugerenciaForm" method="POST" action="{{ route('sugerencias.send') }}" class="php-email-form">
              @csrf
              <div class="row gy-4">
                <div class="col-12 mb-2">
                  <h4 class="fw-bold text-slate-900 mb-1">Buzón de sugerencias</h4>
                  <p class="text-muted small">Tus comentarios nos ayudan a mejorar nuestro servicio.</p>
                </div>
                <div class="col-md-6">
                  <div class="input-group-premium">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingresa tu nombre" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group-premium">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="ejemplo@correo.com" required>
                  </div>
                </div>
                <div class="col-12">
                  <div class="input-group-premium">
                    <label class="form-label">Motivo / Asunto</label>
                    <input type="text" name="subject" class="form-control" placeholder="¿Sobre qué nos escribes?" required>
                  </div>
                </div>
                <div class="col-12">
                  <div class="input-group-premium">
                    <label class="form-label">Mensaje</label>
                    <textarea name="message" class="form-control" rows="5" placeholder="Cuéntanos más detalles..." required></textarea>
                  </div>
                </div>
                <div class="col-12 text-center">
                  <div id="form-messages" class="mt-2"></div>
                  <button type="submit" class="btn-submit-premium">
                    Enviar Sugerencia <i class="bi bi-send-fill ms-2"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<footer id="footer" class="footer">
  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-5 col-md-6 footer-about">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
          <span class="sitename">NCIE</span>
        </a>
        <div class="footer-contact pt-3">
          <p>Av. Tecnológico No. 1340 Fracc. El Crucero</p>
          <p>Ciudad Juárez, Chih. C.P. 32500, México</p>
          <p class="mt-3">
            <strong>Email:</strong>
            <a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a>
          </p>
        </div>
        <div class="social-links d-flex mt-4">
          <a href="https://www.facebook.com/ncie.itcj" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/ncie.itcj/" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Navegación</h4>
        <ul>
          <li><a href="#inicio">Inicio</a></li>
          <li><a href="#about">Nosotros</a></li>
          <li><a href="#areas">Áreas</a></li>
          <li><a href="#gestores">Gestores</a></li>
          <li><a href="#galeria">Galería</a></li>
          <li><a href="#contact">Contacto</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-12 footer-links">
        <h4>Acceso al sistema</h4>
        <ul>
          <li><a href="{{ url('/login') }}">Iniciar sesión</a></li>
          <li><a href="{{ url('/register') }}">Registrarse</a></li>
        </ul>
        <div class="footer-logos mt-4 d-flex align-items-center flex-wrap gap-2">
          <img src="{{ asset('assets/img/sirma-educacion-logo1.png') }}" alt="Logo 1" style="max-height: 28px; opacity: 0.5;">
          <img src="{{ asset('assets/img/sirma-educacion-logo2.png') }}" alt="Logo 2" style="max-height: 28px; opacity: 0.5;">
          <img src="{{ asset('assets/img/sirma-educacion-logo3.png') }}" alt="Logo 3" style="max-height: 28px; opacity: 0.5;">
        </div>
      </div>
    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© {{ date('Y') }} <strong>NCIE</strong> — TecNM Campus Ciudad Juárez. Todos los derechos reservados.</p>
  </div>
</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
  // Gestor area loader
  $(document).ready(function () {
    function cargarDatosArea() {
      var area_id = $('#area_select').val();
      if (area_id) {
        // Show loading state
        const $areaInfo = $('#area_info');
        $areaInfo.addClass('opacity-50');
        
        $.ajax({
          url: "{{ url('/areas/') }}" + '/' + area_id,
          type: 'GET',
          success: function (data) { 
            $areaInfo.html(data).removeClass('opacity-50'); 
          },
          error: function () {
            $areaInfo.html('<p class="text-danger mt-3">Error al cargar los datos del área.</p>').removeClass('opacity-50');
          }
        });
      } else {
        $('#area_info').html('');
      }
    }
    $('#area_select').on('change', cargarDatosArea);
    cargarDatosArea();
  });

  // Hero word cycling animation
  (function () {
    const words = ['Innova.', 'Crea.', 'Transforma.', 'Emprende.', 'Inspira.'];
    const el = document.getElementById('hero-cycling-word');
    if (!el) return;
    let index = 0;
    function cycleWord() {
      el.classList.add('hero-word-exit');
      setTimeout(function () {
        index = (index + 1) % words.length;
        el.textContent = words[index];
        el.classList.remove('hero-word-exit');
        el.classList.add('hero-word-enter');
        setTimeout(function () { el.classList.remove('hero-word-enter'); }, 500);
      }, 400);
    }
    setInterval(cycleWord, 3000);
  })();

  // Suggestion form AJAX
  document.getElementById('sugerenciaForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    const messagesDiv = document.getElementById('form-messages');
    messagesDiv.innerHTML = '';
    messagesDiv.className = 'mt-2';

    fetch(form.action, {
      method: 'POST',
      body: formData,
      headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        messagesDiv.className = 'alert alert-success mt-2';
        messagesDiv.textContent = data.message;
        form.reset();
      } else {
        messagesDiv.className = 'alert alert-danger mt-2';
        messagesDiv.textContent = data.message;
      }
    })
    .catch(() => {
      messagesDiv.className = 'alert alert-danger mt-2';
      messagesDiv.textContent = 'Ocurrió un error al enviar el mensaje.';
    });
  });
</script>

</body>
</html>
