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
                    <div class="col-auto my-auto header-page-title">
                        <h5 class="mt-2">{{ __('Reporte de caja por fecha') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="container-fluid py-4 contariner-report-sale-box">
            <div class="card">
                <div class="card-body pt-4 p-5">
                    <!-- Botón de regreso -->
                    <div class="mb-3">
                        <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm">Regresar</a>
                    </div>
                    <form action="{{ url('/reporte-caja') }}" method="POST">
                        @csrf
                        <div class="col-md-6 d-flex justify-content-start">
                            <div class=" col-md-6">
                                <input type="date" class="form-control" placeholder="Seleccione la fecha de expiración"
                                    name="date" id="date" aria-label="date" aria-describedby="date"
                                    max="{{ now()->format('Y-m-d') }}" value="{{ old('date', $date ? $date : '') }}"
                                    required>
                            </div>
                            <div class="d-flex justify-content-end col-md-6">
                                <button type="submit"
                                    class="btn bg-gradient-info btn-md  mb-4 box-btn-buscar">{{ 'Buscar' }}</button>
                            </div>
                        </div>
                    </form>
                    <!-- Totales -->
                    <div class="row mb-4">
                        <div class="row mb-4">
                            <div class="col-md-4 pb-2">
                                <div class="card sale-card-border-secondary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0"><i class="fas fa-money-bill text-success"></i>
                                            Efectivo</h6>
                                        <p class="mb-0 grand-Totals-p">
                                            ${{ number_format($grandTotalCash, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pb-2">
                                <div class="card sale-card-border-secondary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0"><i class="fas fa-credit-card text-info"></i> Tarjeta
                                            de Crédito</h6>
                                        <p class="mb-0 grand-Totals-p">
                                            ${{ number_format($grandTotalCreditCard, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pb-2">
                                <div class="card sale-card-border-secondary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0"><i class="fas fa-credit-card text-warning"></i>
                                            Tarjeta de Débito</h6>
                                        <p class="mb-0 grand-Totals-p">
                                            ${{ number_format($grandTotalDebiCard, 2) }}</p>
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
                                        <p class="grand-Totals-p">
                                            ${{ number_format($grandTotalBase, 2) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-body">
                                        <h6 class="card-title sale-card-title"><i
                                                class="fa fa-arrow-right text-success"></i> Total ventas</h6>
                                        <p class="grand-Totals-p">${{ number_format($grandTotalSale, 2) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-body">
                                        <h6 class="card-title sale-card-title"><i class="fa fa-arrow-left text-warning"></i>
                                            Total Compras</h6>
                                        <p class="grand-Totals-p">
                                            ${{ number_format($grandTotalPurchase, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card sale-card-border-primary">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Total</h5>
                                        <p class="mb-0 grand-Totals-p">
                                            ${{ number_format($grandTotal, 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($resultBoxes as $result)
                        <div class="mb-3 sale-box-container">
                            <div class="row mb-0">
                                <div class="card-body d-flex justify-content-between align-items-center col-md-12">
                                    <div class="d-flex align-items-center">
                                        <h6 class="card-title mb-0">Asesor</h6>
                                        <p class="mb-0">
                                            {{ $result['totals']['user']['name'] }}
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @php
                                            $color = '#82d616'; // Add the missing semicolon here
                                            if ($result['totals']['status'] == 'Cerrada') {
                                                $color = '#f5365c';
                                            }
                                        @endphp
                                        <h6 class="card-title mb-0">Estado</h6>
                                        <p class="mb-0" style="color:{{ $color }};">
                                            <b>{{ $result['totals']['status'] }}</b>
                                        </p>
                                    </div>
                                    <p class="mb-0">
                                        #Caja {{ $result['totals']['id'] }}
                                    </p>
                                </div>
                                <!-- Resumen de la caja -->
                                <div class="row mb-0">
                                    <div class="col-md-4 pb-2">
                                        <div
                                            class="card-body d-flex justify-content-between align-items-center box-summary-card-body">
                                            <h6 class="card-title mb-0"><i class="fas fa-money-bill text-success"></i>
                                                Efectivo</h6>
                                            <p class="mb-0">
                                                ${{ number_format($result['totals']['cash'], 2) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pb-2">
                                        <div
                                            class="card-body d-flex justify-content-between align-items-center box-summary-card-body">
                                            <h6 class="card-title mb-0"><i class="fas fa-credit-card text-info"></i>
                                                Tarjeta de Crédito</h6>
                                            <p class="mb-0">
                                                ${{ number_format($result['totals']['credit card'], 2) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pb-2">
                                        <div
                                            class="card-body d-flex justify-content-between align-items-center box-summary-card-body">
                                            <h6 class="card-title mb-0"><i class="fas fa-credit-card text-warning"></i>
                                                Tarjeta de Débito</h6>
                                            <p class="mb-0">
                                                ${{ number_format($result['totals']['debit card'], 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gran Totales -->
                                <div class="row mb-0">
                                    <div class="col-md-8 row">
                                        <div class="col-md-4 ">
                                            <div class="card-body">
                                                <h6 class="card-title sale-card-title">Base</h6>
                                                <p class="grand-Totals-p">
                                                    ${{ number_format($result['totals']['base'], 2) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card-body">
                                                <h6 class="card-title sale-card-title"><i
                                                        class="fa fa-arrow-right text-success"></i> Total ventas</h6>
                                                <p class="grand-Totals-p">
                                                    ${{ number_format($result['totals']['sale'], 2) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card-body">
                                                <h6 class="card-title sale-card-title"><i
                                                        class="fa fa-arrow-left text-warning"></i> Total Compras</h6>
                                                <p class="grand-Totals-p">
                                                    ${{ number_format($result['totals']['purchase'], 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <h5 class="card-title mb-0">Total</h5>
                                            <p class="mb-0 grand-Totals-p">
                                                ${{ number_format($result['totals']['total'], 2) }}
                                            </p>
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
                                                    @foreach ($result['totals']['payments'] as $payment)
                                                        @php
                                                            $paymenttype = '';
                                                            $class = 'fa fa-arrow-right text-success';
                                                            switch ($payment->payment_type) {
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
                                                                default:
                                                                    $paymenttype = 'Desconocido';
                                                                    break;
                                                            }
                                                            if ($payment->transactionType == 'purchase') {
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script>
            $('form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
                let date = $('#date').val(); // Get the date value
                if (!date) {
                    alert('Please select a date.');
                    return;
                }
                // Submit the form via AJAX or allow default submission
                this.submit();
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
