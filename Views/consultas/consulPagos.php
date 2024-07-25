<?php
$idSocio = $_GET['idSocio'] ?? '';
$mensaje = $_GET['mensaje'] ?? '';

if ($idSocio) {
    require_once '../../Model/tbl_factura.php';
    $conn = new tbl_factura();
    $soc_id = $conn->obtenerSocioIdPorCedula($idSocio);
    if ($soc_id) {
        $facturas = $conn->obtenerFacturaPorSocioId($soc_id);
    } else {
        echo "No se encontró un socio con esa cédula.";
        exit();
    }
} else {
    echo "No se proporcionó una cédula.";
    exit();
}
include '../_layout/headerCon.php'; 
?>
    <main>
        <section>
            <h2>Pagos Pendientes del Socio <?php echo htmlspecialchars($idSocio); ?></h2>
            <a href="../consultas/comprobantes.php?idSocio=<?php echo urlencode($idSocio); ?>">Ver Comprobantes</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Total</th>
                        <th>Cobrador</th>
                        <th>Estado Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($facturas)) { ?>
                        <?php foreach ($facturas as $factura) { ?>
                            <tr>
                                <td data-label="ID"><?php echo $factura['fac_id']; ?></td>
                                <td data-label="Fecha"><?php echo $factura['fac_fecha']; ?></td>
                                <td data-label="Monto"><?php echo $factura['fac_monto']; ?></td>
                                <td data-label="Total"><?php echo $factura['fac_total']; ?></td>
                                <td data-label="Cobrador"><?php echo $factura['fac_cobrador']; ?></td>
                                <td data-label="Estado"><?php echo $factura['fac_estado']; ?></td>
                                <td data-label="Acciones">
                                    <?php if ($factura['fac_estado'] !== 'PG') { ?>
                                        <a class="btn btn-primary pagar-btn" href="../consultas/pagar.php?idFactura=<?php echo $factura['fac_id']; ?>&idSocio=<?php echo urlencode($idSocio); ?>">Pagar</a>
                                    <?php } else { ?>
                                        <span>Pagado</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="8">No se encontraron facturas para este socio.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="../paginaprincipal.php">Regresar</a>
        </section>
    </main>
<?php include '../_layout/footerCon.php'; ?>