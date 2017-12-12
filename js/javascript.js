var numconsulta = 0;
var comprueba = 0;
var crearBotones = true;
var numRespuestas = 0;
var contador = 0;
var today = obtenerFechaActual();
function obtenerFechaActual(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    return today;
}
 //document.getElementById("demo").innerHTML = "You wrote: " + valor;

 // Funcion que añade una pregunta en un tag<li> a una lista <ul>
 function nuevaRespuesta()
{
	
	var nuevo = document.getElementById("crear_respuesta").value;
    if(nuevo.length>0) // si esta vacio no creara otro input
    {
        if(buscarElementoLi(nuevo))
        {
        	contador++;        	
            var li = document.createElement('li');  // creamos el elemento <li>
            li.setAttribute('id', contador);

            var input = document.createElement('input');
            var textPregunta = document.createTextNode(nuevo);

            input.setAttribute('type', 'text');
   			input.setAttribute('name', 'respuesta'+contador);  
   			input.setAttribute('value', nuevo);

			
			var boton = document.createElement('input');	
		    boton.setAttribute('type', 'button');  //creamos el boton para eliminar
			boton.setAttribute('value', 'Eliminar');
            boton.setAttribute('onclick', 'eliminarRespuesta(this)');

            var botonSubir = document.createElement('input');
            botonSubir.setAttribute('type', 'button');  //creamos el boton para subir la respuesta
            botonSubir.setAttribute('id', 'subirRespuesta'+contador);
            botonSubir.setAttribute('value', 'Subir');
            botonSubir.setAttribute('onclick', 'subirRespuesta('+contador+')');

            var botonBajar = document.createElement('input');
            botonBajar.setAttribute('type', 'button');  //creamos el boton para bajar la respuesta
            botonBajar.setAttribute('id', 'bajarRespuesta'+contador);
            botonBajar.setAttribute('value', 'Bajar');
            botonBajar.setAttribute('onclick', 'bajarRespuesta('+contador+')');


            li.appendChild(input);     //añadimos al <li> los elementos creados
            li.appendChild(boton);
            li.appendChild(botonSubir);
            li.appendChild(botonBajar);

            document.getElementById("listaDesordenada").appendChild(li); // y luego a la lista el <li>


            var audio = carga_sonido(1); // cargamos el sonido de giro 
            audio.play();

            document.getElementById("crear_respuesta").value = ' ';
        	numRespuestas++;
            if(numRespuestas==2){
                crearBotonEnviarDatos();
            }
            correcto("Respuesta creada correctamente!")
        }
    }
    else{
        error("No puedes crear una respuesta vacia!")

    }
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
function bajarRespuesta(elemento) {
    var linea=document.getElementById(elemento);
    var cloneLinea = linea.cloneNode(true);
    var padre = document.getElementById("listaDesordenada");
    if(elemento==(padre.getElementsByTagName("li").length)){
        error("Es el ultimo de la lista, no se puede bajar!");
    }
    else{
        padre.removeChild(padre.childNodes[elemento-1]);
        padre.insertBefore(cloneLinea, padre.childNodes[elemento]);
        document.getElementById('subirRespuesta'+elemento).setAttribute('onclick','subirRespuesta('+(elemento+1)+')');
        document.getElementById('bajarRespuesta'+elemento).setAttribute('onclick','bajarRespuesta('+(elemento+1)+')');
        document.getElementsByName('respuesta'+elemento)[0].setAttribute('name','respuesta'+(elemento+1));


        document.getElementById('subirRespuesta'+(elemento+1)).setAttribute('onclick','subirRespuesta('+(elemento)+')');
        document.getElementById('bajarRespuesta'+(elemento+1)).setAttribute('onclick','bajarRespuesta('+(elemento)+')');
        document.getElementsByName('respuesta'+(elemento+1))[0].setAttribute('name','respuesta'+(elemento));


        document.getElementById('subirRespuesta'+elemento).setAttribute('id','subirRespuesta'+(elemento+1));
        document.getElementById('bajarRespuesta'+elemento).setAttribute('id','bajarRespuesta'+(elemento+1));


        document.getElementById('subirRespuesta'+(elemento+1)).setAttribute('id','subirRespuesta'+(elemento));
        document.getElementById('bajarRespuesta'+(elemento+1)).setAttribute('id','bajarRespuesta'+(elemento));

        document.getElementById(elemento).setAttribute('id',(elemento+1));
        document.getElementById(elemento+1).setAttribute('id',(elemento));




    }


}
function subirRespuesta(elemento) {
    var linea=document.getElementById(elemento);
    var cloneLinea = linea.cloneNode(true);
    var padre = document.getElementById("listaDesordenada");
    if(elemento==1){
        error("Es el primero de la lista, no se puede subir!");
    }
    else{
        padre.removeChild(padre.childNodes[elemento-1]);
        padre.insertBefore(cloneLinea, padre.childNodes[elemento-2]);

        document.getElementById('subirRespuesta'+(elemento-1)).setAttribute('onclick','subirRespuesta('+(elemento)+')');
        document.getElementById('bajarRespuesta'+(elemento-1)).setAttribute('onclick','bajarRespuesta('+(elemento)+')');
        document.getElementsByName('respuesta'+(elemento-1))[0].setAttribute('name','respuesta'+(elemento));

        document.getElementById('subirRespuesta'+elemento).setAttribute('onclick','subirRespuesta('+(elemento-1)+')');
        document.getElementById('bajarRespuesta'+elemento).setAttribute('onclick','bajarRespuesta('+(elemento-1)+')');
        document.getElementsByName('respuesta'+elemento)[0].setAttribute('name','respuesta'+(elemento-1));



        document.getElementById('subirRespuesta'+(elemento-1)).setAttribute('id','subirRespuesta'+(elemento));
        document.getElementById('bajarRespuesta'+(elemento-1)).setAttribute('id','bajarRespuesta'+(elemento));


        document.getElementById('subirRespuesta'+elemento).setAttribute('id','subirRespuesta'+(elemento-1));
        document.getElementById('bajarRespuesta'+elemento).setAttribute('id','bajarRespuesta'+(elemento-1));


        document.getElementById(elemento-1).setAttribute('id',(elemento));
        document.getElementById(elemento).setAttribute('id',(elemento-1));

    }
}

// Funcion para eliminar los elementos
function eliminarRespuesta(elemento)  // recibe el elemento pulsado
{
    var id = elemento.parentNode.getAttribute("id");
    idElemento = document.getElementById(id);
    idElemento.parentNode.removeChild(idElemento);
    numRespuestas--;
    if(numRespuestas<2){
        borrarEnviarDatos();
    }
    correcto("Respuesta eliminada correctamente!")
}

function restarFechas() { //comprueba que la fecha de inicio no sea mayor que la final 
	var fech1 = document.getElementById('fecha_inicio').value;
	var fech2 = document.getElementById('fecha_final').value;

    if((Date.parse(today)) > (Date.parse(fech1))){
        return 1;
    }
	else if((Date.parse(fech1)) <= (Date.parse(fech2))) {
        return 2;
    }
    else return 0;
}

// crea el input de respuesta
function crearInputRespuesta(){
	var padre = document.getElementById("inputRespuesta");
	var br = document.createElement("br");
    var input = document.createElement("input");
    input.setAttribute('type', 'text');
    input.setAttribute('id', 'crear_respuesta');   
  	padre.insertBefore(input, padre.childNodes[0]);

} 


//pone el borde en rojo cuando detecta que esta vacio
function pintarRojo(elemento){
	elemento.style.boxShadow='1px 1px 10px 1px #FA0909';
}
function borrarRojo(elemento){ // quita el border rojo
	elemento.style.boxShadow='';
}
function borrarEnviarDatos(){
    var botonEnviar = document.getElementById("enviarPreguntas");
    while (botonEnviar.firstChild) {
        botonEnviar.removeChild(botonEnviar.firstChild);
    }
}
function borrarRespuestas(){
    var listaRes = document.getElementById("listaDesordenada");
    if(listaRes.length==0){
       error("No puedes hacer eso, no hay respuestas a eliminar!");
    }
    else {
        while (listaRes.firstChild) {
            listaRes.removeChild(listaRes.firstChild);
        }
        borrarEnviarDatos();
        numRespuestas = 0;
        correcto("Respuestas eliminadas correctamente!")
    }
}

function editar(elemento){
    if(elemento=="consulta"){
        var edit = document.getElementById("icon0");
        var consulta = document.getElementById("consulta");
        consulta.disabled = false;
        edit.disabled = false;
        comprueba--;
    }
    else if(elemento=="fecha_inicio"){
        var edit = document.getElementById("icon1");
        var fecha_inicio = document.getElementById("fecha_inicio");
        fecha_inicio.disabled = false;
        edit.disabled = false;
        comprueba--;

    }
    else if(elemento=="fecha_final"){
        var edit = document.getElementById("icon2");
        var fecha_final = document.getElementById("fecha_final");
        fecha_final.disabled = false;
        edit.disabled = false;
        comprueba--;
    }
}


function crearConsulta(){             // crea la consulta cuando le das al boton !! 
	var padre = document.getElementById("crearConsultas");
    var input = document.createElement("input");
    var br = document.createElement("br");
    var icon = document.createElement("img");
    padre.parentNode.insertBefore(br, padre.nextSibling);
    icon.setAttribute('id', 'icon0');
    icon.setAttribute('class', 'edit-icon');
    icon.setAttribute('src', 'img/icon-edit.png');
    icon.disabled = true;
    icon.setAttribute('onclick', 'editar("consulta")');
    padre.parentNode.insertBefore(icon, padre.nextSibling);
    input.required = true;
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'consulta_enviar');
    input.setAttribute('id', 'consulta');     
    input.setAttribute('onfocusout', 'validarCampoVacio()');
    padre.parentNode.insertBefore(input, padre.nextSibling);

	var label = document.createElement("label");
	var insertarTexto = document.createTextNode("Crear consulta: ");
    label.appendChild(insertarTexto);
    padre.parentNode.insertBefore(label, padre.nextSibling);
    
}

