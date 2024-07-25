<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

require_once '../../Model/tbl_medidor.php';
$conn = new tbl_medidor();
$medidores = $conn->obtenerMedidor();
include '../_layout/header.php'; 
?>

<main>
    <section>
        <h2>Medidores Existentes</h2>
        <?php if (isset($_SESSION['alertMessage'])) { ?>
            <div class="alert alert-<?php echo $_SESSION['alertType']; ?>" role="alert">
                <?php echo $_SESSION['alertMessage']; ?>
            </div>
            <?php unset($_SESSION['alertType']); unset($_SESSION['alertMessage']); ?>
        <?php } ?>
        <div>
            <table>
                <thead>
                    <tr>
                        <th class="hidden">ID</th>
                        <th>Identificación</th>
                        <th>Fecha Actual</th>
                        <th>Lectura Actual</th>
                        <th>Fecha Nueva</th>
                        <th>Lectura Nueva</th>
                        <th>Cédula Socio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medidores as $medidor) { ?>
                        <tr>
                            <td data-label="ID" class="hidden"><?php echo $medidor['med_id']; ?></td>
                            <td data-label="Identificación"><?php echo $medidor['med_identificacion']; ?></td>
                            <td data-label="Fecha Actual"><?php echo $medidor['med_fechaA']; ?></td>
                            <td data-label="Lectura Actual"><?php echo $medidor['med_lecturaA']; ?></td>
                            <td data-label="Fecha Nueva"><?php echo $medidor['med_fechaN']; ?></td>
                            <td data-label="Lectura Nueva"><?php echo $medidor['med_lecturaN']; ?></td>
                            <td data-label="Cédula Socio"><?php echo $medidor['soc_cedula']; ?></td>
                            <td data-label="Acciones">
                                <button class="btn btn-danger boton_eliminar" data-medid="<?php echo $medidor['med_id'];?>" data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar</button>
                                <br>
                                <button class="btn btn-primary boton_editar" data-medid="<?php echo $medidor['med_id']; ?>" data-identi="<?php echo $medidor['med_identificacion']; ?>" data-fechaA="<?php echo $medidor['med_fechaA']; ?>" data-lectA="<?php echo $medidor['med_lecturaA']; ?>" data-fechaN="<?php echo $medidor['med_fechaN']; ?>" data-lectN="<?php echo $medidor['med_lecturaN']; ?>" data-bs-toggle="modal" data-bs-target="#modalEditar">Editar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Eliminar Medidor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este medidor?</p>
                <form method="POST" action="../../Views/admin/eliminar_medidor.php">
                    <input type="hidden" name="med_id" id="medidorEliminar">
                    <button type="submit" name="eliminarMedidor" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Medidor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../../Views/admin/editar_medidor.php">
                    <input type="hidden" id="med_idEditar" name="med_id">
                    <div class="mb-3">
                        <label for="identiEditar" class="form-label">Identificación:</label>
                        <input type="text" id="identiEditar" name="med_identificacion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fechaAEditar" class="form-label">Fecha Actual:</label>
                        <input type="date" id="fechaAEditar" name="med_fechaA" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="lecturaAEditar" class="form-label">Lectura Actual:</label>
                        <input type="number" step="0.01" id="lecturaAEditar" name="med_lecturaA" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fechaNEditar" class="form-label">Fecha Nueva:</label>
                        <input type="date" id="fechaNEditar" name="med_fechaN" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="lecturaNEditar" class="form-label">Lectura Nueva:</label>
                        <input type="number" step="0.01" id="lecturaNEditar" name="med_lecturaN" class="form-control" required>
                    </div>
                    <button type="submit" name="editarMedidor" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include '../_layout/footer.php'; ?>

<script>
    $('#modalEditar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var med_id = button.data('medid');
        var identificacion = button.data('identi');
        var fechaA = button.data('fechaA');
        var lecturaA = button.data('lectA');
        var fechaN = button.data('fechaN');
        var lecturaN = button.data('lectN');

        var modal = $(this);
        modal.find('.modal-body #med_idEditar').val(med_id);
        modal.find('.modal-body #identiEditar').val(identificacion);
        modal.find('.modal-body #fechaAEditar').val(fechaA);
        modal.find('.modal-body #lecturaAEditar').val(lecturaA);
        modal.find('.modal-body #fechaNEditar').val(fechaN);
        modal.find('.modal-body #lecturaNEditar').val(lecturaN);
    });

    $('#modalEliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var med_id = button.data('medid'); 

        var modal = $(this);
        modal.find('.modal-body #medidorEliminar').val(med_id);
    });

    $('#crearMedidorModal').on('show.bs.modal', function (event) {
        var modal = $(this);
        modal.find('.modal-body #identificacionCrear').val('');
        modal.find('.modal-body #fechaACrear').val('');
        modal.find('.modal-body #lecturaACrear').val('');
        modal.find('.modal-body #fechaNCrear').val('');
        modal.find('.modal-body #lecturaNCrear').val('');
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