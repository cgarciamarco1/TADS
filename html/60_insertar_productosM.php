<?php

include("lib/conexion.php");
include("lib/mysql2json.php");

switch($_POST["opcion"])

{

	//buscar tipos de productos para cargar el select de insertar productos
	case 1:
		$res_tipo = ("SELECT id, tipo_nombre FROM tipo_producto");

		echo get_Data_SQL ($res_tipo, array() ,$mysqli);
		break;

	//insertar productos en bd
	case 2:
		$nombre=$_POST["nombre"];
		$ingredientes =$_POST["ingredientes"];
		$tipo_producto=$_POST["tipo_producto"];
		$precio=$_POST["precio"];
		$disponible=$_POST["disponible"];

		$SQL="INSERT INTO productos  (nombre, lista_ingredientes, tipo_producto, precio, disponible) VALUES ('$nombre', '$ingredientes', '$tipo_producto', '$precio', '$disponible')";
			$mysqli->query($SQL);

			if($mysqli->affected_rows!=1)
			{
				echo '([false, "ERROR----'.$SQL.'"])';
				exit();
			}

	case 3:
		$nombre=$_POST["nombre"];
		$SQL="SELECT nombre FROM productos WHERE nombre='$nombre'";
		$result=$mysqli->query($SQL);
		$row_cnt = $result->num_rows;
		
		if($row_cnt!=0)
		{
			echo '([false, "Ya existe un producto con ese nombre"])';
			
			exit();
		}
		echo '([true, "Todo ok"])';

	break;

}



