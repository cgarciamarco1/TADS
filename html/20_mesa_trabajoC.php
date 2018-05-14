var json;
var json1;

//funcion para refrescar la pagina
$("refrescar").onclick = function(){
	//llamada al servidor para recibir los datos de los pedidos en formato json
	var ans=AJAXCall("20_mesa_trabajo", "OPC=PEDIDOS");
	try{json=eval(ans);}
	catch(e){alert("ERROR\n\n"+ans); return;}

	//creacion dinamica de los divs correspondientes a los pedidos
	str="";
	for(i=0;i<json.length;i++){
		str+="<div id='pedido_"+i+"' class='pedido_general'><div class='pedido'>Pedido n. "+json[i][0]+" - "+json[i][1]+" - "+json[i][2];
		str+="<img id='btn_detalles_"+i+"' pedido='"+i+"' title='Detalles' src='img/down_arrow.png' class='icon arrows'/>";
		str+="<img id='btn_cierra_detalles_"+i+"' pedido='"+i+"' title='Cierra' src='img/up_arrow.png' class='icon arrows' style='display:none'/></div>";
		str+="<div id='detalles_"+i+"' class='pedido_detalles' style='display:none'></div></div>";
	}
	$("listado_pedidos").innerHTML=str;
	
	//creacion de los eventos relacionados con los diferentes divs
	for(i=0;i<json.length;i++){
	
		//evento para desplegar los detalles del pedido
		$("btn_detalles_"+i).onclick = function(){
			$("detalles_"+this.getAttribute("pedido")).style.display="";
			
			//llamada al servidor para recibir los detalles del pedido en formato json
			var ans=AJAXCall("20_mesa_trabajo", "OPC=LINEAS_PEDIDO&idpedido='"+json[this.getAttribute("pedido")][0]+"'");
			try{json1=eval(ans);}
			catch(e){alert("ERROR\n\n"+ans); return;}
			
			//creacion dinamica de la tabla de las pizzas del pedido
			str = "";
			for(j=0;j<json1.length;j++){
				str += "<tr><td>"+json1[j][0]+"</td><td>"+json1[j][1]+"</td>";
			}
			str = "<table class='lineas_pedido'>"+str+"</table>";
			$("detalles_"+this.getAttribute("pedido")).innerHTML=str;
			
			//esconde el boton para desplegar detalles
			this.style.display="none";
			//muestra el boton para cerrar los detalles
			$("btn_cierra_detalles_"+this.getAttribute("pedido")).style.display="";
		};
		
		
		//evento para cerrar los detalles
		$("btn_cierra_detalles_"+i).onclick = function(){
			//esconde el div de los detalles
			$("detalles_"+this.getAttribute("pedido")).style.display="none";
			//esconde el boton para cerrar los detalles
			this.style.display="none";
			//muestra el div para abrir los detalles
			$("btn_detalles_"+this.getAttribute("pedido")).style.display="";
		};
	}
	
};

$("refrescar").onclick();