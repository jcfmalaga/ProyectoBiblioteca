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
                $consulta="SELECT * FROM lectores"; //Seleccionamos todos los registros
                $resultado=mysqli_query($conexion, $consulta);
                $table = "<table border='1' cellpadding='10'>\n";
                $table .= "<tr><th>Socio</th><th>Nombre</th><th>Dni</th><th>Dirección</th><th>Teléfono</th><th></th></tr>";
                while ($fila = mysqli_fetch_assoc($resultado)){
                    $table .= "<form method='post' action=''><tr>
                    <td>".$fila['idlector']."</td>
                    <td><input type = 'text' name='nombrelec' value='".$fila["nombre"]."' ></td>
                    <td><input type = 'text' name='dnilec' value='".$fila["dni"]."'></td>
                    <td><input type = 'text' name='direccionlec' value='".$fila["direccion"]."'></td>
                    <td><input type = 'text' name='telefonolec' value='".$fila["telefono"]."'></td>
                    <td>
                    <input type = 'hidden' name='idlector' value='".$fila["idlector"]."'>
                    <input type = 'submit' name='modifica' value = 'Actualizar'>
                    </td></form>
                    </tr>\n";
                }
                $table .="</table>\n";
                echo $table;
                if (isset($_POST['idlector'])){ //Cuando pulsamos botón asignamos valor a las variables
                        $actualizalector=$_POST['idlector'];
                        $nombrelec = $_POST['nombrelec'];
                        $dnilec = $_POST['dnilec'];
                        $direccionlec = $_POST['direccionlec'];
                        $telefonolec = $_POST['telefonolec'];
                        $consulta = "UPDATE lectores SET nombre = '$nombrelec', dni = '$dnilec', direccion = '$direccionlec', telefono = '$telefonolec' WHERE idlector = $actualizalector";
                        $resultado = mysqli_query($conexion, $consulta); //modificamos el registro
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