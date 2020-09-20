/**
 * @file
 * Global utilities.
 *
 */
(function($, Drupal) {
   $(document).ready(function() {
   	window.setTimeout(function(){ 
	    // First check, if localStorage is supported.
		if (window.localStorage) {
		// Get the expiration date of the previous popup.
		var nextPopup = localStorage.getItem( 'showPopup' );

		if (nextPopup > new Date()) {
			return;
		}

		// Store the expiration date of the current popup in localStorage.
		var expires = new Date();
		expires = expires.setMinutes(expires.getMinutes() + 1);

		localStorage.setItem( 'showPopup', expires );
		}
		$('#myModal').modal('show');
	}, 2000);
   });

})(jQuery, Drupal);  