<?php

class Conexion {
    private $con;

    //conexion a la base
    public function __construct() {
        $this->con = new mysqli('localhost', 'root', '', 'aguatodo');

        if ($this->con->connect_error) {
            die("Conexión fallida: " . $this->con->connect_error);
        }
    }
    // Autenticación de admin, operador, tesorero
    public function authenticateUser($usuario, $contra, $perf) {
        $stmt = $this->con->prepare("SELECT soc_contra, soc_nombre, soc_apellido FROM tbl_socio WHERE soc_cedula = ? AND per_id = ?");
        $stmt->bind_param("si", $usuario, $perf);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($contra, $user['soc_contra'])) {
            return $user;
        } else {
            return false;
        }
    }
    
    //CRUD obtener
    public function obtenerAdmins() {
        $query = "SELECT soc_cedula, soc_contra FROM tbl_socio WHERE per_id=1 and soc_estado='A'";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    //CRUD crear
    public function crearAdmin($cedula, $contrasena) {
        // Verificar si la cédula ya existe
        $stmt = $this->con->prepare("SELECT soc_cedula FROM tbl_socio WHERE soc_cedula = ? and per_id=1");
        $stmt->bind_param("d", $cedula);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return false; // Cédula ya existe
        }

        // Insertar nuevo admin
        $stmt = $this->con->prepare("INSERT INTO tbl_socio (soc_cedula, soc_nombre,soc_apellido, soc_telefono, soc_email, soc_direccion, soc_contra, per_id,soc_estado) VALUES (?, null,null, null, null, null, ?, 1,'A')");
        $hashed_password = password_hash($contrasena, PASSWORD_BCRYPT);
        $stmt->bind_param("ds", $cedula, $hashed_password);
        return $stmt->execute();
    }
    //CRUD actualizar
    public function actualizarAdmin(){

    }
    //CRUD eliminar

    //CRUD obtener por soc_id
}
?>