function crearBotonEliminarRespuestas() {
    var padre = document.getElementById("crearRespuesta");
    var boton = document.createElement("input");
    boton.setAttribute('type', 'button');
    boton.setAttribute('value', 'Borrar respuestas');
    boton.setAttribute('onclick', 'borrarRespuestas()');
    padre.insertBefore(boton, padre.childNodes[0]);
}



function crearFechaFinal(){         // crea los input de las fechas cuando le das al boton !! 	
	var padre = document.getElementById("crearConsultas");
	var br = document.createElement("br");
    var inputFinal = document.createElement("input");
    var icon = document.createElement("img");
    padre.parentNode.insertBefore(br, padre.nextSibling);
    icon.setAttribute('id', 'icon2');
    icon.setAttribute('class', 'edit-icon');
    icon.setAttribute('src', 'img/icon-edit.png');
    icon.disabled = true;
    icon.setAttribute('onclick', 'editar("fecha_final")');
    padre.parentNode.insertBefore(icon, padre.nextSibling);
    inputFinal.required = true;
    inputFinal.setAttribute('type', 'date');
    inputFinal.setAttribute('name', 'fecha_final');
    inputFinal.setAttribute('id', 'fecha_final'); 
    inputFinal.setAttribute('onfocusout', 'validarFechaFin()');
    padre.parentNode.insertBefore(inputFinal, padre.nextSibling);	

	var labelFinal = document.createElement("label");
	var insertarTexto = document.createTextNode("Fecha final: ");
    labelFinal.appendChild(insertarTexto);
    padre.parentNode.insertBefore(labelFinal, padre.nextSibling);
    padre.parentNode.insertBefore(br, padre.nextSibling);

}

