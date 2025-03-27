"use strict";

// Verify navbar blur on scroll
if (document.getElementById('navbarBlur')) {
  navbarBlurOnScroll('navbarBlur');
}

// initialization of Popovers
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})

// initialization of Tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

// initialization of Toasts
document.addEventListener("DOMContentLoaded", function () {

  var toastButtonList = [].slice.call(document.querySelectorAll(".toast-btn"));

  toastButtonList.map(function (toastButtonEl) {
    toastButtonEl.addEventListener("click", function () {
      var toastToTrigger = document.getElementById(toastButtonEl.dataset.target);

      if (toastToTrigger) {
        var toast = bootstrap.Toast.getInstance(toastToTrigger);
        toast.show();
      }
    });
  });
});


if (document.querySelector('[data-toggle="widget-calendar"]')) {
  var calendarEl = document.querySelector('[data-toggle="widget-calendar"]');
  var today = new Date();
  var mYear = today.getFullYear();
  var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  var mDay = weekday[today.getDay()];

  var m = today.getMonth();
  var d = today.getDate();
  document.getElementsByClassName('widget-calendar-year')[0].innerHTML = mYear;
  document.getElementsByClassName('widget-calendar-day')[0].innerHTML = mDay;


  // helper for adding on all elements multiple attributes
  function setAttributes(el, options) {
    Object.keys(options).forEach(function (attr) {
      el.setAttribute(attr, options[attr]);
    })
  }

  // adding on inputs attributes for calling the focused and defocused functions
  if (document.querySelectorAll('.input-group').length != 0) {
    var allInputs = document.querySelectorAll('input.form-control');
    allInputs.forEach(el => setAttributes(el, {
      "onfocus": "focused(this)",
      "onfocusout": "defocused(this)"
    }));
  }

  if (document.querySelector('.fixed-plugin')) {
    var fixedPlugin = document.querySelector('.fixed-plugin');
    var fixedPluginButton = document.querySelector('.fixed-plugin-button');
    var fixedPluginButtonNav = document.querySelector('.fixed-plugin-button-nav');
    var fixedPluginCard = document.querySelector('.fixed-plugin .card');
    var fixedPluginCloseButton = document.querySelectorAll('.fixed-plugin-close-button');
    var navbar = document.getElementById('navbarBlur');
    var buttonNavbarFixed = document.getElementById('navbarFixed');

    if (fixedPluginButton) {
      fixedPluginButton.onclick = function () {
        if (!fixedPlugin.classList.contains('show')) {
          fixedPlugin.classList.add('show');
        } else {
          fixedPlugin.classList.remove('show');
        }
      }
    }

    if (fixedPluginButtonNav) {
      fixedPluginButtonNav.onclick = function () {
        if (!fixedPlugin.classList.contains('show')) {
          fixedPlugin.classList.add('show');
        } else {
          fixedPlugin.classList.remove('show');
        }
      }
    }

    fixedPluginCloseButton.forEach(function (el) {
      el.onclick = function () {
        fixedPlugin.classList.remove('show');
      }
    })

    document.querySelector('body').onclick = function (e) {
      if (e.target != fixedPluginButton && e.target != fixedPluginButtonNav && e.target.closest('.fixed-plugin .card') != fixedPluginCard) {
        fixedPlugin.classList.remove('show');
      }
    }

    if (navbar) {
      if (navbar.getAttribute('data-scroll') == 'true' && buttonNavbarFixed) {
        buttonNavbarFixed.setAttribute("checked", "true");
      }
    }

  }

  window.addEventListener('resize', function (event) {
    total.forEach(function (item, i) {
      item.querySelector('.moving-tab').remove();
      var moving_div = document.createElement('div');
      var tab = item.querySelector(".nav-link.active").cloneNode();
      tab.innerHTML = "-";

      moving_div.classList.add('moving-tab', 'position-absolute', 'nav-link');
      moving_div.appendChild(tab);

      item.appendChild(moving_div);

      moving_div.style.padding = '0px';
      moving_div.style.transition = '.5s ease';

      let li = item.querySelector(".nav-link.active").parentElement;

      if (li) {
        let nodes = Array.from(li.closest('ul').children); // get array
        let index = nodes.indexOf(li) + 1;

        let sum = 0;
        if (item.classList.contains('flex-column')) {
          for (var j = 1; j <= nodes.indexOf(li); j++) {
            sum += item.querySelector('li:nth-child(' + j + ')').offsetHeight;
          }
          moving_div.style.transform = 'translate3d(0px,' + sum + 'px, 0px)';
          moving_div.style.width = item.querySelector('li:nth-child(' + index + ')').offsetWidth + 'px';
          moving_div.style.height = item.querySelector('li:nth-child(' + j + ')').offsetHeight;
        } else {
          for (var j = 1; j <= nodes.indexOf(li); j++) {
            sum += item.querySelector('li:nth-child(' + j + ')').offsetWidth;
          }
          moving_div.style.transform = 'translate3d(' + sum + 'px, 0px, 0px)';
          moving_div.style.width = item.querySelector('li:nth-child(' + index + ')').offsetWidth + 'px';

        }
      }
    });

    if (window.innerWidth < 991) {
      total.forEach(function (item, i) {
        if (!item.classList.contains('flex-column')) {
          item.classList.remove('flex-row');
          item.classList.add('flex-column', 'on-resize');
          let li = item.querySelector(".nav-link.active").parentElement;
          let nodes = Array.from(li.closest('ul').children); // get array
          let index = nodes.indexOf(li) + 1;
          let sum = 0;
          for (var j = 1; j <= nodes.indexOf(li); j++) {
            sum += item.querySelector('li:nth-child(' + j + ')').offsetHeight;
          }
          var moving_div = document.querySelector('.moving-tab');
          moving_div.style.width = item.querySelector('li:nth-child(1)').offsetWidth + 'px';
          moving_div.style.transform = 'translate3d(0px,' + sum + 'px, 0px)';

        }
      });
    } else {
      total.forEach(function (item, i) {
        if (item.classList.contains('on-resize')) {
          item.classList.remove('flex-column', 'on-resize');
          item.classList.add('flex-row');
          let li = item.querySelector(".nav-link.active").parentElement;
          let nodes = Array.from(li.closest('ul').children); // get array
          let index = nodes.indexOf(li) + 1;
          let sum = 0;
          for (var j = 1; j <= nodes.indexOf(li); j++) {
            sum += item.querySelector('li:nth-child(' + j + ')').offsetWidth;
          }
          var moving_div = document.querySelector('.moving-tab');
          moving_div.style.transform = 'translate3d(' + sum + 'px, 0px, 0px)';
          moving_div.style.width = item.querySelector('li:nth-child(' + index + ')').offsetWidth + 'px';
        }
      })
    }
  });

  if (window.innerWidth < 991) {
    total.forEach(function (item, i) {
      if (item.classList.contains('flex-row')) {
        item.classList.remove('flex-row');
        item.classList.add('flex-column', 'on-resize');
      }
    });
  }

  if (document.querySelector('.sidenav-toggler')) {
    var sidenavToggler = document.getElementsByClassName('sidenav-toggler')[0];
    var sidenavShow = document.getElementsByClassName('g-sidenav-show')[0];
    var toggleNavbarMinimize = document.getElementById('navbarMinimize');

    if (sidenavShow) {
      sidenavToggler.onclick = function () {
        if (!sidenavShow.classList.contains('g-sidenav-hidden')) {
          sidenavShow.classList.remove('g-sidenav-pinned');
          sidenavShow.classList.add('g-sidenav-hidden');
          if (toggleNavbarMinimize) {
            toggleNavbarMinimize.click();
            toggleNavbarMinimize.setAttribute("checked", "true");
          }
        } else {
          sidenavShow.classList.remove('g-sidenav-hidden');
          sidenavShow.classList.add('g-sidenav-pinned');
          if (toggleNavbarMinimize) {
            toggleNavbarMinimize.click();
            toggleNavbarMinimize.removeAttribute("checked");
          }
        }
      };
    }
  }

  const iconNavbarSidenav = document.getElementById('iconNavbarSidenav');
  const iconSidenav = document.getElementById('iconSidenav');
  const sidenav = document.getElementById('sidenav-main');
  const body = document.getElementsByTagName('body')[0];
  const className = 'g-sidenav-pinned';
  
  // Añadir overlay dinámico
  const overlay = document.createElement('div');
  overlay.id = 'sidenav-overlay';
  document.body.appendChild(overlay);
  
  // Estilos CSS críticos (puedes moverlos a tu hoja de estilos)
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
  
  if (iconNavbarSidenav) {
    iconNavbarSidenav.addEventListener("click", toggleSidenav);
  }
  
  if (iconSidenav) {
    iconSidenav.addEventListener("click", toggleSidenav);
  }
  
  function toggleSidenav() {
    if (body.classList.contains(className)) {
      // Cerrar sidenav
      body.classList.remove(className);
      overlay.style.display = 'none';
      setTimeout(function() {
        sidenav.classList.remove('bg-white');
      }, 100);
      sidenav.classList.remove('bg-transparent');
    } else {
      // Abrir sidenav
      body.classList.add(className);
      overlay.style.display = 'block';
      sidenav.classList.add('bg-white');
      sidenav.classList.remove('bg-transparent');
      if (iconSidenav) iconSidenav.classList.remove('d-none');
    }
  }
  
  // Cerrar al hacer clic en el overlay
  overlay.addEventListener('click', toggleSidenav);


  let referenceButtons = document.querySelector('[data-class]');

  window.addEventListener("resize", navbarColorOnResize);

  function navbarColorOnResize() {
    if (sidenav) {
      if (window.innerWidth > 1200) {
        if (referenceButtons.classList.contains('active') && referenceButtons.getAttribute('data-class') === 'bg-transparent') {
          sidenav.classList.remove('bg-white');
        } else {
          sidenav.classList.add('bg-white');
        }
      } else {
        sidenav.classList.add('bg-white');
        sidenav.classList.remove('bg-transparent');
      }
    }
  }

  // Deactivate sidenav type buttons on resize and small screens
  window.addEventListener("resize", sidenavTypeOnResize);
  window.addEventListener("load", sidenavTypeOnResize);

  function sidenavTypeOnResize() {
    let elements = document.querySelectorAll('[onclick="sidebarType(this)"]');
    if (window.innerWidth < 1200) {
      elements.forEach(function (el) {
        el.classList.add('disabled');
      });
    } else {
      elements.forEach(function (el) {
        el.classList.remove('disabled');
      });
    }
  }
}
