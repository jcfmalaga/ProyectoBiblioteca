<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/estilos.css">
        <title>Biblioteca</title>
    </head>
    <body>
        <?php
        if (isset($_REQUEST['registro'])){
            header("location: registro.php");
        }
        if (isset($_REQUEST["Ingresar"])){
            $usuario=$_POST['usuario'];
            $clave=$_POST['contrasena'];

            //Conectamos con la base de datos
            $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca");
            if (!$conexion){
                echo "Error al conectar a la base de datos";
            }else{
                $consulta="SELECT * FROM login WHERE user='$usuario' AND passwd='$clave'";
                $resultado=mysqli_query($conexion, $consulta);
                $filas=mysqli_num_rows($resultado);
                if ($filas>0){
                    header("location: biblioteca.html");
                } else {
                    echo "<script>";
                    echo "if(confirm('Usuario o contraseña errónea'));";
                    echo "window.location='index.php'";
                    echo "</script>";
                }
                mysqli_free_result($resultado);
                mysqli_close($conexion);
            }
        }else{
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <h2>Login</h2>
                <input name="usuario" type="text" placeholder="&#128272; Usuario">
                <input name="contrasena" type="password" placeholder="&#128272; Contraseña">
                <input type="submit" value="Ingresar" name="Ingresar">
                <input type="submit" value="Registrar" name="registro">
            </form>
            <?php
        }
        ?>
    </body>
</html>
