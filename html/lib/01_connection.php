<?php
// AL INCLUIR ESTE FICHERO, TRAS SU EJECUCIÓN, SE DISPONE DEL OBJETO
// GLOBAL '$mysqli' QUE CONTIENE LA CONEXIÓN CON EL SERVIDOR DE 'MySQL'
// EN MODO 'mysqli' (extensión mejorada de mysql).


// 1- Conexión
$mysqli = new mysqli("localhost", "root", "", "pizzeria");

// 2- Verificar si se ha producido o no la conexión
if (mysqli_connect_errno())
{
    printf("<hr>Connect failed (Err. nº %d): %s<hr/>",
mysqli_connect_errno(), mysqli_connect_error());
    exit();
}

// 3- Establecimiento del formato de codificación de caracteres UTF-8
if(!$mysqli->set_charset("utf8"))
{
	printf("<hr>Error loading character set utf8 (Err. nº %d): %s\n<hr/>",
$mysqli->errno, $mysqli->error);
	exit();
}

// 4- Asignar a variables los nombres de las tablas de la base de datos (opcional)
// recomendable por si la aplicación se ha de migrar a otro servidor donde las tablas
// de la base de datos tengan nombres distintos (p.e.: “Usuarios” → “BD1_users”)
$tabUser="usuarios";
$tabUserType = "tipos_usuario";
$tabSectDistr = "sectores_distribucion";


//
// OJO: Antes se debe abrir una conexión MySQL con la extensión MySQLi
//

function get_Type($x)
{
	if( ($p=strpos($x,"(")) === false )
		return $x;
	return substr($x,0,$p);
}

function get_Size($x)
{
	if( ($type=get_Type($x))=="text" || $type=="bold" )
		return "30000";
	if($type=="enum" || $type=="set")
		return "-1";
	if($type=="datetime") // datetime: AAAA-MM-DD hh:mm:ss (19 caracteres)
		return "19";
	$p=strpos($x,"(")+1;
	return substr($x , $p , strpos($x,")")-$p);
}

function get_Enum($x)
{
	if( ($type=get_Type($x))!="enum" && $type!="set")
		return "";
	$p=strpos($x,"(")+1;
	return str_replace("'","\"", substr($x , $p , strpos($x,")")-$p));
}

function get_META_Result($res,  $noFields="")
{
	$js="";
	$pk="";
	$pos=0;
	while ($l = $res->fetch_array())
	{
		if(strpos($noFields, $l["Field"])!==false)
			continue;
		if($js!="")
			$js.=",\n";
		$js.="  {\"name\":\"".$l["Field"]."\","
		    ."\"type\":\"".get_Type($l["Type"])."\","
		    ."\"size\":".get_Size($l["Type"]).","
		    ."\"enum\":[".get_Enum($l["Type"])."],"
		    ."\"PK\":".($l["Key"]=="PRI"?1:0).","
		    ."\"NULL\":".($l["Null"]=="YES"?1:0)."}";
		if($l["Key"]=="PRI")
		{
			if($pk!="")
				$pk.=",\n";
			$pk.="  {\"name\":\"".$l["Field"]."\",\"pos\":$pos}";
		}
		$pos++;
	}
	return "({\"fields\":\n [\n$js\n ],\n \"PK\":\n [\n$pk\n ]\n})";
}

function get_Meta_SQL($SQL, $noFields="", $mysqli)
{
	$nom_view="view_".$_SESSION["USER"]."_".rand(); // para evitar 'colisiones' se da a la vista un nombre aleatorio
	if(!($res = $mysqli->query("CREATE OR REPLACE VIEW $nom_view AS $SQL")))
	{
		echo "<hr/><b>ERROR (CREATE VIEW): ".$mysqli->errno."<br/>".$mysqli->error."<br/>SQL: $SQL</b><hr/>";
		exit();
	}
	if(!($res = $mysqli->query("DESCRIBE $nom_view")))
	{
		echo "<hr/><b>ERROR (DESCRIBE): ".$mysqli->errno."<br/>".$mysqli->error."</b><hr/>";
		exit();
	}
	
	$cad_return=get_META_Result($res,  $noFields);
	if(!$mysqli->query("DROP VIEW IF EXISTS $nom_view"))
	{
		echo "<hr/><b>ERROR (DROP VIEW '$nom_view'): ".$mysqli->errno."<br/>".$mysqli->error."</b><hr/>";
		exit();
	}
	return $cad_return;
}

function get_Meta_Table($table, $noFields="", $mysqli)
{
	if($res = $mysqli->query("DESCRIBE $table"))
		return get_META_Result($res,  $noFields);
	echo "<hr/><b>ERROR: ".$mysqli->errno."<br/>".$mysqli->error."<hr/>";
	exit();
}

function get_Data_Result($res, $noFields=array())
{
	$nF=$res->field_count;

	$dat="";
	$cadAux;
	while($registro = $res->fetch_row())
	{
		$row="";
		for($j=0;$j<$nF;$j++)
		{
			if(in_array($j, $noFields))
				continue;
			if($row!="")
				$row.=",";
			$cadAux=str_replace("\"","\\\"",$registro[$j]);
			$cadAux=str_replace("\r\n","\\n",$cadAux);
			$cadAux=str_replace("\n\r","\\n",$cadAux);
			$cadAux=str_replace("\r","\\n",$cadAux);
			$cadAux=str_replace("\n","\\n",$cadAux);
			$row.="\"$cadAux\"";
		}
		if($dat!="")
			$dat.=",\n";
		$dat.=" [$row]";
	}
	return "([\n$dat\n])";
}

function get_Data_SQL($SQL, $noFields=array(), $mysqli)
{
	if( ($res = $mysqli->query($SQL)) )
		return get_Data_Result($res, $noFields);
	echo "<hr/><b>ERROR: ".$mysqli->errno."<br/>".$mysqli->error."<hr/>SQL: $SQL</b><hr/>";
	exit();
}

function get_Data_Table($table, $where, $noFields=array(), $mysqli)
{
	$w=(!isset($where) || !$where || $where=="")? "" : "WHERE $where";
	if(($res = $mysqli->query("SELECT * FROM $table $w")))
		return get_Data_Result($res, $noFields);
	echo "<hr/><b>ERROR: ".$mysqli->errno."<br/>".$mysqli->error."<hr/>SQL: $SQL</b><hr/>";
	exit();
}

function MYSQL_GET_NUM($mysqli, $SQL)
{
	$res=$mysqli->query($SQL);
	return $res->num_rows;
}

function MYSQL_GET_VAL($mysqli, $SQL, $ID)
{
	static $fila="";
	if($mysqli!=null && $SQL!=null)
	{
		$res=$mysqli->query($SQL);
		if($res->num_rows<1)
			return null;
		$fila=$res->fetch_array();
	}
	return $fila[$ID];
}

?>
