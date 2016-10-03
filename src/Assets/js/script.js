initialSetup();

lookStatus();

$('#vertical-menu').transition('fade');

$( window ).resize(lookStatus);

$(".send-data").click(function(){
	disablePage();
	setTimeout(formSubmit, 500);
});

$( ".form" ).submit(function( event ) {
  disablePage();
});

$("a").click(function(){
	if ($(this).hasClass('no-disable')) {
		//Do nothing
	} else {
		disablePage();
	}
});

$('.ui.dropdown')
  .dropdown()
;

$('.ui.checkbox')
  .checkbox()
;

$('.pop')
  .popup()
;

setTimeout(function(){
	$('.temp-msg').fadeOut();
}, 5000);

$('#close-msg').click(function(){
	$('#msg').fadeOut();
});

$('#check_all').click(function(){
	$(".checkable").prop('checked', true);
});

$('#uncheck_all').click(function(){
	$(".checkable").prop('checked', false);
});

function enablePage() {
	enableButtons();
	hideDimmer();
}

function disablePage() {
	showDimmer();
	disableButtons();
}

function showDimmer() {
	$("body").dimmer('show');
}

function hideDimmer() {
	$("body").dimmer('hide');
}

function disableButtons() {
	$(".button").addClass("loading");
	$(".button").addClass("disabled");
}

function enableButtons() {
	$(".button").removeClass("loading");
	$(".button").removeClass("disabled");
}

function initialSetup() {
	$( "#menu" ).click(function() {
		$('.ui.sidebar').sidebar('toggle');
	});
	$("body").dimmer({closable: false});
}


function setSidebarMode(mode){

	var containerPadding = 150;

	if(mode == 'mobile'){

		$('#menu').fadeIn(500);

		$(".menu-pusher").css("padding-left", 0);

		$('#account_button').removeClass('labeled');
		$('#account_text').hide();

		$('.responsive-button').removeClass('labeled');
		$('.responsive-text').hide();

		$('#breadcrumb').fadeOut();

		$('.ui.sidebar').sidebar('setting', { closable: true, dimPage: false, transition: 'overlay'});
		$('.ui.sidebar').sidebar('hide');

	} else if(mode == 'desktop'){

		$('#menu').hide();

		$(".menu-pusher").css("padding-left", 212);

		$('.responsive-button').addClass('labeled');
		$('.responsive-text').show();

		$('#breadcrumb').fadeIn();

		$('.ui.sidebar').sidebar('setting', { closable: false, dimPage: false, transition: 'overlay'});
		$('.ui.sidebar').sidebar('show');

	}
}

function lookStatus() {
    var currentWidth = $( window ).width();
	if(currentWidth < 991) {
		setSidebarMode('mobile');
	} else {
		setSidebarMode('desktop');
	}
}
