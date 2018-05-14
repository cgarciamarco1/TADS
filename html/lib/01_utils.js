// JavaScript Document

function $(id){return document.getElementById(id);}


/*******************************************************************************
 select-form API
*******************************************************************************/
function SetSelect(idSel, url, postData)
{
	var js, i, texto;
	var e_req=new XMLHttpRequest();

	e_req.open("POST",url,false);
	e_req.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	e_req.send(postData);

	try{ js=eval(e_req.responseText); }
	catch(e){ alert("SetSelect Error: " + idSel + "\nURL: " + url + "\npostDat: " + postData + "\n\n\n" + e_req.responseText); return false;}

	EmptySelect(idSel);
	for(i=0;i<js.length;i++)
	{
		texto=(js[i][1] ? js[i][1] : js[i][0])
	                                 // (TEXT ,  VALUE   , ... )
		$(idSel).options[i+1]=new Option(texto , js[i][0] , "" , "");
		$(idSel).options[i+1].title=(js[i][2] ? js[i][2] : texto);
	}

	return true;
}

function SelectOption(idSel, val)
{
	var i;

	if(!$(idSel) || !$(idSel).options)
	{
		alert("Error 'SelectOpcion' undefined (id: '"+idSel+"')");
		return false;
	}
	for(i=0 ; i<$(idSel).options.length ; i++)
	{
		if($(idSel).options[i].value==val)
		{
			$(idSel).selectedIndex=i;
			return true;
		}
	}
	$(idSel).selectedIndex=0;
	return false;
}

function EmptySelect(idSel)
{
	$(idSel).selectedIndex=0;
	while($(idSel).options.length>1)
		$(idSel).remove(1); // delete old options less '0' (first)
}


/*******************************************************************************
 radiobutton API
*******************************************************************************/
function RadioVal(name)
{
	var radios = document.getElementsByName(name);

	if(!radios || !radios[0] || radios[0].type!="radio")
	{
		alert("Elemento '"+name+"' no es radio-button");
		return null;
	}

	var i;
	for(i=0 ; i<radios.length ; i++)
		if(radios[i].checked)
			return radios[i].value;
	return null;
}

function RadioSet(name, val)
{
	var radios = document.getElementsByName(name);

	if(!radios || !radios[0] || radios[0].type!="radio")
	{
		alert("Elemento '"+name+"' no es radio-button");
		return null;
	}

	var i;
	for(i=0 ; i<radios.length ; i++)
		if(radios[i].value==val)
			return (radios[i].checked=true);
	return null;
}


/*******************************************************************************
 Model-View-Controler cliente API
*******************************************************************************/
var ajaxM=ajaxV=ajaxC=false; // MVC
function alertMVC(id)
{
	switch(id)
	{
		case "M":
			alert(ajaxM.responseText);
			break;
		case "V":
			alert(ajaxV.responseText);
			break;
		case "C":
			alert(ajaxC.responseText);
			break;
		default:
			alert("id = '"+id+"' ???");
			break;
	}
}

function GetModule(module, target)
{
	var v=module+"V.php";
	var c=module+"C.php";

	ajaxV = new XMLHttpRequest();
	ajaxV.open("POST", v, false);
	ajaxV.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxV.send();
	$(target).innerHTML=ajaxV.responseText;

	ajaxC = new XMLHttpRequest();
	ajaxC.open("POST", c, false);
	ajaxC.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxC.send();
	eval(ajaxC.responseText);
}

/*llamada al modelo (module): pasar formID (idFormulario)*/
function AJAXCall(module, formId)
{
	var m=module+"M.php";
	var postData;

	if($(formId))
		postData=GetDataForm(formId);
	else
		postData=formId;

	ajaxM = new XMLHttpRequest();
	ajaxM.open("POST", m, false);
	ajaxM.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxM.send(postData);
	return ajaxM.responseText;/*retocar si se trabaja con XML*/
}

