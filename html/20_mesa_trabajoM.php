<?php
	include("lib/01_connection.php");
	
	switch($_POST["OPC"]){
		case "PEDIDOS":
			//falta el control de la hora de activación
			$SQL="SELECT DISTINCT pedido.ID, nombre_cliente, fecha_hora_activacion FROM pedido, linea_pedido, productos WHERE pedido.ID = linea_pedido.pedido AND linea_pedido.idproducto = productos.ID AND estado = '1' AND tipo_producto = '1'";
			echo get_Data_SQL($SQL, array(), $mysqli);
			break;
		
		case "LINEAS_PEDIDO":
			$idpedido = $_POST["idpedido"];
			$SQL="SELECT nombre, cantidad, comentario, lista_ingredientes FROM linea_pedido, productos WHERE linea_pedido.idproducto = productos.ID AND pedido = $idpedido AND tipo_producto='1'";
			echo get_Data_SQL($SQL, array(), $mysqli);
			break;
			
		default:
			print_r($_POST);
			break;
	}
?>