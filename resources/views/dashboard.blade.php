@extends('layouts.user_type.auth')

@section('content')
    <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
        <div class="col-auto my-auto p-3">
            <div class="h-100 font-weight-bolder mb-0" style="display: flex; justify-content: space-start;">
                <h1>Welcome to the Dashboard</h1>
                </p>
            </div>
        </div>
    </div>
    <script>
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