function AJAXTouch(module, formId, respFunction)
{
	var m=module+"M.php";
	var postData;

	if($(formId))
		postData=GetDataForm(formId);
	else
        postData=formId;

	ajaxM = new XMLHttpRequest();

	ajaxM.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200)
		{
			if(respFunction && respFunction!==null && respFunction!=="")
				respFunction(this);
			else
				console.log(this.responseText);
		}
	};

	ajaxM.open("POST", m, true);
	ajaxM.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxM.send(postData);
}

function GetDataForm(formId)
{
	var f, i, data, pair, postData="";

	if( (f=$(formId)) && (data=new FormData($(formId))) )
	{
		if(data.entries)
		{
			// para chrome y firefox
			for(pair of data.entries())
				postData+=pair[0] + "=" + encodeURIComponent(pair[1]) + "&";  // encodeURIComponent -> scape de caracteres como '+' y otros
		}
		else
		{
			// para edge, explorer, safari, opera, ...
			postData=ScanDataForm(f);
		}
	}
	else
		postData=formId;
	return postData;
}

// Estas dos variables (constantes) son para especificar el valor devuelto un campo 'checkbox' al estar o no marcado.
// Se pueden cambiar por ['true', 'false'] o ['ON', 'OFF'] o lo que se considere apropiado en cada caso.
var VAL_VERDADERO='1';
var VAL_FALSO='0';
function ScanDataForm(f)
{
	if(!f)
		return "";

	var i,j,x;
	var cad="";
	var val;
	var radioNom="";

	for(i=0;i<f.length;i++)
	{
		x=f.elements[i];
		if(typeof(x.name)!="undefined" && x.name.length>0)
		{
			switch(x.type)
			{
				case "text": case "password": case "hidden": case "textarea":
					val=x.value.trim();
					break;

				case "select-one":
					if(x.options.length>0 && x.selectedIndex>=0 && x.selectedIndex<x.options.length)
						val=(x.options[x.selectedIndex].value) ?
						     x.options[x.selectedIndex].value : x.options[x.selectedIndex].text;
					else
						val="__NO__VAL__";
					break;

				case "checkbox":
					val=(x.checked)?VAL_VERDADERO:VAL_FALSO;
					break;

				case "radio":
					val="";
					if(radioNom!=x.name)
					{
						radioNom=x.name;
						j=0;
						while(f.elements[radioNom][j] && val=="")
						{
							if(f.elements[radioNom][j].checked)
								val=f.elements[radioNom][j].value;
							j++;
						}
					}
					break;

				default: //case "button": case "reset": case "submit": case "file":
					val="__NO__VAL__";
					break;
			}
			if(val!="__NO__VAL__")
			{
				if(val!="")
				{
					if(cad!="")
						cad+="&";
					cad+=x.name+"="+encodeURIComponent(val);
				}
			}
		}
	}
	return cad;
}


/******************************************************************************/
/******************************************************************************/


function Msg(str, target)
{
	if(!$(target))
	{
		alert("MSG ERROR: id '"+target+"' not found");
		return;
	}

	$(target).innerHTML=str;
	$(target).setAttribute("msg-lop-for-user", str);
	MsgLoop(target);
}

function MsgLoop(target)
{
	var i;
	for(i=0 ; i<6 ; i++)
	{
		setTimeout("$('"+target+"').innerHTML=$('"+target+"').getAttribute('msg-lop-for-user');", i*1000);
		setTimeout("$('"+target+"').innerHTML='&nbsp;'", i*1000 + 800);
	}
}


// Validación de una cadena, sólo caracteres alfanuméricos y '.', '-', '_'
function StrOK(cad)
{
	var i;

	if(!cad || cad.length==0)
		return 0;
	for(i=0;i<cad.length;i++)
		if( ((c=cad.charAt(i))<'a' || c>'z') && (c<'A' || c>'Z') && (c<'0' || c>'9') && c!='.' && c!='-' && c!='_' )
			return 0;
	return 1;
}

