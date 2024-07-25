<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'tesorero') {
    header('Location: ../login.php');
    exit();
}
require_once '../../Model/tbl_pagos.php';
$conn = new tbl_pagos();
$pagos = $conn->obtenerPagos();

include '../_layout/headerT.php'; 
?>
    <main>
        <section>
            <h2>Pagos Pendientes</h2>
            <h4>PP = Por pagar</h4>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Estado Pago</th>
                            <th>Cedula Socio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagos as $pago) { ?>
                            <tr>
                                <td class="hidden" data-label="ID"><?php echo $pago['pag_id']; ?></td>
                                <td data-label="Fecha Pago"><?php echo $pago['pag_fecha']; ?></td>
                                <td data-label="Pago"><?php echo $pago['pag_monto']; ?></td>
                                <td data-label="Estado"><?php echo $pago['pag_estado']; ?></td>
                                <td data-label="Cedula Socio"><?php echo $pago['soc_cedula']; ?></td>
                                <td class="hidden" data-label="id Socio"><?php echo $pago['soc_id']; ?></td>
                                <td data-label="Acciones">
                                    <form method="POST" action="../../Views/tesorero/teso_modales/generar_factura.php" style="display: inline;">
                                        <input type="hidden" name="fac_fecha" value="<?php echo $pago['pag_fecha']; ?>">
                                        <input type="hidden" name="fac_monto" value="<?php echo $pago['pag_monto']; ?>">
                                        <input type="hidden" name="fac_total" value="<?php echo $pago['pag_monto']; ?>">
                                        <input type="hidden" name="soc_id" value="<?php echo $pago['soc_id']; ?>">
                                        <button type="submit" class="boton_factu">Generar Factura</button>
                                    </form>
                                    <button class="boton_agregar" data-pagid="<?php echo $pago['pag_id']; ?>" data-socid="<?php echo $pago['soc_id']; ?>">Generar Multa</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
<?php include '../_layout/footerT.php'; ?>

    <div id="modalAgregar" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalAgregar')">&times;</span>
            <h2>Agregar Multa</h2>
            <form method="POST" action="../../Views/tesorero/teso_modales/generar_multa.php">
                <input type="hidden" id="pagid" name="pagid">
                <label for="multa">Monto de Multa:</label>
                <input type="number" id="multa" name="multa" step="0.01" pattern="\d+(\.\d{2})?" title="Ingrese un número con dos dígitos enteros y dos decimales (por ejemplo, 123.45)" required>
                <br>

                <label for="descrip">Descripción:</label><br>
                <textarea id="descrip" name="descrip" style="width: 100%; max-width: 100%; min-height: 100px; resize: none;" required></textarea>
                <br>
                <input type="hidden" id="socid" name="socid">

                <button type="submit" name="agregarMulta">Agregar Multa</button>
            </form>
        </div>

