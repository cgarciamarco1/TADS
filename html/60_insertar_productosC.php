// Cargamos los tipos de productos
$("tipo_producto").onclick=function(){

	var REQ, resp, i, j;
	var cad="";

	try{REQ=new XMLHttpRequest();}
	catch(e){alert("No AJAX"); return;}

	REQ.onreadystatechange=function()
	{
		if(REQ.readyState==4)
		{
			try
			{
				resp = eval(REQ.responseText);
			}
			catch(e)
			{
				$("main").innerHTML = "<b><u>Error</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
				return;
			}
			
			
			// longitud del select
			$("tipo_producto").length = resp.length;
			
			
			for(i=0;i<resp.length;i++)
			{
				$("tipo_producto").options[i].value=resp[i][0];
				$("tipo_producto").options[i].text=resp[i][1];
			}
				//$("provincia").onchange();//volvemos a recargar los lugares
				
            //$("contenido").innerHTML = cad + "<hr/><br/> la respuesta 'JSON' del servidor ha sido la siguiente:<pre>"+REQ.responseText+"</pre>";
		}
	}

	opcion=1;
	REQ.open("POST","60_insertar_productosM.php",true); // true -> Ajax ASINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion);
}

// Cargamos los tipos de productos
$("enviar").onclick=function(){
	var nombre=$("nombre").value;
	var ingredientes=$("ingredientes").value;
	var tipo_producto=$("tipo_producto").value;
	var precio=$("precio").value;
	var disponible=$("disponible").value;

	// validar nombre no vacío
	var ok;
	ok=CampoVacio(nombre);
	if (ok!=1){
		myAlert("&#10008; Debes pone un nombre al producto", false);
		$("nombre").focus();
		return;
	} 

	opcion=2;
	var REQ=new XMLHttpRequest();
	REQ.open("POST","60_insertar_productosM.php",false); // false -> Ajax SINCRONO
	REQ.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	REQ.send("opcion="+opcion+"&nombre="+nombre+"&ingredientes="+ingredientes+"&tipo_producto="+tipo_producto+"&precio="+precio+"&disponible="+disponible);
	if(resp[0]==false){
					myAlert("&#10008; "+resp[1], false);
					$("nombre").focus();
					return;
					}
				else{
					myAlert("&#10008; Producto insertado", true);
					CargarID('50_ver_productosV.php', '50_ver_productosC.php', 'main');
				}
}

$("cancelar").onclick=function(){
	CargarID('50_ver_productosV.php', '50_ver_productosC.php', 'main');
}

$("nombre").onchange=function(){
	// validar nombre único
	try{REQ=new XMLHttpRequest();}
	catch(e){alert("No AJAX"); return;}

	REQ.onreadystatechange=function()
	{
		if(REQ.readyState==4)
		{
			try
			{
				resp = eval(REQ.responseText);
				
			}
			catch(e)
			{
				$("main").innerHTML = "<b><u>Error</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
				return;
			}
							
				if(resp[0]==false){
					myAlert("&#10008; "+resp[1], false);
					$("nombre").focus();
					return;
					}
				if(resp[0]==true){
				return;
					}
		}
	}

	var nombre=$("nombre").value;
	opcion=3;
	REQ.open("POST","60_insertar_productosM.php",true); // true -> Ajax ASINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion+"&nombre="+nombre);
}

$("tipo_producto").onclick();