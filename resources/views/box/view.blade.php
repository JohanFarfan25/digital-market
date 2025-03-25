@extends('layouts.user_type.auth')

@section('content')
    <div class="body-sale-box ">
        <div class="container-fluid">
            <!-- Header con imagen de fondo o gradiente -->
            <div class="page-header min-height-200 border-radius-xl mt-4 page-header-background-linear-gradient">
            </div>

            <!-- Tarjeta de título -->
            <div class="card card-body blur shadow-blur mx-4 mt-n5">
                <div class="row gx-4">
                    <div class="col-auto my-auto">
                        <h5 class="mt-2">{{ __('Caja') }} # {{ $box->id }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-body pt-4 p-5">
                    <!-- Botón de regreso -->
                    <div class="mb-3">
                        <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm">Regresar</a>
                    </div>
                    <div class="row view-box-container">
                        <div class="card-body d-flex justify-content-start col-md-4">
                            <h6 class="card-title mb-0">Asesor</h6>
                            <p class="mb-0" >
                                {{ $totals['user']['name'] }}
                            </p>
                        </div>
                        <div class="card-body d-flex justify-content-start col-md-4">
                            <h6 class="card-title mb-0">Fecha</h6>
                            <p class="mb-0" >
                                {{ $totals['date'] }}
                            </p>
                        </div>
                        <!-- Resumen de la caja -->
                        <div class="row mb-4">
                            <div class="col-md-4 pb-2">
                                <div class="card view-box-summary-border-secondary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0"><i class="fas fa-money-bill text-success"></i> Efectivo
                                        </h6>
                                        <p class="mb-0 grand-Totals-p">
                                            ${{ number_format($totals['cash'], 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pb-2">
                                <div class="card view-box-summary-border-secondary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0"><i class="fas fa-credit-card text-info"></i> Tarjeta de
                                            Crédito</h6>
                                        <p class="mb-0 grand-Totals-p">
                                            ${{ number_format($totals['credit card'], 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pb-2">
                                <div class="card view-box-summary-border-secondary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0"><i class="fas fa-credit-card text-warning"></i> Tarjeta
                                            de Débito</h6>
                                        <p class="mb-0 grand-Totals-p">
                                            ${{ number_format($totals['debit card'], 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gran Total -->
                        <div class="row mb-4">
                            <div class="col-md-8 row">
                                <div class="col-md-4 ">
                                    <div class="card-body">
                                        <h6 class="card-title sale-card-title">Base</h6>
                                        <p class="grand-Totals-p">${{ number_format($totals['base'], 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-body">
                                        <h6 class="card-title sale-card-title"><i
                                                class="fa fa-arrow-right text-success"></i> Total ventas</h6>
                                        <p class="grand-Totals-p">${{ number_format($totals['sale'], 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-body">
                                        <h6 class="card-title sale-card-title"><i
                                                class="fa fa-arrow-left text-warning"></i> Total Compras</h6>
                                        <p class="grand-Totals-p">${{ number_format($totals['purchase'], 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card sale-card-border-primary">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Total</h5>
                                        <p class="mb-0 grand-Totals-p">
                                            ${{ number_format($totals['total'], 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de pagos realizados -->
                        <div class="card card-margin">
                            <div class="card-body p-0">
                                <div class="table-responsive sale-box-payment-table">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-start text-uppercase text-xxs">
                                                    Tipo de Pago
                                                </th>
                                                <th class="text-start text-uppercase text-xxs">
                                                    Monto
                                                </th>
                                                <th class="text-start text-uppercase text-xxs">
                                                    Fecha
                                                </th>
                                                <th class="text-start text-uppercase text-xxs">
                                                    Número de Voucher
                                                </th>
                                                <th class="text-start text-uppercase text-xxs">
                                                    Número de Tarjeta
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($totals['payments'] as $payment)
                                                @php
                                                    $paymenttype = 'Desconocido'; // Valor por defecto
                                                    $class = 'fa fa-arrow-right text-success'; // Clase CSS por defecto

                                                    // Verifica si $payment y paymentType existen
                                                    if ($payment && $payment->paymentType) {
                                                        switch ($payment->paymentType->type) {
                                                            case 'cash':
                                                                $paymenttype = 'Efectivo';
                                                                break;
                                                            case 'credit card':
                                                                $paymenttype = 'Tarjeta de Crédito';
                                                                break;
                                                            case 'debit card':
                                                                $paymenttype = 'Tarjeta de Débito';
                                                                break;
                                                            case 'check':
                                                                $paymenttype = 'Cheque';
                                                                break;
                                                            case 'transfer':
                                                                $paymenttype = 'Transferencia';
                                                                break;
                                                        }
                                                    }

                                                    // Cambia la clase si es una compra (solo si $payment existe)
                                                    if ($payment && $payment->transactionType == 'purchase') {
                                                        $class = 'fa fa-arrow-left text-warning';
                                                    }
                                                @endphp

                                                <tr>
                                                    <td class="text-start ms-3">&nbsp&nbsp{{ $paymenttype }}</td>
                                                    <td class="text-start ms-3">
                                                        &nbsp&nbsp <i class="{{ $class }}"></i>
                                                        &nbsp&nbsp${{ number_format($payment->amount, 2) }}</td>
                                                    <td class="text-start ms-3">
                                                        &nbsp&nbsp{{ $payment->payment_date->format('d/m/Y H:m:s') }}
                                                    </td>
                                                    <td class="text-start ms-3">
                                                        &nbsp&nbsp{{ $payment->voucher_number ?? '---' }}</td>
                                                    <td class="text-start ms-3">
                                                        &nbsp&nbsp{{ !empty($payment->card_cd) ? '*******' . $payment->card_cd : '---' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <form id="close-box-form" action="{{ url('/cerrar-caja/' . $box->id) }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-end">
                                <button type="button" id="close-box-button"
                                    class="btn bg-gradient-info btn-md mt-4 mb-4">{{ __('Cerrar Caja') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Confirmación de cierre de caja
            document.addEventListener('DOMContentLoaded', function() {
                let closeBoxButton = document.getElementById('close-box-button');
                if (closeBoxButton) {
                    closeBoxButton.addEventListener('click', function() {
                        console.log("Botón presionado");
                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¿Deseas cerrar la caja? Esta acción no se puede deshacer.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#21d4fd',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, cerrar caja',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            console.log("Confirmación SweetAlert:", result);
                            if (result.isConfirmed) {
                                console.log("Enviando formulario...");
                                document.getElementById('close-box-form').submit();
                            }
                        });
                    });
                } else {
                    console.error("El botón #close-box-button no fue encontrado en el DOM.");
                }
            });
            // Manejo de respuestas con SweetAlert
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
