<?php
session_start();
include_once("db_connection.php");

if(isset($_SESSION["user_id"])) {
  $userId = $_SESSION["user_id"];
}

if(!isset($_SESSION["user_id"])) {
  header("Location: index.php");
}

$get_data = "SELECT * FROM `users` WHERE id = $userId";
$result_data = mysqli_query($connection, $get_data);
$row_data = mysqli_fetch_assoc($result_data);
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
  <title>Food Donation - Perfil</title>
</head>
<body>
  <header>
    <nav>
      <a href="./ong_home.php" class="logo">
        <img src="./images/logo.jpg" alt="logo">
        <strong>Food Donation</strong>
      </a>
      <div class="user-perfil">
        <a href="./ong_perfil.php">
          <img src="./images/user.jpg" alt="user photo">
        </a>
        <a href="./logout.php"><i class="fas fa-power-off icon" id="logout"></i></a>
      </div>
    </nav>
  </header>
  
  <section class="container">
    <div class="ong-home-title">
     <h3>Perfil de usuário</h3>
    </div>
  </section>

  <section class="container">
    <?php 
      if(isset($_SESSION["msg"])) {
        echo $_SESSION["msg"];
        unset($_SESSION["msg"]);
      }
    ?>
    <div class="user-container">
      <div class="user-content">
        <form id="register" action="./edit_ong.php" method="POST" onsubmit="return validation();">
          <input type="text" hidden name="id" value="<?php echo $row_data['id']?>">
          <div class="user-photo">
            <img src="./images/user.jpg" alt="user photo">
          </div>
          <label for="username">
            Nome:
            <input type="text" name="username" value="<?php echo $row_data['username']?>">
          </label>
          <label for="email">
            Email:
            <input type="text" name="email" value="<?php echo $row_data['email']?>">
          </label>
          <label for="cell_phone">
            Telefone:
            <input type="text" name="cell_phone" value="<?php echo $row_data['cell_phone']?>">
          </label>

          <div class="address">
            <div class="address-left">
              <label for="cep">
                Cep:
                <input type="text" name="cep" value="<?php echo $row_data['cep']?>" id="cep">
              </label>
              <label for="district">
                Bairro:
                <input type="text" name="district" value="<?php echo $row_data['district']?>" id="district">
              </label>
              <label for="street_number">
                Número
                <input type="text" name="street_number" value="<?php echo $row_data['street_number']?>" id="street_number">
              </label>
            </div>
            <div class="address-right">
              <label for="city">
                Cidade:
                <input type="text" name="city" value="<?php echo $row_data['city']?>" id="city">
              </label>
              <label for="state">
                Estado:
                <input type="text" name="state" value="<?php echo $row_data['state']?>" id="state">
              </label>
              <label for="complement">
                Complemento:
                <input type="text" name="complement" value="<?php echo $row_data['complement']?>" id="complement">
              </label>
            </div>
          </div>
          <label for="street">
            Rua:
            <input type="text" name="street" value="<?php echo $row_data['street']?>" id="street">
          </label>

          <label for="about">
            Sobre:
            <textarea name="about" rows="14">
              <?php echo $row_data['about']?>
            </textarea>
          </label>

          <label for="old_password">
            Senha Atual:
            <input type="password" name="old_password" value="">
          </label>
          <label for="password_confirm">
            Confirmar Senha:
            <input type="password" name="password_confirm" value="">
          </label>
          <label for="password_hash">
            Nova  Senha:
            <input type="password" name="password_hash" value="">
          </label>

          <div class="button">
            <button type="submit">Confirmar</button>
          </div>
        </form>
      </div>
    </div>

  </section>
  <script src="./js/edit_user.js"></script>
  
  <!-- Máscara para cep -->
  <script>
    document.getElementById("cep").addEventListener("keyup", function(e) {
      e.currentTarget.maxLength = 9;
      let value = e.currentTarget.value;
      value = value.replace(/\D/g, "");
      value = value.replace(/^(\d{5})(\d)/, "$1-$2");
      e.currentTarget.value = value;
    });
  </script>
</body>
</html>