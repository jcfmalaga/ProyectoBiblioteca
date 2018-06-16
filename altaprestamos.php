<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Biblioteca EL BAÚL</title>
<link rel="stylesheet" href="css/biblioteca.css">	
</head>
<body>
    <header>
        <h4>BIENVENIDO A LA PÁGINA WEB OFICIAL DE LA</h4>
        <img src="Media/ejemplo-logotipo.gif" width="189" height="57" alt="logo"  /> 
    </header>
    <section>
        <nav class="menu">
            <ul>
                <li><a href="biblioteca.html">Inicio</a></li>
            </ul>
        </nav>
        <figure>
            <?php
            if (isset($_REQUEST["submit"])) {  //Si se pulsa el botón de alta entramos aquí
                $idlector=$_POST['idlector'];  //Asignamos el valor del formulario a las variables
                $idlibro=$_POST['idlibro'];    
                $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca"); //Conectamos con la base de datos
                $consulta="SELECT idlector FROM lectores WHERE idlector = '$idlector'"; //Consultamos si existe el idlector introducido en el formulario
                $resultado=mysqli_query($conexion, $consulta);
                $filas=mysqli_num_rows($resultado); //Introducimos en una variable el resultado de la búsqueda
                if ($filas>0){ //Si existe  entramos en el if
                    $consulta="SELECT idlibro FROM libros WHERE idlibro = '$idlibro'"; // Y consulamos si existe el idlibro introducido en el formulario
                    $resultado=mysqli_query($conexion, $consulta); 
                    $filas=mysqli_num_rows($resultado); //Introducimos en una variable el resultado de la búsqueda
                    if ($filas>0){ //Si existe entramos en el if e introducimos los datos en la tabla de préstamos
                        ini_set('date.timezone','Europe/Madrid');  //Iniciamos la hora de nuestro país
                        $fecha_actual = date("Y-m-d"); //Introducimos la fecha actual en una variable
                        $fecha_devolucion = date("Y-m-d", strtotime($fecha_actual."+ 15 days")); // Y le sumamos 15 días que dura el préstamo
                        $consulta="INSERT INTO prestamos ( fechaprestamo, idlibro, idlector, fechadevolucion) VALUES ('$fecha_actual', $idlibro, $idlector, '$fecha_devolucion' )";
                        mysqli_query($conexion, $consulta);
                        $consulta="UPDATE libros SET prestado = 'SI' WHERE idlibro = $idlibro"; //Actualizamos el estado del prestamo del libro de la tabla libros
                        mysqli_query($conexion, $consulta);
                        echo "<br><h3>Alquiler realizado correctamente</h3>"; //Avisamos de que se ha realizado el préstamo correctamente
                        echo "<h3>Fecha de préstamo: $fecha_actual</h3>"; //Avisamos de cuando empieza y acaba el préstamo
                        echo "<h3>Fecha de devolución: $fecha_devolucion</h3>";
                        header("Refresh: 3; url = biblioteca.html"); //Redirigimos al inicio
                    } else { // Si no existe el idlibro avisamos que ese libro no existe
                        echo "<script>";  
                        echo "if(confirm('Ese libro no existe'));";
                        echo "window.location='biblioteca.html'";
                        echo "</script>";
                    }
                } else { // Y si no existe el idlector avisamos que no existe ese idlector
                    echo "<script>";
                    echo "if(confirm('Ese lector no existe'));";
                    echo "window.location='biblioteca.html'";
                    echo "</script>";
                }
            } else {
                ?>
                <br><br>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <fieldset>
                        <legend><h4>Alta de Préstamos</h4></legend>
                            <label for="idlector">Número de Lector  </label> 
                                <input type="number" name="idlector" min=1 pattern="[0-9]" required>
                            <br><br>
                            <label for="dni">Código del libro  </label> 
                                <input type="number" name="idlibro" min=1 pattern="[0-9]" required>
                            <br><br>
                            <input type="submit" name ="submit" value=" Alta Préstamo ">
                    </fieldset>
                </form>
                <?php
            }
            ?>
        </figure>
    </section>
    <footer>
        <h3>Ejercicio de IAW unidad 6 (Juan Carlos Fuentes)</h3>
    </footer>
</body>
</html>