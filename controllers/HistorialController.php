<?php

namespace App\controllers;

use App\controllers\DataBaseController;

class GenerarFacturaController
{
    private $dbController;

    public function __construct()
    {
        $this->dbController = new DataBaseController();
    }

    public function getFacturasByEstado($estado)
    {
        $conn = $this->dbController->getConexion();
        $sql = "SELECT refencia, fecha, idCliente, estado, descuento FROM facturas WHERE estado = ?";
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Preparación de la declaración fallida: " . $conn->error);
        }
        
        $stmt->bind_param("s", $estado);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $facturas = [];
        while ($row = $result->fetch_assoc()) {
            $facturas[] = $row;
        }

        $stmt->close();
        $this->dbController->close();
        
        return $facturas;
    }
}
?>













