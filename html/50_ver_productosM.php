<?php

include("lib/conexion.php");
include("lib/mysql2json.php");

switch($_POST["opcion"])
{

//mostrar ultimos productos registrados
	case 1:
		$res=("SELECT nombre, lista_ingredientes, precio, disponible, tipo_nombre  FROM productos, tipo_producto WHERE productos.tipo_producto=tipo_producto.id");

		echo get_Data_SQL ($res, array() ,$mysqli);
		break;

//mostrar productos de la búsqueda
	case 2:
		$busqueda=$_POST["busqueda"];
		$res=("SELECT nombre, lista_ingredientes, precio, disponible, tipo_nombre  FROM productos, tipo_producto WHERE productos.tipo_producto=tipo_producto.id AND (nombre LIKE '%$busqueda%' OR lista_ingredientes LIKE '%$busqueda%' OR tipo_nombre LIKE '%$busqueda%')");

		echo get_Data_SQL ($res, array() ,$mysqli);
		break;
}