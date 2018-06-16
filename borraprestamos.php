<?php    
                    $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca"); //Conectamos con la base de datos
                    $consulta="SELECT * FROM prestamos"; //Consultamos 
                    $resultado=mysqli_query($conexion, $consulta);
                    $table = "<table border='1' cellpadding='10'>\n";
                    $table .= "<tr><th>Fecha Préstamo</th><th>Nº libro</th><th>Nº lector</th><th>Fecha devolución</th><th></th></tr>";
                    while ($fila = mysqli_fetch_assoc($resultado)){
                        $table .= "<tr>
                        <td>".$fila['fechaprestamo']."</td>
                        <td>".$fila['idlibro']."</td>
                        <td>".$fila['idlector']."</td>
                        <td>".$fila['fechadevolucion']."</td>
                        <td><form method='post' action=''>\n
                        <input type = 'hidden' name='nroprestamo' value='".$fila["nroprestamo"]."'>
                        <input type = 'hidden' name='idlibro' value='".$fila["idlibro"]."'>
                        <input type = 'submit' value = 'Eliminar'>
                        </form></td>
                        </tr>\n";   
                    }
                    $table .="</table>\n";
                    if (isset($_POST['nroprestamo'])){
                        $borraprestamo=$_POST['nroprestamo'];
                        $libro=$_POST['idlibro'];
                        $consulta = "DELETE FROM prestamos WHERE nroprestamo = $borraprestamo"; //Borramos el registro del préstamo
                        mysqli_query($conexion, $consulta);
                        $consulta = "UPDATE libros SET prestado = 'NO' WHERE idlibro = $libro"; //Y ponemos el libro como no prestado
                        mysqli_query($conexion, $consulta);
                        echo "<script>";  
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