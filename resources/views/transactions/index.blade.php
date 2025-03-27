@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="page-header min-height-100 border-radius-xl mt-4 page-header-background-linear-gradient">
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n5">
                <div class="row gx-4">
                    <div class="col-auto my-auto">
                        <div class="h-100 header-page-title">
                            <h5 class="mt-2">
                                Transacciones
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
                    <!-- Buscar transacciones  -->
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div style="width: 50%;">
                                <input type="text" id="searchInput" class="form-control me-3"
                                    placeholder="Buscar transacciones..." aria-label="Search">
                            </div>
                            <div style="width: 50%; text-align: right;">
                                <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm mb-0 btn-responsive"
                                    type="button">Regresar</a>
                            </div>
                        </div>
                    </div>
                    <!-- Lista de transacciónes  -->
                    <div class="card-body px-0 pt-0 pb-2 mt-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Type
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Quantity
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Cliente
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Creation Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $index => $transaction)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $transaction->id }}</p>
                                            </td>
                                            <td class="text-center">
                                                @if ($transaction->type == 'sale')
                                                    <p class="text-xs font-weight-bold mb-0">venta</p>
                                                @else
                                                    <p class="text-xs font-weight-bold mb-0">orden de compra</p>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $transaction->date->format('d/m/Y') }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0"> {{ $transaction->quantity }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0"> {{ $transaction->price }}</p>
                                            </td>
                                            <td class="text-center">
                                                @if ($transaction->type == 'sale')
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $transaction->customer ?? 'N/A' }}</p>
                                                @else
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $transaction->supplier }}</p>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $transaction->created_at->format('d/m/Y') }}</span>
                                            </td>
                                            <td class="text-center">
                                                <!-- Ver transacción -->
                                                <a href="/ver-transaccion/{{ $transaction->id }}" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Edit User">
                                                    <span class="badge badge-sm bg-gradient-success">View</span>
                                                </a>
                                                @role(env('ROLE_SUPER_ADMIN'))
                                                    <!-- Eliminar transacción -->
                                                    <a href="/eliminar-transaccion/{{ $transaction->id }}" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Delete User">
                                                        <span class="badge badge-sm bg-gradient-secondary">delete</span>
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
        //Buscador de transacciones
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
