<?php
  session_start();
  include_once("db_connection.php");

  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $password_hash = filter_input(INPUT_POST, 'password_hash', FILTER_SANITIZE_STRING);
  
  $check_email_password_query = "SELECT * FROM `users` WHERE email = '$email' AND password_hash = '$password_hash'";
  $check_result = mysqli_query($connection, $check_email_password_query);

  if(mysqli_affected_rows($connection) <= 0){
    $_SESSION['msg'] = "<p style='color: #E81123; padding-top: 10px;'>Email e senha incorretos, tente novamente.</p>";
    header("Location: index.php");
    return false;
  }
  
  if(!empty($check_result)){
    $row_user = mysqli_fetch_assoc($check_result);
    $_SESSION['user_id'] = $row_user['id'];

    if($row_user['category'] === "Doador") {
      header("Location: donator_home.php");
    }
    if($row_user['category'] === "Ong") {
      header("Location: ong_home.php");
    }
  }
?>


