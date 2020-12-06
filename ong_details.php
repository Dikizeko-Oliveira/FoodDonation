<?php
session_start();
include_once("db_connection.php");

if(isset($_SESSION["user_id"])) {
  $userId = $_SESSION["user_id"];
}

if(!isset($_SESSION["user_id"])) {
  header("Location: index.php");
}
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
  <title>Food Donation - Doação</title>
</head>
<body>
  <header>
    <nav>
      <a href="./donator_home.php" class="logo">
        <img src="./images/logo.jpg" alt="logo">
        <strong>Food Donation</strong>
      </a>
      <div class="user-perfil">
        <a href="./donator_perfil.php">
          <img src="./images/user.jpg" alt="user photo">
        </a>
        <a href="./logout.php"><i class="fas fa-power-off icon" id="logout"></i></a>
      </div>
    </nav>
  </header>
  
  <section class="container">
    <div class="search">
      <a href="./donator_home.php" class="link-home">Voltar para a página inicial</a>
    </div>
  </section>

  <section class="container">
    <?php 
      //Recebe o id da ong
      $ong_id = filter_input(INPUT_GET, 'data_id', FILTER_SANITIZE_NUMBER_INT);

      $result_search = "SELECT * FROM users WHERE id='$ong_id'";
      $result_users = mysqli_query($connection, $result_search);

      while($row_user = mysqli_fetch_assoc($result_users)) {
        echo '
          <div class="donate-container">
          <div class="ong">
            <div class="ong-image">
              <img src="./images/macbook.jpg" alt="macbook pro">
            </div>
            <div class="ong-content">
              <h2>'.$row_user["username"].'</h2>
              <span>Cep: '.$row_user["cep"].'</span>
              <span>Rua: '.$row_user["street"].'</span>
              <span>Bairro: '.$row_user["district"].'</span>
              <span>Cidade: '.$row_user["city"].'</span>
              <span>Estado: '.$row_user["state"].'</span>
              <span>Número: '.$row_user["street_number"].'</span>
              <span>Complemento: '.$row_user["complement"].'</span>
              <p>Doar é um ato de bem, não deite fora, doe!</p>
            </div>
          </div>
          
          <div class="donate-options">
            <h3>Bens para doação</h3>
            <form action="donate.php" method="POST">
              <input type="text" name="ong_id"hidden value="'.$ong_id.'"/>
              <input type="text" name="user_id"hidden value="'.$userId.'"/>
              <label for="rice">
                Arroz
                <input type="checkbox" name="rice" id="rice" value="Arroz">
              </label>
              <label for="basic">
                Cesta básica
                <input type="checkbox" name="basic" id="basic" value="Cesta básica">
              </label>
              <label for="bean">
                Feijão
                <input type="checkbox" name="bean" id="bean" value="Feijão">
              </label>
              <label for="cookies">
                Biscoitos
                <input type="checkbox" name="cookies" id="cookies" value="Biscoitos">
              </label>
              <label for="cereals">
                Cereais
                <input type="checkbox" name="cereals" id="cereals" value="Cereais">
              </label>
    
              <h3>Selecione uma forma de doação</h3>
              <div class="donation-type">
                <label for="postal">
                  Correio
                  <input type="radio" name="withdraw" id="postal" value="Correio">
                </label>
                <label for="withdraw">
                  Retirar
                  <input type="radio" name="withdraw" id="withdraw" value="Retirar">
                </label>
              </div>
    
              <button type="submit">
                Efetuar doação
                <i class="fas fa-heart"></i>
              </button>
            </form>
          </div>
        </div>
        ';
      }
    ?> 
  </section>

</body>
</html>