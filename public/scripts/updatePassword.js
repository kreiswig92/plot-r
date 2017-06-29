$(document).ready(function() {
  $('#subPass').click(function() {
    var pass1 = $('#pass1').val();
    var pass2 = $('#pass2').val();
    var curPass = $('#curPass').val();

    if(validPass(pass1) && pass1 === pass2) {
      $.load('../modals/updatePass.php',
      {
        pass1: pass1,
        pass2: pass2,
        curPass: curPass
      }, function(data) {
        if(data === 'success') {
          alert("password updated");
        }
        else if(data === 'empty') {
          printPassError('please make sure all feilds are filled');
        }
        else if(data === 'wrong') {
          printPassError('You entered an incorrect current password');
        }
        else{
          alert('something went wrong please try again later');
        }
      });
    }
    else {
      printPassError('please make sure the passwords match and are valid');
    }
    return false;
  });
});

function validPass(pass) {
  var re = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
  if(re.test(pass)) {
    return true;
  }
  return false;
}

function printPassError(str) {
  if($('.error').length) {
    $('.error').remove();
  }
  $('#passForm').append('<div class="error">'+ str +'</div>');
}
