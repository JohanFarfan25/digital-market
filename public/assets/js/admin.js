"use strict";

// Función auto-ejecutable para inicializar PerfectScrollbar en elementos específicos si el SO es Windows
!(function () {
    var e, t;
    // Verifica si la plataforma es Windows
    -1 < navigator.platform.indexOf("Win") &&
        // Inicializa PerfectScrollbar en elementos con clase "main-content"
        (document.getElementsByClassName("main-content")[0] &&
            ((e = document.querySelector(".main-content")),
                new PerfectScrollbar(e)),
            // Inicializa PerfectScrollbar en el sidenav
            document.getElementsByClassName("sidenav")[0] &&
            ((e = document.querySelector(".sidenav")), new PerfectScrollbar(e)),
            // Inicializa PerfectScrollbar en el navbar-collapse
            document.getElementsByClassName("navbar-collapse")[0] &&
            ((t = document.querySelector(".navbar-collapse")),
                new PerfectScrollbar(t)),
            // Inicializa PerfectScrollbar en el fixed-plugin
            document.getElementsByClassName("fixed-plugin")[0] &&
            ((t = document.querySelector(".fixed-plugin")),
                new PerfectScrollbar(t)));
})(),

// Inicializa el efecto blur en el navbar con ID "navbarBlur"
document.getElementById("navbarBlur") && navbarBlurOnScroll("navbarBlur");

// Variables globales para el calendario y otros elementos
var calendarEl, today, mYear, weekday, mDay, m, d, calendar, allInputs, fixedPlugin, 
    fixedPluginButton, fixedPluginButtonNav, fixedPluginCard, fixedPluginCloseButton, 
    navbar, buttonNavbarFixed;

// Inicializa popovers y tooltips de Bootstrap
var popoverTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="popover"]')
    ),
    popoverList = popoverTriggerList.map(function (e) {
        return new bootstrap.Popover(e);
    }),
    tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    ),
    tooltipList = tooltipTriggerList.map(function (e) {
        return new bootstrap.Tooltip(e);
    });

// Función para agregar clase "focused" al input-group cuando un input recibe foco
function focused(e) {
    e.parentElement.classList.contains("input-group") &&
        e.parentElement.classList.add("focused");
}

// Función para remover clase "focused" al input-group cuando un input pierde foco
function defocused(e) {
    e.parentElement.classList.contains("input-group") &&
        e.parentElement.classList.remove("focused");
}

// Función para asignar múltiples atributos a un elemento
function setAttributes(t, n) {
    Object.keys(n).forEach(function (e) {
        t.setAttribute(e, n[e]);
    });
}

// Función para manejar el despliegue de dropdowns
function dropDown(e) {
    if (!document.querySelector(".dropdown-hover")) {
        event.stopPropagation(), event.preventDefault();
        // Cierra otros dropdowns y abre/cierra el actual
        for (var t = e.parentElement.parentElement.children, n = 0; n < t.length; n++)
            t[n].lastElementChild != e.parentElement.lastElementChild &&
                t[n].lastElementChild.classList.remove("show");
        e.nextElementSibling.classList.contains("show")
            ? e.nextElementSibling.classList.remove("show")
            : e.nextElementSibling.classList.add("show");
    }
}

// Función para cambiar el color del sidenav
function sidebarColor(e) {
    // Remueve la clase "active" de todos los elementos hermanos
    for (var t, n = e.parentElement.children, a = e.getAttribute("data-color"), i = 0; i < n.length; i++)
        n[i].classList.remove("active");
    // Alterna la clase "active" en el elemento clickeado
    e.classList.contains("active")
        ? e.classList.remove("active")
        : e.classList.add("active"),
        // Aplica el color al sidenav
        document.querySelector(".sidenav").setAttribute("data-color", a),
        // Actualiza estilos de la tarjeta del sidenav
        document.querySelector("#sidenavCard") &&
        ((t = ["card", "card-background", "shadow-none", "card-background-mask-" + a]),
            ((e = document.querySelector("#sidenavCard")).className = ""),
            e.classList.add(...t),
            (t = ["ni", "ni-diamond", "text-gradient", "text-lg", "top-0", "text-" + a]),
            ((a = document.querySelector("#sidenavCardIcon")).className = ""),
            a.classList.add(...t));
}

