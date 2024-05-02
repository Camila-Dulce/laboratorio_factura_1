<?php

namespace App\controllers;

use App\controllers\Database;

class ClienteController
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getClienteById($cliente_id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->bind_param("i", $cliente_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function getAllClientes()
    {
        $conn = $this->db->getConnection();
        $result = $conn->query("SELECT * FROM clientes");
        $clientes = array();

        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }

        return $clientes;
    }

    public function actualizarCliente($cliente_id, $nombreCompleto, $tipoDocumento, $numeroDocumento, $email, $telefono)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE clientes SET nombreCompleto=?, tipoDocumento=?, numeroDocumento=?, email=?, telefono=? WHERE id=?");
        $stmt->bind_param("sssssi", $nombreCompleto, $tipoDocumento, $numeroDocumento, $email, $telefono, $cliente_id);
        
        return $stmt->execute();
    }
}

