<?php
require_once '../../Model/tbl_medidor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $med_id = $_POST['med_id'];
    $lecturaA = $_POST['lecturaA'];
    $lecturaN = $_POST['lecturaN'];
    $soc_cedula = $_POST['soc_cedula'];
    
    // Calcular el monto
    $diferencia = $lecturaN - $lecturaA;
    $diferenciaAbsoluta = abs($diferencia); // Obtener el valor absoluto de la diferencia
    $monto = round($diferenciaAbsoluta * 0.31, 2); // Redondear el monto a dos decimales

    // Obtener soc_id a partir de la cédula
    $conn = new tbl_medidor();
    $soc_id = $conn->obtenerSocioIdPorCedula($soc_cedula);

    // Crear el pago
    $fecha = date('Y-m-d');
    if ($conn->crearPago($fecha, $monto, $soc_id)) {
        $response['status'] = 'success';
        $response['message'] = 'Pago generado exitosamente.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error al generar el pago.';
    }

}
echo json_encode($response);
?>