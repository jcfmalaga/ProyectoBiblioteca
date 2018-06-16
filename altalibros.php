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
            if (isset($_REQUEST["submit"])) {
                $titulo=$_POST['titulo'];//Asignamos los valores del formulario a las variables
                $autor=$_POST['autor'];
                $genero=$_POST['genero'];
                if ($genero == " "){ //Si no se ha seleccionado ningún género sacamos aviso y redirigimos
                    echo "<h3> Debes elegir el género que más se aproxime al libro </h3>";
                    header("Refresh: 3; url = altalibros.php");
                } else {
                    $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca"); // Conectamos con la base de datos
                    $consulta="SELECT titulo FROM libros WHERE titulo = '$titulo'"; // seleccionamos si el libro existe
                    $resultado=mysqli_query($conexion, $consulta);
                    $filas=mysqli_num_rows($resultado); //Asignamos el resultado de la consulta a una variable
                    if ($filas>0){ //si existe sacamos un mensaje de que ya existe
                        echo "<script>";
                        echo "if(confirm('Ese libro ya existe'));";
                        echo "window.location='biblioteca.html'";
                        echo "</script>";
                    } else { //Si no existe insertamos los datos en la base de datos
                        $consulta="INSERT INTO libros (titulo, autor, genero, prestado) VALUES ('$titulo','$autor','$genero', 'NO')";
                        mysqli_query($conexion, $consulta);
                        echo "<h3>Alta de libro realizada correctamente</h3>";  //Sacamos mensaje todo correcto
                        header("Refresh: 3; url = biblioteca.html"); // Redirigimos
                    }
                }
            } else {
                ?>
                <br><br>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <fieldset>
                        <legend><h4>Alta de libros</h4></legend>
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" required>
                            <br><br>
                            <label for="autor">Autor</label>
                            <input type="text" name="autor" required>
                            <br><br>
                            <label for="genero">Género</label>
                            <select name="genero">
                                <option value=" " default>--------</option>
                                <option value="aventura">AVENTURA</option>
                                <option value="accion">ACCIÓN</option>
                                <option value="drama">DRAMA</option>
                                <option value="infantil">INFANTIL</option>
                                <option value="belico">BÉLICO</option>
                            </select>
                            <br><br>
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