// Función para cambiar el tipo de sidenav (ej: transparente, blanco)
function sidebarType(e) {
    // Remueve clases activas y recopila clases de todos los elementos
    for (var t = e.parentElement.children, n = e.getAttribute("data-class"), a = [], i = 0; i < t.length; i++)
        t[i].classList.remove("active"),
            a.push(t[i].getAttribute("data-class"));
    // Alterna la clase "active" en el elemento clickeado
    e.classList.contains("active")
        ? e.classList.remove("active")
        : e.classList.add("active");
    // Aplica la nueva clase al sidenav
    for (var l = document.querySelector(".sidenav"), i = 0; i < a.length; i++)
        l.classList.remove(a[i]);
    l.classList.add(n);
}

// Función para fijar el navbar en la parte superior
function navbarFixed(e) {
    var t = ["position-sticky", "blur", "shadow-blur", "mt-4", "left-auto", "top-1", "z-index-sticky"];
    const n = document.getElementById("navbarBlur");
    // Alterna entre navbar fijo y no fijo
    e.getAttribute("checked")
        ? (n.classList.remove(...t),
            n.setAttribute("data-scroll", "false"),
            navbarBlurOnScroll("navbarBlur"),
            e.removeAttribute("checked"))
        : (n.classList.add(...t),
            n.setAttribute("data-scroll", "true"),
            navbarBlurOnScroll("navbarBlur"),
            e.setAttribute("checked", "true"));
}

// Función para minimizar el sidenav
function navbarMinimize(e) {
    var t = document.getElementsByClassName("g-sidenav-show")[0];
    // Alterna entre sidenav minimizado y expandido
    e.getAttribute("checked")
        ? (t.classList.remove("g-sidenav-hidden"),
            t.classList.add("g-sidenav-pinned"),
            e.removeAttribute("checked"))
        : (t.classList.remove("g-sidenav-pinned"),
            t.classList.add("g-sidenav-hidden"),
            e.setAttribute("checked", "true"));
}

// Función para aplicar efecto blur al navbar al hacer scroll
function navbarBlurOnScroll(e) {
    const t = document.getElementById(e);
    var n, e = !!t && t.getAttribute("data-scroll");
    let a = ["blur", "shadow-blur", "left-auto"],
        i = ["shadow-none"];

    // Aplica estilos de blur
    function l() {
        t.classList.add(...a), t.classList.remove(...i), r("blur");
    }

    // Remueve estilos de blur
    function o() {
        t.classList.remove(...a), t.classList.add(...i), r("transparent");
    }

    // Actualiza estilos de los elementos del navbar
    function r(e) {
        let t = document.querySelectorAll(".navbar-main .nav-link"),
            n = document.querySelectorAll(".navbar-main .sidenav-toggler-line");
        "blur" === e
            ? (t.forEach((e) => { e.classList.remove("text-body"); }),
                n.forEach((e) => { e.classList.add("bg-dark"); }))
            : "transparent" === e &&
            (t.forEach((e) => { e.classList.add("text-body"); }),
                n.forEach((e) => { e.classList.remove("bg-dark"); }));
    }

    // Configura eventos de scroll con debounce para mejor performance
    (window.onscroll = debounce(
        "true" == e
            ? function () { (5 < window.scrollY ? l : o)(); }
            : function () { o(); },
        10
    )),
        // Configura eventos de scroll para Windows con PerfectScrollbar
        -1 < navigator.platform.indexOf("Win") &&
        ((n = document.querySelector(".main-content")),
            "true" == e
                ? n.addEventListener("ps-scroll-y", debounce(function () { (5 < n.scrollTop ? l : o)(); }, 10))
                : n.addEventListener("ps-scroll-y", debounce(function () { o(); }, 10)));
}

// Función debounce para limitar la frecuencia de ejecución de eventos
function debounce(a, i, l) {
    var o;
    return function () {
        var e = this, t = arguments, n = l && !o;
        clearTimeout(o),
            (o = setTimeout(function () { (o = null), l || a.apply(e, t); }, i)),
            n && a.apply(e, t);
    };
}

// Inicialización de toasts de Bootstrap al cargar el DOM
document.addEventListener("DOMContentLoaded", function () {
    [].slice.call(document.querySelectorAll(".toast")).map(function (e) {
        return new bootstrap.Toast(e);
    });
    [].slice.call(document.querySelectorAll(".toast-btn")).map(function (t) {
        t.addEventListener("click", function () {
            var e = document.getElementById(t.dataset.target);
            e && bootstrap.Toast.getInstance(e).show();
        });
    });
}),

