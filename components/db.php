<?php

session_start();
if (!isset($_SESSION["login"]) || empty($_SESSION["login"])){
    $_SESSION["login"] = false;
}

if ($_SESSION["login"] == false) {
    if ($_SERVER['PHP_SELF'] != '/cesi-planning/signin.php') {
        if ( $_SERVER['PHP_SELF'] != '/cesi-planning/signup.php') {
            header('Location: ./signin.php');
        }
    }
}

try {
  $db = new PDO('mysql:dbname=cesi_app;host=localhost;charset=UTF8', 'root', '');
} catch (\Throwable $th) {
  var_dump($th);
  die();
}
