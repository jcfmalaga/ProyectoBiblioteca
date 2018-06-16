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
                $buscautor=$_POST['buscautor'];  //Asignamos el valor del formulario a las variables
                $buscagenero=$_POST['buscagenero'];    
                $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca"); //Conectamos con la base de datos
                $consulta="SELECT * FROM libros WHERE autor = '$buscautor' AND genero = '$buscagenero'"; //Consultamos si existe el idlector introducido en el formulario
                $resultado=mysqli_query($conexion, $consulta);
                $filas=mysqli_num_rows($resultado); //Introducimos en una variable el resultado de la búsqueda
                if ($filas>0){ //Si existe  entramos en el if
                    echo "<br>";
                    $table = "<table border='1' cellpadding='10'>\n";
                    $table .= "<tr><th colspan=2>Libros de $buscautor del género: $buscagenero</th></tr>";
                    $table .= "<tr><th>Libro</th><th>Prestado</th></tr>";
                    while ($fila = mysqli_fetch_assoc($resultado)){
                       $table .= "<tr>
                       <td>".$fila['titulo']."</td>
                       <td>".$fila['prestado']."</td>
                       </tr>\n";
                    }
                    $table .="</table>\n";
                    echo $table;
                } else { // Y si no existe el idlector avisamos que no existe ese idlector
                    echo "<script>";
                    echo "if(confirm('Esa busqueda no existe'));";
                    echo "window.location='biblioteca.html'";
                    echo "</script>";
                }
            } else {
                ?>
                <br><br>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <fieldset>
                        <legend><h4>Alta de Préstamos</h4></legend>
                            <label for="buscautor">Introduce el autor  </label> 
                                <input type="text" name="buscautor" required>
                            <br><br>
                            <label for="buscagenero">Selecciona el género</label>
                            <select name="buscagenero">
                                <option value=" " default>--------</option>
                                <option value="aventura">AVENTURA</option>
                                <option value="accion">ACCIÓN</option>
                                <option value="drama">DRAMA</option>
                                <option value="infantil">INFANTIL</option>
                                <option value="belico">BÉLICO</option>
                            </select>
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