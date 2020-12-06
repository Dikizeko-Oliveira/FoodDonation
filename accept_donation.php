<?php
  session_start();
  include_once("db_connection.php");

  $accept = filter_input(INPUT_POST, 'accept', FILTER_SANITIZE_STRING);
  $dataId = filter_input(INPUT_POST, 'data_id', FILTER_SANITIZE_STRING);
  $data_id = $dataId + 0;

  $donation_query = "UPDATE donation SET donation_accepted = '$accept' WHERE id = $data_id";
  mysqli_query($connection, $donation_query);

  $_SESSION['msg'] = "<p style='color: #50FA7B; padding-top: 10px;'>Operação aceita com sucesso!</p>";
  header("Location: ong_home.php");
?>
