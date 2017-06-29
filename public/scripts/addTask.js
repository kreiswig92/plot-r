$(document).ready(function() {
  $(".task__adder").click(function() {
    $(".adder__modal").attr('title', 'Add a task').attr('display', 'block').dialog({
      modal: true,
      width: 1000
    });
    $('#taskDue').datepicker({
      minDate: new Date,
      dateFormat: 'yy-mm-dd'
    });
    $('#subTask').click(function() {
      var name = $('#taskName').val();
      var due = $('#taskDue').val();
      var milestone = $('#taskMilestone').val();
      var projectId = $('#projectId').val();

      if(name !== '' && due !== '') {
        $.post('../modals/addTask.php',
        {
          name: name,
          due: due,
          milestone: milestone,
          projId: projectId
        }, function(data) {
          alert(data);
          if(data === 'success') {
            $('.adder__modal').dialog('close');
            location.reload();
          }
          if(data === 'used') {
            printModError("You've already created that tasks");
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
