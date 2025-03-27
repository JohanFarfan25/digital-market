@extends('layouts.user_type.auth')

@section('content')

    <div>
        <div class="container-fluid">
            <div class="page-header min-height-200 border-radius-xl mt-4 page-header-background-linear-gradient"
                style="background-position-y: 50%;">
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ !empty($user->profile_picture) ? asset($user->profile_picture) : '../assets/img/team-2.jpg' }}"
                                alt="Profile Picture" class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                Vista de Usuario
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ $user->getRoleNames()->first() }}
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
                    <form action="/vista-usuario/{{ $user->id }}" method="POST" role="form text-left"
                        enctype="multipart/form-data" class="mt-5">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Contenedor para la vista previa de la imagen-->
                                <div class="form-group text-center">
                                    <div id="image-preview"
                                        class="border p-2 rounded d-inline-block container-preview-image-user_view image-preview">
                                        @if (!empty($user->profile_picture))
                                            <img id="preview-image" src="{{ asset($user->profile_picture) }}" alt="Preview"
                                                class="img-fluid preview-image">
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
                                            style="min-height:175px;max-height:175px;">{{ old('about_me', $user->about_me) }}</textarea>
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
                                        <input class="form-control" value="{{ old('name', $user->name) }}" type="text"
                                            placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Input para el Correo-->
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Correo') }}</label>
                                    <div class="@error('email') border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('email', $user->email) }}" type="email"
                                            placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input para el Teléfono-->
                                <div class="form-group">
                                    <label for="user-phone" class="form-control-label">{{ __('Teléfono') }}</label>
                                    <div class="@error('phone') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="tel" placeholder="000-000-0000"
                                            id="user-phone" name="phone" value="{{ old('phone', $user->phone) }}">
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
                                        <input class="form-control" type="text" placeholder="Location"
                                            id="user-location" name="location"
                                            value="{{ old('location', $user->location) }}">
                                    </div>
                                </div>
                            </div>
                            @role(env('ROLE_SUPER_ADMIN'))
                                <div class="col-md-6">
                                    <!-- Input para los roles-->
                                    <div class="form-group">
                                        <label for="roles" class="form-control-label">{{ __('Roles') }}</label>
                                        <select class="form-control" name="roles[]" id="roles" multiple
                                            data-mdb-select-init aria-label="roles">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ isset($user) && $user->hasAnyRole($role->id) ? 'selected' : '' }}>
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
                        @role(env('ROLE_SUPER_ADMIN'))
                            <div class="d-flex justify-content-end">
                                <button type="submit"
                                    class="btn bg-gradient-info btn-md mt-4 mb-4">{{ __('Guardar') }}</button>
                            </div>
                        @endrole
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        //SECCIÓN PARA EL PREVIEW DE IMAGEN ***********************
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
