/*
Plugin Name: TentBlogger Social Widget
Author URI: http://tentblogger.com
*/
$tb = jQuery.noConflict();
$tb(function() {
	$tb('.tentblogger-tabs img').each(function() {
		$tb(this).click(function() {
			if($tb(this).hasClass('inactive')) {
				swap($tb('.tentblogger-tabs .active'), $tb(this));
				swap($tb('.tentblogger-content-wrapper .active'), $tb('.tentblogger-content-wrapper .' + findClass(this)));
			}
		});
	});
});

/**
 * Helper function for toggling visibility of elements based on their
 * active status.
 * 
 * @active		The element to hide
 * @inactive	The element to show
 */
function swap(active, inactive) {
	if($tb(active).hasClass('fade')) {
		$tb(active).fadeOut('fast', function() {
			$(this).removeClass('active').addClass('inactive');
			$tb(inactive).fadeIn('fast', function() {
				$tb(inactive).removeClass('inactive').addClass('active');
			});
		});
	} else {
		$tb(active).removeClass('active').addClass('inactive');
		$tb(inactive).removeClass('inactive').addClass('active');
	} // end if
} // end swap

/**
 * Helper function for finding the element to show based on the class
 * name of the incoming element.
 * 
 * @elem	The element with the classname's to retrieve.
 */
function findClass(elem) {
	
	var sId = '';
	
	var aClasses = $tb(elem).get(0).className.split(' ');
	if(aClasses[0].charAt(0).toLowerCase() == 't') {
		sId = aClasses[0];
	} else if (aClasses[1].charAt(0).toLowerCase() == 't') {
		sId = aClasses[1];
	} else {
		sId = aClasses[2];
	} // end if
	
	return sId;
	
} // end findClass
$ = jQuery.noConflict();