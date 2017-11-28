var correcte=true;
var time = 0;
function validar(){
	if(document.getElementById('Nombre').value.length < 2 ){
		correcte = false;
	}
	if(document.getElementById('Mensaje').value.length < 10 ){
		correcte = false;
	}
	var expresion = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;
	var email = document.form1.email.value;
	if (!expresion.test(email)){
		correcte = false;
	}
	if(!document.getElementById('acepto').checked){
		correcte = false;
	}
	if(!correcte){
	alert('Revisa los campos');
	}
	var check1= document.getElementById("acepto");
					if ( check1.checked ) alert("Acepta las condiciones");
					else alert("No aceptes");
	return correcte;
}



window.onload = function () {
    var images = [
		"imagenes/losmasvendidos.jpg",
		"imagenes/camisa1.jpg",
		"imagenes/camisa2.jpg",		     
    ];
    images.current = 0;
    var img = document.getElementById( 'imagen' );
    setInterval(function () {
        img.src = images[ images.current++ ];
        if ( images.current === images.length ) images.current = 0;       
    }, 1000 );
    var images1 = [
		"imagenes/zapatos2.jpg",
		"imagenes/camisa3.jpg",
		"imagenes/camisa4.jpg",		     
    ];
    images1.current = 0;
    var img1 = document.getElementById( 'imagen1' );
    setInterval(function () {
        img1.src = images1[ images1.current++ ];
        if ( images1.current === images1.length ) images1.current = 0;       
    }, 1000 );
	  var images2 = [
		"imagenes/zapatos4.jpg",
		"imagenes/camisa5.jpg",
		"imagenes/ofertasflash.jpg",		     
    ];
    images2.current = 0;
    var img2 = document.getElementById( 'imagen2' );
    setInterval(function () {
        img2.src = images2[ images2.current++ ];
        if ( images2.current === images2.length ) images2.current = 0;       
    }, 1000 );

};


