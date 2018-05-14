<?php
// AL INCLUIR ESTE FICHERO, TRAS SU EJECUCIÓN, SE DISPONE DEL OBJETO
// GLOBAL '$mysqli' QUE CONTIENE LA CONEXIÓN CON EL SERVIDOR DE 'MySQL'
// EN MODO 'mysqli' (extensión mejorada de mysql).


// 1- Conexión (la base de datos 'cdcol' viene de ejemplo con XAMPP)

$mysqli = new mysqli("tads.hopto.org/phpmyadmin", "root", "somos5_tads", "pizzeria");

//$mysqli = new mysqli("localhost", "root", "somos5_tads", "pizzeria");

// 2- Verificar si se ha producido o no la conexión
if (mysqli_connect_errno())
{
    printf("<hr>Connect failed (Err. nº %d): %s<hr/>", mysqli_connect_errno(), mysqli_connect_error());
    exit();
}

// 3- Establecimiento del formato de codificación de caracteres UTF-8
if(!$mysqli->set_charset("utf8"))
{
	printf("<hr>Error loading character set utf8 (Err. nº %d): %s\n<hr/>", $mysqli->errno, $mysqli->error);
	exit();
}

// 4- Asignar a variables los nombres de las tablas de la base de datos (opcional)
// recomendable por si la aplicación se ha de migrar a otro servidor donde las tablas
// de la base de datos tengan nombres distintos (p.e.: “Usuarios” → “BD1_users”)

// la base de datos 'cdcol' tiene una única tabla de nombre 'cds'
// $tb_cds="“usuarios”";















?>
