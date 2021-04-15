<?php
include("../components/db.php");


switch ($_GET["action"]) {
    case 'add':
        if (
            isset($_POST["name"]) && !empty($_POST["name"])
            && isset($_POST["ref"]) && !empty($_POST["ref"])
        ) {
            $sql = "INSERT INTO promos (name, ref) VALUES(?, ?)";
            $req = $db->prepare($sql);
            $req->bindValue(1, $_POST["name"], PDO::PARAM_STR);
            $req->bindValue(2, $_POST["ref"], PDO::PARAM_STR);

            if ($req->execute()) {
                header('Location: ../index.php');
            }
        } else {
            header('Location: ../index.php?notif=' . "Champs invalides" . '&type=danger');
        }
        break;
    case 'del':
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            try {
                $sql = "DELETE FROM promos WHERE id = " . $_GET["id"];
                $req = $db->prepare($sql);
                if ($req->execute()) {
                    header('Location: ../index.php');
                }
            } catch (\Throwable $e) {
                header('Location: ../index.php?notif=' . "Impossible de supprimer" . '&type=danger');

            }
        } else {
            header('Location: ../index.php?notif=' . "Champs invalides" . '&type=danger');
        }
        break;
    case 'edit':
        if (
            isset($_POST["name"]) && !empty($_POST["name"])
            && isset($_POST["ref"]) && !empty($_POST["ref"])
            && isset($_GET["id"]) && !empty($_GET["id"])
        ) {
            $sql = "UPDATE promos SET name = ?, ref = ? WHERE id = " . $_GET["id"];
            $req = $db->prepare($sql);
            $req->bindValue(1, $_POST["name"], PDO::PARAM_STR);
            $req->bindValue(2, $_POST["ref"], PDO::PARAM_STR);

            if ($req->execute()) {
                header('Location: ../index.php');
            }
        } else {
            header('Location: ../index.php?notif=' . "Champs invalides" . '&type=danger');
        }
        break;
    default:
        header("Location: ../404.html");
        break;
}
