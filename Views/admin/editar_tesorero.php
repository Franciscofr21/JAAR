<?php
require_once '../../Model/tbl_tesoreros.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editarTesorero'])) {
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nom'];
    $apellidos = $_POST['ape'];
    $telefono = $_POST['tel'];
    $email = $_POST['email'];
    $direccion = $_POST['direc'];

    $conn = new tbl_tesoreros();
    if ($conn->editarTesorero($cedula, $nombres, $apellidos, $telefono, $email, $direccion)) {
        header('Location: ../admin/admin_tesoreros.php');
        exit();
    } else {
        echo "Error al editar el socio.";
    }
}
?>