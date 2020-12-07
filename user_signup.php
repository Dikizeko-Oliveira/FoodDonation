<?php
  session_start();
  include_once("db_connection.php");

  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $cell_phone = filter_input(INPUT_POST, 'cell_phone', FILTER_SANITIZE_STRING);
  $document = filter_input(INPUT_POST, 'document', FILTER_SANITIZE_STRING);
  $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
  $password_hash = filter_input(INPUT_POST, 'password_hash', FILTER_SANITIZE_STRING);

  $check_email_query = "SELECT id FROM `users` WHERE email = '$email'";
  $check_result = mysqli_query($connection, $check_email_query);
  $check_document_query = "SELECT id FROM `users` WHERE document = '$document'";
  $check_document_result = mysqli_query($connection, $check_document_query);

  $row_email = mysqli_fetch_assoc($check_result);
  $row_document = mysqli_fetch_assoc($check_document_result);

  if(!empty($row_email)){
    $_SESSION['msg'] = "<p style='color: #E81123; padding-top: 10px;'>Esse email já está cadastrado, escolha outro.</p>";
    header("Location: signup.php");
    return false;
  }

  if(!empty($row_document)){
    $_SESSION['msg'] = "<p style='color: #E81123; padding-top: 10px;'>Esse número de documento já está cadastrado.</p>";
    header("Location: signup.php");
    return false;
  }

  $donation_query = "INSERT INTO users (username, email, cell_phone, document, category, password_hash, created_at) VALUES ('$username', '$email', '$cell_phone', '$document', '$category', '$password_hash', NOW())";
  mysqli_query($connection, $donation_query);

  if(mysqli_insert_id($connection)) {
    $_SESSION['msg'] = "<p style='color: #50FA7B; padding-top: 10px;'>Cadastro feito com sucesso!</p>";
    header("Location: index.php");
  } else {
    $_SESSION['msg'] = "<p style='color: #E81123; padding-top: 10px;'>Erro ao fazer cadastro, tente novamente.</p>";
    header("Location: signup.php");
  }
?>