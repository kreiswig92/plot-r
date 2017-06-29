$(document).ready(function() {
  $(".team__invite").click(function() {
    $("#teamInviteModule").attr('title', 'Invite A Member').attr('display', 'block').dialog({
      modal: true,
      width: 1000
    });
    $('#subInvite').click(function() {
      var email = $('#userEmail').val();
      var teamName = $('#inviteTeam').val();
      var admin = $('#makeAdmin').val();
      if(email !== '') {
        $.post('../modals/inviteToTeam.php', {email: email, team: teamName, admin: admin}, function(data) {
          if(data === 'success') {
            $('#teamName').val('');
            $('#teamInviteModule').dialog('close');
            alert('invite sent!');
          }
          else if(data === 'notJoined') {
            printModError('That email is not associated with a PLOT-R user');
          }
          else if(data === 'isMember') {
            printModError('That member has already joined this team');
          }
          else{
            alert(data);
          }
        });
      }
      else {
        printModError('enter a email');
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
