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
  <title>Food Donation - Login</title>
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
        <h2>Faça seu login</h2>
        <form id="register" action="login.php" method="POST" onsubmit="return validation();">
          <label for="email">
            Email *:
            <input type="email" placeholder="Digite seu email" name="email">
          </label>
          <label for="password_hash">
            Senha *:
            <input type="password" placeholder="Digite sua senha" name="password_hash">
          </label>
          <button type="submit">
            Confirmar
          </button>
        </form>
        <p>Ainda não fez seu cadastro? <a href="signup.php">Clique aqui</a></p>
      </div>
    </div>
  </section>

  <script src="./js/login_validation.js"></script>
</body>
</html>