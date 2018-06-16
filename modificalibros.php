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
                $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca"); //Conectamos con la base de datos
                $consulta="SELECT * FROM libros"; //Seleccionamos todos los registros
                $resultado=mysqli_query($conexion, $consulta);
                $table = "<table border='1' cellpadding='10'>\n"; //Creamos el encabezado de la tabla
                $table .= "<tr><th>Código</th><th>Título</th><th>Autor</th><th>Género</th><th>Presado</th><th></th></tr>";
                while ($fila = mysqli_fetch_assoc($resultado)){ //recorremos todos los registros mostraándolos y con un botón oculto para enviar el id del libro
                    $table .= "<form method='post' action=''><tr>
                    <td>".$fila['idlibro']."</td>
                    <td><input type = 'text' name='titulolib' value='".$fila["titulo"]."' ></td>
                    <td><input type = 'text' name='autorlib' value='".$fila["autor"]."'></td>
                    <td><select name = 'generolib' >
                            <option default>".$fila['genero']."</option>
                            <option value='aventura'>AVENTURA</option>
                            <option value='accion'>ACCIÓN</option>
                            <option value='drama'>DRAMA</option>
                            <option value='infantil'>INFANTIL</option>
                            <option value='belico'>BÉLICO</option>
                        </select>
                    </td>
                    <td><input type = 'text' name='prestadolib' value='".$fila["prestado"]."'></td>
                    <td>
                    <input type = 'hidden' name='idlibro' value='".$fila["idlibro"]."'>
                    <input type = 'submit' name='modifica' value = 'Actualizar'>
                    </td></form>
                    </tr>\n";
                }
                $table .="</table>\n";
                echo $table;
                if (isset($_POST['idlibro'])){ //una vez pulsado el botón asignamos valores a las variables
                        $actualizalibro=$_POST['idlibro'];
                        $titulolib = $_POST['titulolib'];
                        $autorlib = $_POST['autorlib'];
                        $generolib = $_POST['generolib'];
                        $prestadolib = $_POST['prestadolib'];
                        $consulta = "UPDATE libros SET titulo = '$titulolib', autor = '$autorlib', genero = '$generolib', prestado = '$prestadolib' WHERE idlibro = $actualizalibro";
                        $resultado = mysqli_query($conexion, $consulta); //Actualizamos los datos en la tabla libros
                        echo "<script>";  
                        echo "if(confirm('Modificación realiza con éxito'));"; //Avisamos que se ha completado con éxito
                        echo "window.location='biblioteca.html'";
                        echo "</script>";
                    }
            ?>
        </figure>
    </section>
    <footer>
        <h3>Ejercicio de IAW unidad 6 (Juan Carlos Fuentes)</h3>
    </footer>
</body>
</html>