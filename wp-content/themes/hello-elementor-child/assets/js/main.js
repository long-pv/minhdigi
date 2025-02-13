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
	// Giới hạn trong khối #comments
	const commentsBlock = $("#comments");
	// số lượng comment
	// var commentCount = $("#comment-count").text();

	// Thay đổi tiêu đề .title-comments
	const titleComments = commentsBlock.find(".title-comments");
	// const commentCount = commentsBlock.find(".comment-list > li").length; // Đếm số lượng bình luận
	titleComments.text("bình luận");

	// Thay đổi văn bản .says thành "nói rằng"
	commentsBlock.find(".says").each(function () {
		$(this).text("nói rằng:");
	});

	$("#sticky-navigator").stickyNavigator({
		wrapselector: ".editor_block .elementor-widget-container",
		targetselector: "h2,h3",
	});

	$("#sticky-navigator").on("click", ".nav-h2", function () {
		$("#sticky-navigator .nav-h2").removeClass("active");
		$(this).addClass("active");
		$("#sticky-navigator .nav-h3").hide();
		$(this).nextUntil(".nav-h2", ".nav-h3").show();
	});
})(jQuery, window);
