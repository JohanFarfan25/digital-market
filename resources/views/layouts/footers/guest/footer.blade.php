<footer class="footer py-2">
    <div class="container">
        @if (!auth()->user() || \Request::is('static-sign-up'))
            <div class="row">
                <div class="col-lg-12 mb-4 mt-4">
                    <div class="social-container">
                        <!-- Título - visible siempre pero con diferente posición -->
                        <div class="text-md-start mb-2 mb-md-0 title-social">
                            <b>Contáctanos</b>
                        </div>

                        <!-- Contenedor de iconos -->
                        <div
                            class="social-links d-flex justify-content-center justify-content-md-between align-items-center px-3">
                            <!-- Whatsapp -->
                            <a href="https://wa.me/573227111889" target="_blank" class="social-icon"
                                aria-label="Enviar mensaje por WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>

                            <!-- Facebook -->
                            <a href="https://m.me/JohanFarfanSierra" target="_blank" class="social-icon"
                                aria-label="Enviar mensaje por Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>

                            <!-- Instagram -->
                            <a href="https://instagram.com/direct?username=johanfarfansierra" target="_blank"
                                class="social-icon instagram" aria-label="Enviar mensaje por Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>

                            <!-- LinkedIn -->
                            <a href="https://www.linkedin.com/messaging/thread/new/?recipient=617844b7" target="_blank"
                                class="social-icon linkedin" aria-label="Enviar mensaje por LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="copyright text-center text-sm text-muted text-lg-center mt-1">
                    © <span id="current-year"></span>, Hecho con <i class="fa fa-heart"></i> en
                    <a href="#" class="font-weight-bold" target="_blank">Colombia </a>&amp;
                    <a style="color: #252f40;" href="#" class="font-weight-bold ml-1" target="_blank">
                        Johan Alexander Farfán Sierra
                    </a>
                    Para el Politécnico Gran Colombiano.
                </div>
            </div>
        @endif
    </div>
    <br>
</footer>

<script>
    document.getElementById('current-year').innerHTML = new Date().getFullYear();
</script>
