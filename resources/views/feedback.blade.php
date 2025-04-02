<!-- Modal Feedback -->
<div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="feedbackLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="feedbackLabel">Tu opinión es importante</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form action="{{ route('feedback') }}" method="POST" role="form text-left" class="mt-3">
                    @csrf
                    <div class="mb-4">
                        <!-- Selección por rango de estrellas -->
                        <label class="form-label">¿Cómo calificarías tu experiencia?</label>
                        <div class="rating-stars mb-2">
                            <div class="d-flex justify-content-center">
                                <input type="hidden" id="rating-value" name="rating" value="0">
                                <i class="bi bi-star-fill star-rating" data-value="1"
                                    style="font-size: 1.8rem; cursor: pointer; color: #ddd;"></i>
                                <i class="bi bi-star-fill star-rating" data-value="2"
                                    style="font-size: 1.8rem; cursor: pointer; color: #ddd;"></i>
                                <i class="bi bi-star-fill star-rating" data-value="3"
                                    style="font-size: 1.8rem; cursor: pointer; color: #ddd;"></i>
                                <i class="bi bi-star-fill star-rating" data-value="4"
                                    style="font-size: 1.8rem; cursor: pointer; color: #ddd;"></i>
                                <i class="bi bi-star-fill star-rating" data-value="5"
                                    style="font-size: 1.8rem; cursor: pointer; color: #ddd;"></i>
                            </div>
                            <small class="text-muted d-block text-center mt-1">Haz clic para calificar</small>
                        </div>
                    </div>
                    <!-- Comentarios -->
                    <div class="mb-3">
                        <label class="form-label">Comentarios:</label>
                        <textarea class="form-control" name="comments" rows="3" placeholder="¿Qué podemos mejorar?" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //Sección para visualización y dinamica de las estrellas
    $(document).ready(function() {
        // Sistema de rating por estrellas
        $('.star-rating').on('click', function() {
            const value = $(this).data('value');
            $('#rating-value').val(value);

            // Actualiza todas las estrellas
            $('.star-rating').each(function() {
                if ($(this).data('value') <= value) {
                    $(this).addClass('active').css('color', '#ffc107');
                } else {
                    $(this).removeClass('active').css('color', '#ddd');
                }
            });
        });

        // Efecto hover
        $('.star-rating').hover(
            function() {
                const hoverValue = $(this).data('value');
                $('.star-rating').each(function() {
                    if ($(this).data('value') <= hoverValue) {
                        $(this).css('color', '#ffc107');
                    }
                });
            },
            function() {
                const currentValue = $('#rating-value').val();
                $('.star-rating').each(function() {
                    if ($(this).data('value') > currentValue) {
                        $(this).css('color', '#ddd');
                    }
                });
            }
        );
    });
</script>
