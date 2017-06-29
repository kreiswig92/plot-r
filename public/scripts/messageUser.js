$(document).ready(function() {
  $(".user__message").click(function() {
    console.log('click');
    $("#messageModal").attr('title', 'Send a Message').attr('display', 'block').dialog({
      modal: true,
      width: 1000
    });
    $('#subMes').click(function() {
      var subject = $('#mesSubj').val();
      var content = $('#mesCont').val();
      var recId = $('#recId').val();
      var teamId = $('#teamId').val();
      if(content !== '') {
        $.post('../modals/sendMessage.php',
        {
          subject: subject,
          content: content,
          recId: recId,
          teamId: teamId
        },
        function(data) {
          if(data === 'success') {
            $('#teamInviteModule').dialog('close');
            alert('message sent!');
          }
          else{
            alert(data);
          }
        });
      }
      else {
        printModError('Fill out message content');
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
