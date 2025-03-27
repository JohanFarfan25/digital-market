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
                                {{ __('Creación de Producto') }}
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
                    <form action="/crear-producto" method="POST" enctype="multipart/form-data" role="form text-left">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Contenedor para la vista previa de la imagen -->
                                <div class="form-group text-center">
                                    <div id="image-preview"
                                        class="border p-2 rounded d-inline-block container-preview-image image-preview">
                                        <img id="preview-image" src="" alt="Preview"
                                            class="img-fluid preview-image preview-image-disabled">
                                    </div>
                                </div>
                                <!-- Input para cargar imagen -->
                                <div class="form-group">
                                    <label for="image" class="form-control-label">{{ __('Cargar Imagen') }}</label>
                                    <div class="@error('user.image') border border-danger rounded-3 @enderror">
                                        <input type="file" id="image" class="form-control" name="image"
                                            accept="image/*">
                                        @error('image')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                            </div>
                            <!-- input para el nombre-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-name" class="form-control-label">{{ __('Nombre') }}</label>
                                    <div class="@error('product.name')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="Nombre" name="name"
                                            id="name" aria-label="Name" aria-describedby="name" required>
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- input para el Descripción-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-description"
                                        class="form-control-label">{{ __('Descripción') }}</label>
                                    <div class="@error('product.description')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="Descripción"
                                            name="description" id="description" aria-label="description"
                                            aria-describedby="description">
                                        @error('description')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- input para la Categoría-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-category" class="form-control-label">{{ __('Categoría') }}</label>
                                    <div class="@error('product.category')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="Categoría" name="category"
                                            id="category" aria-label="category" aria-describedby="category" required>
                                        @error('category')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- input para la Fecha de Expiración-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-expiration_date"
                                        class="form-control-label">{{ __('Fecha de Expiración') }}</label>
                                    <div class="@error('expiration_date') border border-danger rounded-3 @enderror">
                                        <!-- Campo de fecha con Flatpickr -->
                                        <input type="date" class="form-control"
                                            placeholder="Seleccione la fecha de expiración" name="expiration_date"
                                            id="expiration_date" aria-label="expiration_date"
                                            aria-describedby="expiration_date" required>
                                        @error('expiration_date')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- input para el Proveedor-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-supplier" class="form-control-label">{{ __('Proveedor') }}</label>
                                    <div class="@error('product.supplier')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="Proveedor" name="supplier"
                                            id="supplier" aria-label="supplier" aria-describedby="supplier" required>
                                        @error('supplier')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- input para el Precio de compra-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-purchase_price"
                                        class="form-control-label">{{ __('Precio de compra') }}</label>
                                    <div class="@error('product.purchase_price')border border-danger rounded-3 @enderror">
                                        <input type="number" class="form-control" placeholder="$0.00"
                                            name="purchase_price" id="purchase_price" aria-label="purchase_price"
                                            aria-describedby="purchase_price">
                                        @error('purchase_price')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- input para el Precio de venta-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-sale_price"
                                        class="form-control-label">{{ __('Precio de venta') }}</label>
                                    <div class="@error('product.sale_price')border border-danger rounded-3 @enderror">
                                        <input type="number" class="form-control" placeholder="$0.00" name="sale_price"
                                            id="sale_price" aria-label="sale_price" aria-describedby="sale_price">
                                        @error('sale_price')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- input para el Precio de Código-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-code" class="form-control-label">{{ __('Código') }}</label>
                                    <div class="@error('product.code')border border-danger rounded-3 @enderror">
                                        <input type="text" class="form-control" placeholder="000000000000000"
                                            name="code" id="code" aria-label="code" aria-describedby="code"
                                            required>
                                        @error('code')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- input para el Precio de Cantidad-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-quantity" class="form-control-label">{{ __('Cantidad') }}</label>
                                    <div class="@error('product.quantity')border border-danger rounded-3 @enderror">
                                        <input type="number" class="form-control" placeholder="" name="quantity"
                                            id="quantity" aria-label="quantity" aria-describedby="quantity" required>
                                        @error('quantity')
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
