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
				$("pizza").onchange();//volvemos a recargar los lugares
				
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
				$("bebida").onchange();//volvemos a recargar los lugares
				
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
				$("postre").onchange();//volvemos a recargar los lugares
				
            //$("contenido").innerHTML = cad + "<hr/><br/> la respuesta 'JSON' del servidor ha sido la siguiente:<pre>"+REQ.responseText+"</pre>";
		}
	}

	opcion=3;
	REQ.open("POST","10_pedidosM.php",true); // true -> Ajax ASINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion);
}

$("pizza").onclick();
$("bebida").onclick();
$("postre").onclick();