;(function($, window, document) {
	$('document').ready(function () {
		var inputNumber = $('input[type="number"]');
		inputNumber.bind('change keyup', calc);
		inputNumber.keyup();

		function calc(){
			if ($(this).attr('data-sec') != '1'){
				return;
			} 
			var sec = $(this).val();
			var days = Math.floor(sec / 86400);
			var div_hours = sec % 86400;
			var hours = Math.floor(div_hours / 3600);
			var div_minutes = div_hours % 3600;
			var minutes = Math.floor(div_minutes / 60);
			var seconds = div_minutes % 60;

			var str = (days) ? days + ' ' + ' ' : '';
			str += hours + ':' + minutes + ':' + seconds;
			$(this).next('div').text(str);
		}
	});
})(jQuery, window, document);
