<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NCIE · Nodo de Creatividad, Innovación y Emprendimiento | ITCJ</title>
  <meta name="description" content="Nodo de Creatividad, Innovación y Emprendimiento (NCIE) del Instituto Tecnológico de Ciudad Juárez (TecNM): cursos, proyectos reales y laboratorios de IoT, inteligencia artificial, impresión 3D, manufactura y energías renovables.">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('assets/img/logo.png') }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wdth,wght@0,62..125,100..900;1,62..125,100..900&display=swap" rel="stylesheet">

  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/ncie.css') }}" rel="stylesheet">
</head>

<body>
<div class="aurora" aria-hidden="true">
  <span class="aurora-layer aurora-1"></span>
  <span class="aurora-layer aurora-2"></span>
  <span class="aurora-layer aurora-3"></span>
  <span class="aurora-layer aurora-4"></span>
</div>
<a class="skip-link" href="#contenido">Ir al contenido</a>

<div class="topbar">
  <div class="container">
    <div class="topbar-contacts">
      <a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a>
      <a class="hide-xs" href="mailto:ncie@cdjuarez.tecnm.mx">ncie@cdjuarez.tecnm.mx</a>
      <span class="hide-sm">Av. Tecnológico 1340, Ciudad Juárez</span>
    </div>
    <div class="topbar-social">
      <a href="https://www.facebook.com/ncie.itcj" target="_blank" rel="noopener">Facebook</a>
      <a href="https://www.instagram.com/ncie.itcj/" target="_blank" rel="noopener">Instagram</a>
    </div>
  </div>
</div>

<header class="site-header">
  <div class="container">
    <a href="{{ url('/') }}" class="brand" aria-label="NCIE, ir al inicio">
      <img src="{{ asset('assets/img/logo.png') }}" alt="" width="36" height="36">
      <span>NCIE</span>
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="menu" aria-label="Abrir menú"><i class="bi bi-list"></i></button>

    <nav class="site-nav" id="menu" aria-label="Secciones del sitio">
      <a href="#nodo">El nodo</a>
      <a href="#areas">Áreas</a>
      <a href="#atencion">Atención</a>
      <a href="#proyectos">Proyectos</a>
      <a href="#galeria">Galería</a>
      <a href="#contacto">Contacto</a>
      <a href="#preguntas">Preguntas</a>
    </nav>

    <div class="header-actions">
      @auth
        <a class="btn btn-red" href="{{ url('/admin') }}">Mi panel</a>
      @else
        <a class="btn btn-text" href="{{ route('login') }}">Ingresar</a>
        <a class="btn btn-red" href="{{ route('register') }}">Crear cuenta</a>
      @endauth
    </div>
  </div>
</header>

