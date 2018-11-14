jQuery(document).ready(function( $ ) {


	/* ------------------------------------------------
	 AJAX Functions
	------------------------------------------------ */

	$.ajaxSetup({cache:false});

	// Tab Page AJAX
    $(".girt_timeline-container a").click(function(){
		$(".girt_timeline-image").slideUp("fast", function() {
			$(this).remove();
		});

		$(".girt_timeline-container a").removeClass("active");
		$(this).addClass("active");

		var post_link = $(this).attr("href");

		$("#girt_tab-page-container").html("<div class='loading-icon'></div>");

        $("#girt_tab-page-container").load(post_link + " #girt_tab-content-result", function(){
			history.pushState(null, null, post_link);
			$(".coverflow").flipster({
				loop: true,
				style: 'carousel',
			});
		}
		);

		$("html, body").animate({
        	scrollTop: $("#girt_timeline-anchor").offset().top - 101
    	}, 500);
        return false;
    });


	// Gallery AJAX
    $(document).on('click', '.girt_gallery-nav-item-link', function(event){
		event.preventDefault();
		var post_link = $(this).attr('href');
		$( '.girt_gallery-nav' ).fadeOut( 'slow', function() {
			$('#girt_gallery-result').html('<div class="loading-icon"></div>');
			$('#girt_gallery-result').load(post_link + '#girt_gallery', function(){


		$('.girt_gallery-content').fadeIn( 'slow', function() {});
				$('.girt_gallery-content-wrap').fadeIn( 'slow', function() {});
									   } );
		});


        return false;
    });

	// Campaign page AJAX
	$('.girt_campaign-nav a').on('click', function(){
		$(this).addClass('active');
		var post_link = $(this).attr('href');
        $('.girt_campaign-placeholder').html('<div class="loading-icon"></div>');
		$('.girt_campaign-placeholder').load(post_link + " #girt_campaign-content-result" );
		$("html, body").animate({
        	scrollTop: $(".girt_campaign-placeholder").offset().top - 101
    	}, 500);
        return false;
    });

	// Event category filters
	$('#filter').submit(function(){
		var filter = $('#filter');
		$.ajax({
			url:filter.attr('action'),
			data:filter.serialize(),
			type:filter.attr('method'),
			beforeSend:function(xhr){
				filter.find('button').text('Processing...');
			},
			success:function(data){
				filter.find('button').text('Apply filter');
				$('#response').html(data);
			}
		});
		return false;
	});

	// Show/Hide Event Days

	$(':checkbox').change(function() {
		var day = $(this).next('label').text();

		$( ".girt_multi-day-title-" + day ).toggleClass( "hidden");
		$( ".girt_multi-day-" + day ).toggleClass( "hidden");
		$( ".girt_multi-day-title-" + day ).toggleClass( "show");
		$( ".girt_multi-day-" + day ).toggleClass( "show");

		$('.type-multi').each(function() {
        	var $headings = $('h1', $(this)),
			$hiddenHeadings = $('h1.hidden', $(this));

		  if ($headings.length === $hiddenHeadings.length) {
			  $(this).addClass('hidden');
			  $(this).removeClass('show');
		  } else {
			  $(this).addClass('show');
			  $(this).removeClass('hidden');
		  }
		})

	});




	/* ------------------------------------------------
	 Gallery Functions
	------------------------------------------------ */

	$(document).on('click', '.girt_close-gallery-item', function(event){
		event.preventDefault();
		$( '.girt_gallery-nav' ).fadeIn( 'fast', function() {});
		$('#girt_gallery-result').fadeOut( 'fast', function() {});
		$('#girt_gallery-result').html('');
		$('#girt_gallery-result').fadeIn( 'fast', function() {});
	});

	/* ------------------------------------------------
	 Mobile related Functions
	------------------------------------------------ */

	// Mobile Menu Toggle
	$('.girt_mobile-menu-toggle').click(function(){
		$('body').toggleClass('girt_mobile-menu-open');
	});
	$('.girt_global-nav a').click(function(){
		$('body').removeClass('girt_mobile-menu-open');
	});


	/* ------------------------------------------------
	 Event Functions
	------------------------------------------------ */

	// Open event content
	$(document).on('click', '.girt_event-excerpt-cont', function() {
		if( $(this).hasClass('active')) {
			$(this).find('.girt_event-content-cont').hide('fast');
		} else {
			$(this).find('.girt_event-content-cont').show('fast');
		}
		$(this).toggleClass('active');
	});

	// Submit form on tick
	$(function(){
    	$('.styled-checkbox').on('change',function(){
            $('#filter').submit();
        });
    });


	/* ------------------------------------------------
	 Scroll Functions
	------------------------------------------------ */

	$(document).on('click', '.home .girt_global-nav li.scrollto a', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($(this).prop('hash')).offset().top - 101
        }, 500);
    });



	// Timeline Content

	$(document).on('click', '.layout_timeline_sections li .girt_timeline-titles', function (event){
		$('.layout_timeline_sections li').addClass('hide');
		$(this).parents('.layout_timeline_sections li').addClass('active');
		$(this).next('.girt_timeline-item-content').show('fast');
		$('.girt_tab-content-timeline').addClass('active');
		event.preventDefault();
	});
	$(document).on('click', '.layout_timeline_sections li button', function (event){
		$('.layout_timeline_sections li').removeClass('hide');
		$(this).parents('.layout_timeline_sections li').removeClass('active');
		$(this).parent('.girt_timeline-item-content').hide('fast');
		$('.girt_tab-content-timeline').removeClass('active');
		$('html, body').animate({
			scrollTop: $($.attr(this, '.parent')).offset().top - 160
		}, 500);
		event.preventDefault();
	});


	// Timeline Tabs
	$(document).on('click', '.girt_timeline-nav a', function (event){
		event.preventDefault();
		var id = $(this).data('nav');
		$('.layout_timeline_sections').css("display", "none");
		$('#girt_timeline-section-' + id).fadeIn('slow');
		$(this).parent().parent().find('li.active').removeClass('active');
    	$(this).parent().addClass('active');
	});


	$(".coverflow").flipster();


	/* Hide empty parent multi day event */

	$("#lightSlider").lightSlider({
		item:1,
		mode:"fade",
		auto:true,
		loop:true,
		pause: 4000,
		controls: false,
		pager: false,
	});

	/* ------------------------------------------------
	 Tab Navigation Functions
	------------------------------------------------ */

	$(document).on('click', '.girt_tab-nav a[href^="#"]', function (event) {
    	event.preventDefault();
		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top - 160
		}, 500);
	});

	$(document).on("scroll", onScroll);
		function onScroll(event){
			event.preventDefault();
			var scrollPos = $(document).scrollTop() + 200;
			$('.girt_tab-nav a').each(function () {
				var currLink = $(this);
				var refElement = $(currLink.attr("href"));
				if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
					$('.girt_tab-nav li a').removeClass("active");
					currLink.addClass("active");
				}
				else {
					currLink.removeClass("active");
				}
			});
		}
 	});
