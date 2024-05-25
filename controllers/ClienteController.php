<?php

namespace App\controllers;

use App\models\Cliente;
use App\controllers\DataBaseController;

class ClienteController
{
    function read()
    {
        $dataBase = new DataBaseController();
        $sql = "SELECT * FROM clientes"; // Asegúrate de que el nombre de la tabla sea correcto
        $result = $dataBase->execSql($sql);
        $clientes = [];
        if ($result !== false && $result->num_rows > 0) { // Asegúrate de que $result no sea falso
            while ($item = $result->fetch_assoc()) {
                $cliente = new Cliente();
                $cliente->set('id', $item['id']);
                $cliente->set('nombreCompleto', $item['nombreCompleto']);
                $cliente->set('tipoDocumento', $item['tipoDocumento']);
                $cliente->set('numeroDocumento', $item['numeroDocumento']);
                $cliente->set('email', $item['email']);
                $cliente->set('telefono', $item['telefono']);
                $clientes[] = $cliente;
            }
        }
        $dataBase->close();
        return $clientes;
    }

    function create($cliente)
    {
        $sql = "INSERT INTO clientes (nombreCompleto, tipoDocumento, numeroDocumento, email, telefono) VALUES (";
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

    function verificarCliente($numeroDocumento)
    {
        $dataBase = new DataBaseController();
        $sql = "SELECT * FROM clientes WHERE numeroDocumento = '".$numeroDocumento."'";
        $result = $dataBase->execSql($sql);
        $clienteExistente = false;
        if ($result !== false && $result->num_rows > 0) {
            $clienteExistente = true;
        }
        $dataBase->close();
        return $clienteExistente;
    }

    function registrarCliente($nombreCompleto, $tipoDocumento, $numeroDocumento, $email, $telefono)
    {
        $sql = "INSERT INTO clientes (nombreCompleto, tipoDocumento, numeroDocumento, email, telefono) VALUES (";
        $sql .= "'".$nombreCompleto."',";
        $sql .= "'".$tipoDocumento."',";
        $sql .= "'".$numeroDocumento."',";
        $sql .= "'".$email."',";
        $sql .= "'".$telefono."'";
        $sql .= ")";
        $dataBase = new DataBaseController();
        $result = $dataBase->execSql($sql);
        $dataBase->close();
        return $result;
    }
}

    function update()
    {
    }

    function delete()
    {
    }

?>

