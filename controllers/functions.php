<?php 
require_once('config/database.php');



function obtenerFichajes($conexion, $id_usuario) {
    $query = "SELECT TOP 10 Fecha, Hora FROM MPRE WHERE Trabajador = ? ORDER BY fecha DESC";
    $stmt = $conexion->prepare($query);
    $stmt->execute(array($id_usuario));
    $fichajes = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $fichajes[] = $row;
    }
    return $fichajes;
}

function comprobarUsuario($conexion, $dni_usuario, $codigo_usuario) {
    $query = "SELECT Nombre FROM TCP WHERE dni = ? AND Tarjeta = ?";
    $stmt = $conexion->prepare($query);
    
	try{
		$stmt->execute(array($dni_usuario, $codigo_usuario));
   	 	$result = $stmt->fetch(PDO::FETCH_ASSOC);
    	if ($result) {
        	return true; 
		}
	} catch (\Throwable $th) {
		return false;
	}
}

function obtenerDatosUsuarios($conexion, $dni_usuario, $codigo_usuario) {
    $query = "SELECT Nombre FROM TCP WHERE dni = ? AND Tarjeta = ?";
    $stmt = $conexion->prepare($query);
    
	try {
		$stmt->execute(array($dni_usuario, $codigo_usuario));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
			return $result['Nombre'];
		}
	} catch (\Throwable $th) {
		return null;
	}
}


function obtenerTarjetaUsuario($conexion, $dni_usuario, $codigo_usuario) {
    $query = "SELECT Codigo FROM TCP WHERE dni = ? AND Tarjeta = ?";
    $stmt = $conexion->prepare($query);
    
	try {
		$stmt->execute(array($dni_usuario, $codigo_usuario));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
			return $result['Codigo'];
		}
	} catch (\Throwable $th) {
		return null;
	}
}

function obtenerCercoID($conexion) {
    $query = "SELECT TOP 1 cercoid FROM MPRE order by cercoID desc";
    $stmt = $conexion->prepare($query);

    try {
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['cercoid'];
    } catch (\Throwable $th) {
        return false;
    }
}


function agregarMarcaje($conexion, $id_usuario, $fecha, $hora, $cercoid) {
    $query = "INSERT INTO MPRE (Trabajador, Fecha, Hora, TarjetaActividad, Actividad, FechaSys, HoraSys, NumLector, ID_DispositivoERP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    try {
        $stmt->execute(array($id_usuario, $fecha, $hora, "9999998","CP",$fecha, $hora, 2, 0));
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function obtenerMarcajes($conexion, $id_usuario){
    $query = "SELECT TOP 10 Fecha, Hora FROM MPRE WHERE Trabajador LIKE ? ORDER BY Fecha DESC, Hora DESC";
    $stmt = $conexion->prepare($query);
    try {
        $stmt->execute(array($id_usuario));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambiamos fetch por fetchAll
        return $result;
    } catch (\Throwable $th) {
        return false;
    }
}

  
  
  
  
  
  
