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

    public function getFacturaData($numeroDocumento, $referencia)
    {
        $conn = $this->dbController->getConexion();

        // Obtener los datos del cliente utilizando el número de documento
        $clienteSql = "SELECT * FROM clientes WHERE numeroDocumento = ?";
        $stmtCliente = $conn->prepare($clienteSql);
        if (!$stmtCliente) {
            die("Preparación de la declaración fallida: " . $conn->error);
        }
        $stmtCliente->bind_param("s", $numeroDocumento);
        $stmtCliente->execute();
        $clienteResult = $stmtCliente->get_result();
        $cliente = $clienteResult->fetch_assoc();

        if (!$cliente) {
            die("No se encontraron datos del cliente.");
        }

        // Obtener los datos de la factura utilizando la referencia y el ID del cliente
        $facturaSql = "SELECT * FROM facturas WHERE refencia = ? AND idCliente = ?";
        $stmtFactura = $conn->prepare($facturaSql);
        if (!$stmtFactura) {
            die("Preparación de la declaración fallida: " . $conn->error);
        }
        $stmtFactura->bind_param("si", $referencia, $cliente['id']);
        $stmtFactura->execute();
        $facturaResult = $stmtFactura->get_result();
        $factura = $facturaResult->fetch_assoc();

        if (!$factura) {
            die("No se encontraron datos de la factura.");
        }

        // Obtener los detalles de la factura utilizando la referencia de la factura
        $detallesSql = "SELECT * FROM detallefacturas WHERE refenciaFactura = ?";
        $stmtDetalles = $conn->prepare($detallesSql);
        if (!$stmtDetalles) {
            die("Preparación de la declaración fallida: " . $conn->error);
        }
        $stmtDetalles->bind_param("s", $referencia);
        $stmtDetalles->execute();
        $detallesResult = $stmtDetalles->get_result();

        // Cerrar declaraciones
        $stmtCliente->close();
        $stmtFactura->close();
        $stmtDetalles->close();
        $this->dbController->close();

        return [
            'cliente' => $cliente,
            'factura' => $factura,
            'detalles' => $detallesResult
        ];
    }
}
?>



















