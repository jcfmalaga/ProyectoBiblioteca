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
                $consulta="SELECT * FROM prestamos"; //Seleccionamos todos los registros
                $resultado=mysqli_query($conexion, $consulta);
                $table = "<table border='1' cellpadding='10'>\n";
                $table .= "<tr><th>Fecha Préstamo</th><th>Nº libro</th><th>Nº lector</th><th>Fecha devolución</th><th></th></tr>";
                while ($fila = mysqli_fetch_assoc($resultado)){
                    $table .= "<form method='post' action=''><tr>
                    <td><input type = 'text' name='fechaprestamo' value='".date('Y-m-d', strtotime($fila['fechaprestamo']))."' ></td>
                    <td><input type = 'text' name='idlibro' value='".$fila["idlibro"]."'></td>
                    <td><input type = 'text' name='idlector' value='".$fila["idlector"]."'></td>
                    <td><input type = 'text' name='fechadevolucion' value='".$fila["fechadevolucion"]."'></td>
                    <td>
                    <input type = 'hidden' name='nroprestamo' value='".$fila["nroprestamo"]."'>
                    <input type = 'submit' name='modifica' value = 'Actualizar'>
                    </td></form>
                    </tr>\n";
                }
                $table .="</table>\n";
                echo $table;
                if (isset($_POST['nroprestamo'])){
                        $nroprestamo=$_POST['nroprestamo'];
                        $fechaprestamo=date("Y-m-d", strtotime($_POST['fechaprestamo'])); //ponemos formato a la fecha para poder insertarlo en la tabla
                        $idlibro = $_POST['idlibro'];
                        $idlector = $_POST['idlector'];
                        $fechadevolucion = date("Y-m-d", strtotime($_POST['fechadevolucion']));
                        $consulta = "UPDATE prestamos SET fechaprestamo='$fechaprestamo', idlibro = $idlibro, idlector = $idlector, fechadevolucion='$fechadevolucion'  WHERE nroprestamo = $nroprestamo";
                        $resultado = mysqli_query($conexion, $consulta); //Actualizamos el registro
                        echo "<script>";  
                        echo "if(confirm('Modificación realiza con éxito'));";
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