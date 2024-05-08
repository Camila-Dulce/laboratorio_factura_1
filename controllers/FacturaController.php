<?php

namespace App\controllers;

use App\models\Factura;
use App\controllers\DataBaseController;

class FacturaController
{
    function CalculoFactura($factura)
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

    function mostarFactura()
    {
        $dataBase = new DataBaseController();
        $sql = "SELECT * FROM facturas";
        $result = $dataBase->execSql($sql);
        $facturas = [];
        if ($result->num_rows == 0) {
            return $facturas;
        }
        while ($item = $result->fetch_assoc()) {
            $factura = new Factura();
            $factura->set('refencia', $item['refencia']);
            $factura->set('fecha', $item['fecha']);
            $factura->set('idCliente', $item['idCliente']);
            $factura->set('estado', $item['estado']);
            $factura->set('descuento', $item['descuento']);
            array_push($facturas, $factura);
        }
        $dataBase->close();
        return $facturas;
    }

    function guardarFactura($factura)
    {
        $sql = "INSERT INTO facturas (refencia, fecha, idCliente, estado, descuento) VALUES (";
        $sql .= "'".$factura->get('refencia')."',";
        $sql .= "'".$factura->get('fecha')."',";
        $sql .= ($factura->get('idCliente') != '') ? "'".$factura->get('idCliente')."'," : "NULL,";
        $sql .= "'".$factura->get('estado')."',";
        $sql .= "'".$factura->get('descuento')."'"; 
        $sql .= ")";
        $dataBase = new DataBaseController();
        $result = $dataBase->execSql($sql);
        $dataBase->close();
        return $result;
    }
}
?>

