<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
require_once '../../Model/tbl_factura.php';
$conn = new tbl_factura();
$facturas = $conn->obtenerFacturas();

include '../_layout/header.php'; 
?>

    <main>
        <section>
            <h2>Lista de Facturas</h2>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Multa</th>
                            <th>Total</th>
                            <th>Cobrador</th>
                            <th>Estado</th>
                            <th>Cedula Socio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($facturas as $factura) { ?>
                            <tr>
                                <td data-label="ID"><?php echo $factura['fac_id']; ?></td>
                                <td data-label="Fecha"><?php echo $factura['fac_fecha']; ?></td>
                                <td data-label="Monto"><?php echo $factura['fac_monto']; ?></td>
                                <td data-label="Multa"><?php echo is_null($factura['fac_montoM']) ? 'sin multa' : $factura['fac_montoM']; ?></td>
                                <td data-label="Total"><?php echo $factura['fac_total']; ?></td>
                                <td data-label="Cobrador"><?php echo $factura['fac_cobrador']; ?></td>
                                <td data-label="Estado"><?php echo $factura['fac_estado']; ?></td>
                                <td data-label="Cédula Socio"><?php echo $factura['soc_cedula']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
<?php include '../_layout/footer.php'; ?>