/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});
$(document).ready(function()
{
	$("#gear").mlens(
	{
		imgSrc: $("#gear").attr("data-big"),	  // path of the hi-res version of the image
		imgSrc2x: $("#gear").attr("data-big2x"),  // path of the hi-res @2x version of the image
                                                  //for retina displays (optional)
		lensShape: "circle",                // shape of the lens (circle/square)
		lensSize: ["20%","30%"],            // lens dimensions (in px or in % with respect to image dimensions)
		                                    // can be different for X and Y dimension
		borderSize: 4,                  // size of the lens border (in px)
		borderColor: "#fff",            // color of the lens border (#hex)
		borderRadius: 0,                // border radius (optional, only if the shape is square)
		imgOverlay: $("#gear").attr("data-overlay"), // path of the overlay image (optional)
		overlayAdapt: true,    // true if the overlay image has to adapt to the lens size (boolean)
		zoomLevel: 1,          // zoom level multiplicator (number)
		responsive: true       // true if mlens has to be responsive (boolean)
	});
});

