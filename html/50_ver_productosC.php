// carga los productos en la página de ver productos
$("productos").onclick=function()	
{
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
			
			
			// mostramos la tabla con los resultados
			
			// resp[i][0] es ID
			// resp[i][1] es nombre
			// resp[i][2] es lista_ingredientes
			// resp[i][3] es precio
			// resp[i][4] es disponible
			// resp[i][5] es tipo_producto
					
			
			cad+="<table class='productos'>";
			cad+="<tr>";
			cad+="<th>nombre</th>";
			cad+="<th>Ingredientes</th>";
			cad+="<th>Precio</th>";
			cad+="<th>Disponible</th>";
			cad+="<th>Tipo de producto</th>";
			cad+="</tr>";
			
			
			if (resp.length>0){
			
				for(i=0;i<resp.length;i++)
				{
					cad+="<tr>";
					cad+="<td>"+resp[i][0]+"</td>";
					cad+="<td>"+resp[i][1]+"</td>";
					cad+="<td>"+resp[i][2]+"</td>";
					cad+="<td>"+resp[i][3]+"</td>";
					cad+="<td>"+resp[i][4]+"</td>";
					cad+="</tr>";
				}
					cad+="</table>";

	            $("datos2").innerHTML = cad //+ "<hr/><br/> la respuesta 'JSON' del servidor ha sido la siguiente:<pre>"+REQ.responseText+"</pre>";
				
				
			}
		}
	}
	opcion=1;
	REQ.open("POST","50_ver_productosM.php",true); // true -> Ajax ASINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion);
}

// carga los productos en la página de ver productos
$("buscar").onclick=function()	
{
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
			
			
			// mostramos la tabla con los resultados
			
			// resp[i][0] es ID
			// resp[i][1] es nombre
			// resp[i][2] es lista_ingredientes
			// resp[i][3] es precio
			// resp[i][4] es disponible
			// resp[i][5] es tipo_producto
					
			
			cad+="<table class='productos'>";
			cad+="<tr>";
			cad+="<th>nombre</th>";
			cad+="<th>Ingredientes</th>";
			cad+="<th>Precio</th>";
			cad+="<th>Disponible</th>";
			cad+="<th>Tipo de producto</th>";
			cad+="</tr>";
			
			//Si la búsqueda no optiene resultados muestra aviso
			if (resp.length==0){
				myAlert("&#10008; No hay resultados", false);
				$("datos2").innerHTML="No hay resultados";
				$("busqueda").focus();
				return;
			}
	
				for(i=0;i<resp.length;i++)
				{
					cad+="<tr>";
					cad+="<td>"+resp[i][0]+"</td>";
					cad+="<td>"+resp[i][1]+"</td>";
					cad+="<td>"+resp[i][2]+"</td>";
					cad+="<td>"+resp[i][3]+"</td>";
					cad+="<td>"+resp[i][4]+"</td>";
					cad+="</tr>";
				}
					cad+="</table>";

	            $("datos2").innerHTML = cad //+ "<hr/><br/> la respuesta 'JSON' del servidor ha sido la siguiente:<pre>"+REQ.responseText+"</pre>";
		}
	}
	var busqueda=$("busqueda").value;
	opcion=2;
	REQ.open("POST","50_ver_productosM.php",true); // true -> Ajax ASINCRONO
	REQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	REQ.send("opcion="+opcion+"&busqueda="+busqueda);
}

$("productos").onclick(); //ejecuta el script productos