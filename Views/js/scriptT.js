function openNav() {
    document.getElementById("sidebar").style.width = "200px";
}

function closeNav() {
    document.getElementById("sidebar").style.width = "0";
}

function openModal(id) {
    document.getElementById(id).style.display = "block";
}

function closeModal(id) {
    document.getElementById(id).style.display = "none";
}

var botonesEditar = document.querySelectorAll('.boton_agregar');
botonesEditar.forEach(function(boton) {
    boton.addEventListener('click', function() {
        var pagid = this.getAttribute('data-pagid');
        var socid = this.getAttribute('data-socid');
        document.getElementById('pagid').value = pagid;
        document.getElementById('socid').value = socid;
        openModal('modalAgregar');
    });
});
document.addEventListener('DOMContentLoaded', function () {
    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth() + 1; 
    var day = today.getDate();

    if (month < 10) {
        month = '0' + month;
    }
    if (day < 10) {
        day = '0' + day;
    }
    var minFechaLecturaAnterior = new Date(today);
    minFechaLecturaAnterior.setMonth(minFechaLecturaAnterior.getMonth() - 1);
    var minYearAnterior = minFechaLecturaAnterior.getFullYear();
    var minMonthAnterior = minFechaLecturaAnterior.getMonth() + 1;
    if (minMonthAnterior < 10) {
        minMonthAnterior = '0' + minMonthAnterior;
    }
    var maxDayAnterior = new Date(minFechaLecturaAnterior.getFullYear(), minFechaLecturaAnterior.getMonth() + 1, 0).getDate(); // Último día del mes anterior
    var minFechaAnterior = minYearAnterior + '-' + minMonthAnterior + '-01';
    var maxFechaAnterior = minYearAnterior + '-' + minMonthAnterior + '-' + maxDayAnterior;
    
    var minFechaActual = year + '-' + month + '-01';
    var maxFechaActual = year + '-' + month + '-' + day;

    document.getElementById('fec').setAttribute('min', minFechaAnterior);
    document.getElementById('fec').setAttribute('max', maxFechaAnterior);
    document.getElementById('fechaActual').setAttribute('min', minFechaActual);
    document.getElementById('fechaActual').setAttribute('max', maxFechaActual);
});
