$(document).ready(function() {
  $(".team__adder").click(function() {
    $("#teamAddModule").attr('title', 'Create a Team').attr('display', 'block').dialog({
      modal: true,
      width: 1000
    });
    $('#subTeam').click(function() {
      var name = $('#teamName').val();
      if(name !== '') {
        $.post('../modals/addTeam.php', {name: name}, function(data) {
          if(data === 'success') {
            $('#teamName').val('');
            location.reload();
          }
          else if(data === 'failed') {
            printModError('Somthing went wrong, please try again later');
          }
          else if(data === 'used') {
            printModError('That team name has already been used, try a different name.');
          }
        });
      }
      else {
        printModError('enter a name');
      }
      return false;
    });
  });
});

function printModError(str) {
  if($('.error').length) {
    $('.error').remove();
  }
  $('.adder__modal').append('<div class="error">'+ str +'</div>');
}
