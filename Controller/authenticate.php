<?php
require_once '../Model/conexion.php';
require_once 'LoginController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $usuario = $_POST['cedula'];
    $contra = $_POST['contra'];

    $loginController = new LoginController();
    $loginController->login($tipo, $usuario, $contra);
}
?>