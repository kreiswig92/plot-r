$(document).ready(function() {
  $('.member__module').click(function() {
    var userId = this.id;
    var teamId = $('#teamId').val();
    $(this).addClass('small__module--selected');
    $('.member__detail').load('../modals/memberDetail.php',{member: userId, teamId: teamId});
  });
});
