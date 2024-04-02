<?php
$nombreUsuario = "";
require_once('controllers/functions.php');
if(isset($_POST['realizarMarcaje'])){
    $dniUsuario = $_POST['dni'];
    $codigoUsuario = $_POST['codigo'];

    if(comprobarUsuario($conn, $dniUsuario, $codigoUsuario)){
        $idUsuario = obtenerTarjetaUsuario($conn, $dniUsuario, $codigoUsuario);
        $fecha = date("d/m/Y");
        $hora = date("His");
        $cercoID = obtenerCercoID($conn)+1;
        $nombreUsuario = obtenerDatosUsuarios($conn, $dniUsuario, $codigoUsuario) ?? '';
        if(agregarMarcaje($conn, $idUsuario, $fecha, $hora, $cercoID)){ 
            ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>EXITO</strong> El marcaje se realizo correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>ERROR</strong> Ha ocurrido algun error al realizar el marcaje, intente de nuevo mas tarde.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php     
    }
    $marcajes = obtenerMarcajes($conn, $idUsuario) ?? null;
    } else { ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>ADVERTENCIA</strong> No se encontro ningun trabajador con estos datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
}
?>