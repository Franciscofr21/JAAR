<?php
require_once __DIR__ . '/config.php';

class tbl_medidor {
    private $con;

    public function __construct() {
        $db = new Conex();
        $this->con = $db->getConexion();
    }

    // CRUD obtener medidor con cédula de socio
    public function obtenerMedidor() {
        $query = "
            SELECT m.med_id, m.med_identificacion, m.med_fechaA, m.med_lecturaA, m.med_fechaN, m.med_lecturaN, s.soc_cedula, s.soc_id
            FROM tbl_medidor m
            JOIN tbl_socio s ON m.soc_id = s.soc_id";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Eliminar medidor
    public function eliminarMedidor($med_id) {
        $stmt = $this->con->prepare("DELETE FROM tbl_medidor WHERE med_id = ?");
        $stmt->bind_param("i", $med_id);
        return $stmt->execute();
    }

    // Agregar medidor
    public function agregarMedidor($identi, $fechaA, $lecturaA, $fechaN, $lecturaN, $soc_id) {
        // Verificar si ya existe un medidor para el socio
        $stmt = $this->con->prepare("SELECT med_id FROM tbl_medidor WHERE soc_id = ?");
        $stmt->bind_param("i", $soc_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Si ya existe un medidor para el socio, retornar false o lanzar una excepción
            return false;
        }

        // Si no existe, proceder a insertar el nuevo medidor
        $stmt = $this->con->prepare("
            INSERT INTO tbl_medidor(med_identificacion, med_fechaA, med_lecturaA, med_fechaN, med_lecturaN, soc_id) 
            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsdi", $identi, $fechaA, $lecturaA, $fechaN, $lecturaN, $soc_id);
        return $stmt->execute();
    }
    // Obtener socios asociados a un perfil con per_id = 4
    public function obtenerSociosConPerId4() {
        $query = "
            SELECT s.soc_id, s.soc_nombre
            FROM tbl_socio s
            JOIN tbl_perfil p ON s.per_id = p.per_id
            WHERE p.per_id = 4";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener socio id por cédula
    public function obtenerSocioIdPorCedula($cedula) {
        $stmt = $this->con->prepare("SELECT soc_id FROM tbl_socio WHERE soc_cedula = ?");
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['soc_id'];
        }
        return null;
    }

    // Método para crear o actualizar un pago
    public function crearPago($fecha, $monto, $soc_id) {
        // Primero, verifica si ya existe un pago para la soc_id proporcionada
        $stmt = $this->con->prepare("SELECT pag_id FROM tbl_pago WHERE soc_id = ?");
        $stmt->bind_param("i", $soc_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Si existe, actualiza el pago existente
            $stmt = $this->con->prepare("UPDATE tbl_pago SET pag_fecha = ?, pag_monto = ? WHERE soc_id = ?");
            $stmt->bind_param("sdi", $fecha, $monto, $soc_id);
            $stmt->execute();
            return true; // Indica que se actualizó el pago correctamente
        } else {
            // Si no existe, crea un nuevo pago
            $stmt = $this->con->prepare("INSERT INTO tbl_pago (pag_fecha, pag_monto, soc_id, pag_estado) VALUES (?, ?, ?, 'PP')");
            $stmt->bind_param("sdi", $fecha, $monto, $soc_id);
            $stmt->execute();
            return true; // Indica que se creó un nuevo pago correctamente
        }
        return false; // Devuelve falso si no se pudo realizar ninguna acción
    }

    // Método para editar la lectura del medidor
    public function editarLecturaMedidor($med_id, $lectura_actual, $fecha_actual, $lectura_nueva, $fecha_nueva) {
        $stmt = $this->con->prepare("UPDATE tbl_medidor SET med_lecturaA = ?, med_fechaA = ?, med_lecturaN = ?, med_fechaN = ? WHERE med_id = ?");
        $stmt->bind_param("dsdsi", $lectura_actual, $fecha_actual, $lectura_nueva, $fecha_nueva, $med_id);
        return $stmt->execute();
    }
        
}
?>