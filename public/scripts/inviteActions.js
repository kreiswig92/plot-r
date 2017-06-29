$(document).ready(function() {
  $('#inviteAcpt').click(function() {
    var teamId = $('#teamId').val();
    var userId = $('#userId').val();
    var messageId = $('#messageId').val();
    var makeAdmin = $('#is_admin').val();
    $.post('../modals/joinTeam.php',
    {
      teamId: teamId,
      userId: userId,
      messageId: messageId,
      admin: makeAdmin
    }, function(data) {
      alert('Joined Team!');
    });
  });

  $('#inviteDec').click(function() {
    var messageId = $('#messageId').val();
    $.post('../modals/deleteMessage.php', {
      messageId: messageId
    }, function() {
      location.reload();
    });
  });
});