function crearFechaInicio(){  // crea los input de las fechas cuando le das al boton !! 
	var padre = document.getElementById("crearConsultas");
	var br = document.createElement("br");
    var inputInicio = document.createElement("input");
    var icon = document.createElement("img");
    icon.setAttribute('id', 'icon1');
    icon.setAttribute('class', 'edit-icon');
    icon.setAttribute('src', 'img/icon-edit.png');
    icon.disabled = true;
    icon.setAttribute('onclick', 'editar("fecha_inicio")');
    padre.parentNode.insertBefore(icon, padre.nextSibling);
    inputInicio.required = true;
    inputInicio.setAttribute('type', 'date');
    inputInicio.setAttribute('name', 'fecha_inicio');
    inputInicio.setAttribute('id', 'fecha_inicio');     
    inputInicio.setAttribute('onfocusout', 'validarFechaIni()');
  	padre.parentNode.insertBefore(inputInicio, padre.nextSibling);

	var labelInicio = document.createElement("label");
	var insertarTexto = document.createTextNode("Fecha inicio: ");
    labelInicio.appendChild(insertarTexto);
    padre.parentNode.insertBefore(labelInicio, padre.nextSibling); 	
	
}
function validarCampos() {
    if((comprueba==3 )&& (crearBotones==true)){
        crearBotonRespuestas();
        crearBotones = false;
    }
}

