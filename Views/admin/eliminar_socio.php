<?php
session_start(); // Inicia la sesión si aún no está iniciada

require_once '../../Model/tbl_socios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminarSocio'])) {
    $cedula = $_POST['cedula'];
    $conn = new tbl_socio();
    if ($conn->eliminarSocio($cedula)) {
        $_SESSION['alertType'] = 'warning';
        $_SESSION['alertMessage'] = 'Socio eliminado exitosamente.';
    } else {
        $_SESSION['alertType'] = 'danger';
        $_SESSION['alertMessage'] = 'Error al eliminar el socio.';
    }
    // Redirige después de establecer las alertas
    header('Location: ../admin/admin_usuarios.php');
    exit();
}
?>
