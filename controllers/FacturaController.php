<?php

namespace App\controllers;

use App\models\Factura;
use App\controllers\DataBaseController;

class FacturaController
{
    
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

    private $dbController;

    public function __construct()
    {
        $this->dbController = new DataBaseController();
    }

    public function getCount()
    {
        $result = $this->dbController->execSql("SELECT COUNT(*) as total FROM facturas");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function actualizarEstadoFactura($refencia, $nuevoEstado)
    {
        $sql = "UPDATE facturas SET estado = '$nuevoEstado' WHERE refencia = '$refencia'";
        $result = $this->dbController->execSql($sql);
        $this->dbController->close();
        return $result;
    }

}
?>

