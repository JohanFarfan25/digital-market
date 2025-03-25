@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="page-header min-height-200 border-radius-xl mt-4 page-header-background-linear-gradient"
                style="background-position-y: 50%;">
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n5">
                <div class="row gx-4">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mt-2">
                                {{ __('Vista de Producto') }}
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
                        <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary btn-sm mb-3 "
                            type="button">Regresar</a>
                    </div>
                    <form action="/vista-producto/{{ $product->id }}" method="POST" enctype="multipart/form-data"
                        role="form text-left">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Contenedor para la vista previa -->
                                <div class="form-group text-center">
                                    <div id="image-preview"
                                        class="border p-2 rounded d-inline-block container-preview-image">
                                        @if (!empty($product->image))
                                            <img id="preview-image" src="{{ asset($product->image) }}" alt="Preview"
                                                class="img-fluid preview-image">
                                        @else
                                            <img id="preview-image" src="" alt="Preview"
                                                class="img-fluid preview-image preview-image-disabled">
                                        @endif
                                    </div>
                                </div>
                                <!-- Input para cargar imagen -->
                                <div class="form-group">
                                    <label for="image" class="form-control-label">{{ __('Cargar Imagen') }}</label>
                                    <div class="@error('image') border border-danger rounded-3 @enderror">
                                        <input type="file" id="image" class="form-control" name="image"
                                            accept="image/*" onchange="previewImage(event)">
                                        @error('image')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Input para cel Nombre -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-name" class="form-control-label">{{ __('Nombre') }}</label>
                                    <div class="@error('product.name')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="Name" name="name"
                                            id="name" aria-label="Name" aria-describedby="name"
                                            value="{{ old('name', $product->name) }}">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Input para la Descripción-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-description"
                                        class="form-control-label">{{ __('Descripción') }}</label>
                                    <div class="@error('product.description')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="description"
                                            name="description" id="description" aria-label="description"
                                            aria-describedby="description"
                                            value="{{ old('description', $product->description) }}">
                                        @error('description')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Input para la Categoría-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-category" class="form-control-label">{{ __('Categoría') }}</label>
                                    <div class="@error('product.category')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="category" name="category"
                                            id="category" aria-label="category" aria-describedby="category"
                                            value="{{ old('category', $product->category) }}">
                                        @error('category')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Input para la Fecha de Expriración-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-expiration_date"
                                        class="form-control-label">{{ __('Fecha de Expriración') }}</label>
                                    <div class="@error('expiration_date') border border-danger rounded-3 @enderror">
                                        <!-- Campo de fecha con Flatpickr -->
                                        <input type="date" class="form-control"
                                            placeholder="Seleccione la fecha de expiración" name="expiration_date"
                                            id="expiration_date" aria-label="expiration_date"
                                            aria-describedby="expiration_date"
                                            value="{{ old('expiration_date', $product->expiration_date ? $product->expiration_date->format('Y-m-d') : '') }}"
                                            min="{{ now()->format('Y-m-d') }}">
                                        @error('expiration_date')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Input para el Proveedor -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-supplier"
                                        class="form-control-label">{{ __('Proveedor') }}</label>
                                    <div class="@error('product.supplier')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="Proveedor"
                                            name="supplier" id="supplier" aria-label="supplier"
                                            aria-describedby="supplier"
                                            value="{{ old('supplier', $product->supplier) }}">
                                        @error('supplier')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Input para el Precio de compra -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-sale_price"
                                        class="form-control-label">{{ __('Precio de compra') }}</label>
                                    <div class="@error('product.sale_price')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="purchase_price"
                                            name="purchase_price" id="purchase_price" aria-label="$0.00"
                                            aria-describedby="purchase_price"
                                            value="{{ old('purchase_price', $product->purchase_price) }}">
                                        @error('purchase_price')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Input para el Precio de venta -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-sale_price"
                                        class="form-control-label">{{ __('Precio de venta') }}</label>
                                    <div class="@error('product.sale_price')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="sale_price"
                                            name="sale_price" id="sale_price" aria-label="$0.00"
                                            aria-describedby="sale_price"
                                            value="{{ old('sale_price', $product->sale_price) }}">
                                        @error('sale_price')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Input para el Código -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-code" class="form-control-label">{{ __('Código') }}</label>
                                    <div class="@error('product.code')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="000000000000000"
                                            name="code" id="code" aria-label="code" aria-describedby="code"
                                            value="{{ old('code', $product->code) }}">
                                        @error('code')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @role(env('ROLE_SUPER_ADMIN'))
                                <div class="row col-md-6">
                                    <!-- Input para la cantidad -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product-quantity"
                                                class="form-control-label">{{ __('Cantidad') }}</label>
                                            <div class="@error('product.quantity')border border-danger rounded-3 @enderror">
                                                <input type="number" class="form-control" placeholder="" name="quantity"
                                                    id="quantity" aria-label="quantity" aria-describedby="quantity"
                                                    value="{{ old('quantity', $product->quantity) }}"
                                                    oninput="confirmQuantityChange(event)" min="0">
                                                @error('quantity')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product-in_stock"
                                                class="form-control-label">{{ __('Disponibles') }}</label>
                                            <div class="@error('product.in_stock')border border-danger rounded-3 @enderror">
                                                <input type="text" class="form-control" placeholder="0" name="in_stock"
                                                    id="in_stock" aria-label="in_stock" aria-describedby="in_stock"
                                                    value="{{ old('in_stock', $product->in_stock) }}" disabled>
                                                @error('in_stock')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endrole
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
        const currentQuantity = document.getElementById('quantity').value;
        const currentInStock = document.getElementById('in_stock').value;

        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('preview-image');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result; // Establecer la URL de la imagen
                    previewImage.style.display = 'block'; // Mostrar la imagen
                };
                reader.readAsDataURL(file); // Leer el archivo seleccionado
            } else {
                previewImage.src = '';
                previewImage.style.display = 'none'; // Ocultar la imagen si no hay archivo seleccionado
            }
        });

        function confirmQuantityChange(event) {

            const quantityInput = event.target;
            const inStockInput = document.getElementById('in_stock');
            const newQuantity = quantityInput.value;

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Al cambiar la cantidad, también se actualizará el stock disponible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#21d4fd',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualizar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, actualiza el campo in_stock
                    inStockInput.value = newQuantity;
                } else {
                    // Si el usuario cancela, restaura el valor original
                    quantityInput.value = currentQuantity;
                    inStockInput.value = currentInStock;
                }
            });
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
                    timer: result?.status == 'error' ? 5000 : 2000,
                });
            }
        @endif
    </script>
@endsection
