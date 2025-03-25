@extends('layouts.user_type.guest')

@section('content')
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8">
                        @if ($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ $errors->first() }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                role="alert">
                                <span class="alert-text text-white">
                                    {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <div class="card-header pb-0 text-left bg-transparent">
                            <h4 class="mb-0">¿Olvidaste tu contraseña? Ingresa tu email aquí</h4>
                        </div>
                        <div class="card-body">

                            <form action="/contrasena-olvidada" method="POST" role="form text-left">
                                @csrf
                                <div>
                                    <label for="email">Correo</label>
                                    <div class="">
                                        <input id="email" name="email" type="email" class="form-control"
                                            placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Recupera tu
                                        contraseña</button>
                                </div>
                            </form>
                            <div class="text-left mt-4">
                                <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm mb-0 btn-responsive"
                                    type="button">Regresar</a>
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
        </div>
    </div>
@endsection
