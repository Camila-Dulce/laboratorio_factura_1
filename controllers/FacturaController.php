<?php

namespace App\controllers;

use App\models\Factura;
use App\models\Cliente;
use App\models\DetalleFactura;

class FacturaController
{
    function generarFactura($factura)
    {
        // Calcular el descuento
        $totalCompra = 0;
        foreach ($factura->detalleFactura() as $detalle) {
            $totalCompra += $detalle->cantidad * $detalle->precioUnitario;
        }
        $descuento = 0;
        if ($totalCompra > 650000) {
            $descuento = 8;
        } elseif ($totalCompra > 200000) {
            $descuento = 4;
        } elseif ($totalCompra > 100000) {
            $descuento = 2;
        }

        // Crear la factura
        $factura->descuento = $descuento;
        $factura->estado = 'Pagada'; // Estado por defecto
        $result = $this->guardarFactura($factura);

        if ($result) {
            // Actualizar el estado de los artículos y guardar los detalles de la factura
            foreach ($factura->detalleFactura() as $detalle) {
                $detalle->precioUnitario = $detalle->articulo->precio;
                $this->guardarDetalleFactura($detalle);
            }
        }
        return $result;
    }

    function guardarFactura($factura)
    {
        $dataBase = new DataBaseController();
        $sql = "INSERT INTO facturas (referencia, fecha, idCliente, estado, descuento) VALUES ";
        $sql .= "('".$factura->referencia."', ";
        $sql .= "NOW(), ";
        $sql .= "'".$factura->cliente->idCliente."', ";
        $sql .= "'".$factura->estado."', ";
        $sql .= "'".$factura->descuento."')";
        $result = $dataBase->execSql($sql);
        $dataBase->close();
        return $result;
    }

    function guardarDetalleFactura($detalle)
    {
        $dataBase = new DataBaseController();
        $sql = "INSERT INTO detalles_factura (cantidad, precioUnitario, idArticulo, referenciaFactura) VALUES ";
        $sql .= "('".$detalle->cantidad."', ";
        $sql .= "'".$detalle->precioUnitario."', ";
        $sql .= "'".$detalle->idArticulo."', ";
        $sql .= "'".$detalle->referenciaFactura."')";
        $result = $dataBase->execSql($sql);
        $dataBase->close();
        return $result;
    }
}
?>
