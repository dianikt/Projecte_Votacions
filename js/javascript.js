var numconsulta = 0;

 //document.getElementById("demo").innerHTML = "You wrote: " + valor;

function validarCampoVacio(){
	var comprueba = 0;
	
	var consulta = document.getElementById('consulta').value;
	var elementoConsulta = document.getElementById('consulta');
	var fecha_inicio = document.getElementById('fecha_inicio').value;
	var elementoFechaInicio = document.getElementById('fecha_inicio');
	var fecha_final = document.getElementById('fecha_final').value;
	var elementoFechaFinal = document.getElementById('fecha_final');

	if (consulta != '')comprueba++;
	else pintarRojo(elementoConsulta);
	if (fecha_inicio != '')comprueba++;
	else pintarRojo(elementoFechaInicio);
	if (fecha_final != '')comprueba++;
	else pintarRojo(elementoFechaFinal);
	
	if (comprueba==3){		
		elementoConsulta.setAttribute('disabled', 'true');
		elementoFechaInicio.setAttribute('disabled', 'true');
		elementoFechaFinal.setAttribute('disabled','true');
		crearBotonRespuestas();		
	}
	
}

function pintarRojo(elemento){
	elemento.style.borderColor='red';
}

function crearConsulta(){             // crea la consulta cuando le das al boton !! 
	var padre = document.getElementById("crearConsultas");
    var input = document.createElement("input");
    var br = document.createElement("br");
    padre.parentNode.insertBefore(br, padre.nextSibling);
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'consulta');
    input.setAttribute('id', 'consulta');  
    input.setAttribute('onfocusout', 'validarCampoVacio()');    
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
    inputFinal.setAttribute('onfocusout', 'validarCampoVacio()'); 
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
    inputInicio.setAttribute('onfocusout', 'validarCampoVacio()'); 
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