<?php
$server ="localhost";
$user = "root";
$password = "";
$dbname = "school_work";

// Cria a conexão
$connection = mysqli_connect($server, $user, $password, $dbname);

// SELECT * FROM `donation` INNER JOIN users ON donation.donatorId = users.id WHERE payeeId = 3 AND donation_accepted = "Esperando"
// SELECT `donation`.*, `users`.`id` AS item FROM `donation` INNER JOIN `users` ON `donation`.`donatorId` = `users`.`id` WHERE payeeId = 3 AND donation_accepted = 'Esperando'
?>