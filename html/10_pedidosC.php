// Cargamos las pizzas
$("pizza").onclick=function(){

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
			document.registro.pizza.length = resp.length;
			
			
			for(i=0;i<resp.length;i++)
			{
				document.registro.pizza.options[i].value=resp[i][0];
				document.registro.pizza.options[i].text=resp[i][1];
			}
				
            //$("contenido").innerHTML = cad + "<hr/><br/> la respuesta 'JSON' del servidor ha sido la siguiente:<pre>"+REQ.responseText+"</pre>";
		}
	}

	opcion=1;
	REQ.open("POST","10_pedidosM.php",true); // true -> Ajax ASINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion);
}

// Cargamos las bebidas
$("bebida").onclick=function(){

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
			document.registro.bebida.length = resp.length;
			
			
			for(i=0;i<resp.length;i++)
			{
				document.registro.bebida.options[i].value=resp[i][0];
				document.registro.bebida.options[i].text=resp[i][1];
			}
				
            //$("contenido").innerHTML = cad + "<hr/><br/> la respuesta 'JSON' del servidor ha sido la siguiente:<pre>"+REQ.responseText+"</pre>";
		}
	}

	opcion=2;
	REQ.open("POST","10_pedidosM.php",true); // true -> Ajax ASINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion);
}

// Cargamos los postres
$("postre").onclick=function(){

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
			document.registro.postre.length = resp.length;
			
			
			for(i=0;i<resp.length;i++)
			{
				document.registro.postre.options[i].value=resp[i][0];
				document.registro.postre.options[i].text=resp[i][1];
			}
				
            //$("contenido").innerHTML = cad + "<hr/><br/> la respuesta 'JSON' del servidor ha sido la siguiente:<pre>"+REQ.responseText+"</pre>";
		}
	}

	opcion=3;
	REQ.open("POST","10_pedidosM.php",true); // true -> Ajax ASINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion);
}

$("datospedido").onclick=function(){//Borrar datos de tmppedido al cargar la página
	var REQ, resp;
	try{REQ=new XMLHttpRequest();}
	catch(e){alert("No AJAX"); return;}
	opcion=4;
	REQ.open("POST","10_pedidosM.php",false); // false -> Ajax SINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion);
	try
	{
		resp = eval(REQ.responseText);
		//$("main").innerHTML = "<b><u>Bien</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
	}
	catch(e)
	{
		$("main").innerHTML = "<b><u>Error</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
		return;
	}
}

$("cargardetallepedido").onclick=function(){
	var REQ, resp, i;
	var cad="";
	var total=0;
	try{REQ=new XMLHttpRequest();}
	catch(e){alert("No AJAX"); return;}
	opcion=5;
	REQ.open("POST","10_pedidosM.php",false); // false -> Ajax SINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion);
	try
	{
		resp = eval(REQ.responseText);
		//$("main").innerHTML = "<b><u>Bien</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
	}
	catch(e)
	{
		$("main").innerHTML = "<b><u>Error</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
		return;
	}
		// longitud del select			
			for(i=0;i<resp.length;i++)
			{
				cad+="<p>"+resp[i][2]+", cantidad "+resp[i][3]+" precio "+resp[i][5]+"€</p>";
				total+=parseInt(resp[i][5]);
			}
            //$("contenido").innerHTML = cad + "<hr/><br/> la respuesta 'JSON' del servidor ha sido la siguiente:<pre>"+REQ.responseText+"</pre>";
            cad+="<h3> Total: "+total+"€</h3>"
		$("listadelpedido").innerHTML=cad;
}

$("anadirpizza").onclick=function(){
	var pizzaid=$("pizza").value;
	var pizzanombre=document.registro.pizza.options[pizza.selectedIndex].text;
	var pizzacantidad=$("pizzacantidad").value;
	var REQ, resp;
	try{REQ=new XMLHttpRequest();}
	catch(e){alert("No AJAX"); return;}
	opcion=6;
	REQ.open("POST","10_pedidosM.php",false); // false -> Ajax SINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion+"&idproducto="+pizzaid+"&nombre="+pizzanombre+"&cantidad="+pizzacantidad);
	try
	{
		resp = eval(REQ.responseText);
		//$("main").innerHTML = "<b><u>Bien</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
	}
	catch(e)
	{
		$("main").innerHTML = "<b><u>Error</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
		return;
	}
	
	if (!resp[0]){
		myAlert('&#10008; '+resp[1], false);
		}

	if (resp[0]){
		myAlert('&#10008; '+resp[1], true);
		}

	$("cargardetallepedido").onclick();
	
}

