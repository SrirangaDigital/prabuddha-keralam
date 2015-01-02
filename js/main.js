jQuery(document).ready(function($){
	//open-close submenu on mobile
	$('.cd-main-nav').on('click', function(event){
		if($(event.target).is('.cd-main-nav')) $(this).children('ul').toggleClass('is-visible');
	});

	// browser window scroll (in pixels) after which the "menu" link is shown
	var offset = 80;

	var navigationContainer = $('#cd-sec-nav'),
		mainNavigation = navigationContainer.find('#cd-sec-main-nav ul');

	//hide or show the "menu" link
	checkMenu();
	$(window).scroll(function(){
		checkMenu();
	});

	//open or close the menu clicking on the bottom "menu" link
	$('.cd-sec-nav-trigger').on('click', function(){
		$(this).toggleClass('menu-is-open');
		//we need to remove the transitionEnd event handler (we add it when scolling up with the menu open)
		mainNavigation.off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend').toggleClass('is-visible');

	});

	function checkMenu() {
		if( $(window).scrollTop() > offset && !navigationContainer.hasClass('is-fixed')) {
			navigationContainer.addClass('is-fixed').find('.cd-sec-nav-trigger').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
				mainNavigation.addClass('has-transitions');
			});
		} else if ($(window).scrollTop() <= offset) {
			//check if the menu is open when scrolling up
			if( mainNavigation.hasClass('is-visible')  && !$('html').hasClass('no-csstransitions') ) {
				//close the menu with animation
				mainNavigation.addClass('is-hidden').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
					//wait for the menu to be closed and do the rest
					mainNavigation.removeClass('is-visible is-hidden has-transitions');
					navigationContainer.removeClass('is-fixed');
					$('.cd-sec-nav-trigger').removeClass('menu-is-open');
				});
			//check if the menu is open when scrolling up - fallback if transitions are not supported
			} else if( mainNavigation.hasClass('is-visible')  && $('html').hasClass('no-csstransitions') ) {
					mainNavigation.removeClass('is-visible has-transitions');
					navigationContainer.removeClass('is-fixed');
					$('.cd-sec-nav-trigger').removeClass('menu-is-open');
			//scrolling up with menu closed
			} else {
				navigationContainer.removeClass('is-fixed');
				mainNavigation.removeClass('has-transitions');
			}
		} 
	}

	$('nav a[href^="#"], .moreNav[href^="#"]').on("click", function(e) {
        e.preventDefault();
        var t = $(this.hash);
        $("body,html").animate({
            scrollTop: t.offset().top
        }, 900, "swing")
    });

    $('.clickYear').on("click", function(e) {

    	var clickedYear = this;
        var volume = $( clickedYear ).attr('data-volume');

		$.ajax({
			type: "POST",
			url: "get-parts.php?volume=" + volume,
			dataType: "html",
			success: function(res){

				$( '.cd-container' ).find( '.active' ).removeClass( 'active' );
				$( '.cd-container' ).find( '.issueHolder' ).slideUp( 50 );
				$( '.cd-container' ).find( '.issueHolder' ).remove( );

				$( clickedYear ).parent( '.year' ).after(res);
				$( clickedYear ).toggleClass( 'active' );
				$( '#issueHolder' ).slideDown( 250 );
			},
			error: function(e){
				
			}
		});
    });
});
