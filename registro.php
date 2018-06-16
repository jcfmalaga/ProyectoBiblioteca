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
            
        
            $nombre=$_POST['nombre'];
            $apellidos=$_POST['apellidos'];
            $usuario=$_POST['usuario'];
            $clave=$_POST['contrasena'];
            $clave2=$_POST['contrasena2'];
            $mail=$_POST['email'];
            if ($clave!=$clave2){
                echo "<h2 align='center'>Contraseña incorrecta</h2>";
            } else {
            //Conectamos con la base de datos
            $conexion=mysqli_connect("localhost","root","\$Alumno1718","biblioteca");
            if (!$conexion){
                echo "Error al conectar a la base de datos";
            }else{
                $consulta="INSERT INTO login VALUES ('$usuario', '$clave', now(), '$nombre', '$apellidos', '$mail')";
                $resultado=mysqli_query($conexion, $consulta);
                mysqli_free_result($resultado);
                mysqli_close($conexion);
                header("Location: biblioteca.html");
            }
        }
        }else{
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <h2>Crea una cuenta</h2>
                <div class="inputs">
                    <input name="nombre" type="text" placeholder="Nombre" required>
                    <input name="apellidos" type="text" placeholder="Apellidos" required>
                    <input name="usuario" type="text" placeholder="Usuario" required>
                    <input name="contrasena" type="password" placeholder="Contraseña" required>
                    <input name="contrasena2" type="password" placeholder="Repite la contraseña" required>
                    <input name="email" type="email" placeholder="Email" required>
                    <input type="submit" value="Regístrate" name="registro">
                    <p>¿Ya tienes una cuenta? <a href="index.php">Ingresa aquí</a></p>
                </div>
            </form>
            <?php
        }
        ?>
    </body>
</html>