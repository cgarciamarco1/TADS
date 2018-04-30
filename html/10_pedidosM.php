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

//Borrar datos de tmppedido
	case 4:
	
	$SQL = ("DELETE FROM tmppedido");
	$res=$mysqli->query($SQL);//borra los datos de la tabla tmppedido
		echo '([true, "borrados datos de tmppedido..."])';
	break;

//Cargar datos de tmppedido
	case 5:
	
	$SQL = ("SELECT * FROM tmppedido");
		echo get_Data_SQL ($SQL, array() ,$mysqli);//carga datos de tmppedido
	break;

//insertar producto en tabla tmppedido
	case 6:
	$idproducto=$_POST["idproducto"];
	$nombre=$_POST["nombre"];
	$cantidad=$_POST["cantidad"];

	$res=$mysqli->query("SELECT id FROM tmppedido WHERE idproducto='$idproducto'");//buscamos si ya está el producto en tmpproducto
	if($res->num_rows!=1)
	{
		$res=$mysqli->query("SELECT precio FROM productos WHERE id='$idproducto'");//buscamos el precio del producto
		$valor=mysqli_fetch_array($res);
		$precio=$valor['precio'];
		$preciototal=$precio*$cantidad;
		$SQL = ("INSERT INTO tmppedido (idproducto, producto, cantidad, preciounidad, preciototal) VALUES ('$idproducto', '$nombre', '$cantidad', '$precio', '$preciototal')");

		$res=$mysqli->query($SQL);//inserta datos de pedido en tabla tmppedido
			
			echo '([true, "linea insertada..."])';
	}else{
		$res=$mysqli->query("SELECT * FROM tmppedido WHERE idproducto='$idproducto'");//buscamos el precio del producto
		$valor=mysqli_fetch_array($res);
		$preciototal=$valor['preciototal'];
		$preciounidad=$valor['preciounidad'];
		$preciototal=$preciototal+($cantidad*$preciounidad);
		$cantidadregistrada=$valor['cantidad'];
		$cantidadtotal=$cantidadregistrada+$cantidad;
		$SQL = ("UPDATE tmppedido SET cantidad='$cantidadtotal', preciototal='$preciototal' WHERE idproducto='$idproducto'");

		$res=$mysqli->query($SQL);//actualiza datos de pedido en tabla tmppedido
			
			echo '([true, "linea actualizada..."])';
	}
	break;

	//insertar pedido
	case 7:
	$nombre=$_POST["nombre"];
	$comentarios=$_POST["comentarios"];
	$direccion=$_POST["direccion"];
	$telefono=$_POST["telefono"];
	$producto=$_POST["producto"];
	$cantidad=$_POST["cantidad"];
	$horaactivacion=$_POST["horaactivacion"];
	

	$SQL="SELECT SUM(preciototal) FROM tmppedido";//buscamos la suma del precio del pedido
	$res=$mysqli->query($SQL);
	$valor=mysqli_fetch_array($res);
	$preciototal=$valor[0];
	
	$SQL="INSERT INTO pedido (nombre_cliente, telefono, precio_total, direccion_entrega, estado, comentarios, fecha_hora_activacion) VALUES ('$nombre', '$telefono', '$preciototal', '$direccion', '1', '$comentarios', '$horaactivacion')";
	$mysqli->query($SQL);
	$int_id=$mysqli->insert_id;

	// $SQL=("UPDATE tmppedido SET idpedido='$int_id'");
	// $mysqli->query($SQL);

	$SQL=("INSERT INTO linea_pedido (idproducto, pedido, cantidad, preciototal, comentario) SELECT idproducto, '$int_id', cantidad, preciototal, '$comentarios' FROM tmppedido");
	$mysqli->query($SQL);

	$SQL=("DELETE FROM tmppedido");
	$mysqli->query($SQL);
}

?>