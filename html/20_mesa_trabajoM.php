<?php
	include("lib/01_connection.php");
	
	switch($_POST["OPC"]){
		case "PEDIDOS":
			//falta el control de la hora de activación
			$SQL="SELECT ID, nombre_cliente, fecha_hora_activacion FROM pedido where estado = '1'";
			echo get_Data_SQL($SQL, array(), $mysqli);
			break;
		
		case "LINEAS_PEDIDO":
			$idpedido = $_POST["idpedido"];
			$SQL="SELECT nombre, cantidad, comentario, lista_ingredientes FROM linea_pedido, productos WHERE linea_pedido.idproducto = productos.ID AND pedido = $idpedido";
			echo get_Data_SQL($SQL, array(), $mysqli);
			break;
			
		default:
			print_r($_POST);
			break;
	}
?>