$("anadirbebida").onclick=function(){
	var bebidaid=$("bebida").value;
	var bebidanombre=document.registro.bebida.options[bebida.selectedIndex].text;
	var bebidacantidad=$("bebidacantidad").value;
	var REQ, resp;
	try{REQ=new XMLHttpRequest();}
	catch(e){alert("No AJAX"); return;}
	opcion=6;
	REQ.open("POST","10_pedidosM.php",false); // false -> Ajax SINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion+"&idproducto="+bebidaid+"&nombre="+bebidanombre+"&cantidad="+bebidacantidad);
	try
	{
		resp = eval(REQ.responseText);
		//$("main").innerHTML = "<b><u>Bien</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
	}
	catch(e)
	{
		$("main").innerHTML = "<b><u>Error</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
		return;
	}
	
	if (!resp[0]){
		myAlert('&#10008; '+resp[1], false);
		}

	if (resp[0]){
		myAlert('&#10008; '+resp[1], true);
		}

	$("cargardetallepedido").onclick();
	
}

$("anadirpostre").onclick=function(){
	var postreid=$("postre").value;
	var postrenombre=document.registro.postre.options[postre.selectedIndex].text;
	var postrecantidad=$("postrecantidad").value;
	var REQ, resp;
	try{REQ=new XMLHttpRequest();}
	catch(e){alert("No AJAX"); return;}
	opcion=6;
	REQ.open("POST","10_pedidosM.php",false); // false -> Ajax SINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion+"&idproducto="+postreid+"&nombre="+postrenombre+"&cantidad="+postrecantidad);
	try
	{
		resp = eval(REQ.responseText);
		//$("main").innerHTML = "<b><u>Bien</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
	}
	catch(e)
	{
		$("main").innerHTML = "<b><u>Error</u>:</b><br/><br/><pre>" + REQ.responseText + "</pre>";
		return;
	}
	
	if (!resp[0]){
		myAlert('&#10008; '+resp[1], false);
		}

	if (resp[0]){
		myAlert('&#10008; '+resp[1], true);
		}

	$("cargardetallepedido").onclick();
	
}

$("pizzacantidad").onchange=function(){
	var pizzacantidad=$("pizzacantidad").value;
	if (pizzacantidad<1){
		$("pizzacantidad").value=1;
		$("pizzacantidad").focus;
	}
}

$("bebidacantidad").onchange=function(){
	var bebidacantidad=$("bebidacantidad").value;
	if (bebidacantidad<1){
		$("bebidacantidad").value=1;
		$("bebidacantidad").focus;
	}
}

$("postrecantidad").onchange=function(){
	var postrecantidad=$("postrecantidad").value;
	if (postrecantidad<1){
		$("postrecantidad").value=1;
		$("postrecantidad").focus;
	}
}

$("cancelar").onclick=function(){
	CargarID('10_pedidosV.php', '10_pedidosC.php', 'main');
}

$("cancelar").onclick=function(){
	CargarID('10_pedidosV.php', '10_pedidosC.php', 'main');
}

$("confirmar").onclick=function(){
	var cad=$("listadelpedido").innerHTML;
	var nada="<p>Ningún producto seleccionado</p>";
	if (cad==nada){
		myAlert("&#10008; No se ha añadido ningún producto",false);
		return;
	}
	
	$("transparencia").style="display:inline";
	$("datosenvio").style="display:inline";
	var fecha=new Date();
	var horas=fecha.getHours();
	var minutos=fecha.getMinutes();
		if(horas<10){
			horas="0"+horas;
		}
		if(minutos<10){
			minutos="0"+minutos;
		}
	$("horaactivacion").value=(horas+":"+minutos);	
}

$("confirmardatosenvio").onclick=function(){
		var REQ, resp, i, j;
		nombre=$("nombrecliente").value;
		var ok;
		ok=CampoVacio(nombre);
		if (ok!=1){
			myAlert("&#10008; El campo nombre no puede estar vacío",false);
			$("nombrecliente").focus();
			return;
		} 

		horaactivacion=$("horaactivacion").value;
		comentarios=$("comentarios").value;
		direccion=$("direccion").value;
		telefono=$("telefono").value;
		var REQ, resp;
		try{REQ=new XMLHttpRequest();}
		catch(e){alert("No AJAX"); return;}


		opcion=7;
		REQ.open("POST","10_pedidosM.php",false); // false -> Ajax SINCRONO
		REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		REQ.send("opcion="+opcion+"&nombre="+nombre+"&horaactivacion="+horaactivacion+"&comentarios="+comentarios+"&direccion="+direccion+"&telefono="+telefono);
		



		$("transparencia").style="display:none";
		$("datosenvio").style="display:none";
		myAlert('&#10008; Pedido realizado', true);
		CargarID('10_pedidosV.php', '10_pedidosC.php', 'main');
}

$("cerrarmodal").onclick=function(){
	$("transparencia").style="display:none";
	$("datosenvio").style="display:none";
}

$("pizza").onclick();
$("bebida").onclick();
$("postre").onclick();
$("datospedido").onclick();