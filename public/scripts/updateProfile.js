$(document).ready(function() {
  $('#subInfo').click(function() {
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var user = $("#uid").val();
    var go = true;
    if(fname === '' || lname === '' || email === '') {
      printFormError('please make sure all feilds are filled out');
      go = false;
    }
    if(!validEmail(email)) {
      printFormError('please make use a valid email address');
      go = false;
    }
    if(go) {
      $.post('../modals/updateUser.php',
      {
        fname: fname,
        lname: lname,
        email: email,
        user: user
      }, function(data) {
        if(data === 'success') {
          alert('info updated');
        }
        else if(data ==='blank') {
          printFormError('missing feilds');
        }
        else{
          alert('somthing went wrong, please try again');
        }

      });
    }
    return false;
  });
});

function validEmail(email) {
  var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
  if(re.test(email)) {
    return true;
  }
  return false;
}

function printFormError(str) {
  if($('.error').length) {
    $('.error').remove();
  }
  $('#updateForm').append('<div class="error">'+ str +'</div>');
}
