<?php
  session_start();
  $user_idactuel = isset ($_SESSION['connected_id']) ?  $_SESSION['connected_id'] : null;

  if ($user_idactuel) {
    include_once('connexion.php');

    $sqlUserQuery = "SELECT user_id, user_name, email FROM users WHERE user_id == $user_idactuel";
    $connectedUser = $connexion->query($sqlUserQuery)->fetch_all();
        $userId = $connectedUser['user_id'];
        $userName = $connectedUser['user_name'];
        $userEmail = $connectedUser['email'];
  }


//OLD
/*
$users = [
    [
        'full_name' => 'Célia',
        'email' => 'celia@exemple.com',
        'age' => 34,
    ],
    [
        'full_name' => 'Gaspard',
        'email' => 'gaspard@exemple.com',
        'age' => 31,
    ],
    [
        'full_name' => 'Laurène',
        'email' => 'laurene@exemple.com',
        'age' => 28,
    ],
];
*/
