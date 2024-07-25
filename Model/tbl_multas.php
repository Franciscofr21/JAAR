<?php
require_once __DIR__ . '/config.php';

class tbl_multas{
    private $con;

    public function __construct() {
        $db = new Conex();
        $this->con = $db->getConexion();
    }

    // CRUD obtener multa con cedula del deudor
    public function obtenerMulta() {
        $query = "
            SELECT m.mul_id, m.mul_fecha, m.mul_monto, m.mul_descrip, s.soc_cedula, m.mul_estado
            FROM tbl_multa m
            JOIN tbl_socio s ON m.soc_id = s.soc_id
            WHERE m.mul_estado = 'M'";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // CRUD obtener multa con cedula del deudor
    public function obtenerMultaP() {
        $query = "
            SELECT m.mul_id, m.mul_fecha, m.mul_monto, m.mul_descrip, s.soc_cedula, m.mul_estado
            FROM tbl_multa m
            JOIN tbl_socio s ON m.soc_id = s.soc_id
            WHERE m.mul_estado = 'N'";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Crear multa
    public function crearMulta($fecha, $monto,$codmul, $descripcion, $soc_id) {
        $stmt = $this->con->prepare("INSERT INTO tbl_multa (mul_fecha, mul_monto,mul_codMul, mul_descrip, soc_id, mul_estado) VALUES (?, ?, ?,?, ?, 'M')");
        $stmt->bind_param("sdssi", $fecha, $monto,$codmul, $descripcion, $soc_id);
        return $stmt->execute();
    }
    // para mandar el codigo de la multa al pago
    public function actualizarCodigoMulta($pag_id, $codMul) {
        $stmt = $this->con->prepare("UPDATE tbl_pago SET pag_codMul = ? WHERE pag_id = ?");
        $stmt->bind_param("si", $codMul, $pag_id);
        return $stmt->execute();
    }


    // Actualizar multa
    public function actualizarMulta($id, $fecha, $monto, $descripcion, $soc_id, $estado) {
        $stmt = $this->con->prepare("UPDATE tbl_multa SET mul_fecha = ?, mul_monto = ?, mul_descrip = ?, soc_id = ?, mul_estado = ? WHERE mul_id = ?");
        $stmt->bind_param("sdsisi", $fecha, $monto, $descripcion, $soc_id, $estado, $id);
        return $stmt->execute();
    }

    // Eliminar multa
    public function eliminarMulta($id) {
        $stmt = $this->con->prepare("DELETE FROM tbl_multa WHERE mul_id = ?");
        $stmt->bind_param("i", $id);
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
        $stmt = $this->con->prepare("SELECT soc_id FROM tbl_socio WHERE soc_cedula = ? and per_id=4");
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['soc_id'];
        }
        return null;
    }
    
    public function obtenerMultasPorSocioId($soc_id) {
        $stmt = $this->con->prepare("SELECT * FROM tbl_multa WHERE soc_id = ? and mul_estado='M'");
        $stmt->bind_param("i", $soc_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function actualizarEstadoMulta($mul_id, $estado) {
        $stmt = $this->con->prepare("UPDATE tbl_multa SET mul_estado = ? WHERE mul_id = ?");
        $stmt->bind_param("si", $estado, $mul_id);
        return $stmt->execute();
    }
}
?>