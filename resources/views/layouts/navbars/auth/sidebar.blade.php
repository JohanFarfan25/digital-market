<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header mb-3">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
            <span class="ms-0 font-weight-bold" style="display: inline-block; width: 100%; max-width: 180px;">
                <svg viewBox="0 0 250 100" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
                    <text x="10" y="40" font-family="Arial, sans-serif" font-size="32" font-weight="bold"
                        fill="#17c1e8">
                        Digital
                    </text>
                    <text x="110" y="40" font-family="Arial, sans-serif" font-size="32" font-weight="bold"
                        fill="#8392AB">
                        Market
                    </text>
                    <text x="10" y="70" font-family="Arial, sans-serif" font-size="16" fill="#555">
                        Optimizar, controlar y crecer
                    </text>º
                    <circle cx="100" cy="30" r="5" fill="#8392AB" />
                    <rect x="102" y="25" width="6" height="10" fill="#8392AB" />
                </svg>
            </span>
        </a>
    </div>
    <span class="ms-4 font-weight-bold" style="font-size: 80%;">{{ auth()->user()->name }}</span>
    <hr class="horizontal dark mt-3">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}"
                    id="dashboard-link">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="2 2 20 20" width="35px" height="35px">
                            <path fill="#7f8388" d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Gestión de usuarios</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('perfil-usuario') ? 'active' : '' }} "
                    href="{{ url('perfil-usuario') }}" id="perfil-usuario-link">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="800px" height="800px" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="Rounded-Icons" transform="translate(-1717.000000, -291.000000)" fill="#7f8388"
                                fill-rule="nonzero">
                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                    <g id="customer-support" transform="translate(1.000000, 0.000000)">
                                        <path
                                            d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                            fill="#7f8388" />
                                        <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z"
                                            fill="#7f8388" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Perfil</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ Request::is('usuarios') ? 'active' : '' }}" href="{{ url('usuarios') }}"
                    id="usuarios-link">
                    <div
                        class="icon icon-shape icon-sm shadow border: 1px border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg fill="#7f8388" width="800px" height="800px" viewBox="7 7 25 25" version="1.1"
                            preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Rounded-Icons" transform="translate(-1717.000000, -291.000000)" fill="#7f8388"
                                fill-rule="nonzero">
                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                    <g id="customer-support" transform="translate(1.000000, 0.000000)">
                                        <path class="clr-i-solid--badged clr-i-solid-path-1--badged"
                                            d="M12,16.14q-.43,0-.87,0a8.67,8.67,0,0,0-6.43,2.52l-.24.28v8.28H8.54v-4.7l.55-.62.25-.29a11,11,0,0,1,4.71-2.86A6.58,6.58,0,0,1,12,16.14Z">
                                        </path>
                                        <path class="clr-i-solid--badged clr-i-solid-path-2--badged"
                                            d="M31.34,18.63a8.67,8.67,0,0,0-6.43-2.52,10.47,10.47,0,0,0-1.09.06,6.59,6.59,0,0,1-2,2.45,10.91,10.91,0,0,1,5,3l.25.28.54.62v4.71h3.94V18.91Z">
                                        </path>
                                        <path class="clr-i-solid--badged clr-i-solid-path-3--badged"
                                            d="M11.1,14.19c.11,0,.2,0,.31,0a6.45,6.45,0,0,1,3.11-6.29,4.09,4.09,0,1,0-3.42,6.33Z">
                                        </path>
                                        <circle class="clr-i-solid--badged clr-i-solid-path-4--badged" cx="17.87"
                                            cy="13.45" r="4.47"></circle>
                                        <path class="clr-i-solid--badged clr-i-solid-path-5--badged"
                                            d="M18.11,20.3A9.69,9.69,0,0,0,11,23l-.25.28v6.33a1.57,1.57,0,0,0,1.6,1.54H23.84a1.57,1.57,0,0,0,1.6-1.54V23.3L25.2,23A9.58,9.58,0,0,0,18.11,20.3Z">
                                        </path>
                                        <path class="clr-i-solid--badged clr-i-solid-path-6--badged"
                                            d="M24.43,13.44a6.54,6.54,0,0,1,0,.69,4.09,4.09,0,0,0,.58.05h.19a4.05,4.05,0,0,0,2.52-1,7.5,7.5,0,0,1-5.14-6.32A4.13,4.13,0,0,0,21.47,8,6.53,6.53,0,0,1,24.43,13.44Z">
                                        </path>
                                        <circle class="clr-i-solid--badged clr-i-solid-path-7--badged clr-i-badge"
                                            cx="30" cy="6" r="5"></circle>
                                        <rect x="0" y="0" width="36" height="36" fill-opacity="0" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Usuarios</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ Request::is('roles') ? 'active' : '' }}" href="{{ url('roles') }}"
                    id="roles-link">
                    <div
                        class="icon icon-shape icon-sm shadow border: 1px border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" fill="#7f8388"
                            xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="20 15 60 60"
                            enable-background="new 0 0 100 100">
                            <g id="Rounded-Icons" transform="translate(-1717.000000, -291.000000)" fill="#7f8388"
                                fill-rule="nonzero">
                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                    <g id="customer-support" transform="translate(1.000000, 0.000000)">
                                        <path
                                            d="M44,63.3c0-3.4,1.1-7.2,2.9-10.2c2.1-3.7,4.5-5.2,6.4-8c3.1-4.6,3.7-11.2,1.7-16.2c-2-5.1-6.7-8.1-12.2-8&#10;&#9;s-10,3.5-11.7,8.6c-2,5.6-1.1,12.4,3.4,16.6c1.9,1.7,3.6,4.5,2.6,7.1c-0.9,2.5-3.9,3.6-6,4.6c-4.9,2.1-10.7,5.1-11.7,10.9&#10;&#9;c-1,4.7,2.2,9.6,7.4,9.6h21.2c1,0,1.6-1.2,1-2C45.8,72.7,44,68.1,44,63.3z M64,48.3c-8.2,0-15,6.7-15,15s6.7,15,15,15s15-6.7,15-15&#10;&#9;S72.3,48.3,64,48.3z M66.6,64.7c-0.4,0-0.9-0.1-1.2-0.2l-5.7,5.7c-0.4,0.4-0.9,0.5-1.2,0.5c-0.5,0-0.9-0.1-1.2-0.5&#10;&#9;c-0.6-0.6-0.6-1.7,0-2.5l5.7-5.7c-0.1-0.4-0.2-0.7-0.2-1.2c-0.2-2.6,1.9-5,4.5-5c0.4,0,0.9,0.1,1.2,0.2c0.2,0,0.2,0.2,0.1,0.4&#10;&#9;L66,58.9c-0.2,0.1-0.2,0.5,0,0.6l1.7,1.7c0.2,0.2,0.5,0.2,0.7,0l2.5-2.5c0.1-0.1,0.4-0.1,0.4,0.1c0.1,0.4,0.2,0.9,0.2,1.2&#10;&#9;C71.6,62.8,69.4,64.9,66.6,64.7z"
                                            fill="#7f8388" />
                                    </g>
                                </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Roles</span>
                </a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ Request::is('permisos') ? 'active' : '' }}" href="{{ url('permisos') }}"
                    id="permisos-link">
                    <div
                        class="icon icon-shape icon-sm shadow border: 1px border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="512px" height="512px"
                            version="1.1" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                            image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                            viewBox="0 0 512 512">
                            <g id="Rounded-Icons" transform="translate(-1717.000000, -291.000000)" fill="#7f8388"
                                fill-rule="nonzero">
                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                    <g id="customer-support" transform="translate(1.000000, 0.000000)">
                                        <path fill="#7f8388" fill-rule="nonzero"
                                            d="M423.51 61.53c-5.02,-5.03 -10.92,-7.51 -17.75,-7.51 -6.82,0 -12.8,2.48 -17.75,7.51l-27.05 26.97c-7.25,-4.7 -14.93,-8.8 -22.95,-12.47 -8.02,-3.67 -16.22,-6.82 -24.5,-9.55l0 -41.48c0,-7 -2.38,-12.89 -7.25,-17.75 -4.86,-4.86 -10.75,-7.25 -17.75,-7.25l-52.05 0c-6.66,0 -12.45,2.39 -17.49,7.25 -4.95,4.86 -7.43,10.75 -7.43,17.75l0 37.98c-8.7,2.04 -17.15,4.6 -25.26,7.76 -8.19,3.16 -15.95,6.74 -23.29,10.75l-29.96 -29.53c-4.69,-4.94 -10.4,-7.5 -17.32,-7.5 -6.83,0 -12.71,2.56 -17.75,7.5l-36.43 36.54c-5.03,5.03 -7.51,10.92 -7.51,17.73 0,6.83 2.48,12.81 7.51,17.75l26.97 27.06c-4.7,7.26 -8.79,14.93 -12.46,22.95 -3.68,8.02 -6.83,16.22 -9.56,24.49l-41.47 0c-7.01,0 -12.9,2.39 -17.76,7.26 -4.86,4.86 -7.25,10.75 -7.25,17.75l0 52.05c0,6.65 2.39,12.46 7.25,17.5 4.86,4.94 10.75,7.42 17.76,7.42l37.97 0c2.04,8.7 4.6,17.15 7.76,25.25 3.17,8.2 6.75,16.13 10.75,23.81l-29.52 29.44c-4.95,4.7 -7.51,10.41 -7.51,17.33 0,6.82 2.56,12.71 7.51,17.75l36.53 36.95c5.03,4.69 10.92,7 17.75,7 6.82,0 12.79,-2.31 17.75,-7l27.04 -27.48c7.26,4.69 14.94,8.78 22.96,12.46 8.02,3.66 16.21,6.83 24.49,9.55l0 41.48c0,7 2.39,12.88 7.25,17.74 4.86,4.87 10.76,7.26 17.75,7.26l52.05 0c6.66,0 12.46,-2.39 17.5,-7.26 4.94,-4.86 7.42,-10.74 7.42,-17.74l0 -37.98c8.7,-2.04 17.15,-4.6 25.25,-7.76 8.2,-3.16 16.14,-6.74 23.81,-10.75l29.44 29.53c4.7,4.95 10.49,7.5 17.51,7.5 7.07,0 12.87,-2.55 17.57,-7.5l36.95 -36.53c4.69,-5.04 7,-10.92 7,-17.75 0,-6.82 -2.31,-12.8 -7,-17.75l-27.48 -27.05c4.7,-7.26 8.79,-14.93 12.46,-22.96 3.66,-8.01 6.83,-16.21 9.56,-24.49l41.47 0c7,0 12.88,-2.4 17.74,-7.25 4.87,-4.87 7.26,-10.75 7.26,-17.75l0 -52.05c0,-6.66 -2.39,-12.45 -7.26,-17.5 -4.86,-4.95 -10.74,-7.42 -17.74,-7.42l-37.98 0c-2.04,-8.36 -4.6,-16.73 -7.76,-25 -3.16,-8.37 -6.74,-16.21 -10.75,-23.56l29.53 -29.95c4.95,-4.69 7.5,-10.41 7.5,-17.32 0,-6.83 -2.55,-12.71 -7.5,-17.75l-36.53 -36.43zm-48.41 257.98c-22.72,42.52 -67.54,71.44 -119.1,71.44 -51.58,0 -96.37,-28.92 -119.09,-71.42 2.66,-11.61 7.05,-21.74 19.9,-28.84 17.76,-9.89 48.34,-9.15 62.89,-22.24l20.1 52.78 10.1 -28.77 -4.95 -5.42c-3.72,-5.44 -2.44,-11.62 4.46,-12.74 2.33,-0.37 4.95,-0.14 7.47,-0.14 2.69,0 5.68,-0.25 8.22,0.32 6.41,1.41 7.07,7.62 3.88,12.56l-4.95 5.42 10.11 28.77 18.18 -52.78c13.12,11.8 48.43,14.18 62.88,22.24 12.89,7.22 17.26,17.24 19.9,28.82zm-159.11 -86.45c-1.82,0.03 -3.31,-0.2 -4.93,-1.1 -2.15,-1.19 -3.67,-3.24 -4.7,-5.55 -2.17,-4.86 -3.89,-17.63 1.57,-21.29l-1.02 -0.66 -0.11 -1.41c-0.21,-2.57 -0.26,-5.68 -0.32,-8.95 -0.2,-12 -0.45,-26.56 -10.37,-29.47l-4.25 -1.26 2.81 -3.38c8.01,-9.64 16.38,-18.07 24.82,-24.54 9.55,-7.33 19.26,-12.2 28.75,-13.61 9.77,-1.44 19.23,0.75 27.97,7.62 2.57,2.03 5.08,4.48 7.5,7.33 9.31,0.88 16.94,5.77 22.38,12.75 3.24,4.16 5.71,9.09 7.29,14.33 1.56,5.22 2.24,10.77 1.95,16.23 -0.53,9.8 -4.2,19.35 -11.61,26.33 1.3,0.04 2.53,0.33 3.61,0.91 4.14,2.15 4.27,6.82 3.19,10.75 -1.08,3.28 -2.44,7.08 -3.73,10.28 -1.56,4.31 -3.85,5.12 -8.27,4.65 -9.93,43.45 -69.98,44.93 -82.53,0.04zm40.01 -135.69c87.64,0 158.63,71.04 158.63,158.63 0,87.64 -71.04,158.63 -158.63,158.63 -87.63,0 -158.63,-71.04 -158.63,-158.63 0,-87.64 71.04,-158.63 158.63,-158.63z" />
                                        />
                                    </g>
                                </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Permisos</span>
                </a>
            </li>
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Gestión de recursos</h6>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ Request::is('productos') ? 'active' : '' }}" href="{{ url('productos') }}"
                    id="productos-link">
                    <div
                        class="icon icon-shape icon-sm shadow border: 1px border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="800px" height="800px" viewBox="2 5 20 20" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0" fill="none" width="24" height="24" />
                            <g>
                                <path fill="#7f8388"
                                    d="M22 3H2v6h1v11c0 1.105.895 2 2 2h14c1.105 0 2-.895 2-2V9h1V3zM4 5h16v2H4V5zm15 15H5V9h14v11zm-2-9v6h-2v-2.59l-3.29 3.29-1.41-1.41L13.59 13H11v-2h6z" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Productos</span>
                </a>
            </li>
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Gestión de pagos</h6>
            </li>
            @if (auth()->check() && !auth()->user()->roles->isEmpty())
                <li class="nav-item pb-2">
                    <a class="nav-link {{ Request::is('facturacion') ? 'active' : '' }}"
                        href="{{ url('facturacion') }}" id="facturacion-link">
                        <div
                            class="icon icon-shape icon-sm shadow border: 1px border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg height="800px" width="800px" version="1.1" id="Capa_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="15 15 302.672 302.672" xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path style="fill:#7f8388;"
                                                d="M106.905,80.468c-4.702,5.263-6.989,11.497-6.989,18.723c0,7.118,1.963,13.05,5.932,17.861
                                                        c4.012,4.81,10.85,8.434,20.277,10.85V70.675C117.971,71.947,111.586,75.204,106.905,80.468z" />
                                            <path style="fill:#7f8388;"
                                                d="M138.614,152.816v62.642c8.132-1.014,14.884-4.53,20.19-10.591
                                                        c5.263-6.04,8.024-13.525,8.024-22.434c0-7.636-1.941-13.719-5.695-18.357C157.402,159.503,149.917,155.707,138.614,152.816z" />
                                            <path style="fill:#7f8388;" d="M479.583,291.775l0.841,1.294l-19.176-65.489c-2.438-8.348-8.003-15.229-15.66-19.414
                                                        c-7.636-4.163-16.458-5.134-24.742-2.696l-3.969,1.165c-6.536,1.898-11.066,6.967-15.164,12.209
                                                        c-5.846-16.049-22.779-25.41-39.367-20.579l-9.232,2.718c-6.04,1.79-10.656,5.803-14.647,10.246
                                                        c-0.043-0.151-0.561-2.049-0.561-2.049c-5.048-17.235-23.232-27.114-40.445-22.045l-9.232,2.696
                                                        c-5.716,1.661-9.362,6.428-13.244,10.721c-4.034-13.676-8.003-27.33-11.368-38.784V57.581c0-28.668-23.447-52.072-52.029-52.072
                                                        H52.093C23.469,5.509,0,28.914,0,57.581v182.23c0,28.668,23.469,52.093,52.093,52.093h159.494c4.077,0,8.003-0.582,11.821-1.488
                                                        c2.934,10.074,4.94,16.911,5.242,17.968c-4.918,15.121-13.956,62.361-16.933,77.935c0.043,5.134,2.265,25.152,17.58,35.851
                                                        l92.905,59.622c2.243,1.38,3.387,2.157,3.387,2.157c22.024,12.511,42.991,16.178,61.261,10.829l54.811-16.049
                                                        c37.08-10.829,61.52-56.106,61.002-91.503C502.297,366.604,487.672,307.91,479.583,291.775z M336.785,465.808
                                                        c-1.877-1.057-3.689-2.2-3.689-2.2c0.367,0.28-91.697-58.737-91.697-58.737c-6.191-4.336-8.456-14.15-8.758-17.58
                                                        c6.191-30.954,14.172-69.199,16.588-74.635l1.553-3.516l-0.992-3.947l-45.881-156.518c-1.726-5.954,1.812-12.446,7.765-14.215
                                                        l9.232-2.653c6.04-1.79,12.403,1.704,14.172,7.744l46.291,158.114l23.814-8.391l-2.589-9.707l-16.2-55.264
                                                        c-0.841-2.89-0.475-5.954,0.949-8.65c1.51-2.696,3.926-4.659,6.816-5.522l9.232-2.696c6.083-1.79,12.425,1.704,14.194,7.765
                                                        l19.759,67.344l26.51-4.724l-3.408-11.238l-9.168-31.04c-1.79-6.018,1.747-12.403,7.766-14.194l9.254-2.718
                                                        c6.018-1.769,12.382,1.747,14.15,7.787l13.719,46.658l27.244-3.085l-3.408-12.08l-4.918-16.782
                                                        c-0.82-2.934-0.475-6.018,0.992-8.715c1.402-2.675,3.861-4.616,6.73-5.436l4.055-1.186c2.891-0.863,5.91-0.496,8.585,0.949
                                                        c2.696,1.467,4.681,3.883,5.522,6.795l19.306,65.856l0.216,0.496c2.416,6.514,20.579,61.757,21.075,87.621
                                                        c0.388,27.05-18.357,62.836-45.752,70.882l-54.854,16.049C365.021,479.117,348.109,472.344,336.785,465.808z M174.443,217.464
                                                        c-9.232,9.728-21.139,14.905-35.872,15.617v21.312h-12.425v-0.022v-21.01c-10.397-1.294-18.961-3.624-25.583-7.054
                                                        c-6.536-3.365-12.166-8.844-16.911-16.394c-4.832-7.571-7.571-16.782-8.283-27.697l21.075-4.055
                                                        c1.704,11.303,4.487,19.565,8.564,24.85c5.867,7.485,12.964,11.648,21.118,12.468v-65.834
                                                        c-8.542-2.243-17.321-5.846-26.36-10.915c-6.709-3.732-11.842-8.866-15.445-15.488c-3.645-6.601-5.436-14.064-5.436-22.455
                                                        c0-14.905,5.263-26.963,15.811-36.217c7.032-6.234,17.537-10.009,31.407-11.433V43.042h12.446v10.095
                                                        c12.144,1.165,21.851,4.767,28.926,10.807c9.189,7.636,14.625,18.184,16.502,31.493l-21.571,3.257
                                                        c-1.294-8.262-3.84-14.56-7.744-18.982c-3.904-4.4-9.254-7.291-16.07-8.693v60.161c10.591,2.696,17.515,4.81,21.01,6.277
                                                        c6.493,2.869,11.799,6.385,15.962,10.505c4.12,4.098,7.291,9.017,9.448,14.69c2.286,5.673,3.343,11.821,3.343,18.443
                                                        C188.356,195.634,183.761,207.735,174.443,217.464z" />
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Facturación</span>
                    </a>
                </li>
                <li class="nav-item pb-2">
                    <a class="nav-link {{ Request::is('facturacion-compra') ? 'active' : '' }}"
                        href="{{ url('facturacion-compra') }}" id="facturacion-compra-link">
                        <div
                            class="icon icon-shape icon-sm shadow border: 1px border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4 3H20C20.55 3 21 3.45 21 4V20C21 20.55 20.55 21 20 21H4C3.45 21 3 20.55 3 20V4C3 3.45 3.45 3 4 3Z"
                                    stroke="#7f8388" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M7 9H17M7 13H17M7 17H12" stroke="#7f8388" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8 3V6M16 3V6" stroke="#7f8388" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Orden de Compra</span>
                    </a>
                </li>
            @endif
            <li class="nav-item pb-2">
                <a class="nav-link {{ Request::is('transacciones') ? 'active' : '' }}"
                    href="{{ url('transacciones') }}" id="transacciones-link">
                    <div
                        class="icon icon-shape icon-sm shadow border: 1px border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="10 15 412.00 412.00"
                            xml:space="preserve" width="181px" height="181px" fill="#7f8388" stroke="#000000"
                            stroke-width="9.728">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <path style="fill:#fffafa;"
                                    d="M146.712,6.456H512l0,0v251.768c0,22.84-18.512,41.352-41.352,41.352H105.36l0,0V47.808 C105.36,24.968,123.872,6.456,146.712,6.456L146.712,6.456z" />
                                <rect x="105.36" y="53.608" width="406.64" height="58.584" />
                                <path style="fill:#FFFFFF;"
                                    d="M4,501.544V253.776c0.024-20.616,16.736-37.328,37.352-37.352H402.64v247.76 c-0.024,20.624-16.728,37.336-37.352,37.36H4z" />
                                <path style="fill:#CCCCCC;"
                                    d="M398.64,220.424v243.768c-0.024,18.408-14.944,33.328-33.352,33.352H8V253.776 c0.024-18.408,14.944-33.328,33.352-33.352H398.64 M406.64,212.424H41.352C18.512,212.424,0,230.936,0,253.776l0,0v251.768h365.288 c22.84,0,41.352-18.512,41.352-41.352C406.64,464.192,406.64,212.424,406.64,212.424z" />
                                <rect y="259.568" width="406.64" height="58.584" />
                                <rect x="52.8" y="363.68" style="fill:#FFFFFF;" width="134.032" height="18.592" />
                                <g style="opacity:0.15;">
                                    <polygon
                                        points="105.36,212.424 406.64,212.424 406.64,299.72 430.576,299.72 430.576,187.864 105.36,187.864 " />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Transacciones</span>
                </a>
            </li>
            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Reportes</h6>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link {{ Request::is('reporte-caja') ? 'active' : '' }}"
                    href="{{ url('reporte-caja') }}" id="reporte-caja-link">
                    <div
                        class="icon icon-shape icon-sm shadow border: 1px border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="7 10 50 50" width="50" height="50">
                            <!-- Fondo del ícono -->
                            <rect width="64" height="64" fill="#7f8388" rx="10" ry="10" />

                            <!-- Caja -->
                            <rect x="18" y="18" width="28" height="28" fill="#FFFFFF" rx="4"
                                ry="4" />
                            <rect x="22" y="22" width="20" height="20" fill="#FFFFFF" rx="2"
                                ry="2" />

                            <!-- Gráfico de barras (representando ventas) -->
                            <rect x="26" y="34" width="4" height="8" fill="#7f8388" />
                            <rect x="32" y="30" width="4" height="12" fill="#7f8388" />
                            <rect x="38" y="26" width="4" height="16" fill="#7f8388" />

                            <!-- Texto "Reporte" -->
                            <text x="32" y="58" font-size="10" fill="#FFFFFF" text-anchor="middle"
                                font-family="Arial, sans-serif">Reporte</text>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Reporte de caja</span>
                </a>
            </li>
            <hr>
            <li class="nav-item pb-2">
                <a class="nav-link {{ Request::is('logout') ? 'active' : '' }}" href="{{ url('logout') }}"
                    id="logout-link">
                    <div
                        class="icon icon-shape icon-sm shadow border: 1px border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <!-- Flecha de salida -->
                            <path d="M16 17L21 12M21 12L16 7M21 12H9" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <!-- Puerta (opcional) -->
                            <path d="M9 21H5C4.44772 21 4 20.5523 4 20V4C4 3.44772 4.44772 3 5 3H9"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>

                    </div>
                    <span class="nav-link-text ms-1">Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Boton para acceder al modal de comentarios y recomendaciones -->
    <div class="sidenav-footer mx-1 mt-4">
        <div class="card card-background-feedback" id="sidenavCard">
            <div class="card-body text-start p-3 w-100">
                <div class="docs-info p-1">
                    <h6 class="mb-0">¡Ayudanos a mejorar!</h6>
                    <div class="row mt-1 p-1 sidenav-footer-container-feedback">
                        <button class="feedback-btn" data-bs-toggle="modal" data-bs-target="#feedback">Déjanos tu
                            opinión</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const svg = document.querySelector('svg');
            const texts = svg.querySelectorAll('text');
            let maxX = 0;

            texts.forEach(text => {
                const bbox = text.getBBox();
                if (bbox.x + bbox.width > maxX) {
                    maxX = bbox.x + bbox.width;
                }
            });

            // Ajustar el viewBox para que se ajuste al contenido
            svg.setAttribute('viewBox', `0 0 ${maxX + 20} 100`);
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Obtén el ítem activo
            const activeItem = document.querySelector('.nav-link.active');

            if (activeItem) {
                // Desplaza el ítem activo a la vista
                activeItem.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>
</aside>
