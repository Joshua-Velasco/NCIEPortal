<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sistema NCIE</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>

</head>

<body class="index-page">

<header id="header" class="header sticky-top">
    
    <style>
        .logo {
  margin-right: 0 !important;
  justify-content: flex-start !important;
}

.sitename {
  margin-right: 1rem;
}

/* Asegura que el botón sea visible en móviles */
.cta-btn {
  display: inline-block !important; /* Sobreescribe el d-none d-sm-block */
  margin-left: auto;
  padding: 0.5rem 1rem;
}

/* Ajustes para pantallas pequeñas */
@media (max-width: 992px) {
  .logo {
    flex-wrap: wrap;
  }
  
  .cta-btn {
    order: 3; /* Coloca el botón después del menú */
    margin-left: 1rem;
  }
  
  .navmenu {
    order: 2;
  }
}

/* Opcional: ajusta el espaciado entre logos en móviles */
@media (max-width: 768px) {
  .logo img {
    margin-left: 0.5rem !important;
    margin-right: 0.5rem !important;
  }
}
    </style>

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a >ncie@itcj.edu.mx o ncie@cdjuarez.tecnm.mx</a></i>
         <!-- <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>-->
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="https://www.facebook.com/ncie.itcj" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/ncie.itcj/" class="instagram"><i class="bi bi-instagram"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

   <div class="branding d-flex align-items-center">
  <div class="container position-relative d-flex align-items-center justify-content-between">
    <a href="{{url('/')}}" class="logo d-flex align-items-center me-auto me-lg-4" style="margin-right: 0!important;">
      <h1 class="sitename">NCIE</h1>
      <img src="{{ asset('assets/img/logo.png') }}" class="mx-3 my-1 img-fluid" alt="Logo Educación" style="max-height: 35px;">
      <img src="{{ asset('assets/img/sirma-educacion-logo1.png') }}" class="mx-3 my-1 img-fluid" alt="Logo Educación" style="max-height: 35px;">
      <img src="{{ asset('assets/img/sirma-educacion-logo2.png') }}" class="mx-3 my-1 img-fluid" alt="Logo Institución" style="max-height: 35px;">
      <img src="{{ asset('assets/img/sirma-educacion-logo3.png') }}" class="mx-3 my-1 img-fluid" alt="Logo Partner" style="max-height: 35px;">
    </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#inicio" class="active">Inicio<br></a></li>
            <li><a href="#about">Sobre nosotros</a></li>
            <li><a href="#areas">Áreas</a></li>
            <li><a href="#gestores">Atención de gestores</a></li>
            <li><a href="#galeria">Galería</a></li>
            <li><a href="#contact">Contacto</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

           <a class="cta-btn" href="{{url('login')}}">Ingresar</a>

      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="inicio" class="hero section light-background">

      <img src="assets/img/nodo.png" alt="" data-aos="fade-in">

      <div class="container position-relative">

        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
    <h2 style="color: black; text-shadow: 2px 2px 4px rgba(255,255,255,0.8);">
        Bienvenido al Nodo de Creatividad, Innovación y Emprendimiento
    </h2>
