$(document).ready(function() {
	$(".panel-group > .panel>textarea").change(function() {
		if ($(this).text() == "") {
				$(this).removeClass('panel-info');
		} else {
				$(this).addClass('panel-info');
		}
	});
});

$(document).ready(function() {
	$(".btn,.btn-lg").parent("li").css("padding","0");
});