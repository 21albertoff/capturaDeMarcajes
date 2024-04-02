<?php
$nombreUsuario = "";
require_once('controllers/functions.php');
if(isset($_POST['consultarMarcajes'])){
    $dniUsuario = $_POST['dni'];
    $codigoUsuario = $_POST['codigo'];

    if(comprobarUsuario($conn, $dniUsuario, $codigoUsuario)){
        $idUsuario = obtenerTarjetaUsuario($conn, $dniUsuario, $codigoUsuario);
        $fecha = date("d/m/Y");
        $hora = date("His");
        $cercoID = obtenerCercoID($conn)+1;
        $nombreUsuario = obtenerDatosUsuarios($conn, $dniUsuario, $codigoUsuario) ?? '';
        if(true){ 
            
            $marcajes = obtenerMarcajes($conn, $idUsuario) ?? null;
         
        }
   
    } else { ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>ADVERTENCIA</strong> No se encontro ningun trabajador con estos datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
}
?>