</div>

        <div class="content row gy-4">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
              <h3>¡Inscríbete en los cursos del NCIE y amplía tus conocimientos!</h3>
              <p>
                El NCIE te invita a formar parte de su nueva oferta de cursos diseñados para impulsar tu desarrollo académico y profesional.
              </p>
              <p>
                  Registrate en nuestro sitio web para tener acceso al calendario en donde se visualizaran los cursos que haya disponibles y poder registrate a ellos.
              </p>
              <div class="text-center">
                <a href="{{url('/admin')}}" class="more-btn"><span>Regístrate aquí </span> <i class="bi bi-chevron-right"></i></a>
              </div>
            </div>
          </div><!-- End Why Box -->
          
          
          
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
              <h3>¡Se parte del NCIE!</h3>
              <p>
                NCIE TE INVITA:
              </p>
              <p>
                  A pertenecer a nuestro equipo, donde puedes echar a volar tu imaginación con Impresión 3D, área de videojuegos, energías renovables y más.
              </p>
              <p>
                  Visita nuestras instalaciones, nos encontramos atrás del laboratorio de Mecatrónica.
              </p>
              <p>
                  Para más información, contáctanos en ncie@itcj.edu.mx o ncie@cdjuarez.tecnm.mx
              </p>
             
            </div>
          </div><
          
          
          

        
        </div><!-- End  Content-->
        
       

      </div>

    </section><!-- /Hero Section -->


    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4 gx-5">

          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/img/nodo2.jpg" class="img-fluid" alt="">
            <a href="assets/img/videonodo.mp4" class="glightbox pulsating-play-btn"></a>
          </div>

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <h3>Sobre nosotros</h3>
            <p>
              El Nodo de Creatividad, Innovación y Emprendimiento (NCIE) es un centro para el desarrollo de proyectos “reales” a través de un programa dual academia-empresa basado en la creación de infraestructura para soportarlos, el cual fue fundado alrededor del año 2016. El objetivo es ser una plataforma de trabajo y aprendizaje autosuficiente para el mundo académico, así como un recurso de desarrollo tecnológico para toda la sociedad. Las áreas que lo conforman son: desarrollo de software, inteligencia artificial, realidad aumentada, impresión 3D, manufactura, internet de las cosas y energías renovables.
            </p>

          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    

    

  

    <!-- Departments Section -->
    <section id="areas" class="departments section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Áreas</h2>
      
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#departments-tab-1">IOT</a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-3">Inteligencia Artificial</a>
              </li>
           
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-5">Impresión 3D</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-6">Manufactura</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-7">Gestión Tecnológica</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="departments-tab-1">
                <div class="row">
                  <div class="col-lg-4 details order-2 order-lg-1">
                    <h3>IOT</h3>
                    <p class="fst-italic"></p>
                    <p> VECTORES DE 
                        TECNOLOGÍA: <br>
                        •Monitoreo de condiciones <br>
                        •Diseño electrónico <br>
                        •Protocolos de 
                        comunicación <br>
                        •Dispositivos IoT</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/areaN-1.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-3">
                <div class="row">
                  <div class="col-lg-4 details order-2 order-lg-1">
                    <h3>Inteligencia Artificial</h3>
                    <p class="fst-italic"></p>
                    <p> VECTORES DE 
                        TECNOLOGÍA: <br> 
                        •Análisis de Datos <br>
                        •Visión por Computadora <br>
                        •Desarrollo de Software <br>
                        •Desarrollo de Videojuegos <br>
                        •Realidad Virtual y 
                        Aumentada</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/areaN-3.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="departments-tab-5">
                <div class="row">
                  <div class="col-lg-4 details order-2 order-lg-1">
                    <h3>Impresión 3D</h3>
                    <p class="fst-italic"></p>
                    <p>VECTORES DE 
                        TECNOLOGÍA: <br>
                        •Tecnologías de Impresión 3D  <br>
                        •Diseño <br>
                        •Prototipado <br>
                        •Maker Impresión 3D</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/areaN-5.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
               <div class="tab-pane" id="departments-tab-6">
                <div class="row">
                  <div class="col-lg-4 details order-2 order-lg-1">
                    <h3>Manufactura</h3>
                    <p class="fst-italic"></p>
                    <p>VECTORES DE 
                      TECNOLOGÍA: <br>
                      •Retro Acondicionamiento <br>
                      •Fabricación de Filamento <br>
                      •Robótica <br>
                      •Procesos Manufactura</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/areaN-6.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
               <div class="tab-pane" id="departments-tab-7">
                <div class="row">
                  <div class="col-lg-4 details order-2 order-lg-1">
                    <h3>Gestión Tecnológica</h3>
                    <p class="fst-italic"></p>
                    <p>
                      USOS DEL ESPACIO: <br>
                      •Asesoría <br>
                      •Seguimiento de 
                      proyectos <br>
                      •Administración de 
                      recursos <br>
                      •Administración del Centro
                    </p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/areaN-7.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Departments Section -->




<br> <br>
 <section id="gestores" class="about section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                   <div class="row">
                    <div class="col-md-6"> <h3 class="card-title">Calendario de atención de gestores</h3> </div>
                    <div class="col-md-6"> 
                            <label for="">Área</label>
                            <select name="area_id" id="area_select" class="form-control">
                               <!-- <option value="">Seleccione un area...</option> -->
                                @foreach($areas as $area)
                                <option value="{{$area->id}}" {{$area->id == $selectedAreaId ? 'selected' : ''}}>
                                    {{$area->nombre}}
                                </option>
                                @endforeach
                            </select>
                    </div>
                   </div>
                 </div>

