<?php

try {
  $db = new PDO('mysql:dbname=cesi_app;host=localhost;charset=UTF8', 'root', '');
} catch (\Throwable $th) {
  var_dump($th);
  die();
}
