var numconsulta = 0;


function validarCampoVacio(comprobar){
    if(comprobar == '')return false;    	
    else return true;    
}

function Votaciones(){

	if (numconsulta == 0){		
		var fechaFinal = crearFechaFinal();
		var fechaInicio = crearFechaInicio();
		var consulta = crearConsulta();	

		var validarfechaInicio = validarCampoVacio(fechaFinal);	
		var validarfechaFinal = validarCampoVacio(fechaInicio);	
		var validarConsulta = validarCampoVacio(consulta);	
		numconsulta++;		
	}
	else 
		alert('Debes terminar la consulta actual para poder crear otra!!');

	if(validarfechaInicio && validarfechaFinal && validarConsulta){
			crearBotonRespuestas();
		}else alert('Debes rellenar todos los campos!!');	
		
}


function crearConsulta(){             // crea la consulta cuando le das al boton !! 
	var padre = document.getElementById("crearConsultas");
    var input = document.createElement("input");
    var br = document.createElement("br");
    padre.parentNode.insertBefore(br, padre.nextSibling);
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'consulta');
    input.setAttribute('id', 'consulta');     
	padre.parentNode.insertBefore(input, padre.nextSibling);

	var label = document.createElement("label");
	var insertarTexto = document.createTextNode("Crear consulta: ");
    label.appendChild(insertarTexto);
    padre.parentNode.insertBefore(label, padre.nextSibling);

    var campo = document.getElementById('consulta');
    return campo;     
}


function crearFechaFinal(){         // crea los input de las fechas cuando le das al boton !! 	
	var padre = document.getElementById("crearConsultas");
	var br = document.createElement("br");
    var inputFinal = document.createElement("input");
    inputFinal.setAttribute('type', 'date');
    inputFinal.setAttribute('name', 'fecha_final');
    inputFinal.setAttribute('id', 'fecha_final');  
	padre.parentNode.insertBefore(inputFinal, padre.nextSibling);	

	var labelFinal = document.createElement("label");
	var insertarTexto = document.createTextNode("Fecha final: ");
    labelFinal.appendChild(insertarTexto);
    padre.parentNode.insertBefore(labelFinal, padre.nextSibling);
    padre.parentNode.insertBefore(br, padre.nextSibling);

    var fecha_final = document.getElementById('fecha_final');
    return fecha_final;
}
function crearFechaInicio(){
	var padre = document.getElementById("crearConsultas");
	var br = document.createElement("br");
    var inputInicio = document.createElement("input");
    inputInicio.setAttribute('type', 'date');
    inputInicio.setAttribute('name', 'fecha_inicio');
    inputInicio.setAttribute('id', 'fecha_inicio'); 
	padre.parentNode.insertBefore(inputInicio, padre.nextSibling);

	var labelInicio = document.createElement("label");
	var insertarTexto = document.createTextNode("Fecha inicio: ");
    labelInicio.appendChild(insertarTexto);
    padre.parentNode.insertBefore(labelInicio, padre.nextSibling);

    var fecha_inicio = document.getElementById('fecha_inicio');
    return fecha_inicio;	
	
}
function crearBotonRespuestas(){
	var padre = document.getElementById("crearConsultas");
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
/*
	<form method="POST" action="creacioConsultes.php" >	  	
		  		<input type="text" id="pregunta" name="pregunta"><br>
		  		<label>Introduce la fecha de inicio:</label>
		  		<input type="date"  name= "fecha_inicio">
		  		<label>Introduce la fecha final:</label>
		  		<input type="date" name = "fecha_final">
		  		<input type="submit" value="envia" onclick="Votaciones()">
		  	</form>  */