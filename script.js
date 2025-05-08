var password = document.getElementById("password")
  , password2 = document.getElementById("password2");

function validatePassword(){
  if(password.value != password2.value) {
    password2.setCustomValidity("Passwords Don't Match");
  } else {
    password2.setCustomValidity('');
  }
}

password.onchange = validatePassword;
password2.onkeydown = validatePassword;