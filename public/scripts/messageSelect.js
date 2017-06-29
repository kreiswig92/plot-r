$(document).ready(function() {
  // sidebar message modules
  $('.message__module').click(function() {
    var messageId = this.id;
    $(this).addClass('small__module--selected');
    $('.message__detail').load('../modals/messageDetail.php',
    {
      messageId: messageId
    });
  });
});