// Configuración del widget de calendario (FullCalendar)
document.querySelector('[data-toggle="widget-calendar"]') &&
    ((calendarEl = document.querySelector('[data-toggle="widget-calendar"]')),
        (mYear = (today = new Date()).getFullYear()),
        (mDay = (weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"])[today.getDay()]),
        (m = today.getMonth()),
        (d = today.getDate()),
        (document.getElementsByClassName("widget-calendar-year")[0].innerHTML = mYear),
        (document.getElementsByClassName("widget-calendar-day")[0].innerHTML = mDay),
        (calendar = new FullCalendar.Calendar(calendarEl, {
            contentHeight: "auto",
            initialView: "dayGridMonth",
            selectable: !0,
            initialDate: "2020-12-01",
            editable: !0,
            headerToolbar: !1,
            events: [ /* Eventos del calendario */ ],
        })).render()),

// Configuración de eventos focus/focusout para inputs
0 != document.querySelectorAll(".input-group").length &&
    (allInputs = document.querySelectorAll("input.form-control")).forEach(
        (e) => setAttributes(e, { onfocus: "focused(this)", onfocusout: "defocused(this)" })
    ),

// Configuración del plugin fijo (panel de configuración)
document.querySelector(".fixed-plugin") &&
    ((fixedPlugin = document.querySelector(".fixed-plugin")),
        (fixedPluginButton = document.querySelector(".fixed-plugin-button")),
        (fixedPluginButtonNav = document.querySelector(".fixed-plugin-button-nav")),
        (fixedPluginCard = document.querySelector(".fixed-plugin .card")),
        (fixedPluginCloseButton = document.querySelectorAll(".fixed-plugin-close-button")),
        (navbar = document.getElementById("navbarBlur")),
        (buttonNavbarFixed = document.getElementById("navbarFixed")),
        // Eventos para mostrar/ocultar el panel de configuración
        fixedPluginButton && (fixedPluginButton.onclick = function () {
            fixedPlugin.classList.contains("show") ? fixedPlugin.classList.remove("show") : fixedPlugin.classList.add("show");
        }),
        fixedPluginButtonNav && (fixedPluginButtonNav.onclick = function () {
            fixedPlugin.classList.contains("show") ? fixedPlugin.classList.remove("show") : fixedPlugin.classList.add("show");
        }),
        fixedPluginCloseButton.forEach(function (e) {
            e.onclick = function () { fixedPlugin.classList.remove("show"); };
        }),
        // Cierra el panel al hacer clic fuera de él
        (document.querySelector("body").onclick = function (e) {
            e.target != fixedPluginButton &&
                e.target != fixedPluginButtonNav &&
                e.target.closest(".fixed-plugin .card") != fixedPluginCard &&
                fixedPlugin.classList.remove("show");
        }),
        // Configura el navbar fijo si está activo por defecto
        navbar && "true" == navbar.getAttribute("data-scroll") && buttonNavbarFixed && buttonNavbarFixed.setAttribute("checked", "true"));

// Variables para el sidenav toggler
var sidenavToggler, sidenavShow, toggleNavbarMinimize, 
    total = document.querySelectorAll(".nav-pills");

// Función para inicializar pestañas con efecto de movimiento
function initNavs() {
    total.forEach(function (l, e) {
        var o = document.createElement("div"),
            t = l.querySelector("li:first-child .nav-link").cloneNode();
        (t.innerHTML = "-"),
            o.classList.add("moving-tab", "position-absolute", "nav-link"),
            o.appendChild(t),
            l.appendChild(o);
        l.getElementsByTagName("li").length;
        (o.style.padding = "0px"),
            (o.style.width = l.querySelector("li:nth-child(1)").offsetWidth + "px"),
            (o.style.transform = "translate3d(0px, 0px, 0px)"),
            (o.style.transition = ".5s ease"),
            (l.onmouseover = function (e) {
                let t = getEventTarget(e),
                    i = t.closest("li");
                if (i) {
                    let n = Array.from(i.closest("ul").children),
                        a = n.indexOf(i) + 1;
                    l.querySelector("li:nth-child(" + a + ") .nav-link").onclick = function () {
                        o = l.querySelector(".moving-tab");
                        let e = 0;
                        if (l.classList.contains("flex-column")) {
                            for (var t = 1; t <= n.indexOf(i); t++)
                                e += l.querySelector("li:nth-child(" + t + ")").offsetHeight;
                            (o.style.transform = "translate3d(0px," + e + "px, 0px)"),
                                (o.style.height = l.querySelector("li:nth-child(" + t + ")").offsetHeight);
                        } else {
                            for (t = 1; t <= n.indexOf(i); t++)
                                e += l.querySelector("li:nth-child(" + t + ")").offsetWidth;
                            (o.style.transform = "translate3d(" + e + "px, 0px, 0px)"),
                                (o.style.width = l.querySelector("li:nth-child(" + a + ")").offsetWidth + "px");
                        }
                    };
                }
            });
    });
}

// Función para obtener el objetivo de un evento
function getEventTarget(e) {
    return (e = e || window.event).target || e.srcElement;
}

// Inicializa las pestañas después de un retraso
setTimeout(function () { initNavs(); }, 100),

// Maneja el redimensionamiento de la ventana para las pestañas
window.addEventListener("resize", function (e) {
    total.forEach(function (n, e) {
        n.querySelector(".moving-tab").remove();
        var a = document.createElement("div"),
            i = n.querySelector(".nav-link.active").cloneNode();
        (i.innerHTML = "-"),
            a.classList.add("moving-tab", "position-absolute", "nav-link"),
            a.appendChild(i),
            n.appendChild(a),
            (a.style.padding = "0px"),
            (a.style.transition = ".5s ease");
        let l = n.querySelector(".nav-link.active").parentElement;
        if (l) {
            let e = Array.from(l.closest("ul").children);
            i = e.indexOf(l) + 1;
            let t = 0;
            if (n.classList.contains("flex-column")) {
                for (var o = 1; o <= e.indexOf(l); o++)
                    t += n.querySelector("li:nth-child(" + o + ")").offsetHeight;
                (a.style.transform = "translate3d(0px," + t + "px, 0px)"),
                    (a.style.width = n.querySelector("li:nth-child(" + i + ")").offsetWidth + "px"),
                    (a.style.height = n.querySelector("li:nth-child(" + o + ")").offsetHeight);
            } else {
                for (o = 1; o <= e.indexOf(l); o++)
                    t += n.querySelector("li:nth-child(" + o + ")").offsetWidth;
                (a.style.transform = "translate3d(" + t + "px, 0px, 0px)"),
                    (a.style.width = n.querySelector("li:nth-child(" + i + ")").offsetWidth + "px");
            }
        }
    }),
        // Ajusta las pestañas para dispositivos móviles
        window.innerWidth < 991
            ? total.forEach(function (a, e) {
                if (!a.classList.contains("flex-column")) {
                    a.classList.remove("flex-row"),
                        a.classList.add("flex-column", "on-resize");
                    let e = a.querySelector(".nav-link.active").parentElement,
                        t = Array.from(e.closest("ul").children);
                    t.indexOf(e);
                    let n = 0;
                    for (var i = 1; i <= t.indexOf(e); i++)
                        n += a.querySelector("li:nth-child(" + i + ")").offsetHeight;
                    var l = document.querySelector(".moving-tab");
                    (l.style.width = a.querySelector("li:nth-child(1)").offsetWidth + "px"),
                        (l.style.transform = "translate3d(0px," + n + "px, 0px)");
                }
            })
            : total.forEach(function (a, e) {
                if (a.classList.contains("on-resize")) {
                    a.classList.remove("flex-column", "on-resize"),
                        a.classList.add("flex-row");
                    let e = a.querySelector(".nav-link.active").parentElement,
                        t = Array.from(e.closest("ul").children);
                    var i = t.indexOf(e) + 1;
                    let n = 0;
                    for (var l = 1; l <= t.indexOf(e); l++)
                        n += a.querySelector("li:nth-child(" + l + ")").offsetWidth;
                    var o = document.querySelector(".moving-tab");
                    (o.style.transform = "translate3d(" + n + "px, 0px, 0px)"),
                        (o.style.width = a.querySelector("li:nth-child(" + i + ")").offsetWidth + "px");
                }
            });
}),

// Ajusta las pestañas para dispositivos móviles al cargar
window.innerWidth < 991 &&
    total.forEach(function (e, t) {
        e.classList.contains("flex-row") &&
            (e.classList.remove("flex-row"),
                e.classList.add("flex-column", "on-resize"));
    }),

// Configuración del toggle del sidenav
document.querySelector(".sidenav-toggler") &&
    ((sidenavToggler = document.getElementsByClassName("sidenav-toggler")[0]),
        (sidenavShow = document.getElementsByClassName("g-sidenav-show")[0]),
        (toggleNavbarMinimize = document.getElementById("navbarMinimize")),
        sidenavShow &&
        (sidenavToggler.onclick = function () {
            sidenavShow.classList.contains("g-sidenav-hidden")
                ? (sidenavShow.classList.remove("g-sidenav-hidden"),
                    sidenavShow.classList.add("g-sidenav-pinned"),
                    toggleNavbarMinimize &&
                    (toggleNavbarMinimize.click(),
                        toggleNavbarMinimize.removeAttribute("checked")))
                : (sidenavShow.classList.remove("g-sidenav-pinned"),
                    sidenavShow.classList.add("g-sidenav-hidden"),
                    toggleNavbarMinimize &&
                    (toggleNavbarMinimize.click(),
                        toggleNavbarMinimize.setAttribute("checked", "true")));
        }));

// Configuración del sidenav con overlay dinámico
const iconNavbarSidenav = document.getElementById('iconNavbarSidenav');
const iconSidenav = document.getElementById('iconSidenav');
const sidenav = document.getElementById('sidenav-main');
const body = document.getElementsByTagName('body')[0];
const className = 'g-sidenav-pinned';

// Crea un overlay para el sidenav
const overlay = document.createElement('div');
overlay.id = 'sidenav-overlay';
document.body.appendChild(overlay);

// Añade estilos críticos para el overlay y el sidenav
const style = document.createElement('style');
style.textContent = `
    #sidenav-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9998;
        display: none;
    }
    #sidenav-main {
        z-index: 9999 !important;
        position: fixed !important;
    }
`;
document.head.appendChild(style);

// Eventos para abrir/cerrar el sidenav
if (iconNavbarSidenav) {
    iconNavbarSidenav.addEventListener("click", toggleSidenav);
}

if (iconSidenav) {
    iconSidenav.addEventListener("click", toggleSidenav);
}

// Función para alternar el sidenav
function toggleSidenav() {
    if (body.classList.contains(className)) {
        // Cierra el sidenav
        body.classList.remove(className);
        overlay.style.display = 'none';
        setTimeout(function () {
            sidenav.classList.remove('bg-white');
        }, 100);
        sidenav.classList.remove('bg-transparent');
    } else {
        // Abre el sidenav
        body.classList.add(className);
        overlay.style.display = 'block';
        sidenav.classList.add('bg-white');
        sidenav.classList.remove('bg-transparent');
        if (iconSidenav) iconSidenav.classList.remove('d-none');
    }
}

// Cierra el sidenav al hacer clic en el overlay
overlay.addEventListener('click', toggleSidenav);

// Funciones para manejar el responsive del navbar y sidenav
let referenceButtons = document.querySelector("[data-class]");
function navbarColorOnResize() {
    sidenav &&
        (1200 < window.innerWidth
            ? referenceButtons.classList.contains("active") &&
                "bg-transparent" === referenceButtons.getAttribute("data-class")
                ? sidenav.classList.remove("bg-white")
                : sidenav.classList.add("bg-white")
            : (sidenav.classList.add("bg-white"),
                sidenav.classList.remove("bg-transparent")));
}

function sidenavTypeOnResize() {
    let e = document.querySelectorAll('[onclick="sidebarType(this)"]');
    window.innerWidth < 1200
        ? e.forEach(function (e) { e.classList.add("disabled"); })
        : e.forEach(function (e) { e.classList.remove("disabled"); });
}

// Función para mostrar notificaciones
function notify(e) {
    var t = document.querySelector("body"),
        n = document.createElement("div");
    n.classList.add("alert", "position-absolute", "top-0", "border-0", "text-white", "w-50", "end-0", "start-0", "mt-2", "mx-auto", "py-2"),
        n.classList.add("alert-" + e.getAttribute("data-type")),
        (n.style.transform = "translate3d(0px, 0px, 0px)"),
        (n.style.opacity = "0"),
        (n.style.transition = ".35s ease"),
        setTimeout(function () {
            (n.style.transform = "translate3d(0px, 20px, 0px)"),
                n.style.setProperty("opacity", "1", "important");
        }, 100),
        (n.innerHTML = '<div class="d-flex mb-1"><div class="alert-icon me-1"><i class="' + e.getAttribute("data-icon") + ' mt-1"></i></div><span class="alert-text"><strong>' + e.getAttribute("data-title") + '</strong></span></div><span class="text-sm">' + e.getAttribute("data-content") + "</span>"),
        t.appendChild(n),
        setTimeout(function () {
            (n.style.transform = "translate3d(0px, 0px, 0px)"),
                n.style.setProperty("opacity", "0", "important");
        }, 4e3),
        setTimeout(function () {
            e.parentElement.querySelector(".alert").remove();
        }, 4500);
}


/**
 * Función para alternar la visibilidad de la contraseña en un campo de entrada
 */
function togglePassword() {
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.getElementById("eyeIcon")

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}



// Eventos de resize para el navbar y sidenav
window.addEventListener("resize", navbarColorOnResize),
    window.addEventListener("resize", sidenavTypeOnResize),
    window.addEventListener("load", sidenavTypeOnResize);