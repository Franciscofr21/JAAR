<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

require_once '../../Model/tbl_tesoreros.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminarTesorero'])) {
    $cedula = $_POST['cedula'];
    $conn = new tbl_tesoreros();
    if ($conn->eliminarTesorero($cedula)) {
        $_SESSION['alertType'] = 'warning';
        $_SESSION['alertMessage'] = 'Se ha eliminado un tesorero.';
        header('Location: ../admin/admin_tesoreros.php');
        exit();
    } else {
        $_SESSION['alertType'] = 'danger';
        $_SESSION['alertMessage'] = 'Hubo un error al eliminar el tesorero.';
        header('Location: ../admin/admin_tesoreros.php');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>