jQuery(document).ready(function(){

	var $ = jQuery;

	var sitename = jQuery('meta[name=site_name]').attr("content");

	jQuery('<a href="/" target="_blank" class="view-site">' + sitename + '</a>').prependTo('#wpadminbar');

	jQuery('#user_login').attr( 'placeholder', 'Username' );
	jQuery('#user_pass').attr( 'placeholder', 'Password' );

	var userInput = jQuery('label[for="user_login"] input');
	var passInput = jQuery('label[for="user_pass"] input');

	jQuery('label[for="user_login"]').html(userInput);
	jQuery('label[for="user_pass"]').html(passInput);

	jQuery('ul#adminmenu > li > a, .button').click(function(){
		$(this).addClass('clicked');
	});


	jQuery(document).ready(function($){
	    jQuery('#wpadminbar').find('li.menupop').hover( function(){
	        jQuery(this).toggleClass('hover');
	    });
	    // Bring menu into scope(defined by common.js in wordpress)
	    var menu;
	    // Copy of the function from common.js, just without hoverIntent
	    jQuery('li.wp-has-submenu', menu).hover(
	        function(e){
	            var b, h, o, f, m = jQuery(this).find('.wp-submenu'), menutop, wintop, maxtop;

	            if ( !jQuery(document.body).hasClass('folded') && jQuery(this).hasClass('wp-menu-open') )
	                return;

	            menutop = jQuery(this).offset().top;
	            wintop = jQuery(window).scrollTop();
	            maxtop = menutop - wintop - 30; // max = make the top of the sub almost touch admin bar

	            b = menutop + m.height() + 1; // Bottom offset of the menu
	            h = jQuery('#wpwrap').height(); // Height of the entire page
	            o = 60 + b - h;
	            f = jQuery(window).height() + wintop - 15; // The fold

	            if ( f < (b - o) )
	                o = b - f;

	            if ( o > maxtop )
	                o = maxtop;

	            if ( o > 1 )
	                m.css({'marginTop':'-'+o+'px'});
	            else if ( m.css('marginTop') )
	                m.css({'marginTop':''});

	            m.addClass('sub-open');
	        },
	        function(){
	            jQuery(this).find('.wp-submenu').removeClass('sub-open');
	        }
	    );
	});

});