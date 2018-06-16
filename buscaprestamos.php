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
                $dnilector=$_POST['dnilector'];  //Asignamos el valor del formulario a las variables    
                $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca"); //Conectamos con la base de datos
                $consulta="SELECT idlector, nombre FROM lectores WHERE dni = '$dnilector'"; //Seleccionamos el idlector y nombre buscando el dni introducido
                $resultado=mysqli_query($conexion, $consulta); //Ejecutamos la consulta
                $filas=mysqli_num_rows($resultado); //Introducimos en una variable el resultado de la búsqueda
                if ($filas>0){ //Si existe  entramos en el if

                    $usuario = mysqli_fetch_row($resultado); //almacenamos el contenido del array devuelto en la variable
                    $consulta="SELECT * FROM prestamos WHERE idlector = $usuario[0]"; //Seleccionamos todos los datos de la tabla prestamos de es idlector
                    $resultado=mysqli_query($conexion, $consulta);
                    $filas=mysqli_num_rows($resultado); //Introducimos en una variable el resultado de la búsqueda
                    if ($filas>0){ //Si existe  entramos en el if*/
                        echo "<br>";
                        $table = "<table border='1' cellpadding='10'>\n";
                        $table .= "<tr ><th colspan=3>Libros de prestados a: $usuario[1]</th></tr>";
                        $table .= "<tr><th>Título</th><th>Autor</th><th>Género</th></tr>";
                        while ($fila = mysqli_fetch_array($resultado)){
                            $consulta2 ="SELECT * FROM libros WHERE idlibro = $fila[2]"; //Ahora para cada registro seleccionamos los datos del libro para mostrarlos en la tabla
                            $resultado2 = mysqli_query($conexion, $consulta2);
                            $libroarray=mysqli_fetch_array($resultado2);
                            $table .= "<tr>
                            <td>".$libroarray[1]."</td>
                            <td>".$libroarray[2]."</td>
                            <td>".$libroarray[3]."</td>
                            </tr>\n";
                        }
                        $table .="</table>\n";
                        echo $table;
                    } else { // Y si no hay datos en la tabla présamos de ese lector lo comunicamos
                        echo "<script>";
                        echo "if(confirm('Ese lector no tiene ningún préstamo'));";
                        echo "window.location='biblioteca.html'";
                        echo "</script>";
                    }
                } else { // Y si no existe el dni avisamos que no existe ningun lector con ese dni
                    echo "<script>";
                    echo "if(confirm('No existe ningún lector con ese dni'));";
                    echo "window.location='biblioteca.html'";
                    echo "</script>";
                }
            } else {
                ?>
                <br><br>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <fieldset>
                        <legend><h4>Busquedas de préstamos</h4></legend>
                            <label for="dnilector">Introduce el dni del lector  </label> 
                                <input type="text" name="dnilector" required>
                            <br><br>
                            
                            <br><br>
                            <input type="submit" name ="submit" value=" Consulta ">
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