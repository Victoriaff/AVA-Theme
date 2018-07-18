// *************************************************************************//
// ! This is main JS file that contains custom scripts used in this template*/
// *************************************************************************//
/**
	Navigation File

	01. Carousel
	02. Fixed Header
	03. View All Features
	04. Anchor menu
	05. Counted
	06. Mobile Btn
    07. Waypoint

 */

(function($){
	$( document ).ready(function() {
		"use strict";

		// **********************************************************************//
		// 07. Waypoint animation
		// **********************************************************************//
		$('.animated.waypoint:not(.go)').waypoint(function () {
			$(this.element).addClass('go')
		}, {
			offset: '85%'
		});


	});
})( window.jQuery );