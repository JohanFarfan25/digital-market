@extends('layouts.user_type.auth')

@section('content')
    @php
        $type = 'Compra';
        switch ($transaction->type) {
            case 'purchase':
                $type = 'Compra';
                break;
            case 'sale':
                $type = 'Venta';
                break;
            case 'adjustment':
                $type = 'Compra';
                break;
        }
    @endphp

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <div class="container-fluid">
        <div class="page-header min-height-100 border-radius-xl mt-4 page-header-background-linear-gradient">
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n5">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100 header-page-title">
                        <h5 class="mt-2 ">
                            Orden de {{ $type }} Nº {{ $transaction->id }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid py-2">
        <div style="width: 25%; text-align: left;">
            <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm mb-3 " type="button">Regresar</a>
        </div>
        <div class="row">
            <div class="col-md-5 mt-4">
                <div class="card h-100 mb-4">
                    <div class="card-header pb-0 px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0">Información de facturación</h6>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end align-items-center">
                                <i class="far fa-calendar-alt me-2"></i>
                                <small style="font-weight: 600;">{{ $transaction->date->format('d/m/Y') }}</small>
                            </div>
                        </div>
                    </div>
                    <!-- Detalle de la transacción  -->
                    <div class="card-body pt-4 p-3 transaccion-datail">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                        <i class="fas fa-credit-card"></i>
                                    </button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Tipo</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-danger text-dark text-sm ">
                                    {{ $type }}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                        <i class="fas fa-barcode"></i>
                                    </button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Número</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-danger text-dark text-sm ">
                                    {{ $transaction->id }}
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                        <i class="fas fa-cogs"></i>
                                    </button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Cantidad</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-danger text-dark text-sm ">
                                    {{ $transaction->quantity }}
                                </div>
                            </li>
                            <hr>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user"></i>
                                    </button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Cliente</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-danger text-dark text-xsm">
                                    @if ($transaction->type == 'sale')
                                        {{ $transaction->customer ?? 'N/A' }} </br>
                                    @else
                                        {{ $transaction->supplier }} </br>
                                    @endif

                                </div>
                            </li>
                            <hr>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                <div class=" text-danger text-dark text-sm">
                                    @php
                                        $colorTheme = '#82d616'; // Valor por defecto
                                        switch ($transaction->transaction_status) {
                                            case 'pending':
                                                $colorTheme = '#ff8d72';
                                                break;
                                            case 'authorized':
                                                $colorTheme = '#82d616';
                                                break;
                                            case 'failed':
                                                $colorTheme = '#ea0606';
                                                break;
                                            case 'cancelled':
                                                $colorTheme = '#fd7e14';
                                                break;
                                            case 'expired':
                                                $colorTheme = '#D63381';
                                                break;
                                            default:
                                                $colorTheme = '#82d616';
                                        }
                                    @endphp
                                    <!-- Estado de la transacción -->
                                    <div class="transaccion-datailtransaction-status">
                                        <div class="d-flex align-items-center ms-sm-2 text-success text-sm">
                                            <div class="text-dark p-3  text-sm">
                                                <b>Total:</b>
                                            </div>
                                            <div >
                                                <b>${{ $transaction->price }}</b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center ms-sm-2 text-success text-sm">
                                            <div class="text-dark p-3">
                                                <b>Status:</b>
                                            </div>
                                            <div class="ms-sm-2" style="color: {{ $colorTheme }};">
                                                <b>{{ $transaction->transaction_status }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @if ($transaction->transaction_status != 'completed' && $transaction->transaction_status != 'pending')
                                <p class="transaction-status-reson-rejection">{{ $transaction->reson_rejection }}
                                </p>
                            @endif
                            @php
                                $paymStatus = ['completed', 'cancelled'];
                            @endphp
                            @if (!in_array($transaction->transaction_status, $paymStatus))
                                @role(env('ROLE_SUPER_ADMIN'))
                                    <div class="d-flex justify-content-space-between">
                                        <div>
                                            <a href="/proceso-de-pago/{{ $transaction->id }}" class="mx-3 mt-2"
                                                data-bs-toggle="tooltip" data-bs-original-title="Pay">
                                                <span class="badge badge-sm bg-gradient-success">Realizar transacción</span>
                                            </a>
                                        </div>
                                        <a href="/cancelar-transaccion/{{ $transaction->id }}" class="mx-3 "
                                            data-bs-toggle="tooltip" data-bs-original-title="Cancel">
                                            <span class="badge badge-sm bg-gradient-danger">Cancelar</span>
                                        </a>
                                        <div>
                                        </div>
                                    </div>
                                @endrole
                            @endif
                        </ul>
                        <hr>
                        <!-- Sección detalle de Pagos -->
                        @if (isset($payResult))
                            <div class="list-group mb-4">
                                <span class="mb-2text-xs text-dark"><b>Pagos</b>
                                    <div class="mt-3 payment-details">
                                        @foreach ($payResult as $pay)
                                            @php
                                                $paymentTypeName = 'Efectivo';

                                                if ($pay['paymentTypeName'] == 'credit card') {
                                                    $paymentTypeName = 'Tarjeta Credito';
                                                } elseif ($pay['paymentTypeName'] == 'debit card') {
                                                    $paymentTypeName = 'Tarjeta Debito';
                                                }
                                            @endphp

                                            <div class="col-md-12 d-flex justify-content-between">
                                                <div class="col-md-12 row payment-datail-item">

                                                    @if ($pay['type'] == 'cash')
                                                        <div class="col-md-12 d-flex justify-content-between">
                                                            <p><i
                                                                    class="fas fa-money-bill payment-datail-item-icon-cash"></i>
                                                                {{ $paymentTypeName }}</p>
                                                            <p><b>Valor:</b>
                                                                ${{ $pay['amount'] }}</p>
                                                        </div>
                                                    @elseif($pay['type'] == 'credit card' || $pay['type'] == 'debit card')
                                                        <div class="col-md-12 d-flex justify-content-between">
                                                            <p><i
                                                                    class="fas fa-credit-card payment-datail-item-icon-card"></i>
                                                                {{ $pay['frachise'] }} ***{{ $pay['cardCd'] }}</p>
                                                            <p>{{ $pay['bank'] }}</p>
                                                        </div>
                                                        <div class="col-md-12 d-flex justify-content-between">
                                                            <p><b>Valor:</b>
                                                                ${{ $pay['amount'] }}</p>
                                                            <p><b>Número de Vaucher:</b>
                                                                {{ $pay['voucherNumber'] }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-7 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">( {{ count($items) }} ) - Productos</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            <!-- Productos adquiridos en al transacción -->
                            @foreach ($items as $item)
                                <li
                                    class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg justify-content-between">
                                    <div class="d-flex flex-column w-50">
                                        <span class="mb-2 text-xs text-dark"><b>Nombre del Producto:
                                            </b>{{ $item->product->name }}
                                            <span class="text-dark ms-sm-2">
                                                <p class="transaction-detail-product-item">
                                                    V/U: {{ $item->product->sale_price }}</p>
                                                <p class="transaction-detail-product-item">Cantidad:
                                                    {{ $item->quantity }}</p>
                                                <p class="transaction-detail-product-item">Proveedor del producto:
                                                    {{ $item->product->supplier }}</p>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column w-50">
                                        <span class="mb-2 text-m text-dark"><b>Precio:</b>
                                            <span class="ms-sm-2 text-success"><b>${{ $item->price }}</b></span>
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
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
