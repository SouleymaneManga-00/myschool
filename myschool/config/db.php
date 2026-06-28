<?php

$host ="localhost";
$base ="myschool";
$user = "root";
$password ="";

//connection

try {
   $pdo = new PDO ("mysql:host=$host;dbname=$base;charset=utf8",
     $user,
     $password );

      $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


} catch (PDOExection $e) {
    die("Erreur de connection ".$e->getMessage());
}