function validation() {
  var formulary = document.getElementById("register");
  var search = formulary.search;

  if (search.value === "") {
    search.style.borderColor = "#E81123";

    alert("Digite um nome válido.");
    return false;
  }
  
  return true;
}