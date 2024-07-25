<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
require_once '../../Model/tbl_operadores.php';
$conn = new tbl_operadores();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminarOperador'])) {
    $cedula = $_POST['cedula'];
    if ($conn->eliminarOperador($cedula)) {
        $_SESSION['alertType'] = 'warning';
        $_SESSION['alertMessage'] = 'Operador eliminado exitosamente.';
    } else {
        $_SESSION['alertType'] = 'danger';
        $_SESSION['alertMessage'] = 'Hubo un error al eliminar el operador.';
    }
    header('Location: ../admin/admin_operadores.php');
    exit();
}
?>