@extends('layouts.user_type.auth')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
        <div class="col-auto my-auto p-3">
            <div class="h-100 font-weight-bolder mb-0 dashboard-title">
                <h5 class="mt-2 mb-3"> Total Transacciones: </h5>
                <p class="h-100 font-weight-bolder mb-0 mt-1"> ${{ isset($grantTotal) ? $grantTotal : 0 }} </p>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Completas</p>
                                <h5 class="font-weight-bolder mb-0">
                                    ${{ isset($completed) ? $completed : 0 }}
                                    <span class="text-success text-sm font-weight-bolder"></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pendientes</p>
                                <h5 class="font-weight-bolder mb-0">
                                    ${{ isset($pending) ? $pending : 0 }}
                                    <span class="text-success text-sm font-weight-bolder"></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
                                <i class="ni ni-bold-left text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Canceladas</p>
                                <h5 class="font-weight-bolder mb-0">
                                    ${{ isset($cancelled) ? $cancelled : 0 }}
                                    <span class="text-danger text-sm font-weight-bolder"></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                <i class="ni ni-fat-remove text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rechazadas</p>
                                <h5 class="font-weight-bolder mb-0">
                                    ${{ isset($declined) ? $declined : 0 }}
                                    <span class="text-success text-sm font-weight-bolder"></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                <i class="ni ni-sound-wave text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <!-- Garfica de ventas -->
        <div class="col-lg-7 mb-lg-0 mb-5">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="card-header pb-0">
                        <h6 class="dashboard-h6">Resumen de ventas</h6>
                        <p class="text-sm">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold text-lg">Año
                                {{ isset($currentYear) ? $currentYear : now()->toDateString() }}</span>
                        </p>
                    </div>
                    <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top de productos mas vendidos -->
        <div class="col-lg-5">
            <div class="card z-index-2 dashboard-products-container">
                <div class="card-header pb-0 mt-1">
                    <h6 class="dashboard-h6">Top 10 de productos mas vendidos</h6>
                    <form action="{{ url('/reporte-caja') }}" method="POST">
                        @csrf
                        <div class="col-md-6 d-flex justify-content-start">
                            <div class=" col-md-12">
                                <input type="date" class="form-control" placeholder="Seleccione la fecha de expiración"
                                    name="date" id="date" aria-label="date" aria-describedby="date"
                                    value="{{ now()->toDateString() }}" required>
                            </div>
                            <div class="d-flex justify-content-end col-md-6">
                                <button type="button" id="search-products"
                                    class="btn bg-gradient-info btn-md  mb-4">{{ 'Buscar' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-4">
                    <!-- Lista de productos -->
                    <div class="card-body px-0 pt-0 pb-2 mt-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Posición
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nombre
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Cantidad
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products ?? [] as $index => $product)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0 text-start">{{ $index + 1 }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0 text-start">{{ $product['name'] }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0 text-start">
                                                    {{ $product['quantity'] }}</p>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No hay productos disponibles para esta
                                                fecha.</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const newDate = new Date();
        const currentDate = newDate.toLocaleDateString();

        $(document).ready(function() {

            /*SECCIÓN DE TOP 10 DE PRODUCTOS*/
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

            function searchTopTenProducts(date) {
                $.ajax({
                    url: '/top-diez-productos',
                    type: 'POST',
                    data: {
                        date: date
                    },
                    success: function(response) {
                        // Cerrar el loading después de 3 segundos (3000 ms)
                        setTimeout(() => {
                            Swal.close();
                        }, 2000);
                        if (response.status == "success") {
                            let html = '';
                            response.data.forEach((product, index) => {
                                html += `
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0 text-start">${index + 1}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0 text-start">${product.name}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0 text-start">${product.total_quantity}</p>
                                        </td>
                                    </tr>
                                `;
                            });
                            $('table tbody').html(html); // Actualiza la tabla
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire({
                            title: 'Ups!',
                            icon: 'error',
                            text: 'No se cargar el top de productos. ' + error,
                            showConfirmButton: false,
                            timer: 4000
                        });
                    }
                });
            }
            // Cargar los productos por defecto
            searchTopTenProducts(currentDate);


            // Evento para buscar productos
            $('#search-products').on('click', function() {
                var date = $('#date').val();
                if (!date) {
                    Swal.fire('Error', 'Selecciona una fecha.', 'warning');
                    return;
                }
                // Mostrar loading
                Swal.fire({
                    title: 'Buscando productos...',
                    html: 'Por favor espera un momento.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                searchTopTenProducts(date);
            });


            //SECCIÓN DE GRÁFICA DE VENTAS
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: @json($months),
                    datasets: [{
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#fff",
                        data: @json($salesData),
                        maxBarThickness: 6
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: Math.max(...@json($salesData)) + 100,
                                beginAtZero: true,
                                padding: 15,
                                font: {
                                    size: 14,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#fff"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false
                            },
                            ticks: {
                                display: true,
                                color: '#fff'
                            },
                        },
                    },
                },
            });
        });

        //SECCIÓN PARA LAS RESPUESTAS SWAL ***********************
        @if (isset($response))

            let result = @json($response);

            if (result && result?.status == 'error') {
                Swal.fire({
                    title: 'Ups!',
                    icon: 'error',
                    text: result?.message,
                    showConfirmButton: false,
                    timer: 4000
                });
            }
        @endif
    </script>
@endsection
