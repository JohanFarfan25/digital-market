<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <!-- Breadcrumb -->
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 flex-grow-1">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    {{ str_replace('-', ' ', Request::path()) }}
                </li>
            </ol>

            <!-- Rol + Avatar (Contenedor Flex) -->
            <div class="d-flex align-items-center ms-auto">
                <!-- Rol del usuario -->
                <div class="nav-item pe-2 title-rol">
                    ({{ auth()->user()->getRoleNames()->first() ?? 'Invitado' }})
                </div>

                <!-- Imagen de perfil -->
                <div class="nav-link text-body font-weight-bold px-0">
                    @if (auth()->user()->profile_picture)
                        <img src="{{ asset(auth()->user()->profile_picture) }}" alt="{{ auth()->user()->name }}"
                            class="img-fluid rounded-circle img-avatar-2">
                    @else
                        <div
                            class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center img-avatar-2">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <div class="ms-md-3 pe-md-3 d-flex flex-column flex-md-row align-items-center">
                <!-- Botón: Cerrar caja -->
                <div class="nav-item btn-box">
                    @role(env('ROLE_SUPER_ADMIN'))
                        <a href="{{ url('vista-caja') }}"
                            class="{{ Request::is('vista-caja') ? 'active' : '' }} btn bg-gradient-success btn-responsive">
                            Cerrar caja
                        </a>
                    @endrole
                </div>
                <!-- Botón: Generar Compra -->
                <div class="nav-item btn-billing">
                    @role(env('ROLE_SUPER_ADMIN'))
                        <a href="{{ url('facturacion-compra') }}"
                            class="{{ Request::is('facturacion-compra') ? 'active' : '' }} btn bg-gradient-secondary btn-responsive">
                            Generar Compra
                        </a>
                    @endrole
                </div>

                <!-- Botón: Generar Venta -->
                <div class="nav-item btn-purchase">
                    @role(env('ROLE_SUPER_ADMIN'))
                        <a href="{{ url('facturacion') }}"
                            class="{{ Request::is('facturacion') ? 'active' : '' }} btn bg-gradient-info btn-responsive">
                            Generar Venta
                        </a>
                    @endrole
                </div>
            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ url('/logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <div
                            class="icon icon-shape icon-sm shadow border: 1px border-radius-md bg-white text-center me-2 d-none d-sm-flex align-items-center justify-content-center icon-logout-header">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 17L21 12M21 12L16 7M21 12H9" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 21H5C4.44772 21 4 20.5523 4 20V4C4 3.44772 4.44772 3 5 3H9"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <span class="d-sm-inline d-none">Cerrar Sesión</span>
                    </a>
                </li>

                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
