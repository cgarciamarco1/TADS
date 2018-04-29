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

$("anadirpizza").onclick=function(){
	var numlineas=$("numlineas");
	var pizzaid=$("pizza").value;
	var pizzanombre=document.registro.pizza.options[pizza.selectedIndex].text;
	var pizzacantidad=$("pizzacantidad").value;
	var anadir=$("listadelpedido").innerHTML;
	anadir+="<p>"+pizzanombre+" "+pizzacantidad+"</p>";
	$("listadelpedido").innerHTML=anadir;
	anadir=$("datospedido").innerHTML;
	anadir+="<p>"+pizzaid+" "+pizzanombre+" "+pizzacantidad+"</p>";
	$("datospedido").innerHTML=anadir;


	
}

$("anadirbebida").onclick=function(){
	var bebidaid=$("bebida").value;
	var bebidanombre=document.registro.bebida.options[bebida.selectedIndex].text;
	var bebidacantidad=$("bebidacantidad").value;
	
}

$("anadirpostre").onclick=function(){
	var postreid=$("postre").value;
	var postrenombre=document.registro.postre.options[postre.selectedIndex].text;
	var postrecantidad=$("postrecantidad").value;
	
}

$("pizzacantidad").onchange=function(){
	var pizzacantidad=$("pizzacantidad").value;
	if (pizzacantidad<1){
		$("pizzacantidad").value=1;
		$("pizzacantidad").focus;
	}
}

$("pizza").onclick();
$("bebida").onclick();
$("postre").onclick();