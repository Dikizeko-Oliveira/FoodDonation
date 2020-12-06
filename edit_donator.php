<?php
  session_start();
  include_once("db_connection.php");

  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $cell_phone = filter_input(INPUT_POST, 'cell_phone', FILTER_SANITIZE_STRING);
  $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
  $street_number = filter_input(INPUT_POST, 'street_number', FILTER_SANITIZE_STRING);
  $district = filter_input(INPUT_POST, 'district', FILTER_SANITIZE_STRING);
  $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
  $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
  $complement = filter_input(INPUT_POST, 'complement', FILTER_SANITIZE_STRING);
  $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
  $password_hash = filter_input(INPUT_POST, 'password_hash', FILTER_SANITIZE_STRING);
  $userId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
  $user_id = $userId + 0;

  if(empty($password_hash)) {
    $edit_query = "UPDATE users SET username = '$username', email = '$email' ,cell_phone = '$cell_phone', cep = '$cep', street_number = '$street_number',  district = '$district', city = '$city', state = '$state', complement = '$complement', street = '$street' WHERE id = $user_id";
    mysqli_query($connection, $edit_query);
    $_SESSION['msg'] = "<p style='color: #50FA7B; padding-top: 10px;'>Operação feita com sucesso!</p>";
    header("Location: donator_perfil.php");
  } else {
    $edit_query = "UPDATE users SET username = '$username', email = '$email' ,cell_phone = '$cell_phone', cep = '$cep', street_number = '$street_number',  district = '$district', city = '$city', state = '$state', complement = '$complement', street = '$street', password_hash = $password_hash WHERE id = $user_id";
    mysqli_query($connection, $edit_query);
    $_SESSION['msg'] = "<p style='color: #50FA7B; padding-top: 10px;'>Operação feita com sucesso!</p>";
    header("Location: donator_perfil.php");
  }




?>
