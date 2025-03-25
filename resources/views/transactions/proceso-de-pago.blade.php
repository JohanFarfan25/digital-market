@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="page-header min-height-100 border-radius-xl mt-4 page-header-background-linear-gradient">
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n5">
                <div class="row gx-4">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mt-2">
                                {{ __('Generar pago') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-body pt-4 p-6 mt-4">
                    <div style="width: 25%; text-align: left;">
                        <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm mb-3"
                            type="button">Regresar</a>
                    </div>
                    <form action="/proceso-de-pago" method="POST" enctype="multipart/form-data" role="form text-left">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 row">
                                <!-- Metodo de pago  -->
                                <div class="form-group col-md-12">
                                    <label for="proceso-de-pagoment_type"
                                        class="form-control-label">{{ __('Método de pago') }}</label>
                                    <div class="@error('payment_type') border border-danger rounded-3 @enderror">
                                        <select name="payment_type" id="payment_type" class="form-control" required>
                                            <option value="" selected disabled>Seleccione un método de pago</option>
                                            <option value="cash">Efectivo</option>
                                            <option value="credit card">Tarjeta Crédito</option>
                                            <option value="debit card">Tarjeta Débito</option>
                                        </select>
                                        @error('payment_type')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Valor a cobrar  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="payment-amount"
                                            class="form-control-label">{{ __('Valor a cobrar') }}</label>
                                        <div class="@error('payment.amount')border border-danger rounded-3 @enderror">
                                            <input type="number" class="form-control" placeholder="$000.000.000"
                                                name="amount" id="amount" aria-label="Amount" aria-describedby="amount"
                                                required>
                                            @error('amount')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- Franquicia  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="payment-franchise_id"
                                            class="form-control-label">{{ __('Franquicias') }}</label>
                                        <div class="@error('franchise') border border-danger rounded-3 @enderror">
                                            <select name="franchise" id="franchise" class="form-control"
                                                aria-label="franchise" aria-describedby="franchise">
                                                <option value="">Selecciono una franquicia</option>
                                                <option value="visa">Visa</option>
                                                <option value="mastercard">Mastercard</option>
                                                <option value="american expres">American expres</option>
                                            </select>
                                            @error('franchise')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- Bancos  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="payment-bank" class="form-control-label">{{ __('Bancos') }}</label>
                                        <div class="@error('bank') border border-danger rounded-3 @enderror">
                                            <select name="bank" id="bank" class="form-control" aria-label="bank"
                                                aria-describedby="bank">
                                                <option value="">Selecciono un Banco</option>
                                                <option value="bancolombia">Bancolombia</option>
                                                <option value="davivienda">Davivienda</option>
                                                <option value="colpatria">Colpatria</option>
                                                <option value="banco de Bogota">Banco de Bogota</option>
                                            </select>
                                            @error('bank')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- En caso de ser tarjeta Número de aprovación  -->
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment-voucher_number"
                                                class="form-control-label">{{ __('Número de aprobación') }}</label>
                                            <div
                                                class="@error('payment.voucher_number')border border-danger rounded-3 @enderror">
                                                <input type="text" class="form-control"
                                                    placeholder="Número de aprobación" name="voucher_number"
                                                    id="voucher_number" aria-label="voucher_number"
                                                    aria-describedby="voucher_number">
                                                @error('voucher_number')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- En caso de ser tarjeta Número de referencia  -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment-card_cd"
                                                class="form-control-label">{{ __('Número de referencia') }}</label>
                                            <div class="@error('payment.card_cd')border border-danger rounded-3 @enderror">
                                                <input type="text" class="form-control"
                                                    placeholder="Número de referencia" name="card_cd" id="card_cd"
                                                    aria-label="card_cd" aria-describedby="card_cd">
                                                @error('card_cd')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sección de pagos ya realizados de la transacción -->
                            <div class="col-md-6">
                                <div class="form-group row col-md-12">
                                    <div class="col-md-12 d-flex justify-content-between payment-total">
                                        <b>Total a pagar: </b>
                                        <p>${{ number_format($transaction->price, 0, ',', '.') }}</p>
                                    </div>
                                    <hr>
                                    <div class="payment-details">
                                        @foreach ($payResult as $pay)
                                            @php
                                                $paymentTypeName = 'Efectivo'; // Valor por defecto

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
                                    <hr class="payment-hr">
                                    <div class="col-md-12 d-flex justify-content-between payment-total">
                                        <b>Saldo: </b>
                                        <p class="payment-total-balance "> ${{ $diferece }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="transactionId" value="{{ $transactionId ?? '' }}">
                        <div class="d-flex justify-content-start">
                            <button type="submit"
                                class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Pagar' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        //SECCIÓN PARA EL CAMBIO DE ESTADO DE LOS CAMPOS DEPENDIENDO DEL TIPO DE PAGO
        document.addEventListener("DOMContentLoaded", function() {
            let paymentTypeSelect = document.getElementById('payment_type');

            if (paymentTypeSelect) {
                paymentTypeSelect.addEventListener('change', function() {
                    let paymentType = this.value; // Obtener el valor seleccionado
                    let franchiseId = document.getElementById('franchise');
                    let bankId = document.getElementById('bank');
                    let voucherNumber = document.getElementById('voucher_number');
                    let cardCd = document.getElementById('card_cd');

                    let isCash = paymentType === 'cash';

                    // Habilitar/deshabilitar campos según el tipo de pago
                    franchiseId.disabled = isCash;
                    bankId.disabled = isCash;
                    voucherNumber.disabled = isCash;
                    cardCd.disabled = isCash;

                    // Establecer requeridos si no es efectivo
                    franchiseId.required = !isCash;
                    bankId.required = !isCash;
                    voucherNumber.required = !isCash;
                    cardCd.required = !isCash;

                    // Limpiar campos si se selecciona efectivo
                    if (isCash) {
                        franchiseId.value = '';
                        bankId.value = '';
                        voucherNumber.value = '';
                        cardCd.value = '';
                    }
                });

                // Disparar el evento change al cargar la página para establecer el estado inicial
                paymentTypeSelect.dispatchEvent(new Event('change'));
            }
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
