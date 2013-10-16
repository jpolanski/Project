$(document).ready(function() {
  $('*[data-toggle="tooltip"]').tooltip()
  data_confirm();
});

/*** Confirm dialog **/
var data_confirm = function () {
   $('a[data-confirm]').click( function () {
      var msg = $(this).data('confirm');
      return confirm(msg);
   });
};
