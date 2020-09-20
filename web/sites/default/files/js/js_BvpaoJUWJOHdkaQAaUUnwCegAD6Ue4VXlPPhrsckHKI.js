/**
 * @file
 * Global utilities.
 *
 */
(function($, Drupal) {
 $(document).ready(function() {
     if ($.cookie(‘pop’) == null) {
         $(‘#myModal’).modal(‘show’);
         $.cookie(‘pop’, ’7');
     }
 });
console.log('kapil');

})(jQuery, Drupal);  ;
