<?php
class Conex {
    private $con;

    // Conexión a la base de datos
    public function __construct() {
        $this->con = new mysqli('localhost', 'root', '', 'aguatodo');

        if ($this->con->connect_error) {
            die("Conexión fallida: " . $this->con->connect_error);
        }
    }

    public function getConexion() {
        return $this->con;
    }
}
?>