<div class="card-body">
                
                    <script>
                        $(document).ready(function() {
                            // Función para cargar los datos del área
                            function cargarDatosArea() {
                                var area_id = $('#area_select').val();
                               

                                if(area_id) {
                                    $.ajax({
                                    url: "{{url('/areas/')}}" + '/' + area_id,
                                        type: 'GET',
                                        success: function(data) {
                                            $('#area_info').html(data);
                                        },
                                        error: function() {
                                            alert('Error al obtener los datos del área');
                                        }
                                    });
                                } else {
                                    $('#area_info').html('');
                                }
                            }

                            // Cargar datos al cambiar el select
                            $('#area_select').on('change', cargarDatosArea);

                            // Cargar datos automáticamente al entrar a la página
                            cargarDatosArea();
                        });
                    </script>
                            <hr>   
                        <div id="area_info">

                        </div>
    </div>
             

</div>
            </div>
        </div>
    </div>
</section>

    <!-- Gallery Section -->
    <section id="galeria" class="gallery section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Galería</h2>
      
      </div><!-- End Section Title -->

<style>
  .gallery-item {
    height: 250px; /* ajusta esta altura según necesites */
    overflow: hidden;
    margin-bottom: 15px; /* espacio entre imágenes */
  }
  
  .gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease; /* efecto hover opcional */
  }
  
  .gallery-item:hover img {
    transform: scale(1.05); /* efecto zoom al pasar el mouse */
  }
</style>
      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/galeria-1.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/galeria-1.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/galeria-2.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/galeria-2.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/galeria-3.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/galeria-3.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/galeria-4.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/galeria-4.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/galeria-5.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/galeria-5.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/galeria-6.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/galeria-6.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/galeria-7.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/galeria-7.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/galeria-8.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/galeria-8.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

        </div>

      </div>

    </section><!-- /Gallery Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contáctanos</h2>
       
      </div><!-- End Section Title -->

      <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3365.258715579593!2d-106.4239507!3d31.7200523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86e75dc249fd3e4b%3A0x58a769357165487b!2sTecNM%20-%20Campus%20Cd.%20Ju%C3%A1rez!5e0!3m2!1ses!2smx!4v1719762345678!5m2!1ses!2smx"></iframe>
      </div><!-- End Google Maps -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Ubicación</h3>
                <p>Av. Tecnológico No. 1340 Fracc. El Crucero C.P. 32500 Ciudad Juárez, Chih. México</p>
              </div>
            </div><!-- End Info Item -->


            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Correo</h3>
                <p>ncie@itcj.edu.mx</p>
                <p>ncie@cdjuarez.tecnm.mx</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
    <form id="sugerenciaForm" method="POST" action="{{ route('sugerencias.send') }}">
    @csrf
    <div class="row gy-4">
        <h2>Buzón de sugerencias</h2>
        
        <!-- Campos del formulario -->
        <div class="col-md-6">
            <input type="text" name="name" class="form-control" placeholder="Nombre" required>
        </div>

        <div class="col-md-6">
            <input type="email" name="email" class="form-control" placeholder="Correo" required>
        </div>

        <div class="col-md-12">
            <input type="text" name="subject" class="form-control" placeholder="Motivo" required>
        </div>

        <div class="col-md-12">
            <textarea name="message" class="form-control" rows="6" placeholder="Mensaje" required></textarea>
        </div>

        <div class="col-md-12 text-center">
           <div id="form-messages" class="mt-3"></div>

            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
        </div>
    </div>
</form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">NCIE</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Av. Tecnológico No. 1340 Fracc. El Crucero C.P. 32500</p>
            <p>Ciudad Juárez, Chih. México</p>
            <p><strong>Email:</strong> <span>ncie@itcj.edu.mx</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href="https://www.facebook.com/ncie.itcj"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/ncie.itcj/"><i class="bi bi-instagram"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

 

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

<script>
document.getElementById('sugerenciaForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const messagesDiv = document.getElementById('form-messages');
    
    // Limpiar mensajes anteriores
    messagesDiv.innerHTML = '';
    messagesDiv.className = 'mt-3';
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messagesDiv.className = 'alert alert-success mt-3';
            messagesDiv.textContent = data.message;
            form.reset();
        } else {
            messagesDiv.className = 'alert alert-danger mt-3';
            messagesDiv.textContent = data.message;
        }
    })
    .catch(error => {
        messagesDiv.className = 'alert alert-danger mt-3';
        messagesDiv.textContent = 'Ocurrió un error al enviar el mensaje.';
    });
});

</script>

</body>

</html>