// Valida una fecha en formato YYYY/MM/DD
function YMD_DateOK(cad)
{
	if(cad.length!=10)
		return 0;

	var sep=cad.substr(4,1);
	if((sep!="/" && sep!="-") || sep!=cad.substr(7,1))
		return 0;

	var d=(cad.substr(8,2)*1);
	var m=(cad.substr(5,2)*1);
	var a=(cad.substr(0,4)*1);

	if(d<1 || d>31 || m<1 || m>12 || a<1000 || a>9999 ||
	   (d>30 && (m==4 || m==6 || m==9 || m==11)) ||
	   (m==2 && (d>29 || (d>28 && (a%4)!=0))))
		return 0;

	return 1;
}

// Verificar si la cadena es un email válido
function EmailOK(cad)
{
	var arrPos, puntPos, str;

	arrPos=cad.indexOf("@");
	puntPos=cad.lastIndexOf(".");
	if(arrPos<1 || arrPos!=cad.lastIndexOf("@") || puntPos<arrPos || puntPos==(arrPos+1) || puntPos<cad.length-5 || puntPos>cad.length-3)
		return 0;
	str=cad.substring(0,arrPos);
	if(!StrOK(str))
		return 0;
	str=cad.substring(arrPos+1, puntPos);
	if(!StrOK(str))
		return 0;
	str=cad.substring(puntPos+1);
	if(!StrOK(str))
		return 0;
	return 1;
}

// reemplazar caracteres "problemáticos" (', ", \n')
function MyReplace(cad)
{
	var aux = cad.replace(/(?:\r\n|\r|\n)/g, '\\n');
	aux = aux.replace(/[']/g, "\\'");
	//return aux.replace(/["]/g, '\\"');
	return aux;
}

// Convierte fecha AAAA/MM/DD en DD/MM/AAAA
function AMD2DMA(x)
{
	if(x)
	{
		var a=x.substr(0,4);
		var m=x.substr(5,2);
		var d=x.substr(8,2);

		return d+"/"+m+"/"+a;
	}
	return false;
}

// Scroll Pantalla (http://stackoverflow.com)
function ScrollTo(element, to, duration)
{
	if (duration <= 0) return;
	var difference = to - element.scrollTop;
	var perTick = difference / duration * 10;

	setTimeout(function() {
		element.scrollTop = element.scrollTop + perTick;
		if (element.scrollTop === to) return;
		ScrollTo(element, to, duration - 10);
	}, 10);
}

// Enable TAB in textarea (https://jsfiddle.net/tovic/2wAzx/)
// Admite el caracter [TAB] en un "textarea"
function EnableTab(id)
{
	$(id).onkeydown = function(e)
	{
		if (e.keyCode === 9)
		{ // tab was pressed
			// get caret position/selection
			var val = this.value,
				start = this.selectionStart,
				end = this.selectionEnd;
			// set textarea value to: text before caret + tab + text after caret
			this.value = val.substring(0, start) + '\t' + val.substring(end);
			// put caret at right position again
			this.selectionStart = this.selectionEnd = start + 1;
			// prevent the focus lose
			return false;
		}
	};
}

// Insert text into textarea (https://stackoverflow.com/questions/11076975/insert-text-into-textarea-at-cursor-position-javascript)
function InsertAtCursor(id, text)
{
	if ($(id).selectionStart || $(id).selectionStart == '0') //MOZILLA and others
	{
		var startPos = $(id).selectionStart;
		var endPos = $(id).selectionEnd;
		$(id).value = $(id).value.substring(0, startPos)
			+ text
			+ $(id).value.substring(endPos, $(id).value.length);
		$(id).focus();
        $(id).setSelectionRange(startPos+text.length, startPos+text.length);
	}
	else if (document.selection)//IE support
	{
		$(id).focus();
		sel = document.selection.createRange();
		sel.text = text;
	}
	else // No encuentra el cursor -> inserta al final
	{
		$(id).value += text;
	}
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//if(!window.XMLHttpRequest) alert('AJAX not supported !!!\nget another browser');
//else if(!window.FormData) alert('JavaScript FormData not supported !!!\nget another browser');
//else { var fd=new FormData(); if(!fd.entries) alert('JavaScript FormData.entries not supported !!!\nget another browser'); }
