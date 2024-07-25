<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../Model/tbl_multas.php';
    $conn = new tbl_multas();

    // Obtener los datos del formulario
    $monto = $_POST['MontoM'];
    $ncuenta = $_POST['ncuenta'];
    $mul_id = $_POST['mul_id'];
    $idSocio = $_POST['idSocio'];

    // Validar y sanitizar los datos si es necesario
    if (!is_numeric($monto) || $monto <= 0 || !is_numeric($ncuenta) || strlen($ncuenta) !== 10) {
        header('Location: ../consultas/consulMultas.php?idSocio=' . urlencode($idSocio) . '&status=error&message=Datos+de+entrada+inválidos');
        exit();
    }

    // Actualizar el estado de la multa
    if ($conn->actualizarEstadoMulta($mul_id, 'N')) {
        header('Location: ../consultas/consulMultas.php?idSocio=' . urlencode($idSocio) . '&status=success&message=Pago+realizado+exitosamente');
    } else {
        header('Location: ../consultas/consulMultas.php?idSocio=' . urlencode($idSocio) . '&status=error&message=Error+al+procesar+el+pago');
    }
} else {
    header('Location: ../consultas/consulMultas.php?idSocio=' . urlencode($idSocio) . '&status=error&message=Método+no+permitido');
}
exit();
?>