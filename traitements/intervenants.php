<?php
include("../components/db.php");


switch ($_GET["action"]) {
    case 'add':
        if (
            isset($_POST["lastname"]) && !empty($_POST["lastname"])
            && isset($_POST["firstname"]) && !empty($_POST["firstname"])
        ) {
            $sql = "INSERT INTO speakers (lastname, firstname) VALUES(?, ?)";
            $req = $db->prepare($sql);
            $req->bindValue(1, $_POST["lastname"], PDO::PARAM_STR);
            $req->bindValue(2, $_POST["firstname"], PDO::PARAM_STR);
      
            if ($req->execute()) {
              header('Location: ../intervenants.php');
            }
          }
        break;
    case 'del':
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $sql = "DELETE FROM speakers WHERE id = " . $_GET["id"];
            $req = $db->prepare($sql);
            if ($req->execute()) {
              header('Location: ../intervenants.php');
            }
          }
        break;
    case 'edit':
        if (
            isset($_POST["lastname"]) && !empty($_POST["lastname"])
            && isset($_POST["firstname"]) && !empty($_POST["firstname"])
            && isset($_GET["id"]) && !empty($_GET["id"])
        )  {
            $sql = "UPDATE speakers SET lastname = ?, firstname = ? WHERE id = " . $_GET["id"];
            $req = $db->prepare($sql);
            $req->bindValue(1, $_POST["lastname"], PDO::PARAM_STR);
            $req->bindValue(2, $_POST["firstname"], PDO::PARAM_STR);
            echo $req->execute();

            if ($req->execute()) {
              header('Location: ../intervenants.php');
            }
          }
        break;
    default:
        header("Location: ../404.html");
        break;
}
