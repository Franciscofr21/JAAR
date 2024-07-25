<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'tesorero') {
    header('Location: ../login.php');
    exit();
}
require_once '../../Model/tbl_pagos.php';
$conn = new tbl_pagos();
$pagos = $conn->obtenerPagosP();
include '../_layout/headerT.php'; 
?>
    <main>
        <section>
            <h2>Pagos Realizados</h2>
            <h4>PG = Pagado</h4>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Estado Pago</th>
                            <th>Cedula Socio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagos as $pago) { ?>
                            <tr>
                                <td data-label="Fecha Pago"><?php echo $pago['pag_fecha']; ?></td>
                                <td data-label="Pago"><?php echo $pago['pag_monto']; ?></td>
                                <td data-label="Estado"><?php echo $pago['pag_estado']; ?></td>
                                <td data-label="Cedula Socio"><?php echo $pago['soc_cedula']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
<?php include '../_layout/footerT.php'; ?>