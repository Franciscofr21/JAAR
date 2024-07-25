<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'operador') {
    header('Location: ../login.php');
    exit();
}
require_once '../../../Model/tbl_medidor.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregarMedidor'])) {
    $identi = $_POST['identi'];
    $fechaA = $_POST['fec'];
    $lecturaA = $_POST['lecturaAnterior'];
    $fechaN = $_POST['fechaActual'];
    $lecturaN = $_POST['lecturaActual'];
    $soc_id = $_POST['soc_id'];

    $conn = new tbl_medidor();
    if ($conn->agregarMedidor($identi, $fechaA, $lecturaA, $fechaN, $lecturaN, $soc_id)) {
        header('Location: ../../operador/operador_dashboard.php?medidor_agregado=true');
        exit();
    } else {
        // Mostrar mensaje de error si ya existe un medidor para el socio
        header('Location: ../../operador/operador_dashboard.php?error=medidor_existente');
        exit();
    }
}
?>
