function $(id){return document.getElementById(id);}

function CargarID(vista, controlador, id)
{
	// Cargar la vista
	AJAX = new XMLHttpRequest();
	AJAX.open("POST",vista,false); // OJO: false -> Ajax SINCRONO !!!
	AJAX.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	AJAX.send("");
	$(id).innerHTML=AJAX.responseText;

	if(controlador!==false)
	{
		// Cargar el controlador
		AJAX = new XMLHttpRequest();
		AJAX.open("POST",controlador,false); // OJO: false -> Ajax SINCRONO !!!
		AJAX.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		AJAX.send("");
		try
		{
			eval(AJAX.responseText);
		}
		catch(e)
		{
			alert("ERROR en CargarID:\n\n" + AJAX.responseText);
		}
	}
}

// Muestra mensajes con color
function myAlert(msg, ok){
	// muestra 'myAlert'
	if(ok)
		$("myAlert").className="alertOK";
	else
		$("myAlert").className="alertERROR";

	$("myAlert").innerHTML=msg;
	setTimeout("$('myAlert').style.display = '';", 0); 
	setTimeout("$('myAlert').style.display = 'none';", 2000); 
}

// Valida campo no vacío
function CampoVacio(p1){
	if(p1.length==0){
		return false;
	}else {
		return true;
	}
}