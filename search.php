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
  <title>Food Donation - Pesquisa</title>
</head>
<body>
  <header>
    <nav>
      <a href="./index.php" class="logo">
        <img src="./images/logo.jpg" alt="logo">
        <strong>Food Donation</strong>
      </a>
      <div class="user-perfil">
        <img src="./images/user.jpg" alt="user photo">
        <i class="fas fa-power-off icon"></i>
      </div>
    </nav>
  </header>
  
  <section class="container">
    <div class="search">
      <a href="./donator_home.php" class="link-home">Voltar para a página inicial</a>
    </div>
  </section>

  <section class="container">
    <div class="ongs-content">
      <?php 
        $search = $_POST['search'];

        $result_search = "SELECT * FROM users WHERE username LIKE '%$search%'";
        $result_users = mysqli_query($connection, $result_search);

        if (mysqli_num_rows($result_users) === 0) {
          $_SESSION['msg'] = "<p style='color:#E81123; padding-top: 10px;'>Ong não encontrada, tente novamente</p>";
          header("Location: donator_home.php");
        } else {
          while($row_user = mysqli_fetch_array($result_users)) {
            echo '
              <div class="card-container">
                <div class="card">
                  <figure class="front">
                    <div class="image">
                      <img src="./images/macbook.jpg" alt="macbook pro">
                    </div>
                    <h1>'. $row_user["username"] .'</h1>
                    <p>'. $row_user["email"] .'</p>
                  </figure>
                  <figure class="back">
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet 
                      doloremque qui facilis fugit fuga veritatis
                      doloremque qui facilis fugit fuga veritatis
                      doloremque qui facilis fugit fuga veritatis
                    </p>
                    <button>FAZER DOAÇÃO</button>
                  </figure>
                </div>
              </div>
            ';
          }
        }  
      ?>
    </div>
  </section>
</body>
</html>