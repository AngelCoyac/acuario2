
<?php
include 'conexion.php'; 

class OpcionesFormulario {
    private $conn;

    public function __construct() {
        $this->conn = new Conexion(); 
    }

    public function obtenerOpcionesAreas() {
        $sql = "SELECT pk_area, nombre FROM area";
        $result = $this->conn->query($sql);
        $opciones = "";

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opciones .= "<option value='" . $row['pk_area'] . "'>" . $row['nombre'] . "</option>";
            }
        } else {
            $opciones = "<option value=''>No se encontraron áreas</option>";
        }

        return $opciones;
    }

    public function obtenerOpcionesRoles() {
        $sql = "SELECT pk_roles, roles FROM roles";
        $result = $this->conn->query($sql);
        $opciones = "";

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opciones .= "<option value='" . $row['pk_roles'] . "'>" . $row['roles'] . "</option>";
            }
        } else {
            $opciones = "<option value=''>No se encontraron roles</option>";
        }

        return $opciones;
    }
    public function obtenerOpcionesEspecies() {
        $sql = "SELECT pk_especie, nombre FROM especie";
        $result = $this->conn->query($sql);
        $opciones = "";

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opciones .= "<option value='" . $row['pk_especie'] . "'>" . $row['nombre'] . "</option>";
            }
        } else {
            $opciones = "<option value=''>No se encontraron especies</option>";
        }

        return $opciones;
    }
}

class ValidarUsuario {
    private $conn;
  
    public function registrar($nombres, $apaterno, $amaterno, $fk_area, 
    $fecha_nac, $genero, $direccion, $correo, $num_telefono, $contrasena, $fk_roles) {
    
    
    $query = "SELECT * FROM persona WHERE correo = '$correo'";
    $result = $this->conn->query($query);

    if ($result && $result->num_rows > 0) {
        return false; 
    }

   
    $sql = "INSERT INTO persona (nombre, apaterno, amaterno, correo, 
            fecha_nac, telefono, genero, direccion, contrasena, fk_roles, fk_area) 
            VALUES ('$nombres', '$apaterno', '$amaterno', '$correo', 
            '$fecha_nac', '$num_telefono', '$genero', '$direccion', 
            '$contrasena', '$fk_roles', $fk_area)";

    if ($this->conn->query($sql)) {
        return true; 
    } else {
        return false; 
    }
}


    public function validarLogin($correo, $contrasena) {
        $query = "SELECT * FROM persona WHERE correo = '$correo' AND contrasena = '$contrasena'";
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); 
        }
        return false; 
    }
   
    
}
class Tanque {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();  // Crea una instancia de la clase Conexion
        $this->conn = $conexion->conn;  // Obtiene la conexión
    }

    public function registrar_tanque($capacidad, $temperatura, $iluminacion, $filtracion, $fk_area, $fk_especie, $fecha) {
        if (empty($capacidad) || empty($temperatura) || empty($iluminacion) || empty($filtracion) || empty($fk_area) || empty($fk_especie) || empty($fecha)) {
            return false; 
        }
    
        // Crear la consulta SQL (asegúrate de que los nombres sean correctos)
        $sql = "INSERT INTO tanque (capacidad, temperatura, iluminacion, filtracion, fk_area, fk_especie, fecha) 
                VALUES ('$capacidad', '$temperatura', '$iluminacion', '$filtracion', '$fk_area', '$fk_especie', '$fecha')";
    
        // Ejecutar la consulta
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return "Error en la consulta: " . $this->conn->error;
        }
    }
    
}

?>

