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

// Obtener todos los botones de eliminar de socios
var botonesEliminar = document.querySelectorAll('.boton_eliminar');
botonesEliminar.forEach(function(boton) {
    boton.addEventListener('click', function() {
        var cedula = this.getAttribute('data-cedula');
        document.getElementById('cedulaEliminar').value = cedula;
        openModal('modalEliminar');
    });
});

// Obtener todos los botones de editar de socios
var botonesEditar = document.querySelectorAll('.boton_editar');
botonesEditar.forEach(function(boton) {
    boton.addEventListener('click', function() {
        var cedula = this.getAttribute('data-cedula');
        var nombre = this.getAttribute('data-nombre');
        var apellido = this.getAttribute('data-apellido');
        var telefono = this.getAttribute('data-telefono');
        var email = this.getAttribute('data-email');
        var direccion = this.getAttribute('data-direccion');

        document.getElementById('cedulaEditar').value = cedula;
        document.getElementById('nombreEditar').value = nombre;
        document.getElementById('apellidoEditar').value = apellido;
        document.getElementById('telefonoEditar').value = telefono;
        document.getElementById('emailEditar').value = email;
        document.getElementById('direccionEditar').value = direccion;

        openModal('modalEditar');
    });
});

// Obtener todos los botones de eliminar de medidores
var botonesEliminarMedidor = document.querySelectorAll('.boton_eliminar');
botonesEliminarMedidor.forEach(function(boton) {
    boton.addEventListener('click', function() {
        var medid = this.getAttribute('data-medid');
        document.getElementById('medidorEliminar').value = medid;
        openModal('modalEliminar');
    });
});

// Obtener todos los botones de editar medidores
var botonesEditarMedidor = document.querySelectorAll('.boton_editar');
botonesEditarMedidor.forEach(function(boton) {
    boton.addEventListener('click', function() {
        var medid = this.getAttribute('data-medid');
        var identi = this.getAttribute('data-identi');
        var fechaA = this.getAttribute('data-fechaA');
        var lectuA = this.getAttribute('data-lectA');
        var fechaN = this.getAttribute('data-fechaN');
        var lectuN = this.getAttribute('data-lectN');

        document.getElementById('med_idEditar').value = medid;
        document.getElementById('identiEditar').value = identi;
        document.getElementById('fechaAEditar').value = fechaA;
        document.getElementById('lecturaAEditar').value = lectuA;
        document.getElementById('fechaNEditar').value = fechaN;
        document.getElementById('lecturaNEditar').value = lectuN;

        openModal('modalEditar');
    });
});
// Obtener todos los botones de eliminar de multas
var botonesEliminarMulta = document.querySelectorAll('.boton_eliminar');
botonesEliminarMulta.forEach(function(boton) {
    boton.addEventListener('click', function() {
        var mulid = this.getAttribute('data-mulid');
        document.getElementById('multaEliminar').value = mulid;
        openModal('modalEliminar');
    });
});

// Función para mostrar una alerta utilizando Bootstrap
function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.classList.add('alert', `alert-${type}`, 'alert-dismissible', 'fade', 'show');
    alertDiv.setAttribute('role', 'alert');
    alertDiv.innerHTML = `
        <strong>${message}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    document.body.appendChild(alertDiv);
    setTimeout(() => {
        alertDiv.remove();
    }, 5000); // Tiempo en milisegundos para que la alerta desaparezca automáticamente (opcional)
}

// Escuchar el evento cuando el modal se muestra
$('#crearAdminModal').on('show.bs.modal', function (event) {
    // Limpiar el formulario cuando se muestre el modal
    document.getElementById('cedula').value = '';
    document.getElementById('contrasena').value = '';
});

// Escuchar el evento cuando el formulario dentro del modal se envía
$('#crearAdminModal form').submit(function (event) {
    event.preventDefault(); // Evitar que el formulario se envíe normalmente

    // Realizar aquí cualquier validación adicional si es necesario

    // Simular el envío del formulario y mostrar la alerta según el resultado
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (response) {
            // Mostrar alerta de éxito o error según el tipo de respuesta
            if (response.success) {
                showAlert('success', response.message);
            } else {
                showAlert('danger', response.message);
            }
            // Cerrar el modal después de mostrar la alerta
            $('#crearAdminModal').modal('hide');
            // Recargar la página para actualizar la lista de administradores (opcional)
            location.reload();
        },
        error: function () {
            showAlert('danger', 'Hubo un error al procesar la solicitud.');
        }
    });
});
