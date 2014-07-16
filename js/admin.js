jQuery(document).ready(function(){

	var $ = jQuery;

	$('<a href="/" class="view-site"></a>').prependTo('#wpadminbar')


	// if ($('select').parents('#woocommerce-product-data, #post-body').length) {

	// }

	// else {

	// 	$("select").chosen({
	// 		disable_search: true,
	// 		inherit_select_classes: true
	// 	});

	// 	$("select").on(function(e){
	// 		e.this.chosen({
	// 			disable_search: true,
	// 			inherit_select_classes: true
	// 		});
	// 	});

	// 	$('#add_field').click(function(){
	// 		$("select").chosen({
	// 			disable_search: true,
	// 			inherit_select_classes: true
	// 		});
	// 	});

	// }





	jQuery(document).ready(function($){
	    $('#wpadminbar').find('li.menupop').hover( function(){
	        $(this).toggleClass('hover');
	    });
	    // Bring menu into scope(defined by common.js in wordpress)
	    var menu;
	    // Copy of the function from common.js, just without hoverIntent
	    $('li.wp-has-submenu', menu).hover(
	        function(e){
	            var b, h, o, f, m = $(this).find('.wp-submenu'), menutop, wintop, maxtop;

	            if ( !$(document.body).hasClass('folded') && $(this).hasClass('wp-menu-open') )
	                return;

	            menutop = $(this).offset().top;
	            wintop = $(window).scrollTop();
	            maxtop = menutop - wintop - 30; // max = make the top of the sub almost touch admin bar

	            b = menutop + m.height() + 1; // Bottom offset of the menu
	            h = $('#wpwrap').height(); // Height of the entire page
	            o = 60 + b - h;
	            f = $(window).height() + wintop - 15; // The fold

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
	            $(this).find('.wp-submenu').removeClass('sub-open');
	        }
	    );
	});


	// jQuery("input[type=checkbox]").altCheckbox();

	// jQuery("body.edit-php div#wpbody").addClass("simple-view");

	// jQuery(".wp-list-table th.check-column").css('display','table-cell');

	// jQuery("body.edit-php div.wrap > h2").after('<a href="#" class="advanced-view">Advanced View</a>');

	// jQuery("a.advanced-view").click(function(){
	// 	var txt = jQuery("div#wpbody").is('.simple-view') ? 'Simple View' : 'Advanced View';
 //     	jQuery(this).text(txt);
 //     	jQuery("div#wpbody").toggleClass('simple-view');
	// });

});

// jQuery(document).ajaxSuccess(function() {
// 	if ($('select').parents('#woocommerce-product-data, #post-body').length) {

// 	}

// 	else {

// 		$("select").chosen({
// 			disable_search: true,
// 			inherit_select_classes: true
// 		});

// 		$("select").on(function(e){
// 			e.this.chosen({
// 				disable_search: true,
// 				inherit_select_classes: true
// 			});
// 		});

// 		$('#add_field').click(function(){
// 			$("select").chosen({
// 				disable_search: true,
// 				inherit_select_classes: true
// 			});
// 		});

// 	}
// });