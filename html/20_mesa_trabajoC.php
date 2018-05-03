var json;
var json1;

$("refrescar").onclick = function(){
	var ans=AJAXCall("20_mesa_trabajo", "OPC=PEDIDOS");
	try{json=eval(ans);}
	catch(e){alert("ERROR\n\n"+ans); return;}
	
	str="";
	for(i=0;i<json.length;i++){
		str+="<div id='pedido_"+i+"' class='pedido_general'><div class='pedido'>Pedido n. "+json[i][0]+" - "+json[i][1]+" - "+json[i][2];
		str+="<img id='btn_detalles_"+i+"' title='"+i+"'src='img/down_arrow.png' class='icon arrows'/>";
		str+="<img id='btn_cierra_detalles_"+i+"' title='"+i+"'src='img/up_arrow.png' class='icon arrows' style='display:none'/></div>";
		str+="<div id='detalles_"+i+"' class='pedido_detalles' style='display:none'></div></div>";
	}
	$("listado_pedidos").innerHTML=str;
	
	for(i=0;i<json.length;i++){
		
		$("btn_detalles_"+i).onclick = function(){
			$("detalles_"+this.title).style.display="";
			
			var ans=AJAXCall("20_mesa_trabajo", "OPC=LINEAS_PEDIDO&idpedido='"+json[this.title][0]+"'");
			try{json1=eval(ans);}
			catch(e){alert("ERROR\n\n"+ans); return;}
			//alert(ans);
			str = "";
			for(j=0;j<json1.length;j++){
				str += "<tr><td>"+json1[j][0]+"</td><td>"+json1[j][1]+"</td>";
			}
			str = "<table class='lineas_pedido'>"+str+"</table>";
			$("detalles_"+this.title).innerHTML=str;
			this.style.display="none";
			$("btn_cierra_detalles_"+this.title).style.display="";
		};
		
		$("btn_cierra_detalles_"+i).onclick = function(){
			$("detalles_"+this.title).style.display="none";
			this.style.display="none";
			$("btn_detalles_"+this.title).style.display="";
		};
	}
	
};

$("refrescar").onclick();