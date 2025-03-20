<footer class="footer py-5">
    <div class="container">
        @if (!auth()->user() || \Request::is('static-sign-up'))
            <div class="row">
                <div class="copyright text-center text-sm text-muted text-lg-center mt-4">
                    © <span id="current-year"></span>, Hecho con <i class="fa fa-heart"></i> en
                    <a href="#" class="font-weight-bold" target="_blank">Colombia </a>&amp; 
                    <a style="color: #252f40;" href="#" class="font-weight-bold ml-1" target="_blank">
                        Digital Market
                    </a>
                    Para una mejor web.
                </div>
            </div>
        @endif
    </div>
</footer>

<script>
    document.getElementById('current-year').innerHTML = new Date().getFullYear();
</script>
