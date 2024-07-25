<?php
require_once '../../Model/tbl_operadores.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editarOperador'])) {
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nom'];
    $apellidos = $_POST['ape'];
    $telefono = $_POST['tel'];
    $email = $_POST['email'];
    $direccion = $_POST['direc'];

    $conn = new tbl_operadores();
    if ($conn->editarOperador($cedula, $nombres, $apellidos, $telefono, $email, $direccion)) {
        $_SESSION['alertType'] = 'success';
        $_SESSION['alertMessage'] = 'Operador editado exitosamente.';
        header('Location: ../admin/admin_operadores.php');
        exit();
    } else {
        $_SESSION['alertType'] = 'danger';
        $_SESSION['alertMessage'] = 'Error al editar el operador.';
        header('Location: ../admin/admin_operadores.php');
        exit();
    }
}
?>
