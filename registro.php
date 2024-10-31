<?php
include 'class/clases.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apaterno = $_POST['apaterno'];
    $amaterno = $_POST['amaterno'];
    $fk_area = $_POST['fk_area'];
    $fecha_nac = $_POST['fecha_nac'];
    $genero = $_POST['genero'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];
    $pk_roles = $_POST['roles'];

    $usuario = new ValidarUsuario();
    $registroExitoso = $usuario->registrar($nombre, $apaterno, $amaterno, $fk_area, 
        $fecha_nac, $genero, $direccion, $correo, $telefono, $contrasena, $pk_roles);

    if ($registroExitoso) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>
