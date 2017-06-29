$(document).ready(function() {
  $('#selectTeam').change(function() {
    var teamId = $('#selectTeam').val();
    $('#projectList').load('../modals/listProjects.php', {
      teamId: teamId
    });
  });
});
