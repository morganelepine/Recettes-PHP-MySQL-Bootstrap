<?php
$url = getenv("DB_URL") ? getenv("DB_URL") : "localhost";
$user = getenv("DB_USER") ? getenv("DB_USER") : "root";
$password = getenv("DB_PASSWORD") ? getenv("DB_PASSWORD") : "root";
$dbName = getenv("DB_NAME") ? getenv("DB_NAME") : "my_recipes";
$connexion = new mysqli($url, $user, $password, $dbName);
