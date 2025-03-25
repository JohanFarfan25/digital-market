@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="page-header min-height-200 border-radius-xl mt-4 page-header-background-linear-gradient"
                style=" background-position-y: 50%;">
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n5">
                <div class="row gx-4">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mt-2">
                                Usuarios
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="buscador">
                            <!-- Fila 1: Buscador y Botón Regresar -->
                            <div class="d-flex flex-row justify-content-between mb-3">
                                <div class="flex-grow-1 me-3">
                                    <input type="text" id="searchInput" class="form-control"
                                        placeholder="Buscar usuarios..." aria-label="Search">
                                </div>
                                <div>
                                    <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm mb-0">
                                        Regresar
                                    </a>
                                </div>
                            </div>

                            <!-- Fila 2: Botón Nuevo Usuario (100% ancho) -->
                            @role(env('ROLE_SUPER_ADMIN'))
                                <div class="w-100">
                                    <a href="/crear-usuario" class="btn bg-gradient-info btn-sm mb-0 w-100">
                                        +&nbsp; Nuevo Usuario
                                    </a>
                                </div>
                            @endrole
                        </div>
                    </div>
                    <!-- Lista de usuarios -->
                    <div class="card-body px-0 pt-0 pb-2 mt-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Imagen
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nombre
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Correo
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Teléfono
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Rol
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Fecha de Creación
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                                            </td>
                                            <td>
                                                <div>
                                                    @if ($user->profile_picture && !empty($user->profile_picture))
                                                        <img src="{{ $user->profile_picture }}" alt="Profile Picture"
                                                            class="rounded-circle img-fluid avatar avatar-sm me-3">
                                                    @else
                                                        <div
                                                            class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center img-avatar-default avatar-sm">
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->phone }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->rol_id }}</p>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $user->created_at->format('d/m/Y') }}</span>
                                            </td>
                                            <td class="text-center">
                                                <!-- ver usuario -->
                                                <a href="/vista-usuario/{{ $user->id }}" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Edit User">
                                                    <span class="badge badge-sm bg-gradient-success">Ver</span>
                                                </a>
                                                @role(env('ROLE_SUPER_ADMIN'))
                                                    <!-- Eliminar usuario -->
                                                    <a href="/eliminar-usuario/{{ $user->id }}" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Delete User">
                                                        <span class="badge badge-sm bg-gradient-secondary">Eliminar</span>
                                                    </a>
                                                @endrole
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //SECCIÓN PARA EL FILTRO DE BÚSQUEDA ***********************
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('tbody tr');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    if (rowText.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

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
