$(document).ready(function(){
  $('.laxVal').blur(function() {
    if($(this).val().trim() === "") {
      $(this).css('border-color', 'red');
    }
    else {
      clearError($(this));
      $(this).css('border-color', '#737373');
    }
  });

  $('#email_validation').blur(function() {
   if( !validEmail($('#email_validation').val().trim()) ) {
      $(this).css('border-color', 'red');
   }
   else {
     $(this).css('border-color', '#737373');
   }
  });

  $('.pass').blur(function() {
    var passFeilds = $('.pass');
    if($('#pass1_validation').val().trim() !== "" ) {
      parsePasses();
    }
    else {
      clearError($('#pass1_validation'));
      $('#pass1_validation').css('border-color', 'red');
    }
  });

  $('#reg_form').submit(function() {
    if(goodLax() && goodStrict()) {
      return true;
    }
    else{
      return false;
    }
  });

});

function printPassError() {
  var error = ($('#pass1_validation').val() !== $('#pass2_validation').val()) ? 'mismatch' : 'badPass';
  var message = '';
  switch (error) {
    case 'mismatch':
        message = 'passwords must match';
      break;
    case 'badPass' :
        message = 'week password';
      break;
    default:
        message = '';
      break;
  }

  $('#pass2_validation').after("<span class='err'>" + message + "</span>");
}

function printEmailError(el) {
  let err = (el.val().trim() === "") ? "Please enter email" : "That is not a valid email";
  clearError(el);
  el.after("<span class='err'>" + err + "</span>");
};

function goodLax() {
  var feilds = $('.lax_validation');

  for(let i = 0; i < feilds.length; i ++) {
    if(feilds[i].value.trim() === "") {
      return false;
    }
  }
  return true;
}

function printLaxError(el) {
  clearError(el);
  el.after("<span class='err'>Required Feild</span>");
}

function clearError(el) {
  if(el.next().attr('class') === 'err') {
    el.next().remove();
  }
}

function goodStrict() {
  var email = $('#email_validation').val();
  var pass1 = $('#pass1_validation').val();
  var pass2 = $('#pass2_validation').val();
  if(validEmail(email) && validPass(pass1) && pass1 === pass2) {
    return true;
  }
  return false;
}

function validEmail(email) {
  var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
  if(re.test(email)) {
    return true;
  }
  return false;
}

function validPass(pass) {
  var re = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
  if(re.test(pass)) {
    return true;
  }
  return false;
}

function parsePasses() {
  pass1 = $('#pass1_validation');
  pass2 = $('#pass2_validation');
  passStruct = $('#passStruct');
  passMatch = $('#passInfo');

  if(validPass(pass1.val())) {
    pass1.css('border-color', '#737373');
    passStruct.css('color', '#777');
  }
  else {
    pass1.css('border-color', 'red');
    passStruct.css('color', '#000');
  }

  if(pass1.val() === pass2.val()) {
    pass2.css('border-color', '#737373');
    passMatch.css('color', '#555');
  }
  else {
    pass2.css('border-color', 'red');
    passMatch.css('color', '#000');
  }
}
