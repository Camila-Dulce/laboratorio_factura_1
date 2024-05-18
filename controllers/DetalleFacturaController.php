<?php

namespace App\controllers;

use App\models\DetalleFactura;
use mysqli_sql_exception;

class DetalleFacturaController
{
    private $dbController;

    function __construct()
    {
        $this->dbController = new DataBaseController();
    }

    function crear(DetalleFactura $detalleFactura, $idCliente)
    {
        try {
            // Inserción en la tabla facturas
            $sqlFactura = "INSERT INTO facturas (refencia, idCliente) VALUES ('{$detalleFactura->refencia}', '$idCliente')";
            if ($this->dbController->execSql($sqlFactura)) {
                // Verificar si la factura fue insertada correctamente
                if ($this->dbController->conex->affected_rows > 0) {
                    // Inserción en la tabla detallefacturas
                    $sqlDetalle = "INSERT INTO detallefacturas (refenciaFactura, idArticulo, precioUnitario) VALUES ('{$detalleFactura->refencia}', '{$detalleFactura->idArticulo}', '{$detalleFactura->precioUnitario}')";
                    if ($this->dbController->execSql($sqlDetalle)) {
                        return true; // Éxito
                    } else {
                        throw new mysqli_sql_exception("Error al insertar en detallefacturas: " . $this->dbController->conex->error);
                    }
                } else {
                    throw new mysqli_sql_exception("No se pudo insertar la factura: " . $this->dbController->conex->error);
                }
            } else {
                throw new mysqli_sql_exception("Error al insertar en facturas: " . $this->dbController->conex->error);
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}



