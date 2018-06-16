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
            if (isset($_REQUEST["submit"])) { //Cuando se pulsa botón formulario se asigna valores a las variables
                $nombre=$_POST['nombre'];
                $dni=$_POST['dni'];
                $direccion=$_POST['direccion'];
                $telefono=$_POST['telefono'];
                $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca"); //Conectamos con la base de datos e insertamos el registro
                $consulta="SELECT dni FROM lectores WHERE dni = '$dni'"; // seleccionamos si el dni ya existe
                $resultado=mysqli_query($conexion, $consulta);
                $filas=mysqli_num_rows($resultado); //Asignamos el resultado de la consulta a una variable
                if ($filas>0){ //si existe sacamos un mensaje de que ya existe
                    echo "<script>";
                    echo "if(confirm('Ese DNI ya pertenece a algún socio'));";
                    echo "window.location='biblioteca.html'";
                    echo "</script>";
                } else {
                    $consulta="INSERT INTO lectores (nombre, dni, direccion, telefono) VALUES ('$nombre','$dni','$direccion', '$telefono')";
                    mysqli_query($conexion, $consulta); //insertamos el registro en la tabla
                    echo "<h3>Alta del lector realizada correctamente</h3>";
                    header("Refresh: 3; url = biblioteca.html");
                }
            } else {
                ?>
                <br><br>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <fieldset>
                        <legend><h4>Alta de Lectores</h4></legend>
                            <label for="nombre">Nombre    
                                <input type="text" name="nombre" required>
                            </label><br><br>
                            <label for="dni">DNI    
                                <input type="text" name="dni">
                            </label><br><br>
                            <label for="direccion">Dirección
                                <input type="text" name="direccion">
                            </label><br><br>
                            <label for="telefono">Teléfono
                                <input type="number" name="telefono" required min=100000000>
                            </label><br><br>
                            <input type="submit" name ="submit" value="Alta">
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