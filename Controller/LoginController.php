<?php
require_once '../Model/conexion.php';

class LoginController {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function login($tipo, $usuario, $contra) {
        session_start(); // Iniciar sesión
        $perfil_id = 0;
        if ($tipo === 'admin') {
            $perfil_id = 1;
        } elseif ($tipo === 'tesorero') {
            $perfil_id = 2;
        } elseif ($tipo === 'operador') {
            $perfil_id = 3;
        }

        $user = $this->conexion->authenticateUser($usuario, $contra, $perfil_id);
        if ($user) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['nombre'] = $user['soc_nombre'];
            $_SESSION['apellido'] = $user['soc_apellido'];
            if ($tipo === 'admin') {
                header("Location: ../Views/admin/admin_dashboard.php");
            } elseif ($tipo === 'tesorero') {
                header("Location: ../Views/tesorero/tesorero_dashboard.php");
            } elseif ($tipo === 'operador') {
                header("Location: ../Views/operador/operador_dashboard.php");
            }
            exit;
        } else {
            header("Location: ../Views/login.php?error=1");
            exit;
        }
    }
}
?>