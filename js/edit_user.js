var cep = document.getElementById("cep");
var district = document.getElementById("district");
var complement = document.getElementById("complement");
var city = document.getElementById("city");
var state = document.getElementById("state");
var street = document.getElementById("street");

var formulary = document.getElementById("register");
var password_confirm = formulary.password_confirm;
var old_password = formulary.old_password;
var password_hash = formulary.password_hash;

cep.addEventListener("blur", function (event) {
  const url = ` https://viacep.com.br/ws/${cep.value}/json/`;
  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      district.value = data.bairro;
      city.value = data.localidade;
      state.value = data.uf;
      street.value = data.logradouro;
      complement.value = data.complemento;
    });
});

function validation() {
  if(password_hash !== "" || old_password !== "") {
    if (password_confirm.value !== old_password.value ) {
      old_password.style.borderColor = "#E81123";
      password_confirm.style.borderColor = "#E81123";
      alert("A senha atual está errada.");
      return false;
    }
  }
}
