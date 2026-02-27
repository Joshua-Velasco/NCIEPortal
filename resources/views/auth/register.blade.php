<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema NCIE</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
<script data-cfasync="false" nonce="846b6b5e-a579-467a-9627-ef47191d37fe">try{(function(w,d){!function(fv,fw,fx,fy){if(fv.zaraz)console.error("zaraz is loaded twice");else{fv[fx]=fv[fx]||{};fv[fx].executed=[];fv.zaraz={deferred:[],listeners:[]};fv.zaraz._v="5858";fv.zaraz._n="846b6b5e-a579-467a-9627-ef47191d37fe";fv.zaraz.q=[];fv.zaraz._f=function(fz){return async function(){var fA=Array.prototype.slice.call(arguments);fv.zaraz.q.push({m:fz,a:fA})}};for(const fB of["track","set","debug"])fv.zaraz[fB]=fv.zaraz._f(fB);fv.zaraz.init=()=>{var fC=fw.getElementsByTagName(fy)[0],fD=fw.createElement(fy),fE=fw.getElementsByTagName("title")[0];fE&&(fv[fx].t=fw.getElementsByTagName("title")[0].text);fv[fx].x=Math.random();fv[fx].w=fv.screen.width;fv[fx].h=fv.screen.height;fv[fx].j=fv.innerHeight;fv[fx].e=fv.innerWidth;fv[fx].l=fv.location.href;fv[fx].r=fw.referrer;fv[fx].k=fv.screen.colorDepth;fv[fx].n=fw.characterSet;fv[fx].o=(new Date).getTimezoneOffset();if(fv.dataLayer)for(const fF of Object.entries(Object.entries(dataLayer).reduce(((fG,fH)=>({...fG[1],...fH[1]})),{})))zaraz.set(fF[0],fF[1],{scope:"page"});fv[fx].q=[];for(;fv.zaraz.q.length;){const fI=fv.zaraz.q.shift();fv[fx].q.push(fI)}fD.defer=!0;for(const fJ of[localStorage,sessionStorage])Object.keys(fJ||{}).filter((fL=>fL.startsWith("_zaraz_"))).forEach((fK=>{try{fv[fx]["z_"+fK.slice(7)]=JSON.parse(fJ.getItem(fK))}catch{fv[fx]["z_"+fK.slice(7)]=fJ.getItem(fK)}}));fD.referrerPolicy="origin";fD.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(fv[fx])));fC.parentNode.insertBefore(fD,fC)};["complete","interactive"].includes(fw.readyState)?zaraz.init():fv.addEventListener("DOMContentLoaded",zaraz.init)}}(w,d,"zarazData","script");window.zaraz._p=async eC=>new Promise((eD=>{if(eC){eC.e&&eC.e.forEach((eE=>{try{const eF=d.querySelector("script[nonce]"),eG=eF?.nonce||eF?.getAttribute("nonce"),eH=d.createElement("script");eG&&(eH.nonce=eG);eH.innerHTML=eE;eH.onload=()=>{d.head.removeChild(eH)};d.head.appendChild(eH)}catch(eI){console.error(`Error executing script: ${eE}\n`,eI)}}));Promise.allSettled((eC.f||[]).map((eJ=>fetch(eJ[0],eJ[1]))))}eD()}));zaraz._p({"e":["(function(w,d){})(window,document)"]});})(window,document)}catch(e){throw fetch("/cdn-cgi/zaraz/t"),e;};</script></head>

<body class="hold-transition login-page"
style="background-image: url('{{url('assets/img/nodo.png')}}');
background-repeat: no repeat;
background-size: 100vw 100vh;
background-attachment: fixed">

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{url('')}}" class="h1"><b>NCIE</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><b>Registro de usuario</b></p>

        <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <label for="name" class="col-form-label text-md-end">{{ __('Nombre y Apellidos') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                 
                        <div class="row">
                            <label for="email" class="col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row">
                            <label for="password" class="col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                   
                        <div class="row">
                            <label for="password-confirm" class="col-form-label text-md-end">{{ __('Contraseña Verificación') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="icheck-primary">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">
                                Acepto los <a href="#" data-toggle="modal" data-target="#termsModal">Términos y Condiciones</a>
                            </label>
                            @error('terms')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>

                    <br>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- Paso 2: Modal de Términos y Condiciones -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Términos y Condiciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  style="max-height: 70vh; overflow-y: auto;">
        <h5>1. Aceptación de los Términos</h5>
        <p>Al acceder y utilizar este sitio web, propiedad del Nodo de Creatividad, Innovación Tecnológica y Emprendimiento (NCIE) de la
         Universidad del Instituto Tecnológico de Ciudad Juárez (ITCJ), usted ("Usuario") acepta los presentes Términos y Condiciones en su
         totalidad. Si no está de acuerdo con alguna parte de estos términos, deberá abstenerse de usar el sitio.</p>
        
        <h5>2. Uso del Servicio</h5>
        <p>El NCIE es una plataforma universitaria que ofrece:</p>
        <p>● Cursos de formación abiertos a estudiantes y público en general.</p>
        <p>● Registro de usuarios con acceso limitado según su rol (solo inscripción a cursos y visualización de sus actividades).</p>
        
        <h5>3. Registro de Usuarios</h5>
        <p>● Solo usuarios registrados podrán inscribirse a cursos disponibles.</p>
        <p>● Los datos proporcionados durante el registro deben ser verídicos y actualizados.</p>
        <p>● La cuenta es personal e intransferible; el Usuario es responsable de su uso.</p>
        
        <h5>4. Uso Adecuado de la Plataforma</h5>
        <p>El Usuario se compromete a:</p>
        <p>● No utilizar el sitio con fines ilegales o fraudulentos.</p>
        <p>● No compartir credenciales de acceso.</p>
        <p>● No alterar, copiar o distribuir contenido sin autorización.</p>

        <h5>5. Privacidad y Protección de Datos</h5>
        <p>El tratamiento de datos personales se rige conforme a la Ley Federal de Protección de Datos Personales. Al registrarse, el Usuario autoriza el uso de su información para:</p>
        <p>● Gestión de cursos.</p>
        <p>● Mejora de servicios.</p>
        <p>Puede ejercer sus derechos ARCO (Acceso, Rectificación, Cancelación y Oposición) enviando una solicitud a: ncie@itcj.edu.mx o ncie@cdjuarez.tecnm.mx.</p>

        <h5>6. Propiedad Intelectual</h5>
        <p>Todo el contenido (imágenes, logos) es propiedad del Tecnológico Nacional de México (TecNM) de la universidad del Instituto Tecnológico de Ciudad Juárez (ITCJ) campus 1. Queda prohibida su reproducción sin autorización.</p>

        <h5>Limitación de Responsabilidad</h5>
        <p>● El NCIE no garantiza la disponibilidad permanente del sitio.</p>
        <p>● No se responsabiliza por daños derivados del uso incorrecto de la plataforma.</p>
        <p>● Los cursos pueden estar sujetos a cambios de fechas o cancelaciones por causas ajenas al NCIE.</p>

        <h5>8. Modificaciones</h5>
        <p>Estos términos pueden actualizarse. Se notificará a los Usuarios por correo o mediante anuncios en el sitio.</p>

        <hr>
        
        <h5>Contacto</h5>
        <p>Para dudas sobre estos términos, escriba a: ncie@itcj.edu.mx o ncie@cdjuarez.tecnm.mx.</p>


  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js?v=3.2.0"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"957b13d92eff2b7b","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.6.2","token":"2437d112162f4ec4b63c3ca0eb38fb20"}' crossorigin="anonymous"></script>
</body>
</html>

