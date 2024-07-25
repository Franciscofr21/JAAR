<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
require_once '../../Model/tbl_multas.php';
$conn = new tbl_multas();
$multas = $conn->obtenerMulta();

include '../_layout/header.php'; 
?>
    <main>
        <section>
            <h2>Multas Existentes</h2>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Multa</th>
                            <th>Multa</th>
                            <th>Descripción</th>
                            <th>Cedula Socio</th>
                            <th>Estado Multa</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($multas as $multa) { ?>
                            <tr>
                                <td data-label="ID"><?php echo $multa['mul_id']; ?></td>
                                <td data-label="Fecha Multa"><?php echo $multa['mul_fecha']; ?></td>
                                <td data-label="Multa"><?php echo $multa['mul_monto']; ?></td>
                                <td data-label="Descripción"><?php echo $multa['mul_descrip']; ?></td>
                                <td data-label="Cedula Socio"><?php echo $multa['soc_cedula']; ?></td>
                                <td data-label="Estado Multa"><?php echo $multa['mul_estado']; ?></td>
                                <td data-label="Acciones">
                                    <button class="boton_eliminar" data-mulid="<?php echo $multa['mul_id'];?>">Eliminar</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <!-- Modales -->
    <div id="modalEliminar" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalEliminar')">&times;</span>
            <p>¿Estás seguro de que deseas eliminar este medidor?</p>
            <form method="POST" action="../../Views/admin/eliminar_multa.php">
                <input type="hidden" name="mul_id" id="multaEliminar">
                <button type="submit" name="eliminarMulta">Eliminar</button>
                <button type="button" onclick="closeModal('modalEliminar')">Cancelar</button>
            </form>
        </div>
    </div>
<?php include '../_layout/footer.php'; ?>