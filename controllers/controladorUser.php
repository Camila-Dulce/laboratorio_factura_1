<?php
namespace App\controllers; 

use mysqli;

class controladorUser
{
    private $host = 'localhost';
    private $user = 'root';
    private $pwd = '';
    private $db = 'factura';
    private $conex;

    function __construct()
    {
        $this->conex = new mysqli(
            $this->host,
            $this->user,
            $this->pwd,
            $this->db
        );
    }

    function validarUsuario($usuario, $password)
    {
        $stmt = $this->conex->prepare("SELECT * FROM usuarios WHERE usuario = ? AND pwd = ?");
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return true; // Usuario válido
        } else {
            return false; // Usuario inválido
        }

        $stmt->close();
    }

    function close()
    {
        $this->conex->close();
    }
}
?>
