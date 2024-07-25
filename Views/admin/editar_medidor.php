<?php
session_start(); // Inicia la sesión si aún no está iniciada

require_once '../../Model/tbl_medidor.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editarMedidor'])) {
    $identi = $_POST['med_identificacion'];
    $fechaA = $_POST['med_fechaA'];
    $lecturaA = $_POST['med_lecturaA'];
    $fechaN = $_POST['med_fechaN'];
    $lecturaN = $_POST['med_lecturaN'];
    $med_id = $_POST['med_id'];

    $conn = new tbl_medidor();
    if ($conn->editarLecturaMedidor($med_id, $identi, $fechaA, $lecturaA, $fechaN, $lecturaN)) {
        $_SESSION['alertType'] = 'success';
        $_SESSION['alertMessage'] = 'Medidor editado exitosamente.';
    } else {
        $_SESSION['alertType'] = 'danger';
        $_SESSION['alertMessage'] = 'Error al editar el medidor.';
    }
    header('Location: ../admin/admin_medidores.php');
    exit();
}
?>