<main id="contenido">

  <section class="hero" data-scene="1">
    <div class="container">
      <div>
        <h1>Donde las ideas del Tec se vuelven proyectos.</h1>
        <p class="hero-lead">El Nodo de Creatividad, Innovación y Emprendimiento abre sus laboratorios de IoT, inteligencia artificial, impresión 3D, manufactura y energías renovables a estudiantes y comunidad. Toma un curso, súmate a un proyecto real o ven a conocer el espacio.</p>
        <div class="hero-actions">
          @auth
            <a class="btn btn-red" href="{{ url('/admin') }}"><i class="bi bi-calendar-check"></i> Ver cursos disponibles</a>
          @else
            <a class="btn btn-red" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Crear cuenta para inscribirme</a>
          @endauth
        </div>
      </div>
      <figure class="hero-figure">
        <img src="{{ asset('assets/img/nodo.png') }}" alt="Instalaciones del NCIE" width="1200" height="630">
        <figcaption>Instalaciones del NCIE en el campus del ITCJ, detrás del laboratorio de Mecatrónica.</figcaption>
      </figure>
    </div>
  </section>

  <section class="section" id="participa" data-scene="2">
    <div class="container">
      <div class="section-head">
        <h2>Dos formas de participar</h2>
      </div>
      <div class="paths">
        <div class="path path--red">
          <div class="path-head">
            <span class="path-icon"><i class="bi bi-mortarboard" aria-hidden="true"></i></span>
            <span class="path-tag">Para todos</span>
          </div>
          <h3>Toma un curso</h3>
          <p>Cursos y talleres cortos y gratuitos que imparten los gestores en los laboratorios del nodo, para estudiantes del Tec y público en general.</p>
          <ul class="path-list">
            <li><i class="bi bi-check2" aria-hidden="true"></i><span>Calendario con los cursos abiertos, en tu panel</span></li>
            <li><i class="bi bi-check2" aria-hidden="true"></i><span>Inscripción con un clic y seguimiento de tus actividades</span></li>
            <li><i class="bi bi-check2" aria-hidden="true"></i><span>Avisos del nodo directamente en tu cuenta</span></li>
          </ul>
        </div>

        <div class="path path--blue">
          <div class="path-head">
            <span class="path-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
            <span class="path-tag">Para estudiantes del ITCJ</span>
          </div>
          <h3>Únete al equipo</h3>
          <p>Intégrate a un proyecto en curso y trabaja con un gestor de área y con empresas que plantean problemas reales.</p>
          <ul class="path-list">
            <li><i class="bi bi-check2" aria-hidden="true"></i><span>Impresión 3D, videojuegos, energías renovables, IoT y más</span></li>
            <li><i class="bi bi-check2" aria-hidden="true"></i><span>Acompañamiento de un gestor durante todo el proyecto</span></li>
            <li><i class="bi bi-check2" aria-hidden="true"></i><span>Infraestructura y equipo del nodo a tu disposición</span></li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="nodo" data-scene="2">
    <div class="container about">
      <figure class="about-media">
        <div class="video-frame" id="nodoFrame">
          <video id="nodoVideo" class="video" preload="none" playsinline width="640" height="352">
            <source src="{{ asset('assets/img/videonodo.mp4') }}" type="video/mp4">
            Tu navegador no puede reproducir este video. <a href="{{ asset('assets/img/videonodo.mp4') }}">Descárgalo</a>.
          </video>
          <img class="video-poster" src="{{ asset('assets/img/nodo2.jpg') }}" alt="" width="1600" height="1200" loading="lazy">
          <button type="button" class="video-play" id="nodoPlay" aria-label="Reproducir el video del nodo">
            <span class="play"><i class="bi bi-play-fill" aria-hidden="true"></i></span>
          </button>
        </div>
        <span class="video-hud" aria-hidden="true"></span>
      </figure>
      <div>
        <div class="section-head">
          <h2>Un centro para hacer proyectos reales</h2>
        </div>
        <p>El NCIE nació en 2016 como un programa dual entre academia y empresa: las compañías plantean problemas, los estudiantes los resuelven con acompañamiento de gestores y el nodo aporta la infraestructura. La meta es ser una plataforma autosuficiente de trabajo y aprendizaje para el Tec, y un recurso de desarrollo tecnológico para la ciudad.</p>
        <dl class="about-facts">
          <div><dt><i class="bi bi-calendar3" aria-hidden="true"></i>Fundación</dt><dd>2016, Instituto Tecnológico de Ciudad Juárez</dd></div>
          <div><dt><i class="bi bi-diagram-3" aria-hidden="true"></i>Modelo</dt><dd>Programa dual entre academia y empresa</dd></div>
          <div><dt><i class="bi bi-cpu" aria-hidden="true"></i>Áreas</dt><dd>{{ $areas->count() }} laboratorios y espacios de trabajo</dd></div>
          <div><dt><i class="bi bi-geo-alt" aria-hidden="true"></i>Ubicación</dt><dd>Campus ITCJ, detrás del laboratorio de Mecatrónica</dd></div>
        </dl>
      </div>
    </div>
  </section>

  <section class="section section-band" id="areas" data-scene="3">
    <div class="container">
      <div class="section-head">
        <h2>Áreas del nodo</h2>
        <p>Cada área tiene un gestor responsable, equipo propio y proyectos abiertos a estudiantes.</p>
      </div>
      @php
        $iconsFor = function ($nombre) {
          $n = mb_strtolower($nombre);
          return match (true) {
            str_contains($n, 'software') => ['bi-code-slash', 'bi-braces'],
            str_contains($n, 'inteligencia') => ['bi-robot', 'bi-robot'],
            str_contains($n, 'realidad') => ['bi-headset-vr', 'bi-headset-vr'],
            str_contains($n, 'impresi') => ['bi-printer', 'bi-box'],
            str_contains($n, 'manufactura') => ['bi-gear-wide-connected', 'bi-gear-fill'],
            str_contains($n, 'internet') || str_contains($n, 'iot') => ['bi-broadcast-pin', 'bi-wifi'],
            str_contains($n, 'energ') => ['bi-sun', 'bi-lightning-charge-fill'],
            str_contains($n, 'gesti') => ['bi-diagram-3', 'bi-diagram-3-fill'],
            default => ['bi-box', 'bi-boxes'],
          };
        };
      @endphp
      <div class="areas-grid">
        @forelse ($areas as $area)
          @php [$iconTile, $iconMark] = $iconsFor($area->nombre); @endphp
          <article class="slide">
            <span class="slide-ring" aria-hidden="true"></span>
            <i class="slide-watermark bi {{ $iconMark }}" aria-hidden="true"></i>
            <span class="slide-icon"><i class="bi {{ $iconTile }}" aria-hidden="true"></i></span>
            <div class="slide-body">
              <h3>{{ $area->nombre }}</h3>
              <p>{{ $area->descripcion }}</p>
            </div>
          </article>
        @empty
          <article class="slide"><div class="slide-body"><p>Todavía no hay áreas publicadas.</p></div></article>
        @endforelse
      </div>
    </div>
  </section>

  <section class="section" id="atencion" data-scene="3">
    <div class="container">
      <div class="section-head">
        <h2>Atención de gestores</h2>
        <p>Elige un área para ver los días y horas en que atiende su gestor.</p>
      </div>
      <div class="schedule-picker">
          <div class="field">
          <label for="area_select">Área</label>
          <select id="area_select" class="select" name="area_id">
            @foreach ($areas as $area)
              <option value="{{ $area->id }}" @selected($area->id == $selectedAreaId)>{{ $area->nombre }}</option>
            @endforeach
          </select>
        </div>
        </div>
      <div class="schedule" id="area_info" aria-live="polite">
        <p class="schedule-loading">Cargando horario…</p>
      </div>
      <p class="schedule-note"><i class="bi bi-info-circle" aria-hidden="true"></i><span>Los horarios pueden cambiar durante el semestre. Si tienes duda, escribe a <a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a>.</span></p>
    </div>
  </section>

  <section class="section" id="proyectos" data-scene="3">
    <div class="container">
      <div class="section-head">
        <h2>Proyectos en el nodo</h2>
        <p>Lo que hoy se construye en los laboratorios, con el área y el gestor que lo acompañan.</p>
      </div>
      @if ($proyectos->isEmpty())
        <p class="projects-empty">Todavía no hay proyectos publicados.</p>
      @else
        <div class="table-scroll projects-wrap glass">
          <table class="projects-table">
            <thead>
              <tr>
                <th scope="col" class="num">Nº</th>
                <th scope="col">Proyecto</th>
                <th scope="col">Descripción</th>
                <th scope="col">Área</th>
                <th scope="col">Gestor</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($proyectos as $proyecto)
                @php
                  $areasProyecto = $proyecto->gestores->flatMap(fn ($g) => $g->horarios->pluck('area.nombre'))->filter()->unique()->values();
                  $gestoresProyecto = $proyecto->gestores->map(fn ($g) => trim($g->nombres . ' ' . $g->apellidos))->filter()->unique()->values();
                @endphp
                <tr>
                  <td class="num">{{ $loop->iteration }}</td>
                  <th scope="row">{{ $proyecto->nombre }}</th>
                  <td class="desc">{{ $proyecto->descripcion }}</td>
                  <td>{{ $areasProyecto->isNotEmpty() ? $areasProyecto->join(', ', ' y ') : '—' }}</td>
                  <td>{{ $gestoresProyecto->isNotEmpty() ? $gestoresProyecto->join(', ', ' y ') : '—' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </section>

  <section class="section" id="galeria" data-scene="4">
    <div class="container">
      <div class="section-head">
        <h2>El espacio</h2>
      </div>
      <div class="gallery">
        @for ($i = 1; $i <= 8; $i++)
          <a href="{{ asset('assets/img/gallery/galeria-'.$i.'.jpg') }}" class="glightbox" data-gallery="nodo">
            <img src="{{ asset('assets/img/gallery/galeria-'.$i.'.jpg') }}" alt="Fotografía {{ $i }} del NCIE" loading="lazy" width="1080" height="1080">
          </a>
        @endfor
      </div>
    </div>
  </section>

  <section class="section section-band" id="contacto" data-scene="1">
    <div class="container">
      <div class="section-head">
        <h2>Contacto</h2>
      </div>
      <div class="contact">
        <div>
          <ul class="contact-list">
            <li>
              <i class="bi bi-geo-alt" aria-hidden="true"></i>
              <div><strong>Dirección</strong><p>Av. Tecnológico 1340, Fracc. El Crucero, C.P. 32500. Ciudad Juárez, Chihuahua.</p></div>
            </li>
            <li>
              <i class="bi bi-envelope" aria-hidden="true"></i>
              <div><strong>Correo</strong><p><a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a><br><a href="mailto:ncie@cdjuarez.tecnm.mx">ncie@cdjuarez.tecnm.mx</a></p></div>
            </li>
            <li>
              <i class="bi bi-share" aria-hidden="true"></i>
              <div><strong>Redes</strong><p><a href="https://www.facebook.com/ncie.itcj" target="_blank" rel="noopener">Facebook</a><br><a href="https://www.instagram.com/ncie.itcj/" target="_blank" rel="noopener">Instagram</a></p></div>
            </li>
          </ul>
          <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3365.258715579593!2d-106.4239507!3d31.7200523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86e75dc249fd3e4b%3A0x58a769357165487b!2sTecNM%20-%20Campus%20Cd.%20Ju%C3%A1rez!5e0!3m2!1ses!2smx!4v1719762345678!5m2!1ses!2smx" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Mapa del Instituto Tecnológico de Ciudad Juárez"></iframe>
          </div>
        </div>

        <form class="form" id="sugerenciaForm" method="POST" action="{{ route('sugerencias.send') }}">
          @csrf
          <h3>Buzón de sugerencias</h3>
          <p>Cuéntanos ideas, dudas o comentarios. Te respondemos al correo con el que te registraste.</p>
          <div class="form-grid">
            <div class="field">
              <label for="s-name">Nombre</label>
              <input class="input" id="s-name" name="name" type="text" required autocomplete="name">
            </div>
            <div class="field">
              <label for="s-email">Correo registrado</label>
              <input class="input" id="s-email" name="email" type="email" required autocomplete="email">
            </div>
            <div class="field span2">
              <label for="s-subject">Motivo</label>
              <input class="input" id="s-subject" name="subject" type="text" required>
            </div>
            <div class="field span2">
              <label for="s-message">Mensaje</label>
              <textarea class="textarea" id="s-message" name="message" required></textarea>
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-blue"><i class="bi bi-send"></i> Enviar mensaje</button>
            <div id="form-messages" class="notice" role="status"></div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <section class="section" id="preguntas" data-scene="4">
    <div class="container faq-intro">
      <div class="faq-side">
        <div class="section-head">
          <h2>Preguntas frecuentes</h2>
          <p>Lo que más nos preguntan sobre el nodo, los cursos y cómo participar.</p>
        </div>
        <p class="faq-help">¿Tu duda no está aquí? Escríbenos a <a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a> o usa el <a href="#contacto">buzón de sugerencias</a>.</p>
      </div>

      <div class="faq">
        <details open>
          <summary>¿Qué es el NCIE y desde cuándo existe? <i class="bi bi-chevron-down" aria-hidden="true"></i></summary>
          <div class="faq-body"><p>Es el Nodo de Creatividad, Innovación y Emprendimiento del Instituto Tecnológico de Ciudad Juárez. Nació en 2016 como un programa dual entre academia y empresa: las compañías plantean problemas reales y los estudiantes los resuelven con acompañamiento de gestores y la infraestructura del nodo.</p></div>
        </details>
        <details>
          <summary>¿Qué áreas de trabajo tiene? <i class="bi bi-chevron-down" aria-hidden="true"></i></summary>
          <div class="faq-body"><p>{{ $areas->pluck('nombre')->join(', ', ' y ') }}. Cada una tiene un gestor responsable y equipo propio.</p></div>
        </details>
        <details>
          <summary>¿Los cursos son solo para estudiantes del Tec? <i class="bi bi-chevron-down" aria-hidden="true"></i></summary>
          <div class="faq-body"><p>No. Los cursos y talleres son gratuitos y están abiertos a la comunidad. @if (config('ncie.email_verification')) Solo necesitas crear una cuenta y verificar tu correo para inscribirte. @else Solo necesitas crear una cuenta para inscribirte. @endif</p></div>
        </details>
        <details>
          <summary>¿Cómo me inscribo a un curso? <i class="bi bi-chevron-down" aria-hidden="true"></i></summary>
          <div class="faq-body"><p>@if (config('ncie.email_verification'))Crea tu cuenta, abre el enlace de verificación que llega a tu correo y entra a tu panel.@else Crea tu cuenta y entra a tu panel.@endif Ahí verás el calendario con los cursos disponibles y podrás inscribirte con un clic. @guest <a href="{{ route('register') }}">Crear cuenta</a>. @else <a href="{{ url('/admin') }}">Ir a mi panel</a>. @endguest</p></div>
        </details>
        <details>
          <summary>¿Qué son los proyectos con empresas? <i class="bi bi-chevron-down" aria-hidden="true"></i></summary>
          <div class="faq-body"><p>Son proyectos reales que una empresa plantea al nodo y que un equipo de estudiantes desarrolla con un gestor de área. Si estudias en el ITCJ y quieres integrarte a uno, escríbenos a <a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a> o visita el espacio en el horario de atención.</p></div>
        </details>
        <details>
          <summary>¿Dónde está el nodo y cuándo atienden? <i class="bi bi-chevron-down" aria-hidden="true"></i></summary>
          <div class="faq-body"><p>Dentro del campus del ITCJ, detrás del laboratorio de Mecatrónica. Cada área tiene su propio horario de atención; consúltalo por área en <a href="#atencion">Atención de gestores</a>.</p></div>
        </details>
      </div>
    </div>
  </section>

</main>

<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-about">
        <a href="{{ url('/') }}" class="brand">
          <img src="{{ asset('assets/img/logo.png') }}" alt="" width="40" height="40">
          <span>NCIE<small>Instituto Tecnológico de Ciudad Juárez</small></span>
        </a>
        <p>Nodo de Creatividad, Innovación y Emprendimiento del ITCJ, Tecnológico Nacional de México. Un espacio para aprender haciendo proyectos reales.</p>
      </div>
      <div>
        <h4>Secciones</h4>
        <ul>
          <li><a href="#nodo">El nodo</a></li>
          <li><a href="#areas">Áreas</a></li>
          <li><a href="#atencion">Atención de gestores</a></li>
          <li><a href="#proyectos">Proyectos</a></li>
          <li><a href="#galeria">Galería</a></li>
          <li><a href="#contacto">Contacto</a></li>
          <li><a href="#preguntas">Preguntas frecuentes</a></li>
        </ul>
      </div>
      <div>
        <h4>Contacto</h4>
        <p>Av. Tecnológico 1340, Fracc. El Crucero, C.P. 32500. Ciudad Juárez, Chihuahua.</p>
        <p><a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a></p>
        <p><a href="mailto:ncie@cdjuarez.tecnm.mx">ncie@cdjuarez.tecnm.mx</a></p>
        <p><a href="https://www.facebook.com/ncie.itcj" target="_blank" rel="noopener">Facebook</a> y <a href="https://www.instagram.com/ncie.itcj/" target="_blank" rel="noopener">Instagram</a></p>
      </div>
    </div>
    <div class="footer-partners">
      <img src="{{ asset('assets/img/sirma-educacion-logo1.png') }}" alt="Logo Educación">
      <img src="{{ asset('assets/img/sirma-educacion-logo2.png') }}" alt="Logo Institución">
      <img src="{{ asset('assets/img/sirma-educacion-logo3.png') }}" alt="Logo TecNM">
    </div>
    <p class="footer-bottom">© {{ date('Y') }} NCIE, Instituto Tecnológico de Ciudad Juárez.</p>
  </div>
</footer>

<a href="#contenido" class="to-top" id="toTop" aria-label="Volver arriba"><i class="bi bi-arrow-up" aria-hidden="true"></i></a>

<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script>
(function () {
  // Menú móvil
  var header = document.querySelector('.site-header');
  var toggle = document.querySelector('.nav-toggle');
  function closeMenu() {
    header.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Abrir menú');
    toggle.firstElementChild.className = 'bi bi-list';
  }
  toggle.addEventListener('click', function () {
    if (header.classList.contains('is-open')) { closeMenu(); return; }
    header.classList.add('is-open');
    toggle.setAttribute('aria-expanded', 'true');
    toggle.setAttribute('aria-label', 'Cerrar menú');
    toggle.firstElementChild.className = 'bi bi-x-lg';
  });
  header.querySelectorAll('.site-nav a').forEach(function (a) { a.addEventListener('click', closeMenu); });

  // Fondo que cambia de escena según la sección que está en el centro de la pantalla
  var root = document.documentElement;
  var sceneSections = document.querySelectorAll('[data-scene]');
  var navLinks = Array.prototype.slice.call(document.querySelectorAll('.site-nav a'));
  if ('IntersectionObserver' in window && sceneSections.length) {
    var sceneObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) {
          root.setAttribute('data-scene', en.target.getAttribute('data-scene'));
          var current = '#' + en.target.id;
          navLinks.forEach(function (a) { a.classList.toggle('is-active', a.getAttribute('href') === current); });
        }
      });
    }, { rootMargin: '-45% 0px -45% 0px', threshold: 0 });
    sceneSections.forEach(function (sec) { sceneObserver.observe(sec); });
  }
  // Progreso de scroll (0 a 1) para el leve desplazamiento de las auroras
  var ticking = false;
  function updateScroll() {
    var max = document.documentElement.scrollHeight - window.innerHeight;
    root.style.setProperty('--scroll', max > 0 ? (window.scrollY / max).toFixed(4) : 0);
    header.classList.toggle('is-scrolled', window.scrollY > 24);
    ticking = false;
  }
  window.addEventListener('scroll', function () {
    if (!ticking) { ticking = true; window.requestAnimationFrame(updateScroll); }
  }, { passive: true });
  updateScroll();

  // Botón para volver arriba: aparece al pasar la primera sección
  var toTop = document.getElementById('toTop');
  var hero = document.querySelector('.hero');
  if (toTop && hero && 'IntersectionObserver' in window) {
    new IntersectionObserver(function (entries) {
      toTop.classList.toggle('is-visible', !entries[0].isIntersecting);
    }, { rootMargin: '-80px 0px 0px 0px' }).observe(hero);
  }
  if (toTop) {
    toTop.addEventListener('click', function (e) {
      e.preventDefault();
      var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
    });
  }

  // Video del nodo: se reproduce en la misma sección
  var frame = document.getElementById('nodoFrame');
  var video = document.getElementById('nodoVideo');
  var playBtn = document.getElementById('nodoPlay');
  if (frame && video && playBtn) {
    playBtn.addEventListener('click', function () {
      frame.classList.add('is-playing');
      video.controls = true;
      video.play();
    });
    video.addEventListener('ended', function () {
      video.controls = false;
      video.currentTime = 0;
      frame.classList.remove('is-playing');
    });
  }

  // Preguntas frecuentes: apertura animada, una a la vez
  var faqItems = Array.prototype.slice.call(document.querySelectorAll('.faq details'));
  var faqReduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  function faqClose(d) {
    var body = d.querySelector('.faq-body');
    if (!d.open) { return; }
    if (faqReduce) { d.open = false; return; }
    body.style.height = body.scrollHeight + 'px';
    window.requestAnimationFrame(function () { body.style.height = '0px'; });
    var done = function () { body.removeEventListener('transitionend', done); d.open = false; body.style.height = ''; };
    body.addEventListener('transitionend', done);
  }
  function faqOpen(d) {
    var body = d.querySelector('.faq-body');
    if (d.open) { return; }
    if (faqReduce) { d.open = true; return; }
    d.open = true;
    var target = body.scrollHeight;
    body.style.height = '0px';
    window.requestAnimationFrame(function () { body.style.height = target + 'px'; });
    var done = function () { body.removeEventListener('transitionend', done); body.style.height = ''; };
    body.addEventListener('transitionend', done);
  }
  faqItems.forEach(function (d) {
    var summary = d.querySelector('summary');
    if (!summary) { return; }
    summary.addEventListener('click', function (e) {
      e.preventDefault();
      if (d.open) { faqClose(d); return; }
      faqItems.forEach(function (o) { if (o !== d) { faqClose(o); } });
      faqOpen(d);
    });
  });

  // Galería
  if (window.GLightbox) { GLightbox({ selector: '.glightbox', touchNavigation: true, loop: true }); }

  // Horario de atención por área
  var select = document.getElementById('area_select');
  var info = document.getElementById('area_info');
  var loadToken = 0;
  function loadArea() {
    if (!select.value) { info.innerHTML = ''; return; }
    var token = ++loadToken;
    var url = '{{ url('/areas') }}/' + encodeURIComponent(select.value);
    info.innerHTML = '<p class="schedule-loading">Cargando horario…</p>';

    function request(attempt) {
      var controller = ('AbortController' in window) ? new AbortController() : null;
      var timer = window.setTimeout(function () { if (controller) { controller.abort(); } }, 6000);
      return fetch(url + (attempt > 1 ? '?r=' + Date.now() : ''), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        cache: 'no-store',
        signal: controller ? controller.signal : undefined
      })
        .then(function (r) { if (!r.ok) { throw new Error(r.status); } return r.text(); })
        .then(function (html) { window.clearTimeout(timer); return html; })
        .catch(function (err) {
          window.clearTimeout(timer);
          if (attempt < 2) { return request(attempt + 1); }
          throw err;
        });
    }

    request(1)
      .then(function (html) {
        if (token !== loadToken) { return; } // llegó tarde: ya se eligió otra área
        info.innerHTML = html;
      })
      .catch(function () {
        if (token !== loadToken) { return; }
        info.innerHTML = '<div class="schedule-empty"><i class="bi bi-wifi-off" aria-hidden="true"></i><p>No pudimos cargar el horario.</p><button type="button" class="btn btn-glass" id="retryArea">Reintentar</button></div>';
        var retry = document.getElementById('retryArea');
        if (retry) { retry.addEventListener('click', loadArea); }
      });
  }
  select.addEventListener('change', loadArea);
  loadArea();

  // Buzón de sugerencias
  var form = document.getElementById('sugerenciaForm');
  var msg = document.getElementById('form-messages');
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var btn = form.querySelector('button[type=submit]');
    btn.disabled = true;
    msg.className = 'notice';
    msg.textContent = '';
    fetch(form.action, {
      method: 'POST',
      body: new FormData(form),
      headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
      .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, d: d }; }); })
      .then(function (res) {
        var ok = res.ok && res.d.success;
        msg.className = 'notice ' + (ok ? 'is-ok' : 'is-bad');
        msg.textContent = res.d.message || (ok ? 'Mensaje enviado.' : 'No se pudo enviar el mensaje.');
        if (ok) { form.reset(); }
      })
      .catch(function () {
        msg.className = 'notice is-bad';
        msg.textContent = 'No se pudo enviar el mensaje. Revisa tu conexión e intenta de nuevo.';
      })
      .then(function () { btn.disabled = false; });
  });
})();
</script>
</body>
</html>
