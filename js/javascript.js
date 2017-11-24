var numconsulta = 0;
var comprueba = 0;
 //document.getElementById("demo").innerHTML = "You wrote: " + valor;

 function restarFechas() {
	var fech1 = document.getElementById('fecha_inicio').value;
	var fech2 = document.getElementById('fecha_final').value;

	if((Date.parse(fech1)) > (Date.parse(fech2))){
		return false;
	}else return true;
}

function validarCampoVacio(elemento){
	var consulta = document.getElementById(elemento).value;
	var elementoConsulta = document.getElementById(elemento);

	if (consulta == '') pintarRojo(elementoConsulta);

	else {
		borrarRojo(elementoConsulta);
		comprueba++;
	}	
	
	if (comprueba==3){		
		var elementoConsulta = document.getElementById('consulta');
		var fecha_inicio = document.getElementById('fecha_inicio');
		var fecha_final= document.getElementById('fecha_final');

		var fechas = restarFechas();
		if (!fechas)alert('La fecha inicial no puede ser mayor que la fecha final');		
		else{
			elementoConsulta.setAttribute('disabled', 'true');
			fecha_inicio.setAttribute('disabled', 'true');
			fecha_final.setAttribute('disabled', 'true');			 
			crearBotonRespuestas();	
			}	
	}
	
}

function pintarRojo(elemento){
	elemento.style.boxShadow='1px 1px 10px 1px #FA0909';
}
function borrarRojo(elemento){
	elemento.style.boxShadow='';
}

function crearConsulta(){             // crea la consulta cuando le das al boton !! 
	var padre = document.getElementById("crearConsultas");
    var input = document.createElement("input");
    var br = document.createElement("br");
    padre.parentNode.insertBefore(br, padre.nextSibling);
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'consulta');
    input.setAttribute('id', 'consulta');  
    input.setAttribute('onfocusout', 'validarCampoVacio("consulta")');    
    padre.parentNode.insertBefore(input, padre.nextSibling);

	var label = document.createElement("label");
	var insertarTexto = document.createTextNode("Crear consulta: ");
    label.appendChild(insertarTexto);
    padre.parentNode.insertBefore(label, padre.nextSibling);
  
}


function crearFechaFinal(){         // crea los input de las fechas cuando le das al boton !! 	
	var padre = document.getElementById("crearConsultas");
	var br = document.createElement("br");
    var inputFinal = document.createElement("input");
    inputFinal.setAttribute('type', 'date');
    inputFinal.setAttribute('name', 'fecha_final');
    inputFinal.setAttribute('id', 'fecha_final'); 
    inputFinal.setAttribute('onfocusout', 'validarCampoVacio("fecha_final")'); 
    padre.parentNode.insertBefore(inputFinal, padre.nextSibling);	

	var labelFinal = document.createElement("label");
	var insertarTexto = document.createTextNode("Fecha final: ");
    labelFinal.appendChild(insertarTexto);
    padre.parentNode.insertBefore(labelFinal, padre.nextSibling);
    padre.parentNode.insertBefore(br, padre.nextSibling);    
}

function crearFechaInicio(){
	var padre = document.getElementById("crearConsultas");
	var br = document.createElement("br");
    var inputInicio = document.createElement("input");
    inputInicio.setAttribute('type', 'date');
    inputInicio.setAttribute('name', 'fecha_inicio');
    inputInicio.setAttribute('id', 'fecha_inicio'); 
    inputInicio.setAttribute('onfocusout', 'validarCampoVacio("fecha_inicio")'); 
  	padre.parentNode.insertBefore(inputInicio, padre.nextSibling);

	var labelInicio = document.createElement("label");
	var insertarTexto = document.createTextNode("Fecha inicio: ");
    labelInicio.appendChild(insertarTexto);
    padre.parentNode.insertBefore(labelInicio, padre.nextSibling); 	
	
}

function crearBotonRespuestas(){
	var padre = document.getElementById("crearRespuesta");
	var br = document.createElement("br");	
    var boton = document.createElement("input");
    boton.setAttribute('type', 'button');
    boton.setAttribute('value', 'Crear Respuesta');
	padre.parentNode.insertBefore(boton, padre.nextSibling);
	padre.parentNode.insertBefore(br, padre.nextSibling);
}

function crearBotonBorrarRespuestas(){  // boton para borrar todas las respuestas...................
	var padre = document.getElementById("crearConsultas");
	var br = document.createElement("br");	
    var boton = document.createElement("input");
    boton.setAttribute('type', 'button');
    boton.setAttribute('value', 'Borrar todas las respuestas');
	padre.parentNode.insertBefore(boton, padre.nextSibling);
	padre.parentNode.insertBefore(br, padre.nextSibling);

}

function crearBotonEnviarDatos(){  // boton para enviar los datos al servidor...................
	var padre = document.getElementById("crearConsultas");
	var br = document.createElement("br");	
    var boton = document.createElement("input");
    boton.setAttribute('type', 'button');
    boton.setAttribute('value', 'Enviar datos');
	padre.parentNode.insertBefore(boton, padre.nextSibling);
	padre.parentNode.insertBefore(br, padre.nextSibling);

}
function crear(){

	if (numconsulta == 0){		
		crearFechaFinal();
		crearFechaInicio();
		crearConsulta();		
		numconsulta++;		
	}
	else 
		alert('Debes terminar la consulta actual para poder crear otra!!');	
	
}

function Votaciones(){
	crear();	
	

}