<?php
  session_start();
  include_once("db_connection.php");

  $rice = filter_input(INPUT_POST, 'rice', FILTER_SANITIZE_STRING);
  $basic = filter_input(INPUT_POST, 'basic', FILTER_SANITIZE_STRING);
  $bean = filter_input(INPUT_POST, 'bean', FILTER_SANITIZE_STRING);
  $cookies = filter_input(INPUT_POST, 'cookies', FILTER_SANITIZE_STRING);
  $cereals = filter_input(INPUT_POST, 'cereals', FILTER_SANITIZE_STRING);
  $withdraw = filter_input(INPUT_POST, 'withdraw', FILTER_SANITIZE_STRING);
  $ong_id = filter_input(INPUT_POST, 'ong_id', FILTER_SANITIZE_STRING);
  $data_id = $ong_id + 0;
  $userId = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);
  $user_id = $userId + 0;


  $donation_query = "INSERT INTO donation (payeeId, donatorId, product1, product2, product3, product4, product5, method, created_at) VALUES ($data_id, $user_id, '$rice', '$basic', '$bean', '$cookies', '$cereals', '$withdraw', NOW())";
  mysqli_query($connection, $donation_query);

  if(mysqli_insert_id($connection)) {
    $_SESSION['msg'] = "<p style='color: #50FA7B; padding-top: 10px;'>Doação feita com sucesso!</p>";
    header("Location: donator_home.php");
  } else {
    $_SESSION['msg'] = "<p style='color: #E81123; padding-top: 10px;'>Erro ao fazer doação, tente novamente.</p>";
    header("Location: donator_home.php");
  }
?>
