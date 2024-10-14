( function( $ ) {

	$( function() {

		$( '.section-home.widget_welcart_bestseller ul,.section-home.widget_welcart_featured ul' ).slick({
			slidesToShow: 2,
			slidesToScroll: 1,
			autoplay: false,
			centerMode: false,
			arrows: false,
			speed: 600,
			focusOnSelect: false,
			mobileFirst: true,
			responsive: [{
				breakpoint: 620,
				settings: {
						slidesToShow: 5,
						slidesToScroll: 1,
						arrows: true,
					}
				}]
		});

		var column = $('.section-home.widget_mode_item_list .entrybody').data('column');
		$( '.widget_mode_item_list .entrybody' ).slick({
			slidesToShow: 2,
			slidesToScroll: 1,
			autoplay: false,
			centerMode: false,
			arrows: false,
			speed: 600,
			focusOnSelect: false,
			mobileFirst: true,
			responsive: [{
				breakpoint: 620,
				settings: {
						slidesToShow: column,
						slidesToScroll: 1,
						arrows: true,
					}
				}]
		});


	});



} )( jQuery );