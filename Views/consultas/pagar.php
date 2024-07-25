<?php
require_once '../../Model/tbl_factura.php';

$idFactura = $_GET['idFactura'] ?? '';
$idSocio = $_GET['idSocio'] ?? '';

if ($idFactura && $idSocio) {
    $conn = new tbl_factura();
    $factura = $conn->obtenerFacturaPorId($idFactura);
    if ($factura) {
        // Cambiar el estado de la factura a 'PG'
        $conn->actualizarEstadoFactura($idFactura, 'PG');
        

        // Redirigir con un mensaje de éxito
        header("Location: ../consultas/consulPagos.php?idSocio=" . urlencode($idSocio) . "&mensaje=" . urlencode("Pago realizado con éxito."));
        exit();
    } else {
        echo "No se encontró la factura.";
        exit();
    }
} else {
    echo "No se proporcionó un ID de factura o cédula de socio.";
    exit();
}
?>
