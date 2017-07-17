$(document).ready(function() {
	$(this).on("click", ".browse", function(){
	  var file = $(this).parent().parent().parent().find(".file");
	  file.trigger("click");
	});

	$(this).on("change", ".file", function(){
	  $(this).parent().find(".form-control").val($(this).val().replace(/C:\\fakepath\\/i, ''));
	});

	$(".close").on("click", function(){
		$("#message").empty();
	});
});