<?php
class Cliente {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function verificarCliente($numeroDocumento) {
        $numeroDocumento = $this->db->escape_string($numeroDocumento);
        $sql = "SELECT * FROM clientes WHERE numeroDocumento = '$numeroDocumento'";
        $result = $this->db->query($sql);
        return $result->num_rows > 0;
    }

    public function registrarCliente($nombreCompleto, $tipoDocumento, $numeroDocumento, $email, $telefono) {
        $nombreCompleto = $this->db->escape_string($nombreCompleto);
        $tipoDocumento = $this->db->escape_string($tipoDocumento);
        $numeroDocumento = $this->db->escape_string($numeroDocumento);
        $email = $this->db->escape_string($email);
        $telefono = $this->db->escape_string($telefono);

        $sql_insert = "INSERT INTO clientes (nombreCompleto, tipoDocumento, numeroDocumento, email, telefono) 
                       VALUES ('$nombreCompleto', '$tipoDocumento', '$numeroDocumento', '$email', '$telefono')";
        
        return $this->db->query($sql_insert);
    }
}
?>
