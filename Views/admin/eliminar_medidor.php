<?php
session_start(); // Inicia la sesión si aún no está iniciada

require_once '../../Model/tbl_medidor.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminarMedidor'])) {
    $med_id = $_POST['med_id'];
    $conn = new tbl_medidor();
    if ($conn->eliminarMedidor($med_id)) {
        $_SESSION['alertType'] = 'warning';
        $_SESSION['alertMessage'] = 'Medidor eliminado exitosamente.';
    } else {
        $_SESSION['alertType'] = 'danger';
        $_SESSION['alertMessage'] = 'Error al eliminar el medidor.';
    }
    header('Location: ../admin/admin_medidores.php');
    exit();
}
?>
