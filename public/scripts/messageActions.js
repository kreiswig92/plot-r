$(document).ready(function() {
  $('#messageRep').click(function() {
    var teamId = $('#teamId').val();
    var userId = $('#userId').val();
    var messageId = $('#messageId').val();
    $("#messageModal").attr('title', 'Send a Message').attr('display', 'block').dialog({
      modal: true,
      width: 1000
    });
    $('#subMes').click(function() {
      var subject = $('#mesSubj').val();
      var content = $('#mesCont').val();
      var recId = $('#senderId').val();
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
            $('#messageRep').attr('onclick', '').unbind('click');
            $('#mssageRep').addClass('button--dead');
            alert('message sent!');
            location.reload();
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

  $('#messageDel').click(function() {
    var messageId = $('#messageId').val();
    $.post('../modals/deleteMessage.php', {
      messageId: messageId
    }, function() {
      location.reload();
    });
  });
});

function printModError(str) {
  if($('.error').length) {
    $('.error').remove();
  }
  $('.adder__modal').append('<div class="error">'+ str +'</div>');
}
