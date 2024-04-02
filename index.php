<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Marcaje de entrada y salida con huella dactilar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

<header>
    <div class="px-3 py-2 bg-dark text-white">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
              <img src="assets/images/logo.png" alt="logo" height="45">
          </a>
        </div>
      </div>
    </div>
  </header>

	<div class="container mt-5">

    <h1><div id="clock" style="text-align:center; font-size: 50px;"></div></h1>


    <!-- Formulario para capturar la huella dactilar -->
		<div class="card mt-5">
			<div class="card-header">Captura de marcaje</div>
			<div class="card-body">
            <form action="index.php" method="POST">
            <div class="form-group mt-2">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>
            <div class="form-group mt-2">
                <label for="codigo">Codigo</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="d-grid mt-2">
                <button type="submit" class="btn btn-danger" name="realizarMarcaje">Realizar marcaje</button>

            </div>
            <div class="d-grid mt-2">

            <button type="submit" class="btn btn-dark" name="consultarMarcajes">Consultar marcajes</button>
            </div>

        </form>
			</div>
		</div>

        <div class="mt-5">
            <?php require_once('models/comprobarMarcaje.php'); ?>
        </div>

        <div class="mt-5">
            <?php require_once('models/consultarMarcajes.php'); ?>
        </div>

		<!-- Tabla para mostrar los registros de entrada y salida -->
		<div class="card mt-5">
			<div class="card-header">Registros de entrada y salida: <b><?=$nombreUsuario?></b></div>
			<div class="card-body">
				<div id="records-table" class="table-responsive">
                    <?php
                        if (!empty($marcajes)){
                            echo '<table class="table">';
                            echo '<thead><tr><th>Fecha</th><th>Hora</th></tr></thead>';
                            echo '<tbody>';
                            foreach ($marcajes as $fila) {
                                $fecha = $fila["Fecha"];
                                $tiempo = $fila["Hora"];
                                $tamaño = strlen($tiempo);
                                if ($tamaño == 5) {
                                    $hora = substr($tiempo, 0, 1);
                                } else {
                                    $hora = substr($tiempo, 0, 2);
                                }
                                $minutos = substr($tiempo, 2, 2);
                                $segundos = substr($tiempo, 4, 2);
                                $hora_formateada = sprintf("%02d:%02d:%02d", $hora, $minutos, $segundos);
                                $objeto_fecha = DateTime::createFromFormat('Y-m-d H:i:s', $fecha);
                                $fecha_formateada = date('d/m/Y', $objeto_fecha->getTimestamp());
                                echo "<tr><td>$fecha_formateada</td><td>$hora_formateada</td></tr>";
                            }   
                            echo '</tbody></table>';
                        } else {
                            echo "No existe ningun marcaje";
                        } 
                    ?>
                </div>
			</div>
		</div>
	</div>

	


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            
            // Agrega un cero delante de los números menores a 10
            hours = (hours < 10 ? "0" : "") + hours;
            minutes = (minutes < 10 ? "0" : "") + minutes;
            seconds = (seconds < 10 ? "0" : "") + seconds;
            
            // Formatea la hora en formato HH:MM:SS
            var time = hours + ":" + minutes + ":" + seconds;
            
            // Actualiza el reloj en la página
            document.getElementById("clock").innerHTML = time;
        }

        // Ejecuta la función cada segundo
        setInterval(updateClock, 1000);
    </script>
</body>
</html>
