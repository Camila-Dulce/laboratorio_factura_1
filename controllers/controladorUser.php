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
            // Usuario válido
            return true;
        } else {
            // Usuario inválido
            return false;
        }

        $stmt->close();
    }

    function close()
    {
        $this->conex->close();
    }
}

// Ahora, fuera de la clase controladorUser, puedes redirigir según el resultado de la validación

$controlador = new controladorUser();

if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario']; 
    $password = $_POST['password']; 

    if ($controlador->validarUsuario($usuario, $password)) {
        // Usuario válido, redirigir a generadorFactura.php
        header("Location: generadorFactura.php");
        exit;
    } else {
        // Usuario inválido, redirigir a una página de error
        header("Location: validacionUser.php");
        exit;
    }
}
?>





