<?php

namespace App\controllers;

use App\controllers\DataBaseController;

class GenerarFacturaController {

    public function getFacturasByEstado($estado) {
        $dbController = new DataBaseController();
        $conn = $dbController->getConexion();

        $sql = "SELECT * FROM facturas WHERE estado = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $estado);
        $stmt->execute();
        $result = $stmt->get_result();
        $facturas = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $conn->close();

        return $facturas;
    }

    public function getFacturaData($idCliente, $referencia) {
        $dbController = new DataBaseController();
        $conn = $dbController->getConexion();

        $sql = "SELECT * FROM facturas WHERE refencia = ? AND idCliente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $referencia, $idCliente);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $stmt->close();
            $conn->close();
            return false;
        }

        $factura = $result->fetch_assoc();

        $sqlDetalles = "SELECT * FROM detallefacturas WHERE refenciaFactura = ?";
        $stmtDetalles = $conn->prepare($sqlDetalles);
        $stmtDetalles->bind_param("s", $referencia);
        $stmtDetalles->execute();
        $detalles = $stmtDetalles->get_result();

        $sqlCliente = "SELECT * FROM clientes WHERE id = ?";
        $stmtCliente = $conn->prepare($sqlCliente);
        $stmtCliente->bind_param("i", $idCliente);
        $stmtCliente->execute();
        $resultCliente = $stmtCliente->get_result();

        if ($resultCliente->num_rows === 0) {
            $stmt->close();
            $stmtDetalles->close();
            $stmtCliente->close();
            $conn->close();
            return false;
        }

        $cliente = $resultCliente->fetch_assoc();

        $stmt->close();
        $stmtDetalles->close();
        $stmtCliente->close();
        $conn->close();

        return [
            'factura' => $factura,
            'detalles' => $detalles,
            'cliente' => $cliente,
        ];
    }
}
?>

























