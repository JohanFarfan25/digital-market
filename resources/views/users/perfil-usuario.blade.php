@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="page-header min-height-200 border-radius-xl mt-4 page-header-background-linear-gradient">
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto header-page-image">
                        <div class="p-2 nav-link text-body font-weight-bold px-0">
                            @if (auth()->user()->profile_picture)
                                <img src="{{ asset(auth()->user()->profile_picture) }}" alt="{{ auth()->user()->name }}"
                                    class="img-fluid rounded-circle img-avatar">
                            @else
                                <div
                                    class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center img-avatar-default">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto my-auto header-page-title">
                        <div class="h-100">
                            <h5 class="mb-1">
                                Información de Perfil
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ auth()->user()->getRoleNames()->first() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-body pt-4 p-5">
                    <div style="width: 25%; text-align: left;">
                        <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm mb-0 "
                            type="button">Regresar</a>
                    </div>
                    <form action="/perfil-usuario" method="POST" role="form text-left" enctype="multipart/form-data"
                        class="mt-5">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Contenedor para la vista previa de la imagen-->
                                <div class="form-group text-center">
                                    <div id="image-preview" class="border p-2 rounded d-inline-block image-preview">
                                        @if (!empty(auth()->user()->profile_picture))
                                            <img id="preview-image" src="{{ asset(auth()->user()->profile_picture) }}"
                                                alt="Preview" class="img-fluid preview-image">
                                        @else
                                            <img id="preview-image" src="" alt="Preview"
                                                class="img-fluid preview-image preview-image-disabled">
                                        @endif
                                    </div>
                                </div>
                                <!-- Input para cargar imagen -->
                                <div class="form-group">
                                    <label for="profile_picture"
                                        class="form-control-label">{{ __('Cargar Imagen') }}</label>
                                    <div class="@error('profile_picture') border border-danger rounded-3 @enderror">
                                        <input type="file" id="profile_picture" class="form-control"
                                            name="profile_picture" accept="image/*" onchange="previewImage(event)">
                                        @error('profile_picture')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about">{{ 'Acerca de mi' }}</label>
                                    <div class="@error('about_me') border border-danger rounded-3 @enderror">
                                        <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about_me"
                                            style="min-height:175px;max-height:175px;">{{ old('about_me', auth()->user()->about_me) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Input para el Nombre-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Nombre') }}</label>
                                    <div class="@error('name') border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('name', auth()->user()->name) }}"
                                            type="text" placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Input para el Correo-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Correo') }}</label>
                                    <div class="@error('email') border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('email', auth()->user()->email) }}"
                                            type="email" placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Input para el Teléfono-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-phone" class="form-control-label">{{ __('Teléfono') }}</label>
                                    <div class="@error('phone') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="tel" placeholder="000-000-0000"
                                            id="user-phone" name="phone"
                                            value="{{ old('phone', auth()->user()->phone) }}">
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Input para el Dirección-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-location" class="form-control-label">{{ __('Dirección') }}</label>
                                    <div class="@error('location') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Dirección"
                                            id="user-location" name="location"
                                            value="{{ old('location', auth()->user()->location) }}">
                                    </div>
                                </div>
                            </div>
                            @role(env('ROLE_SUPER_ADMIN'))
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="roles" class="form-control-label">{{ __('Roles') }}</label>
                                        <select class="form-control" name="roles[]" id="roles" multiple
                                            data-mdb-select-init aria-label="roles">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ null !== auth()->user() && auth()->user()->hasAnyRole($role->id) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('roles')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                        <small
                                            class="text-muted">{{ __('Hold Ctrl/Command to select multiple options.') }}</small>
                                    </div>
                                </div>
                            @endrole

                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-info btn-md mt-4 mb-4">{{ __('Guardar') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //SECCIÓN PARA EL PREVIEW DE LA IMAGEN ***********************
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const preview = document.getElementById('preview-image');
                preview.src = reader.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

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
