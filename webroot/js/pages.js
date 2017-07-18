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

	$("#send-file-btn, #login-btn").on("click", function(){
		if($(".file").val() !== ""){
			$("#send-file-btn").attr("disabled", "disabled");
		}
		if(
			($("#form-login input[name=usuario]").val() != "") &&
			($("#form-login input[name=senha]").val() != "")
		){
			$("#login-btn").attr("disabled", "disabled");
		}
	});
});