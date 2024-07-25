<?php
require_once __DIR__ . '/config.php';

class tbl_factura {
    private $con;

    public function __construct() {
        $db = new Conex();
        $this->con = $db->getConexion();
    }

    public function insertarFactura($fac_fecha, $fac_monto, $fac_montoM, $fac_total, $fac_cobrador, $soc_id) {
        $sql = "INSERT INTO tbl_factura (fac_fecha, fac_monto, fac_montoM, fac_total, fac_cobrador, soc_id,fac_estado) VALUES (?, ?, ?, ?, ?, ?,'PP')";
        $stmt = $this->con->prepare($sql);
        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($this->con->error));
        }
        $stmt->bind_param('sdddsi', $fac_fecha, $fac_monto, $fac_montoM, $fac_total, $fac_cobrador, $soc_id);
        $stmt->execute();
        $stmt->close();
    }
    public function obtenerFacturas() {
        $sql = "
            SELECT f.*, s.soc_cedula 
            FROM tbl_factura f
            JOIN tbl_socio s ON f.soc_id = s.soc_id
        ";
        $result = $this->con->query($sql);
        if ($result === false) {
            die('Query() failed: ' . htmlspecialchars($this->con->error));
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerSocioIdPorCedula($cedula) {
        $stmt = $this->con->prepare("SELECT soc_id FROM tbl_socio WHERE soc_cedula = ? AND per_id = 4");
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['soc_id'];
        }
        return null;
    }

    public function obtenerFacturaPorSocioId($soc_id) {
        $stmt = $this->con->prepare("SELECT * FROM tbl_factura WHERE soc_id = ? and fac_estado='PP'");
        $stmt->bind_param("i", $soc_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function obtenerFacturaPorSocioIdPG($soc_id) {
        $stmt = $this->con->prepare("SELECT * FROM tbl_factura WHERE soc_id = ? and fac_estado='PG'");
        $stmt->bind_param("i", $soc_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function obtenerFacturaPorId($facturaId) {
        $query = "
            SELECT f.fac_id, f.fac_fecha, f.fac_monto, f.fac_montoM, f.fac_total, f.fac_cobrador, f.fac_estado, 
                   s.soc_nombre AS nombre_socio, s.soc_apellido AS apellido_socio, f.fac_fecha
            FROM tbl_factura f
            JOIN tbl_socio s ON f.soc_id = s.soc_id
            WHERE f.fac_id = ?
        ";
        $stmt = $this->con->prepare($query);
        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($this->con->error));
        }
        $stmt->bind_param('i', $facturaId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function actualizarEstadoFactura($idFactura, $estado) {
        // Suponiendo que tienes una conexión a la base de datos configurada
        $query = "UPDATE tbl_factura SET fac_estado = ? WHERE fac_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->execute([$estado, $idFactura]);
    }
}
?>
