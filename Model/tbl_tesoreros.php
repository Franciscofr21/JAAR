<?php
require_once __DIR__ . '/config.php';

class tbl_tesoreros {
    private $con;

    public function __construct() {
        $db = new Conex();
        $this->con = $db->getConexion();
    }

    //CRUD obtener socio
    public function obtenerTesorero() {
        $query = "SELECT soc_cedula, soc_nombre, soc_apellido, soc_telefono, soc_email, soc_direccion FROM tbl_socio WHERE per_id=2 and soc_estado='A'";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    //CRUD crear
    public function crearTesorero($cedula, $nombres, $apellidos, $telef, $email, $direc, $contra) {
        // Verificar si la cédula ya existe
        $stmt = $this->con->prepare("SELECT soc_cedula FROM tbl_socio WHERE soc_cedula = ? and per_id=2");
        $stmt->bind_param("d", $cedula);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return false; // Cédula ya existe
        }

        // Insertar nuevo usuario
        $stmt = $this->con->prepare("INSERT INTO tbl_socio (soc_cedula, soc_nombre,soc_apellido, soc_telefono, soc_email, soc_direccion, soc_contra, per_id,soc_estado) VALUES (?,?,?,?,?,?,?,2,'A')");
        $hashedcontra = password_hash($contra, PASSWORD_BCRYPT);
        $stmt->bind_param("dssdsss", $cedula,$nombres,$apellidos,$telef,$email,$direc,$hashedcontra);
        return $stmt->execute();
    }
    //Eliminar
    public function eliminarTesorero($cedula) {
        $stmt = $this->con->prepare("DELETE FROM tbl_socio WHERE soc_cedula = ? and per_id=2");
        $stmt->bind_param("s", $cedula);
        return $stmt->execute();
    }
    //Editar
    public function editarTesorero($cedula, $nombres, $apellidos, $telefono, $email, $direccion) {
        $stmt = $this->con->prepare("UPDATE tbl_socio SET soc_nombre = ?, soc_apellido = ?, soc_telefono = ?, soc_email = ?, soc_direccion = ? WHERE soc_cedula = ? and per_id=2");
        $stmt->bind_param("ssdssd", $nombres, $apellidos, $telefono, $email, $direccion, $cedula);
        return $stmt->execute();
    }

}
?>