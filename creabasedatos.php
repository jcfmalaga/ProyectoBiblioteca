<?php
$host = "localhost";           //Variables para crear la conexión.
$user = "root";
$pwd = "\$Alumno1718";
$enlace = mysqli_connect($host, $user, $pwd);           //Creamos la conexión a la BD.
if (!$enlace){
     die("No se pudo realizar la conexión.");           //Se produjo un error y se finaliza la ejecución del script.
}
else{
    $consulta = "create DATABASE biblioteca";
    mysqli_query($enlace, $consulta);           //Creamos la BD.

    mysqli_select_db($enlace, "biblioteca");           //Seleccionamos la BD recién creada.

    //CREAMOS LA TABLA LOGIN QUE CONTENDRÁ LOS USUARIOS QUE PUEDEN LOGUEARSE
    $consulta = "CREATE TABLE login(
          user varchar(20) not null,
          passwd varchar(8) not null,
          fechaRegistro timestamp not null,
          nombre varchar(20) not null,
          apellidos varchar(30),
          email varchar(30))";
    mysqli_query($enlace, $consulta);
    $consulta = "INSERT INTO login VALUES ('carlos', 'carlos', now(), 'Juan Carlos', 'Fuentes Lamas', 'jcfmalaga@gmail.com')";
    mysqli_query($enlace, $consulta);

    //CREAMOS LA TABLA LIBROS
    $consulta = "CREATE TABLE libros (
            idlibro INT NOT NULL AUTO_INCREMENT,
            titulo VARCHAR (30) NOT NULL,
            autor VARCHAR (30) NOT NULL,
            genero VARCHAR (20),
            prestado ENUM('SI','NO'),
            PRIMARY KEY (idlibro))";
    mysqli_query($enlace, $consulta);

    //CREAMOS LA TABLA LECTORES
    $consulta = "CREATE TABLE lectores (
        idlector INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR (30) NOT NULL,
        dni VARCHAR (10),
        direccion VARCHAR (30),
        telefono VARCHAR (15) NOT NULL,
        PRIMARY KEY (idlector))";
    mysqli_query($enlace, $consulta);

    //CREAMOS LA TABLA PRESTAMOS
    $consulta = "CREATE TABLE prestamos (
        nroprestamo INT NOT NULL AUTO_INCREMENT,
        fechaprestamo TIMESTAMP,
        idlibro INT NOT NULL,
        idlector INT NOT NULL,
        fechadevolucion DATE,
        PRIMARY KEY (nroprestamo))";
    mysqli_query($enlace, $consulta);

    //CREAMOS LAS CLAVES FORANEAS
    $consulta = "ALTER TABLE prestamos ADD FOREIGN KEY (idlibro) REFERENCES libros (idlibro) ON DELETE CASCADE ON UPDATE NO ACTION";
    mysqli_query($enlace, $consulta);
    $consulta = "ALTER TABLE prestamos ADD FOREIGN KEY (idlector) REFERENCES lectores (idlector) ON DELETE CASCADE ON UPDATE NO ACTION";
    mysqli_query($enlace, $consulta);

    echo "Base de datos creada con éxito, cerrando la conexión con la base de datos";

mysqli_close($enlace);           //Cerramos la conexión al SGBD
}
?>