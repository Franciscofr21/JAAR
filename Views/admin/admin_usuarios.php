<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

require_once '../../Model/tbl_socios.php';
$conn = new tbl_socio();
$socios = $conn->obtenerSocio();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crearSocio'])) {
    $cedula = $_POST['ced'];
    $nombres = $_POST['nom'];
    $apellidos = $_POST['ape'];
    $telefono = $_POST['tel'];
    $email = $_POST['email'];
    $direccion = $_POST['direc'];
    $contra = $_POST['contra'];
    if ($conn->crearSocio($cedula, $nombres, $apellidos, $telefono, $email, $direccion, $contra)) {
        $_SESSION['alertType'] = 'success';
        $_SESSION['alertMessage'] = 'Socio registrado exitosamente.';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['alertType'] = 'danger';
        $_SESSION['alertMessage'] = 'La cédula ya existe o hubo un error al crear el socio.';
    }
}

include '../_layout/header.php'; 
?>

<main>
    <section id="section1">
        <h2>Registrar Socios</h2>
        <?php if (isset($_SESSION['alertMessage'])) { ?>
            <div class="alert alert-<?php echo $_SESSION['alertType']; ?>" role="alert">
                <?php echo $_SESSION['alertMessage']; ?>
            </div>
            <?php unset($_SESSION['alertType']); unset($_SESSION['alertMessage']); ?>
        <?php } ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearSocioModal">
            Registrar Socio
        </button>
    </section>
    <section>
        <h2>Socios Existentes</h2>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($socios as $socio) { ?>
                        <tr>
                            <td data-label="Cédula"><?php echo $socio['soc_cedula']; ?></td>
                            <td data-label="Nombres"><?php echo $socio['soc_nombre']; ?></td>
                            <td data-label="Apellidos"><?php echo $socio['soc_apellido']; ?></td>
                            <td data-label="Teléfono"><?php echo $socio['soc_telefono']; ?></td>
                            <td data-label="Email"><?php echo $socio['soc_email']; ?></td>
                            <td data-label="Dirección"><?php echo $socio['soc_direccion']; ?></td>
                            <td data-label="Acciones">
                                <button class="btn btn-danger boton_eliminar" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-cedula="<?php echo $socio['soc_cedula']; ?>">
                                    Eliminar
                                </button>
                                <button class="btn btn-primary boton_editar" data-bs-toggle="modal" data-bs-target="#modalEditar" data-cedula="<?php echo $socio['soc_cedula']; ?>" data-nombre="<?php echo $socio['soc_nombre']; ?>" data-apellido="<?php echo $socio['soc_apellido']; ?>" data-telefono="<?php echo $socio['soc_telefono']; ?>" data-email="<?php echo $socio['soc_email']; ?>" data-direccion="<?php echo $socio['soc_direccion']; ?>">
                                    Editar
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Modal para crear socio -->
<div class="modal fade" id="crearSocioModal" tabindex="-1" aria-labelledby="crearSocioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearSocioModalLabel">Registrar Socio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="ced" class="form-label">Cédula:</label>
                        <input type="text" id="ced" name="ced" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nombres:</label>
                        <input type="text" id="nom" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="ape" class="form-label">Apellidos:</label>
                        <input type="text" id="ape" name="ape" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">Teléfono:</label>
                        <input type="text" id="tel" name="tel" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="direc" class="form-label">Dirección:</label>
                        <input type="text" id="direc" name="direc" class="form-control" required>
                    </div>
                    <button type="submit" name="crearSocio" class="btn btn-primary">Registrar Socio</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para eliminar socio -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Eliminar Socio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este socio?</p>
                <form method="POST" action="../../Views/admin/eliminar_socio.php">
                    <input type="hidden" name="cedula" id="cedulaEliminar">
                    <button type="submit" name="eliminarSocio" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar socio -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Socio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../../Views/admin/editar_socio.php">
                    <input type="hidden" name="cedula" id="cedulaEditar">
                    <div class="mb-3">
                        <label for="nombreEditar" class="form-label">Nombres:</label>
                        <input type="text" id="nombreEditar" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoEditar" class="form-label">Apellidos:</label>
                        <input type="text" id="apellidoEditar" name="ape" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefonoEditar" class="form-label">Teléfono:</label>
                        <input type="text" id="telefonoEditar" name="tel" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailEditar" class="form-label">Email:</label>
                        <input type="email" id="emailEditar" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccionEditar" class="form-label">Dirección:</label>
                        <input type="text" id="direccionEditar" name="direc" class="form-control" required>
                    </div>
                    <button type="submit" name="editarSocio" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../_layout/footer.php'; ?>

<script>
    // Escuchar evento cuando el modal de editar se muestra
    $('#modalEditar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var cedula = button.data('cedula'); 
        var nombre = button.data('nombre'); 
        var apellido = button.data('apellido'); 
        var telefono = button.data('telefono'); 
        var email = button.data('email'); 
        var direccion = button.data('direccion'); 

        var modal = $(this);
        modal.find('.modal-body #cedulaEditar').val(cedula);
        modal.find('.modal-body #nombreEditar').val(nombre);
        modal.find('.modal-body #apellidoEditar').val(apellido);
        modal.find('.modal-body #telefonoEditar').val(telefono);
        modal.find('.modal-body #emailEditar').val(email);
        modal.find('.modal-body #direccionEditar').val(direccion);
    });

    // Escuchar evento cuando el modal de eliminar se muestra
$('#modalEliminar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var cedula = button.data('cedula'); 

    var modal = $(this);
    modal.find('.modal-body #cedulaEliminar').val(cedula);
});

// Manejar el formulario de eliminación
$('#modalEliminar form').submit(function (event) {
    event.preventDefault(); 

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (response) {
            if (response.success) {
                showAlert('success', response.message);
            } else {
                showAlert('danger', response.message); // Mostrar mensaje de error
            }
            $('#modalEliminar').modal('hide');
            location.reload(); // Recargar la página después de eliminar
        },
        error: function () {
            showAlert('danger', 'Hubo un error al procesar la solicitud.');
        }
    });
});

    // Escuchar evento cuando el modal de crear se muestra
    $('#crearSocioModal').on('show.bs.modal', function (event) {
        var modal = $(this);
        modal.find('.modal-body #ced').val('');
        modal.find('.modal-body #nom').val('');
        modal.find('.modal-body #ape').val('');
        modal.find('.modal-body #tel').val('');
        modal.find('.modal-body #email').val('');
        modal.find('.modal-body #direc').val('');
        modal.find('.modal-body #contra').val('');
    });

    $('#crearSocioModal form').submit(function (event) {
        event.preventDefault(); 

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    showAlert('success', response.message);
                } else {
                    showAlert('danger', response.message);
                }
                $('#crearSocioModal').modal('hide');
                location.reload();
            },
            error: function () {
                showAlert('danger', 'Hubo un error al procesar la solicitud.');
            }
        });
    });

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
        }, 5000); 
    }
</script>
