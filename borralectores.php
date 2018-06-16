<?php    
                    $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca"); //Conectamos con la base de datos
                    $consulta="SELECT * FROM lectores"; //Seleccionamos los registros
                    $resultado=mysqli_query($conexion, $consulta);
                    $table = "<table border='1' cellpadding='10'>\n";
                    $table .= "<tr><th>Código de lector</th><th>Nombre</th><th>DNI</th><th>Dirección</th><th>Teléfono</th><th></th></tr>";
                    while ($fila = mysqli_fetch_assoc($resultado)){
                        $table .= "<tr>
                        <td>".$fila['idlector']."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['dni']."</td>
                        <td>".$fila['direccion']."</td>
                        <td>".$fila['telefono']."</td>
                        <td><form method='post' action=''>\n
                        <input type = 'hidden' name='idlector' value='".$fila["idlector"]."'>
                        <input type = 'submit' value = 'Eliminar'>
                        </form></td>
                        </tr>\n"; 
                    }
                    $table .="</table>\n";
                    if (isset($_POST['idlector'])){
                        $borralector=$_POST['idlector'];
                        $consulta = "DELETE FROM lectores WHERE idlector = $borralector"; //Damos de baja el lector en la tabla
                        $resultado = mysqli_query($conexion, $consulta);
                        $consulta = "DELETE FROM prestamo WHERE idlector = $borralector"; //Y borramos todos los prestamos que tuviese ese lector
                        $resultado = mysqli_query($conexion, $consulta);
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