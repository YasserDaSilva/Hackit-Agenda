jQuery(document).ready(function($){
	var timelineBlocks = $('.cd-timeline-block'),
		offset = 0.8;

	//hide timeline blocks which are outside the viewport
	hideBlocks(timelineBlocks, offset);

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function(){
		(!window.requestAnimationFrame) 
			? setTimeout(function(){ showBlocks(timelineBlocks, offset); }, 100)
			: window.requestAnimationFrame(function(){ showBlocks(timelineBlocks, offset); });
	});

	function hideBlocks(blocks, offset) {
		blocks.each(function(){
			( $(this).offset().top > $(window).scrollTop()+$(window).height()*offset ) && $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		});
	}

	function showBlocks(blocks, offset) {
		blocks.each(function(){
			( $(this).offset().top <= $(window).scrollTop()+$(window).height()*offset && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) && $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
		});
	}
});




// Smooth Scrolling
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


// Show/Hide Inner Timelines

$( ".cd-read-more" ).click(function() {

var Mode = $(this).siblings('p').css('display');
if (Mode == 'block') {
 
  $(this).siblings('p').css("display", "none") ;  
  $(this).siblings('div').css("display", "block") ; 
  $(this).text("Show less") ;

} else {
  $(this).siblings('div').css("display", "none") ;
  $(this).siblings('p').css("display", "block") ;
  $(this).text("Read more") ;

}
});






