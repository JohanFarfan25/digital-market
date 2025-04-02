@extends('layouts.user_type.guest')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <!-- Contenedor central para el formulario de inicio de sesión -->
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-6">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Bienvenido</h3>
                                </div>
                                <!-- Logo en formato SVG -->
                                <div class="col-xl-4 col-lg-5 col-md-6 svg-logo-company">
                                    <svg viewBox="0 0 500 120" preserveAspectRatio="xMidYMid meet"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <text x="20" y="80" font-family="Arial, sans-serif" font-size="64"
                                            font-weight="bold" fill="rgb(23, 193, 232)">Digital</text>
                                        <text x="220" y="80" font-family="Arial, sans-serif" font-size="64"
                                            font-weight="bold" fill="#8392AB">Market</text>
                                        <text x="20" y="110" font-family="Arial, sans-serif" font-size="24" fill="#555">
                                            Optimizar, controlar y crecer
                                        </text>
                                        <circle cx="200" cy="60" r="10" fill="#8392AB" />
                                        <rect x="204" y="50" width="12" height="20" fill="#8392AB" />
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <!-- Formulario de inicio de sesión -->
                                    <form role="form" method="POST" action="/session">
                                        @csrf
                                        <label>Correo</label>
                                        <!-- Campo para el correo electrónico -->
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                            @error('email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Contraseña</label>
                                        <!-- Campo para la contraseña con opción de visibilidad -->
                                        <div class="mb-3 position-relative">
                                            <input type="password" class="form-control pe-5" name="password" id="password"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon">
                                            <span class="position-absolute end-0 top-50 translate-middle-y me-3"
                                                onclick="togglePassword()" style="cursor: pointer;">
                                                <i id="eyeIcon" class="fas fa-eye"></i>
                                            </span>
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <!-- Checkbox para recordar sesión -->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                            <label class="form-check-label" for="rememberMe">Recordar</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Iniciar
                                                sesión</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <!-- Enlace para restablecer contraseña -->
                                    <small class="text-muted">¿Olvidaste tu contraseña? Restablecer tu contraseña
                                        <a href="/login/contrasena-olvidada"
                                            class="text-info text-gradient font-weight-bold">aquí</a>
                                    </small>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <!-- Enlace para crear cuenta como invitado -->
                                    <a class="d-flex align-items-center me-2 active" aria-current="page"
                                        href="{{ url('crear-usuario-invitado') }}">
                                        <i class="fa fa-hand-point-right me-2 pointing-hand"></i>
                                        <i
                                            class="fa fa-user-plus opacity-6 me-1 {{ Request::is('crear-usuario-invitado') ? '' : 'text-dark' }}"></i>
                                        Crear cuenta como invitado
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Sección de imagen decorativa -->
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div
                                    class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Selecciona el elemento SVG en el documento
            const svg = document.querySelector('svg');
            // Selecciona todos los elementos de texto dentro del SVG
            const texts = svg.querySelectorAll('text');
            let maxX = 0;

            // Itera sobre cada elemento de texto para calcular la posición más a la derecha
            texts.forEach(text => {
                const bbox = text.getBBox(); // Obtiene las dimensiones del texto
                if (bbox.x + bbox.width > maxX) {
                    maxX = bbox.x + bbox.width; // Actualiza el valor máximo de X
                }
            });

            // Ajusta el viewBox del SVG para asegurar que todo el texto sea visible
            svg.setAttribute('viewBox', `0 0 ${maxX + 20} 120`);
        });

        /**
         * Función para alternar la visibilidad de la contraseña en un campo de entrada
         */
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eyeIcon")

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
@endsection
