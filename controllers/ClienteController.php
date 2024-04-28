<?php

namespace App\controllers;

use App\models\Cliente;

class ClienteController
{
    function read()
    {
        $dataBase = new DataBaseController();
        $sql = "select * from contactos";
        $result = $dataBase->execSql($sql);
        $clientes = [];
        if ($result->num_rows == 0) {
            return $Detallefacturas;
        }
        while ($item = $result->fetch_assoc()) {
            $cliente = new Cliente();
    protected $referencia = " " ;
            $cliente->set('idCliente', $item['idCliente']);
            $cliente->set('nombreCompleto', $item['nombreCompleto']);
            $cliente->set('tipoDocumento', $item['tipoDocumento']);
            $cliente->set('numeroDocumento', $item['numeroDocumento']);
            $cliente->set('email', $item['email']);
            $cliente->set('telefono', $item['telefono']);
            array_push($Clientes, $cliente);
        }
        $dataBase->close();
        return $clientes;
    }

    function create($cliente)
    {
        $sql = "insert into detallefactura(nombreCompleto,tipoDocumento,numeroDocumento,email,telefono)values";
        $sql .= "(";
        $sql .= "'".$cliente->get('nombreCompleto')."',";
        $sql .= "'".$cliente->get('tipoDocumento')."',";
        $sql .= "'".$cliente->get('numeroDocumento')."',";
        $sql .= "'".$cliente->get('email')."',";
        $sql .= "'".$cliente->get('telefono')."'";
        $sql .= ")";
        $dataBase = new DataBaseController();
        $result = $dataBase->execSql($sql);
        $dataBase->close();
        return $result;
    }

    function update()
    {
    }

    function delete()
    {
    }
}
