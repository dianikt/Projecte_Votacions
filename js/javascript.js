var numconsulta = 0;
var comprueba = 0;
var numRespuestas = 0;
 //document.getElementById("demo").innerHTML = "You wrote: " + valor;

 // Funcion que añade una pregunta en un tag<li> a una lista <ul>
 function nuevaRespuesta()
{
	
	var nuevo = document.getElementById("crear_respuesta").value;

    if(nuevo.length>0) // si esta vacio no creara otro input 
    {
        if(buscarElementoLi(nuevo))
        {
        	
            var li = document.createElement('li');  // creamos el elemento <li>
            li.setAttribute('id', nuevo);
            li.setAttribute('name', 'pregunta');
            li.setAttribute('value', nuevo);
			var textPregunta = document.createTextNode(nuevo);
			var boton = document.createElement('input');	
		    boton.setAttribute('type', 'button');  //creamos el boton para eliminar
			boton.setAttribute('value', 'Eliminar');
			boton.setAttribute('onclick', 'eliminarRespuesta(this)');
			li.appendChild(textPregunta);     //añadimos al <li> los elementos creados 
			li.appendChild(boton);  
            document.getElementById("listaDesordenada").appendChild(li); // y luego a la lista el <li>        	
        	document.getElementById("crear_respuesta").value = ' '; 
        	numRespuestas++;
        }
    }
    if (numRespuestas == 2)crearBotonEnviarDatos();
    return false;
}

//Funcion que busca si existe ya el <li> dentrol del <ul> Devuelve true si no existe.
function buscarElementoLi(contenido)
{
    var lista = document.getElementById("listaDesordenada").getElementsByTagName("li");
    for (var i=0; i<lista.length; i++)
    {
        if(lista[i].value == contenido)
            return false;
    }
    return true;
}

// Funcion para eliminar los elementos
function eliminarRespuesta(elemento)  // recibe el elemento pulsado
{
    var id = elemento.parentNode.getAttribute("id");
    idElemento = document.getElementById(id);
    idElemento.parentNode.removeChild(idElemento);
}

function restarFechas() {
	var fech1 = document.getElementById('fecha_inicio').value;
	var fech2 = document.getElementById('fecha_final').value;

	if((Date.parse(fech1)) > (Date.parse(fech2))){
		return false;
	}else return true;
}

//...................................................................
function crearInputRespuesta(){
	var padre = document.getElementById("inputRespuesta");
	var br = document.createElement("br");
    var input = document.createElement("input");
    input.setAttribute('type', 'text');
    input.setAttribute('id', 'crear_respuesta');   
  	padre.parentNode.insertBefore(input, padre.nextSibling);

} 

//.................................................


function pintarRojo(elemento){
	elemento.style.boxShadow='1px 1px 10px 1px #FA0909';
}
function borrarRojo(elemento){
	elemento.style.boxShadow='';
}

function editar(elemento){
	//alert("entro");
    var elementoConsulta = document.getElementById(elemento);
    elementoConsulta.disabled = false;
    comprueba--;
}


function crearConsulta(){             // crea la consulta cuando le das al boton !! 
	var padre = document.getElementById("crearConsultas");
    var input = document.createElement("input");
    var br = document.createElement("br");
    var icon = document.createElement("img");
    padre.parentNode.insertBefore(br, padre.nextSibling);
    icon.setAttribute('class', 'edit-icon');
    icon.setAttribute('src', 'img/icon-edit.png');
    icon.setAttribute('onclick', 'editar("consulta")');
    padre.parentNode.insertBefore(icon, padre.nextSibling);
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'consulta_enviar');
    input.setAttribute('id', 'consulta');     
    input.setAttribute('onfocusout', 'validarCampoVacio("consulta")');    
    padre.parentNode.insertBefore(input, padre.nextSibling);

	var label = document.createElement("label");
	var insertarTexto = document.createTextNode("Crear consulta: ");
    label.appendChild(insertarTexto);
    padre.parentNode.insertBefore(label, padre.nextSibling);
    validarCampoVacio("consulta");
}



function crearFechaFinal(){         // crea los input de las fechas cuando le das al boton !! 	
	var padre = document.getElementById("crearConsultas");
	var br = document.createElement("br");
    var inputFinal = document.createElement("input");
    var icon = document.createElement("img");
    padre.parentNode.insertBefore(br, padre.nextSibling);
    icon.setAttribute('class', 'edit-icon');
    icon.setAttribute('src', 'img/icon-edit.png');
    icon.setAttribute('onclick', 'editar("fecha_final")');
    padre.parentNode.insertBefore(icon, padre.nextSibling);
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
    var icon = document.createElement("img");
    icon.setAttribute('class', 'edit-icon');
    icon.setAttribute('src', 'img/icon-edit.png');
    icon.setAttribute('onclick', 'editar("fecha_inicio")');
    padre.parentNode.insertBefore(icon, padre.nextSibling);
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


function validarCampoVacio(elemento){
	var consulta = document.getElementById(elemento).value;
	var elementoConsulta = document.getElementById(elemento);

	if (consulta == '') pintarRojo(elementoConsulta);

	else {
        //elementoConsulta.setAttribute('disabled', 'true');
        elementoConsulta.setAttribute('value',consulta);
		borrarRojo(elementoConsulta);
		comprueba++;
	}	
	
	if (comprueba==3){
		var fechas = restarFechas();
		if (!fechas)alert('La fecha inicial no puede ser mayor que la fecha final');		
		else{
			crearBotonRespuestas();	
			}	
	}
}


function crearBotonRespuestas(){
	var padre = document.getElementById("crearRespuesta");
	var br = document.createElement("br");	
    var boton = document.createElement("input");
    boton.setAttribute('type', 'submit');
    boton.setAttribute('value', 'Crear respuesta');
    boton.setAttribute('onclick', 'return nuevaRespuesta()');
	padre.parentNode.insertBefore(boton, padre.nextSibling);
	padre.parentNode.insertBefore(br, padre.nextSibling);
	crearInputRespuesta();	

}

function crearBotonEnviarDatos(){  // boton para enviar los datos al servidor...................
	var padre = document.getElementById("enviarPreguntas");
	var br = document.createElement("br");	
    var boton = document.createElement("input");
    boton.setAttribute('type', 'submit');
    boton.setAttribute('value', 'Enviar preguntas');
	padre.parentNode.insertBefore(boton, padre.nextSibling);
	padre.parentNode.insertBefore(br, padre.nextSibling);

}

function Votaciones()
{
	if (numconsulta == 0){		
		crearFechaFinal();
		crearFechaInicio();
		crearConsulta();		
		numconsulta++;		
	}
	else 
		alert('Debes terminar la consulta actual para poder crear otra!!');	
	
}

