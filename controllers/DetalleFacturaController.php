<?php

namespace App\controllers;

use App\models\DetalleFactura;
use App\models\Articulo;

class DetalleFacturaController
{
    function crearDetalleFactura($detalle)
    {
        $articulo = $detalle->articulo;
        $detalle->precioUnitario = $articulo->precio;

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
