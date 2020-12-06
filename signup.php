<?php
session_start();
include_once("db_connection.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/styles.css">
  <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
  <script src="https://kit.fontawesome.com/99b1b95bb1.js" crossorigin="anonymous"></script>
  <title>Food Donation - Cadastro</title>
</head>
<body>
  <header>
    <nav class="nav">
      <a href="./index.php" class="logo">
        <img src="./images/logo.jpg" alt="logo">
        <strong>Food Donation</strong>
      </a>
    </nav>
  </header>
  
  <section class="container">
    <div class="message-content">
     <div class="message">
      <?php 
        if(isset($_SESSION["msg"])) {
          echo $_SESSION["msg"];
          unset($_SESSION["msg"]);
        }
      ?>
     </div>
    </div>
    <div class="login-container">
      <div class="login">
        <h2>Faça seu cadastro</h2>
        <form id="register" action="user_signup.php" method="POST" onsubmit="return validation();">
          <label for="username">
            Nome *:
            <input type="text" placeholder="Digite seu nome" name="username">
          </label>
          <label for="email">
            Email *:
            <input type="email" placeholder="Digite seu email" name="email">
          </label>
          <label for="cell_phone">
            Telefone *:
            <input 
              type="text" 
              placeholder="Digite seu número" 
              name="cell_phone" 
              max="11" 
              id="cell_phone"
            >
          </label>
          <label for="document">
            CPF *:
            <input 
              type="text" 
              placeholder="Digite seu cpf" 
              name="document" 
              id="document"
              >
          </label>
          <label for="user_type">
            Categoria *:
            <select name="category" id="category">
              <option hidden default>Selecione uma opção</option>
              <option value="Doador">Doador</option>
              <option value="Ong">Ong</option>
            </select>
          </label>
          <label for="password_hash">
            Senha *:
            <input 
              type="password" 
              placeholder="Digite sua senha" 
              name="password_hash"
              o
            />
          </label>
          <label for="password_confirm">
            Confirmar Senha *:
            <input type="password" placeholder="Repita sua senha" name="password_confirm">
          </label>
          <button type="submit">
            Confirmar
          </button>
        </form>
      </div>
    </div>
  </section> 

  <script src="./js/signup_validation.js"></script>
  <!-- Máscara para CPF e Telefone -->
  <script>
    document.getElementById("document").addEventListener("keyup", function(e) {
      e.currentTarget.maxLength = 14;
      let value = e.currentTarget.value;
      if (!value.match(/^(\d{3}).(\d{3}).(\d{3})-(\d{2})$/)) {
        value = value.replace(/\D/g, "");
        value = value.replace(/(\d{3})(\d)/, "$1.$2");
        value = value.replace(/(\d{3})(\d)/, "$1.$2");
        value = value.replace(/(\d{3})(\d{2})$/, "$1-$2");
        e.currentTarget.value = value;
      }
    });
    document.getElementById("cell_phone").addEventListener("keyup", function(e) {
      e.currentTarget.maxLength = 13;
      let value = e.currentTarget.value;
      if (!value.match(/^(\d{2}).(\d{5}).(\d{4})$/)) {
        value = value.replace(/\D/g, "");
        value = value.replace(/(\d{2})(\d)/, "$1 $2");
        value = value.replace(/(\d{5})(\d)/, "$1-$2");
        e.currentTarget.value = value;
      }
    });
  </script>
</body>
</html>