function validarFechaIni(){
    var fechaIni = document.getElementById("fecha_inicio").value;
    var elementoConsulta = document.getElementById("fecha_inicio");
    var edit = document.getElementById("icon1");//Icono de habilitar editar campo
    if(today >= fechaIni){
        error('La fecha inicial no puede ser inferior o igual a la fecha actual!');
        pintarRojo(elementoConsulta);
    }
    else{
        borrarRojo(elementoConsulta);
        elementoConsulta.disabled = true;
        edit.disabled = false;
        correcto("Correcto!");
        comprueba++;
        validarCampos();
    }
}
function validarFechaFin(){
    var fechaFin = document.getElementById("fecha_final").value;
    var fechaIni = document.getElementById("fecha_inicio").value;
    var edit = document.getElementById("icon2");
    var elementoConsulta = document.getElementById("fecha_final");
    if(fechaFin <= fechaIni){
        error('La fecha final tiene que ser mayor a la fecha inicial!');
        pintarRojo(elementoConsulta);
    }
    else{
        borrarRojo(elementoConsulta);
        elementoConsulta.disabled = true;
        edit.disabled = false;
        correcto("Correcto!");
        comprueba++;
        validarCampos();
    }
}


function validarCampoVacio(){
	var consulta = document.getElementById("consulta").value;
	var elementoConsulta = document.getElementById("consulta");
    var edit = document.getElementById("icon0");
    if (consulta == '') {
        error('El campo no puede estar vacio!');
        pintarRojo(elementoConsulta);
    }

	else {
        elementoConsulta.setAttribute('value',consulta);
        borrarRojo(elementoConsulta);
        elementoConsulta.disabled = true;
        edit.disabled = false;
        correcto("Correcto!");
        comprueba++;
        validarCampos();
    }
}


function crearBotonRespuestas(){ // crea el boton para añadir respuestas
    crearBotonEliminarRespuestas();
    var padre = document.getElementById("crearRespuesta");
    var br = document.createElement("br");
    var boton = document.createElement("input");
    boton.setAttribute('type', 'submit');
    boton.setAttribute('value', 'Crear respuesta');
    boton.setAttribute('onclick', 'return nuevaRespuesta()');
	padre.insertBefore(boton, padre.childNodes[0]);
    padre.insertBefore(br, padre.childNodes[0]);
    crearInputRespuesta();
}

function crearBotonEnviarDatos(){  // boton para enviar los datos al servidor
	var padre = document.getElementById("enviarPreguntas");
	var br = document.createElement("br");	
    var boton = document.createElement("input");
    boton.setAttribute('type', 'submit');
    boton.setAttribute('value', 'Enviar pregunta');
    boton.setAttribute('onclick', 'habilitarDatos()');
	padre.insertBefore(boton, padre.childNodes[0]);
	padre.insertBefore(br, padre.childNodes[0]);
}

function habilitarDatos() {
    document.getElementById("consulta").disabled = false;
    document.getElementById("fecha_inicio").disabled = false;
    document.getElementById("fecha_final").disabled = false;
}

function Votaciones()
{
	if (numconsulta == 0){		
		crearFechaFinal();
		crearFechaInicio();
		crearConsulta();

		numconsulta++;		
	}
	else if(numconsulta>0){
        error('Debes terminar la consulta actual para poder crear otra!!');
    }
	
}

function carga_sonido(audio){ //crea y devuelve los sonidos
    var audio;
    if ( audio == 1) var audio = new Audio('sonidos/GIRAR.WAV');
    else if ( audio == 2) var audio = new Audio('sonidos/FALLAR.WAV');
    else if ( audio == 3) var audio = new Audio('sonidos/VICTORY.WAV');    
    return audio;
}

function desvanecer(id) {
    closeBtn(id,2000);
}

function closeBtn(id,time) {
    var padre = document.getElementById(id);
    setTimeout(function(){padre.style = "opacity: 0;";},time/1.5);
    setTimeout(function () {
        while (padre.firstChild) {
            padre.removeChild(padre.firstChild);
        }
        padre.removeAttribute('class');
        padre.removeAttribute('style');
    },time);
}

function error(mensaje){
    var padre = document.getElementById("error");
    var span = document.createElement("span");
    var strong = document.createElement("strong");
    padre.innerHTML = ''+mensaje;
    padre.setAttribute('class', 'alert');
    span.setAttribute('class', 'closebtn');
    span.setAttribute('onclick', 'closeBtn("error",500)');
    span.innerHTML ='&times;';
    strong.innerHTML = "Error!";
    padre.insertBefore(strong, padre.childNodes[0]);
    padre.insertBefore(span, padre.childNodes[0]);
    desvanecer("error");
}

function correcto(mensaje){
    var padre = document.getElementById("correcto");
    var span = document.createElement("span");
    var strong = document.createElement("strong");
    padre.setAttribute('class', 'alert success');
    span.setAttribute('class', 'closebtn');
    span.setAttribute('onclick', 'closeBtn("correcto",500)');
    span.innerHTML ='&times;';
    strong.innerHTML = mensaje;
    padre.insertBefore(strong, padre.childNodes[0]);
    padre.insertBefore(span, padre.childNodes[0]);
    desvanecer("correcto");
}
