(function ($, window) {
	// longpv ---------------------
	//
	$(".tab_custom_1 .e-n-tabs-heading").on("wheel", function (event) {
		event.preventDefault();
		this.scrollLeft += event.originalEvent.deltaY;
	});
	// vucoder --------------------
	//
})(jQuery, window);
