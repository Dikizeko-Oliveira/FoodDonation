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
     <h3>Suas doações</h3>
    </div>
  </section>

  <section class="container">
    <?php 
      if(isset($_SESSION["msg"])) {
        echo $_SESSION["msg"];
        unset($_SESSION["msg"]);
      }
    ?>
    <div class="ong-home-container">
      <?php 
        //Recebe o  número da página
        $current_page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
        $page = (!empty($current_page)) ? $current_page : 1;

        //Seta a quantidade de itens por página
        $qnt_results_pg = 3;
        
        // Calcula o início da visualização
        $init = ($qnt_results_pg * $page) - $qnt_results_pg;

        $get_donations = "SELECT `donation`.*, `users`.`username`, `users`.`email` FROM `donation` INNER JOIN `users` ON `donation`.`donatorId` = `users`.`id` WHERE payeeId = $userId AND donation_accepted = 'Esperando'";
        
        $result_donations = mysqli_query($connection, $get_donations);

        while($row_donation = mysqli_fetch_assoc($result_donations)) {
          echo '
            <div class="donation-card">
              <div class="donator-image">
                <img src="./images/user.jpg" alt="user photo">
              </div>
              <div class="donator-data">
                <h3>Nome: '. $row_donation["username"] .'</h3>
                <p>Telefone: '. $row_donation["email"] .'</p>
                <p>Produtos: <b>
                  '. $row_donation["product1"] .', 
                  '. $row_donation["product2"] .',
                  '. $row_donation["product3"] .',
                  '. $row_donation["product4"] .',
                  '. $row_donation["product5"] .'.
                  </b></p>
              </div>
              <div class="donation-data">
                <form action="accept_donation.php" method="POST">
                  <input type="text" name="data_id" hidden value="'.$row_donation["id"].'"/>
                  <label for="agree">
                    Aceitar
                    <input type="radio" name="accept" id="agree" value="Sim">
                  </label>
                  <label for="refuse">
                    Recusar
                    <input type="radio" name="accept" id="refuse" value="Não">
                  </label>
                  <button>
                    Confirmar
                  </button>
                </form>
              </div>
            </div>
          ';
        }
      ?> 
    </div>

    <div class="links">
      <?php 
        // Conta o total de ongs
        $result_pg = "SELECT COUNT(id) AS num_result FROM donation  WHERE payeeId = 3";
        $result = mysqli_query($connection, $result_pg);
        $row_pg = mysqli_fetch_assoc($result);
        
        $quantity_pg = ceil($row_pg['num_result'] / $qnt_results_pg );

        //Limitar os links antes e depois
        $max_links = 3;

        echo "<a href='ong_home.php?page=1'>Primeira</a>";

        for($previous = $page - $max_links; $previous <= $page - 1; $previous++){
          if($previous >= 1){
            echo "<a href='ong_home.php?page=$previous'>$previous</a>";
          }
        }

        echo "$page";

        for($next = $page + 1; $next <= $page + $max_links; $next++){
          if($next <= $quantity_pg){
            echo "<a href='ong_home.php?page=$next'>$next</a>";
          }
        }
        
        echo "<a href='ong_home.php?page=$quantity_pg'>Última</a>";
     ?>
    </div>
  </section>
</body>
</html>