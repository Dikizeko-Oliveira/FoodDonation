function validation() {
  var formulary = document.getElementById("register");
  var email = formulary.email;
  var password = formulary.password;

  if (password.value === "" && email.value === "") {
    email.style.borderColor = "#E81123";
    password.style.borderColor = "#E81123";

    alert("Preencha todos os campos");
    return false;
  }

  if(email.value.indexOf("@") === -1 || email.value.indexOf(".") === -1) {
    email.style.borderColor = "#E81123";
    alert("Insira um email válido");
    return false;
  }

  if (password.value === "") {
    password.style.borderColor = "#E81123";
    alert("Insira uma senha válida.");
    return false;
  }
  
  return true;
}