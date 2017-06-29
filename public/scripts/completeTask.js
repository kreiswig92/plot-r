$(document).ready(function() {
  $('.task__completer').click(function() {
    var taskId = this.id;
      $.post('../modals/completeTask.php',
      {
        taskId: taskId
      }, function(data) {
        if(data == 'success') {
          alert("task completed");
          location.reload();
        }
        else {
          alert('Something went wrong please try again');
        }
      });
  })
});

function printModError(str) {
  if($('.error').length) {
    $('.error').remove();
  }
  $('.adder__modal').append('<div class="error">'+ str +'</div>');
}
