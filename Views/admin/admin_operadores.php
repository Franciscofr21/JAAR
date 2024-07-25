<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

require_once '../../Model/tbl_operadores.php';
$conn = new tbl_operadores();
$operadores = $conn->obtenerOperador();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crearOperador'])) {
    $cedula = $_POST['ced'];
    $nombres = $_POST['nom'];
    $apellidos = $_POST['ape'];
    $telef = $_POST['tel'];
    $email = $_POST['email'];
    $direc = $_POST['direc'];
    $contra = $_POST['contra'];
    if ($conn->crearOperador($cedula, $nombres, $apellidos, $telef, $email, $direc, $contra)) {
        $_SESSION['alertType'] = 'success';
        $_SESSION['alertMessage'] = 'Operador registrado exitosamente.';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['alertType'] = 'danger';
        $_SESSION['alertMessage'] = 'La cédula ya existe o hubo un error al crear el operador.';
    }
}
include '../_layout/header.php'; 
?>

<main>
    <section id="section1">
        <h2>Registrar Operadores</h2>
        <?php if (isset($_SESSION['alertMessage'])) { ?>
            <div class="alert alert-<?php echo $_SESSION['alertType']; ?>" role="alert">
                <?php echo $_SESSION['alertMessage']; ?>
            </div>
            <?php unset($_SESSION['alertType']); unset($_SESSION['alertMessage']); ?>
        <?php } ?>
        <!-- Botón para abrir el modal de Crear Operador -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearOperadorModal">
            Registrar Operador
        </button>
    </section>
    <section>
        <h2>Operadores Existentes</h2>
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
                    <?php foreach ($operadores as $operador) { ?>
                        <tr>
                            <td data-label="Cédula"><?php echo $operador['soc_cedula']; ?></td>
                            <td data-label="Nombres"><?php echo $operador['soc_nombre']; ?></td>
                            <td data-label="Apellidos"><?php echo $operador['soc_apellido']; ?></td>
                            <td data-label="Teléfono"><?php echo $operador['soc_telefono']; ?></td>
                            <td data-label="Email"><?php echo $operador['soc_email']; ?></td>
                            <td data-label="Dirección"><?php echo $operador['soc_direccion']; ?></td>
                            <td data-label="Acciones">
                                
                                <button class="btn btn-danger boton_eliminar" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-cedula="<?php echo $operador['soc_cedula']; ?>">
                                    Eliminar
                                </button>
                                
                                <button class="btn btn-primary boton_editar" data-bs-toggle="modal" data-bs-target="#modalEditar" data-cedula="<?php echo $operador['soc_cedula']; ?>" data-nombre="<?php echo $operador['soc_nombre']; ?>" data-apellido="<?php echo $operador['soc_apellido']; ?>" data-telefono="<?php echo $operador['soc_telefono']; ?>" data-email="<?php echo $operador['soc_email']; ?>" data-direccion="<?php echo $operador['soc_direccion']; ?>">
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

<!-- Modal para crear operador -->
<div class="modal fade" id="crearOperadorModal" tabindex="-1" aria-labelledby="crearOperadorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearOperadorModalLabel">Registrar Operador</h5>
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
                    <div class="mb-3">
                        <label for="contra" class="form-label">Contraseña:</label>
                        <input type="password" id="contra" name="contra" class="form-control" required>
                    </div>
                    <button type="submit" name="crearOperador" class="btn btn-primary">Registrar Operador</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para eliminar operador -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Eliminar Operador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este operador?</p>
                <form method="POST" action="../../Views/admin/eliminar_operador.php">
                    <input type="hidden" name="cedula" id="cedulaEliminar">
                    <button type="submit" name="eliminarOperador" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar operador -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Operador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../../Views/admin/editar_operador.php">
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
                    <button type="submit" name="editarOperador" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../_layout/footer.php'; ?>

<script>
    
    $('#modalEditar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
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

    
    $('#modalEliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var cedula = button.data('cedula'); 

        var modal = $(this);
        modal.find('.modal-body #cedulaEliminar').val(cedula);
    });

   
    $('#crearOperadorModal').on('show.bs.modal', function (event) {

        var modal = $(this);
        modal.find('.modal-body #ced').val('');
        modal.find('.modal-body #nom').val('');
        modal.find('.modal-body #ape').val('');
        modal.find('.modal-body #tel').val('');
        modal.find('.modal-body #email').val('');
        modal.find('.modal-body #direc').val('');
        modal.find('.modal-body #contra').val('');
    });

    $('#crearOperadorModal form').submit(function (event) {
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
                
                $('#crearOperadorModal').modal('hide');
                
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