<?php
include("lib/conexion.php");
include("lib/mysql2json.php");

switch($_POST["opcion"])

{

//buscar pizzas
	case 1:
	$res = ("SELECT * FROM `productos` WHERE tipo_producto=1");

	echo get_Data_SQL ($res, array() ,$mysqli);
	break;

//buscar bebidas
	case 2:
	$res = ("SELECT * FROM `productos` WHERE tipo_producto=2");

	echo get_Data_SQL ($res, array() ,$mysqli);
	break;

//buscar postre
	case 3:
	$res = ("SELECT * FROM `productos` WHERE tipo_producto=3");

	echo get_Data_SQL ($res, array() ,$mysqli);
	break;

}

?>