function validation() {
  var formulary = document.getElementById("register");
  var name = formulary.username;
  var email = formulary.email;
  var cell_phone = formulary.cell_phone;
  var document_number = formulary.document;
  var category = formulary.category;
  var password_hash = formulary.password_hash;
  var password_confirm = formulary.password_confirm;

  if (name.value === "" && email.value === "" && cell_phone.value === "" 
    && document_number.value === "" && category.value === "Selecione uma opção" && 
    password_hash.value === "" && password_confirm.value === "" 
    ) {
    name.style.borderColor = "#E81123";
    email.style.borderColor = "#E81123";
    cell_phone.style.borderColor = "#E81123";
    document_number.style.borderColor = "#E81123";
    category.style.borderColor = "#E81123";
    password_hash.style.borderColor = "#E81123";
    password_confirm.style.borderColor = "#E81123";

    alert("Preencha todos os campos");
    return false;
  }

  if (name.value === "") {
    name.style.borderColor = "#E81123";
    alert("Insira um nome válido.");
    return false;
  }

  if (name.value !== "") {
    name.style.borderColor = "#103650";
  }

  if(email.value.indexOf("@") === -1 || email.value.indexOf(".") === -1) {
    email.style.borderColor = "#E81123";
    alert("Insira um email válido");
    return false;
  }

  if (email.value !== "") {
    email.style.borderColor = "#103650";
  }

  if (cell_phone.value === "") {
    cell_phone.style.borderColor = "#E81123";
    alert("Insira um número de telefone válido.");
    return false;
  }

  if (cell_phone.value !== "") {
    cell_phone.style.borderColor = "#103650";
  }

  if (document_number.value === "") {
    document_number.style.borderColor = "#E81123";
    alert("Insira um número válido.");
    return false;
  } else {
    var data = document_number.value.replace(".","");
      function CheckCPF(strCPF) {
        var Soma;
        var Resto;
        Soma = 0;
        if (strCPF == "00000000000") return false;
      
        for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;
      
          if ((Resto == 10) || (Resto == 11))  Resto = 0;
          if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
      
        Soma = 0;
          for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
          Resto = (Soma * 10) % 11;
      
          if ((Resto == 10) || (Resto == 11))  Resto = 0;
          if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
          return true;
        };
        data = data.replace(".","");
        data = data.replace("-","");
        if(!CheckCPF(data)) {
          document_number.style.borderColor = "#E81123";
          alert("CPF inserido não é válido");
          return false;
        }
    }

  if (document_number.value !== "") {
    document_number.style.borderColor = "#103650";
  }

  if (category.value === "Selecione uma opção") {
    category.style.borderColor = "#E81123";
    alert("Insira um categoria válida.");
    return false;
  }

  if (category.value !== "") {
    category.style.borderColor = "#103650";
  }

  if (password_hash.value === "") {
    password_hash.style.borderColor = "#E81123";
    alert("Insira uma senha válida.");
    return false;
  }
 
  if (password_hash.value !== "") {
    password_hash.style.borderColor = "#103650";
  }

  if (password_confirm.value === "") {
    password_confirm.style.borderColor = "#E81123";
    alert("Insira uma senha válida.");
    return false;
  }

  if (password_confirm.value !== "") {
    password_confirm.style.borderColor = "#103650";
  }

  if (password_confirm.value !== password_hash.value ) {
    password_hash.style.borderColor = "#E81123";
    password_confirm.style.borderColor = "#E81123";
    alert("As senhas precisam ser iguais.");
    return false;
  }
    if (password_confirm.value === password_hash.value ) {
      password_hash.style.borderColor = "#103650";
      password_confirm.style.borderColor = "#103650";
    }
    
  return true;
}