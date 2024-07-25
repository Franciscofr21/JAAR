<?php
require_once __DIR__ . '/config.php';

class tbl_pagos {
    private $con;

    public function __construct() {
        $db = new Conex();
        $this->con = $db->getConexion();
    }

    // CRUD obtener pago con cedula
    public function obtenerPagos() {
        $query = "
            SELECT p.pag_id, p.pag_fecha, p.pag_monto, s.soc_cedula, p.pag_estado,s.soc_id
            FROM tbl_pago p
            JOIN tbl_socio s ON p.soc_id = s.soc_id
            WHERE p.pag_estado = 'PP'
            and s.per_id=4";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // CRUD obtener pago con cedula
    public function obtenerPagosP() {
        $query = "
            SELECT p.pag_id, p.pag_fecha, p.pag_monto, s.soc_cedula, p.pag_estado
            FROM tbl_pago p
            JOIN tbl_socio s ON p.soc_id = s.soc_id
            WHERE p.pag_estado = 'PG'
            and s.per_id=4";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function obtenerPagosT() {
        $query = "
            SELECT p.pag_id, p.pag_fecha, p.pag_monto, s.soc_cedula, p.pag_estado,s.soc_id
            FROM tbl_pago p
            JOIN tbl_socio s ON p.soc_id = s.soc_id
            where s.per_id=4";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Crear pago
    public function crearPago($fecha, $monto, $soc_id, $estado) {
        $stmt = $this->con->prepare("INSERT INTO tbl_pago (pag_fecha, pag_monto, soc_id, pag_estado) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdsi", $fecha, $monto, $soc_id, $estado);
        return $stmt->execute();
    }

    // Actualizar pago
    public function actualizarPago($id, $fecha, $monto, $soc_id, $estado) {
        $stmt = $this->con->prepare("UPDATE tbl_pago SET pag_fecha = ?, pag_monto = ?, soc_id = ?, pag_estado = ? WHERE pag_id = ?");
        $stmt->bind_param("sdsii", $fecha, $monto, $soc_id, $estado, $id);
        return $stmt->execute();
    }

    // Cambiar estado de pago a 'PG' en lugar de eliminar
    public function cambiarEstadoPago($id) {
        $stmt = $this->con->prepare("UPDATE tbl_pago SET pag_estado = 'PG' WHERE pag_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }   
}
?>