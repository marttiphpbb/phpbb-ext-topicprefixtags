;(function($, window, document) {
	$('span.marttiphpbb-topicprefixtags-topicrow').each(function(){
		$(this).insertBefore($(this).parent().find('a.topictitle').eq(0));
		$(this).show();
	});
})(jQuery, window, document);
