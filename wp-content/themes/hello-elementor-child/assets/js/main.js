(function ($, window) {
	// longpv ---------------------
	//
	$(".tab_custom_1 .e-n-tabs-heading").on("wheel", function (event) {
		// Ngăn chặn cuộn dọc mặc định
		event.preventDefault();
		// Cuộn ngang dựa trên cuộn dọc
		this.scrollLeft += event.originalEvent.deltaY;
	});

	$(".btn_dang_ky").on("click", function () {
		$(".form_dang_ky .wpcf7-submit").trigger("click");
	});
	// vucoder --------------------
	//
})(jQuery, window);
