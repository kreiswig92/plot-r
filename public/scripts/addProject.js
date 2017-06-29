$(document).ready(function() {
  $(".project__adder").click(function() {
    $(".adder__modal").attr('title', 'Add a project').attr('display', 'blocks').dialog({
      modal: true,
      width: 1000
    });
    $('#projDue').datepicker({
      minDate: new Date,
      dateFormat: 'yy-mm-dd'
    });
    $('#subProj').click(function() {
      var name = $('#projName').val();
      var due = $('#projDue').val();
      var team = $('#newProjTeam').val();

      if(name !== '' && due !== '') {
        $.post('../modals/addProject.php',
        {
          name: name,
          due: due,
          team: team
        }, function(data) {
          if(data === 'success') {
            $('.adder__modal').dialog('close');
            location.reload();
          }
          if(data === 'used') {
            printModError("You've already created that project");
          }
          else {
            printModError('somthing went wrong.. please try again later');
          }
        });
      }
      else {
        printModError("Please fill out all feilds");
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
