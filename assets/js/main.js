// Mascaras de campo
function tel(v){ 
	if(v.value.length == 0)
		v.value = '(' + v.value;
	if(v.value.length == 3)
		v.value = v.value + ')' ;
	if(v.value.length == 9)
		v.value = v.value + '-' ;
}
function data(v){ 
	if(v.value.length == 2)
		v.value = v.value + '/';
	if(v.value.length == 5)
		v.value = v.value + '/';
}
function mascara(zipcode){
	if(zipcode.value.length == 2)
		zipcode.value = zipcode.value + '.';
	if(zipcode.value.length == 6)
		zipcode.value = zipcode.value + '-';
}

// Menu Escondido
var cont = 0;
$(document).ready(function () {
	$('.menu-bars').click(function () {
		cont++;
		if(cont == 1){
			$('menu').addClass('menu-vai');
			$("menu").addClass("menu-ok");
		} if (cont > 1){
			cont = 0;
			$('menu').removeClass('menu-vai');
			if ($(document).scrollTop() < 100) {
				$("menu").removeClass("menu-ok");
			}
		}
	});
});

// Ancora Scroll
$('.ancora').click(function(){
	cont = 0;
	$('.menuEscondido').removeClass('menu-visible');
	$('.mainPage').removeClass('mainPageActive');
	$('html, body').animate({
		scrollTop: $( $(this).attr('href') ).offset().top
	}, 500);
	return false;
});