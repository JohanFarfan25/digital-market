@extends('layouts.user_type.guest')
@section('content')
    <div class="page-header section-height-75">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-body pt-4 p-6 mt-5">
                    <div  class="col-xl-4 col-lg-5 col-md-6 svg-logo-company">
                        <svg viewBox="0 0 500 120" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
                            <text x="20" y="80" font-family="Arial, sans-serif" font-size="64" font-weight="bold"
                                fill="rgb(23, 193, 232)">
                                Digital
                            </text>
                            <text x="220" y="80" font-family="Arial, sans-serif" font-size="64" font-weight="bold"
                                fill="#8392AB">
                                Market
                            </text>
                            <text x="20" y="110" font-family="Arial, sans-serif" font-size="24" fill="#555">
                                Optimizar, controlar y crecer
                            </text>
                            <circle cx="200" cy="60" r="10" fill="#8392AB" />
                            <rect x="204" y="50" width="12" height="20" fill="#8392AB" />
                        </svg>
                    </div>
                    <div class="mt-3">
                        <form action="/crear-usuario-invitado" method="POST" enctype="multipart/form-data"
                            role="form text-left">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Input para el Nombre-->
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">{{ __('Nombre') }}</label>
                                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                            <input type="text" class="form-control" placeholder="Name" name="name"
                                                id="name" aria-label="Name" aria-describedby="name" required>
                                            @error('name')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Input para el Correo-->
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">{{ __('Correo') }}</label>
                                        <div class="@error('email')border border-danger rounded-3 @enderror">
                                            <input type="email" class="form-control" placeholder="Email" name="email"
                                                id="email" aria-label="Email" aria-describedby="email-addon" required>
                                            @error('email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Input para el Teléfono-->
                                    <div class="form-group">
                                        <label for="user.phone" class="form-control-label">{{ __('Teléfono') }}</label>
                                        <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="tel" placeholder="000-000-0000"
                                                id="number" name="phone" required>
                                            @error('phone')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- Input para el Dirección-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user.location" class="form-control-label">{{ __('Dirección') }}</label>
                                        <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="text" placeholder="Location" id="name"
                                                name="location" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Input para el Contraseña -->
                                    <div class="form-group">
                                        <label for="user.password" class="form-control-label">{{ __('Contraseña') }}</label>
                                        <div class="@error('user.password')border border-danger rounded-3 @enderror">
                                            <input type="password" class="form-control" placeholder="Password"
                                                name="password" id="password" aria-label="Password"
                                                aria-describedby="password-addon" required>
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4 mb-4">
                                <a href="/login" class="btn bg-gradient-secondary btn-md">Iniciar Sesión</a>
                                <button type="submit" class="btn bg-gradient-info btn-md">Crear Cuenta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6">
                </div>
            </div>
        </div>
    </div>
    <script>
        //SECCIÓN PARA LAS RESPUESTAS SWAL ***********************
        @if (isset($response))

            let result = @json($response);

            if (result) {
                Swal.fire({
                    title: result?.status == 'error' ? 'Ups!' : 'En Hora Buena!',
                    icon: result?.status == 'error' ? 'error' : 'success',
                    text: result?.message,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        @endif
    </script>
@endsection
