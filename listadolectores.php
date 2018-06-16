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
                $consulta="SELECT * FROM lectores"; //Seleccionamos los registros
                $resultado=mysqli_query($conexion, $consulta);
                $table = "<table border='1' cellpadding='10'>\n";
                $table .= "<tr><th>Socio</th><th>Nombre</th><th>DNI</th><th>Dirección</th><th>Teléfono</th></tr>";
                while ($fila = mysqli_fetch_assoc($resultado)){
                    $table .= "<tr>
                    <td>".$fila['idlector']."</td>
                    <td>".$fila['nombre']."</td>
                    <td>".$fila['dni']."</td>
                    <td>".$fila['direccion']."</td>
                    <td>".$fila['telefono']."</td>
                    </tr>\n";
                }
                $table .="</table>\n";
                echo $table;
            ?>
        </figure>
    </section>
    <footer>
        <h3>Ejercicio de IAW unidad 6 (Juan Carlos Fuentes)</h3>
    </footer>
</body>
</html>