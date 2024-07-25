function openNav() {
    document.getElementById("sidebar").style.width = "200px";
}

function closeNav() {
    document.getElementById("sidebar").style.width = "0";
}

// Función para abrir un modal
function openModal(id) {
    document.getElementById(id).style.display = "block";
}

// Función para cerrar un modal
function closeModal(id) {
    document.getElementById(id).style.display = "none";
}

// Obtener todos los botones de agregar
var botonesEditar = document.querySelectorAll('.boton_agregar');
botonesEditar.forEach(function(boton) {
    boton.addEventListener('click', function() {
        openModal('modalAgregar');
    });
});

// Limite de las fechas
document.addEventListener('DOMContentLoaded', function () {
    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth() + 1; // Enero es 0
    var day = today.getDate();

    if (month < 10) {
        month = '0' + month;
    }
    if (day < 10) {
        day = '0' + day;
    }

    // Fecha mínima y máxima para "Fecha Lectura Anterior"
    var minFechaLecturaAnterior = new Date(today);
    minFechaLecturaAnterior.setMonth(minFechaLecturaAnterior.getMonth() - 1);
    var minYearAnterior = minFechaLecturaAnterior.getFullYear();
    var minMonthAnterior = minFechaLecturaAnterior.getMonth() + 1; // Enero es 0
    if (minMonthAnterior < 10) {
        minMonthAnterior = '0' + minMonthAnterior;
    }
    var maxDayAnterior = new Date(minFechaLecturaAnterior.getFullYear(), minFechaLecturaAnterior.getMonth() + 1, 0).getDate(); // Último día del mes anterior
    var minFechaAnterior = minYearAnterior + '-' + minMonthAnterior + '-01';
    var maxFechaAnterior = minYearAnterior + '-' + minMonthAnterior + '-' + maxDayAnterior;

    // Fecha mínima y máxima para "Fecha Lectura Actual"
    var minFechaActual = year + '-' + month + '-01';
    var maxFechaActual = year + '-' + month + '-' + day;

    document.getElementById('fec').setAttribute('min', minFechaAnterior);
    document.getElementById('fec').setAttribute('max', maxFechaAnterior);
    document.getElementById('fechaActual').setAttribute('min', minFechaActual);
    document.getElementById('fechaActual').setAttribute('max', maxFechaActual);
});
