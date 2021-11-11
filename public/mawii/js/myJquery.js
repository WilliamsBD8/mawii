$(window).ready(function() {
    var ubicacion = window.pageYOffset;
    var enlaces = document.getElementById('encabezado');
    var principal = document.getElementById('principal');
    var altitud = $('#encabezado').height();
    principal.style.paddingTop = altitud + 'px';
    window.onscroll = function() {
        var desplazamientoActual = window.pageYOffset;
        if (ubicacion >= desplazamientoActual) {
            enlaces.style.top = '0';
        } else if (desplazamientoActual >= altitud) {
            enlaces.style.top = '-' + altitud + 'px';
        }
        ubicacion = desplazamientoActual;
    };
})