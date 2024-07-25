<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'tesorero') {
    header('Location: ../login.php');
    exit();
}

require_once '../../../Model/tbl_factura.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fac_fecha = $_POST['fac_fecha'];
    $fac_monto = $_POST['fac_monto'];
    $fac_montoM = $_POST['fac_montoM'];
    $fac_total = $_POST['fac_total'];
    $fac_cobrador = $_SESSION['nombre'] . ' ' . $_SESSION['apellido'];
    $soc_id = $_POST['soc_id'];

    $factura = new tbl_factura();
    $factura->insertarFactura($fac_fecha, $fac_monto, $fac_montoM, $fac_total, $fac_cobrador, $soc_id);
    
    echo "<script>
        alert('Factura agregada correctamente.');
        window.location.href = '../tesorero_dashboard.php';
    </script>";
    exit();
}
?>
