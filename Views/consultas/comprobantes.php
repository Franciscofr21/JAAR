<?php
$idSocio = $_GET['idSocio'] ?? '';

if ($idSocio) {
    require_once '../../Model/tbl_factura.php';
    $conn = new tbl_factura();
    $soc_id = $conn->obtenerSocioIdPorCedula($idSocio);
    if ($soc_id) {
        $facturas = $conn->obtenerFacturaPorSocioIdPG($soc_id);
    } else {
        echo "No se encontró un socio con esa cédula.";
        exit();
    }
} else {
    echo "No se proporcionó una cédula.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Facturas</title>
    <link rel="stylesheet" href="../../Views/css/stylesA.css">
</head>
<body>
    <header>
        <h1>Consulta de Facturas</h1>
    </header>
    <main>
        <section>
            <h2>Facturas del Socio <?php echo htmlspecialchars($idSocio); ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Multa</th>
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
                                <td data-label="Multa"><?php echo is_null($factura['fac_montoM']) ? 'sin multa' : $factura['fac_montoM']; ?></td>
                                <td data-label="Total"><?php echo $factura['fac_total']; ?></td>
                                <td data-label="Cobrador"><?php echo $factura['fac_cobrador']; ?></td>
                                <td data-label="Estado"><?php echo $factura['fac_estado']; ?></td>
                                <td data-label="Acciones">
                                    <a href="../consultas/comprobantePago.php?idSocio=<?php echo urlencode($idSocio); ?>&facturaId=<?php echo $factura['fac_id']; ?>">Ver Recibo</a>
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
    <footer>
        <p>&copy; 2024 Junta de Riego y/o Drenaje por Aspersión Zumbalica. Todos los derechos reservados.</p>
    </footer>
</body>
</html>