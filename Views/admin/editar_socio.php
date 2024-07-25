<?php
require_once '../../Model/tbl_socios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editarSocio'])) {
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nom'];
    $apellidos = $_POST['ape'];
    $telefono = $_POST['tel'];
    $email = $_POST['email'];
    $direccion = $_POST['direc'];

    $conn = new tbl_socio();
    if ($conn->editarSocio($cedula, $nombres, $apellidos, $telefono, $email, $direccion)) {
        $_SESSION['alertType'] = 'success';
        $_SESSION['alertMessage'] = 'Socio editado exitosamente.';
        header('Location: ../admin/admin_usuarios.php');
        exit();
    } else {
        $_SESSION['alertType'] = 'danger';
        $_SESSION['alertMessage'] = 'Error al editar el socio.';
        header('Location: ../admin/admin_usuarios.php');
        exit();
    }
}
?>