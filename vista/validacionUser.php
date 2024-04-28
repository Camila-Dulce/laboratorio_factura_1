<?php
require_once '../controllers/controladorUser.php';
require_once 'index.php'; 

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$controladorUser = new \App\controllers\controladorUser();
if ($controladorUser->validarUsuario($usuario, $password)) {
    echo "<div class='mensaje-valido'>Usuario validado correctamente</div>";
} else {
    echo "<div class='mensaje-invalido'>Usuario o contraseña incorrectos</div>";
}


$controladorUser->close();
?>

