@extends('layouts.user_type.auth')

@section('content')
    <div>
        <!-- header page de la sección-->
        <div class="container-fluid">
            <div class="page-header min-height-200 border-radius-xl mt-4 page-header-background-linear-gradient">
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n5">
                <div class="row gx-4">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mt-2">
                                {{ __('Crear Rol') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-body pt-4 p-6 mt-4">
                    <!-- Boton de regersar-->
                    <div style="width: 25%; text-align: left;">
                        <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm mb-3"
                            type="button">Regresar</a>
                    </div>
                    <form action="/crear-rol" method="POST" enctype="multipart/form-data" role="form text-left">
                        @csrf
                        <div class="row">
                            <!-- Input para el Nombre-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role-name" class="form-control-label">{{ __('Nombre') }}</label>
                                    <div class="@error('role.name')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="Name" name="name"
                                            id="name" aria-label="Name" aria-describedby="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Guardar' }}</button>
                        </div>
                    </form>

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
