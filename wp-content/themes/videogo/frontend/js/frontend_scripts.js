jQuery(document).ready(function($) {
	
	"use strict";
	
	/* Owl Carousel Script */
	if ($(".side-featured-slider").length) {
		$(".side-featured-slider").owlCarousel({
			navigation : true, // Show next and prev buttons
			pagination: false,
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true
		});
	}
	/* Accordion Toggle */
	$('a.accordion-toggle').click(function(e) {
        e.preventDefault();
        if(!$(this).parent().hasClass('active')) {
            $('.accordion-heading').removeClass('active');
            $('.accordion-body').removeClass('active');
            $(this).parent().addClass('active').next().addClass('active');
        } else {
            $('.accordion-heading').removeClass('active');
            $('.accordion-body').removeClass('active');
        }
    });
	
	/* Search Form Hide */
	$('#search-box-form').hide();
    /* Search Form Show */
    $('a.btn-search').click(function () {
        $('#search-box-form').toggle('slide');
    });
    $('a.crose').click(function () {
        $('#search-box-form').toggle('slide');
    });	
	
	/* Nav Open Class On Hover */
	$(".navbar-inner ul >li").hover(
		function() {
			$(this).addClass('open');
		},
		function() {
			$(this).removeClass('open');
		}
	);
	
});