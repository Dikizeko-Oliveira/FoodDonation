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
  <title>Food Donation</title>
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
      <form id="register" action="search.php" method="POST" onsubmit="return validation();">
        <input 
          type="text" 
          placeholder="Digite aqui o nome da ong que deseja"
          name="search"
          id="search"
          >
        <button type="submit">
          <i class="fas fa-search" style='color: #fff'></i>
        </button>
      </form>
    </div>
  </section>

  <section class="container">
    <?php 
      if(isset($_SESSION["msg"])) {
        echo $_SESSION["msg"];
        unset($_SESSION["msg"]);
      }
    ?>
    <div class="ongs-content">
      <?php 
        //Recebe o  número da página
        $current_page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
        $page = (!empty($current_page)) ? $current_page : 1;

        //Seta a quantidade de itens por página
        $qnt_results_pg = 3;
        
        // Calcula o início da visualização
        $init = ($qnt_results_pg * $page) - $qnt_results_pg;

        $get_users = "SELECT * FROM users WHERE category='Ong' LIMIT $init, $qnt_results_pg";

        $result_users = mysqli_query($connection, $get_users);
        while($row_user = mysqli_fetch_assoc($result_users)) {
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
                  <p>'. $row_user["about"] .'</p>
                  <a href="./ong_details.php?data_id='.$row_user['id'].'">
                    <button>FAZER DOAÇÃO</button>
                  </a>
                </figure>
              </div>
            </div>
          ';
        }
      ?>
    </div>
   
    <div class="links">
      <?php 
        // Conta o total de ongs
        $result_pg = "SELECT COUNT(id) AS num_result FROM users WHERE category='Ong'";
        $result = mysqli_query($connection, $result_pg);
        $row_pg = mysqli_fetch_assoc($result);

        // echo $row_pg['num_result'];
        
        $quantity_pg = ceil($row_pg['num_result'] / $qnt_results_pg );

        //Limitar os links antes e depois
        $max_links = 3;

        echo "<a href='index.php?page=1'>Primeira</a>";

        for($previous = $page - $max_links; $previous <= $page - 1; $previous++){
          if($previous >= 1){
            echo "<a href='index.php?page=$previous'>$previous</a>";
          }
        }

        echo "$page";

        for($next = $page + 1; $next <= $page + $max_links; $next++){
          if($next <= $quantity_pg){
            echo "<a href='index.php?page=$next'>$next</a>";
          }
        }
        
        echo "<a href='index.php?page=$quantity_pg'>Última</a>";
     ?>
    </div>
  </section>

  <script src="./js/search_validation.js"></script>
</body>
</html>