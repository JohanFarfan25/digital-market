@extends('layouts.user_type.auth')

@section('content')
    <div>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="container-fluid">
            <div class="page-header min-height-100 border-radius-xl mt-4 page-header-background-linear-gradient">
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n5">
                <div class="row gx-4">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mt-2">
                                Facturación
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid py-2">
            <div class="card">
                <div class="card-body">
                    <div style="width: 25%; text-align: left;">
                        <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm mb-3"
                            type="button">Regresar</a>
                    </div>
                    <form id="checkout-form">
                        @csrf
                        <!-- Selección de productos -->
                        <div class="card-body px-0 pt-0 pb-2 mt-3">
                            <div class="table-responsive p-1">
                                <h6>Productos Seleccionados</h6>
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Producto
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Cantidad
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Precio Unitario
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Subtotal
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="items-table">
                                        <!-- Aquí se agregarán dinámicamente los productos/lotes seleccionados -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <!-- Campos de la transacción -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="customer" class="form-control-label">{{ __('Cliente') }}</label>
                                        <div class="@error('customer')border border-danger rounded-3 @enderror">
                                            <input type="text" class="form-control" placeholder="Cliente" name="customer"
                                                id="customer" aria-label="customer" aria-describedby="customer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" class="row">
                                    <div class="col-md-12">
                                        <label for="product_id">Productos</label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="search" id="product_search" class="form-control"
                                                placeholder="Buscar producto...">
                                        </div>
                                        <div id="product_list" class="border p-2 rounded search-products">
                                            <p class="text-muted">Productos...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="box-id" id="box-id">
                        <input type="hidden" name="items" id="items-data">

                        <!-- Total y botón de pago -->
                        <div class="row mt-3">
                            <div class="col-md-12 text-end">
                                <h5>Total: <span id="total-amount">$0.00</span></h5>
                                <button id="save" class="btn btn-success" disabled>Generar orden de venta</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal para apertura de caja -->
        <div class="modal fade" id="modalCaja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalCajaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCajaLabel">Apertura de caja</h5>
                        <p class="billing-modal-p">
                            {{ date('Y-m-d H:i:s') }}
                        </p>
                    </div>
                    <div class="modal-body">
                        <p style="text-align:center;">¡La caja está cerrada. Debe abrirla para poder continuar!.</p>
                        <div class="col-md-12">
                            <p class="billing-modal-content-user-p">
                                {{ auth()->user()->name }}
                            </p>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cash" class="form-control-label">{{ __('Caja inicial') }}</label>
                                <div class="@error('box.id')border border-danger rounded-3 @enderror">
                                    <input type="text" class="form-control" placeholder="$0" name="cash"
                                        id="cash" aria-label="Cash" aria-describedby="name">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-lg-between">
                        <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-md mt-4 mb-4"
                            type="button">Regresar</a>
                        <button id="btnAbrirCaja" class="btn bg-gradient-info btn-md mt-4 mb-4">Abrir Caja</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        let items = []; // Almacena los productos seleccionados
        function addItem(productId, productName, productPrice) {
            // Verificar si el producto ya fue agregado
            if (items.some(item => item.productId == productId)) {
                Swal.fire({
                    title: 'Ups!',
                    icon: 'info',
                    text: "Este producto ya fue agregado.",
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }

            const item = {
                productId,
                productName,
                quantity: 1,
                price: parseFloat(productPrice) || 0,
                total: parseFloat(productPrice) || 0
            };

            items.push(item);
            renderItemsTable();
            toggleSaveButton();
        }

        function renderItemsTable() {
            const table = document.getElementById('items-table');
            table.innerHTML = '';
            let total = 0;

            items.forEach((item, index) => {
                item.subtotal = item.quantity * item.price;
                total += item.subtotal;

                table.innerHTML += `
                            <tr>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">${item.productId}</p>
                                </td>
                                <td class="text-left">
                                    <p class="text-xs font-weight-bold mb-0"><b>${item.productName}</b></p>
                                </td>
                                <td class="text-center">
                                    <input type="number" value="${item.quantity}" min="1" onchange="updateQuantity(${index}, this.value)" class="form-control">
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">$${item.price.toFixed(2)}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">$${item.subtotal.toFixed(2)}</p>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm mb-2" onclick="removeItem(${index})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>`;
            });

            document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;
        }

        function updateQuantity(index, quantity) {
            items[index].quantity = parseInt(quantity) || 1;
            renderItemsTable();
            toggleSaveButton();
        }

        function removeItem(index) {
            items.splice(index, 1);
            renderItemsTable();
            toggleSaveButton();
        }

        function toggleSaveButton() {
            const saveButton = document.getElementById('save');
            if (items.length > 0) {
                saveButton.disabled = false;
                saveButton.classList.remove('btn-secondary');
                saveButton.classList.add('btn-success');
            } else {
                saveButton.disabled = true;
                saveButton.classList.remove('btn-success');
                saveButton.classList.add('btn-secondary');
            }
        }

        toggleSaveButton();

        // Validación de caja abierta por día y usuario logueado
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

            // Función para validar si la caja está abierta
            function validarCaja() {
                $.ajax({
                    url: "/validar-caja-abierta", // Ruta a tu backend
                    method: "GET",
                    success: function(response) {
                        if (response.status == "success") {
                            $("#box-id").val(response.boxId);
                        } else {
                            $("#modalCaja").modal("show");
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Ups!',
                            icon: 'error',
                            text: 'Error al validar la caja. ',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
            }

            // Función para abrir la caja
            $("#btnAbrirCaja").on("click", function() {
                $.ajax({
                    url: "/abrir-caja",
                    method: "POST",
                    data: {
                        cash_initial: $("#cash").val(),
                        base: $("#cash").val(),
                        total: $("#cash").val()
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $("#box-id").val(response.boxId);
                            $("#modalCaja").modal("hide");
                        } else {
                            Swal.fire({
                                title: 'Ups!',
                                icon: 'error',
                                text: 'No se pudo abrir la caja. ' + response?.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Ups!',
                            icon: 'error',
                            text: 'No se pudo abrir la caja. ' + error,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
            });

            // Ejecutar validación al cargar la página
            validarCaja();

            $("#product_search").on("input", function() {
                let query = $(this).val().trim();
                let productList = $("#product_list");

                if (query.length < 1) {
                    productList.html('<p class="text-muted">Productos...</p>');
                    return;
                }

                $.ajax({
                    url: "/buscar-productos",
                    method: "GET",
                    data: {
                        search: query
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log("Productos recibidos:", data); // Verifica en la consola

                        productList
                            .empty(); // Limpia la lista antes de agregar nuevos productos

                        if (!Array.isArray(data) || data.length === 0) {
                            productList.append('<p class="text-muted">No hay resultados</p>');
                            return;
                        }

                        data.forEach(product => {
                            let productHtml = `
                                <div class="product-item border p-2 mb-1 rounded bg-light"
                                    data-id="${product.id}"
                                    data-name="${product.name}"
                                    data-price="${product.sale_price}"
                                    style="cursor: pointer; font-size: 14px;">
                                    ${product.code} - <strong>${product.name}</strong> - $${parseFloat(product.sale_price).toFixed(2)}
                                </div>
                            `;
                            productList.append(productHtml);
                        });

                        console.log("Productos agregados al DOM:", productList
                            .html()); // Verifica si realmente se están agregando
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la solicitud:", error);
                    }
                });
            });

            // Evento para seleccionar un producto
            $(document).on("click", ".product-item", function() {
                let productId = $(this).data("id");
                let productName = $(this).data("name");
                let productPrice = $(this).data("price");

                addItem(productId, productName, productPrice);
            });

            $(document).on("click", "#save", function(e) {
                e.preventDefault();

                if (items.length === 0) {
                    Swal.fire({
                        title: 'Ups!',
                        icon: 'info',
                        text: "Debe agregar al menos un producto.",
                        showConfirmButton: false,
                        timer: 5000
                    });
                    return;
                }

                let totalttc = items.reduce((sum, item) => sum + (item.quantity * item.price), 0);
                let type = 'sale';

                const formData = new FormData(document.getElementById("checkout-form"));
                formData.append("items", JSON.stringify(items));

                // Enviar la solicitud al backend de la creación de la transacción
                fetch('/crear-transaccion', {
                        method: "POST",
                        body: JSON.stringify({
                            items: items,
                            type: type,
                            customer: formData.get("customer"),
                            box_id: $("#box-id").val(),
                            price: totalttc,
                            quantity: items.length
                        }),
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        let transactionId = data?.transactionId;
                        window.location.href = "/ver-transaccion/" + transactionId;
                    })
                    .catch(error => console.error("Error:", error));
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
                    timer: result?.status == 'error' ? 6000 : 2000,
                });
            }
        @endif
    </script>
@endsection
