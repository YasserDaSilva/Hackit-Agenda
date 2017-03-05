/** 
 * ===================================================================
 * Main js
 *
 * ------------------------------------------------------------------- 
 */ 

(function($) {

	"use strict";

	/* --------------------------------------------------- */
	/* Preloader
	------------------------------------------------------ */ 
	
    $(window).load(function() {
      // will first fade out the loading animation 
    	$("#loader").fadeOut("slow", function(){

        // will fade out the whole DIV that covers the website.
        $("#preloader").delay(300).fadeOut("slow");

      }); 
  	})


  	/*---------------------------------------------------- */
	/* FitVids
	------------------------------------------------------ */ 
  	$(".fluid-video-wrapper").fitVids();


/*
	/!* --------------------------------------------------- *!/
	/!*  Vegas Slideshow
	------------------------------------------------------ *!/
	$(".home-slides").vegas({
		transition: 'fade',
		transitionDuration: 2500,
		delay: 5000,
    	slides: [
       	{ src: "images/slides/03.jpg" },
        	{ src: "images/slides/02.jpg" },
        	{ src: "images/slides/01.jpg" }
    	]
	});
*/


	/* --------------------------------------------------- */
	/*  Particle JS
	------------------------------------------------------ */
	$('.home-particles').particleground({
	   dotColor: '#fff',
	   lineColor: '#555555',
	   particleRadius: 6,
	   curveLines: true,
	   density: 10000,
	   proximity: 110
	}); 


	/*-----------------------------------------------------*/
	/* tabs
  	-------------------------------------------------------*/	
	$(".tab-content").hide();
	$(".tab-content").first().show();

	$("ul.tabs li").click(function () {
	   $("ul.tabs li").removeClass("active");
	   $(this).addClass("active");
	   $(".tab-content").hide();
	   var activeTab = $(this).attr("data-id");
	   $("#" + activeTab).fadeIn(700);
	});


	/*----------------------------------------------------*/
  	/* Smooth Scrolling
  	------------------------------------------------------*/
  	$('.smoothscroll').on('click', function (e) {
	 	
	 	e.preventDefault();

   	var target = this.hash,
    	$target = $(target);

    	$('html, body').stop().animate({
       	'scrollTop': $target.offset().top
      }, 800, 'swing', function () {
      	window.location.hash = target;
      });

  	});


  	/* --------------------------------------------------- */
	/*  Placeholder Plugin Settings
	------------------------------------------------------ */
	$('input, textarea, select').placeholder()  


  	/*---------------------------------------------------- */
   /* ajaxchimp
	------------------------------------------------------ */

	// Example MailChimp url: http://xxx.xxx.list-manage.com/subscribe/post?u=xxx&id=xxx
	var mailChimpURL = 'www.Hackit-dz.org';

	$('#mc-form').ajaxChimp({

		language: 'es',
	   	url: mailChimpURL

	});

	// Mailchimp translation
	//
	//  Defaults:
	//	 'submit': 'Submitting...',
	//  0: 'We have sent you a confirmation email',
	//  1: 'Please enter a value',
	//  2: 'An email address must contain a single @',
	//  3: 'The domain portion of the email address is invalid (the portion after the @: )',
	//  4: 'The username portion of the email address is invalid (the portion before the @: )',
	//  5: 'This email address looks fake or invalid. Please enter a real email address'

	$.ajaxChimp.translations.es = {
	  'submit': 'Submitting...',
	  0: '<i class="fa fa-check"></i> Thank you for your registration to HackIT, we just sent you a confirmation email !',
	  1: '<i class="fa fa-warning"></i> You must enter a valid e-mail address.',
	  2: '<i class="fa fa-warning"></i> E-mail address is not valid.',
	  3: '<i class="fa fa-warning"></i> E-mail address is not valid.',
	  4: '<i class="fa fa-warning"></i> E-mail address is not valid.',
	  5: '<i class="fa fa-warning"></i> E-mail address is not valid.'
	}




	/*---------------------------------------------------- */
	/*	contact form
	------------------------------------------------------ */

	/* local validation */
	$('#registration_form').validate({

		/* submit via ajax */
		submitHandler: function(form) {

			/*check it.*/
			/*
			var first_name = $("#first_name").val();
			var last_name= $("#last_name").val();
			var email = $("#email").val();
			var phone = $("#phone").val();
			var wilaya1=$("#wilaya1").val();
            var wilaya2=$("#wilaya2").val();
            var linkedin=$("#linkedin").val();
            var github =$("#github").val();
            var first_hackit =$("input[checked]").val();
            var your_self = $("#your_self").val();
            var your_projects=$("#your_projects").val();
			*/


			var sLoader = $('#submit-loader');

			$.ajax({

				type: "POST",
				url: "Ajax/send.php",
				data: $(form).serialize(),
				dataType: 'json',
				beforeSend: function () {
					sLoader.fadeIn();

				},
				success: function (json) {

					// Message was sent
					if (json.reponse == 'OK') {
						sLoader.fadeOut();
						$('#message-warning').hide();
						$('#registration_form').fadeOut();
						$('#message-success').fadeIn();
                        $('#message-success').focus();

					}
							// There was an error
					else {
						sLoader.fadeOut();
						$('#message-warning').html('Error : '+json.reponse);
						$('#message-warning').fadeIn();
						//alert(json.reponse+'  '+json.class_div);
						error(json);
					}

				},
				error: function () {
					sLoader.fadeOut();
					$('#message-warning').html("Something went wrong. Please try again.");
					$('#message-warning').fadeIn();
				}
			});

  		}

	});


	/*----------------------------------------------------*/
	/* Final Countdown Settings
	------------------------------------------------------ */

	$('#formulaire').fadeIn();
	$('#esi').fadeIn();
        $('#map').fadeIn();

		
	var nowDate = new Date();
	if(nowDate.getDate() < '3'){
		
		var finalDate = '2017/03/03';
		$('div#counter').countdown(finalDate)
		    .on('update.countdown', function(event) {

			$(this).html(event.strftime('<div class=\"half\">' +
			    '<span>%D <sup>days</sup></span>' +
			    '<span>%H <sup>hours</sup></span>' +
			    '</div>' +
			    '<div class=\"half\">' +
			    '<span>%M <sup>mins</sup></span>' +
			    '<span>%S <sup>secs</sup></span>' +
			    '</div>'));

		    })
			.on('finish.countdown',function (event) {
				alert('The Registrations are closed.');
				location.reload(true);
		    });
	}else{
		$('#formulaire').fadeOut();
		$('#formulaire_new').fadeOut();
		$('#formulaire_clos').fadeIn();
		$('#speakers').fadeIn();
		finalDate = '2017/03/09 17:00:00 ';
		$('div#counter').countdown(finalDate)
		    .on('update.countdown', function(event) {
			$(this).html(event.strftime('<div class=\"half\">' +
			    '<span>%D <sup>days</sup></span>' +
			    '<span>%H <sup>hours</sup></span>' +
			    '</div>' +
			    '<div class=\"half\">' +
			    '<span>%M <sup>mins</sup></span>' +
			    '<span>%S <sup>secs</sup></span>' +
			    '</div>'));

		    });
	}
	



	/*----------- -----------------------------------------*/
	/* Final Countdown Settings
	 ------------------------------------------------------ */





    function error(json) {

		var class_div = '#'+json.class_div;
		var chi = '.div_'+json.class_div;
		var msg = '<label id="name-error" class="error" for="name">'+json.reponse+'</label>';

		$(class_div).focus();
		$(class_div).css({
			color : 'red'
		});
        $(chi).append(msg);
        $(class_div).on('blur',function () {
            $(class_div).css({
                color : 'black'
            });
            $('#name-error').hide();
        })
    }

    $("#sp1").click(
    	function () {
			alert('General Manager & Founder 2016 till date Connectech LLC. \n ' +
				'Linkedin : " https://www.linkedin.com/in/youcefbelouz/ " ');
        }
	);

    $("#sp2").click(
        function () {
            alert('Senior SharePoint Consultant. \n ' +
				'Linkedin : " https://www.linkedin.com/in/smailbradai/ " ');
        }
    );
    $("#sp3").click(
        function () {
            alert('Partner Channel Development Manager à Microsoft.\n' +
				'Linkedin : " https://www.linkedin.com/in/mounir-lamara-mohammed-789bb719/ " ');
        }
    );
    $("#sp4").click(
        function () {
            alert('Directrice du algerian center for social enterpreneurship LLC.\n' +
				'Linkedin : " https://www.linkedin.com/in/meriem-benslama-2a376432/ " ');
        }
    );
    $("#sp5").click(
        function () {
            alert('Principal Technical Evangelist à Microsoftn.\n' +
				'Linkedin : " https://www.linkedin.com/in/fares-zekri-18b3743/ " ');
        }
    );
    $("#sp6").click(
        function () {
            alert('Azure Premier Field Engineer à Microsoft.\n' +
				'Linkedin : " https://www.linkedin.com/in/airatni/ " ');
        }
    );




})(jQuery);
