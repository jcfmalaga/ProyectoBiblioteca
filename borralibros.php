<?php    
                    $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca"); //Conectamos con la base de datos
                    $consulta="SELECT * FROM libros"; //Seleccionamos todos los registros de la tabla libros
                    $resultado=mysqli_query($conexion, $consulta); //Ejecutamos la consulta
                    $table = "<table border='1' cellpadding='10'>\n"; //Creamos el encabezado de la tabla
                    $table .= "<tr><th>Código</th><th>Título</th><th>Autor</th><th>Género</th><th>Presado</th><th></th></tr>";
                    while ($fila = mysqli_fetch_assoc($resultado)){ //Y recorremos todos los registros seleccionados y con un botón oculto para enviar el id del libro
                        $table .= "<tr>
                        <td>".$fila['idlibro']."</td>
                        <td>".$fila['titulo']."</td> 
                        <td>".$fila['autor']."</td>
                        <td>".$fila['genero']."</td>
                        <td>".$fila['prestado']."</td>
                        <td><form method='post' action=''>\n
                        <input type = 'hidden' name='idlibro' value='".$fila["idlibro"]."'>
                        <input type = 'submit' value = 'Eliminar'>
                        </form></td>
                        </tr>\n";   
                    }
                    $table .="</table>\n"; //cerramos la tabla
                    if (isset($_POST['idlibro'])){ //Cuando se pulsa el boton
                        $borralibro=$_POST['idlibro']; //asignamos el id a una variable
                        $consulta = "DELETE FROM libros WHERE idlibro = $borralibro"; //Damos de baja el libro en la tabla libros
                        mysqli_query($conexion, $consulta);
                        $consulta = "DELETE FROM prestamos WHERE idlibro = $borralibro"; //Y damos de baja todos los registros de alquiler de este libro
                        mysqli_query($conexion, $consulta);
                        echo "<script>";  //Mensaje que se ha hecho con éxito
                        echo "if(confirm('Baja realiza con éxito'));";
                        echo "window.location='biblioteca.html'";
                        echo "</script>";
                    }
                    
            ?>
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
            echo $table;
            ?>
        </figure>
    </section>
    <footer>
        <h3>Ejercicio de IAW unidad 6 (Juan Carlos Fuentes)</h3>
    </footer>
</body>
</html>