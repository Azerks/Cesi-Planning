<?php
include("../components/db.php");


switch ($_GET["action"]) {
  case 'add':
    if (
      isset($_POST["lastname"]) && !empty($_POST["lastname"])
      && isset($_POST["firstname"]) && !empty($_POST["firstname"])
      && isset($_POST["subjects_ids"]) && !empty($_POST["subjects_ids"])
    ) {
      try {
        $db->beginTransaction();
        $sql = "INSERT INTO speakers (lastname, firstname) VALUES(?, ?)";
        $req = $db->prepare($sql);
        $req->bindValue(1, $_POST["lastname"], PDO::PARAM_STR);
        $req->bindValue(2, $_POST["firstname"], PDO::PARAM_STR);

        if (!$req->execute()) {
          throw new Error("impossible de créer un intervenant");
        }

        $speakerID = $db->lastInsertId();
        foreach ($_POST["subjects_ids"] as $key => $subID) {
          $sql = "INSERT INTO speakers_subjects (speaker_id, subject_id) VALUES(?, ?)";
          $req = $db->prepare($sql);
          $req->bindValue(1, $speakerID, PDO::PARAM_STR);
          $req->bindValue(2, $subID, PDO::PARAM_STR);
          if (!$req->execute()) {
            throw new Error("une erreur s'est produite pendant la création des matières");
          }
        }

        $db->commit();
        header('Location: ../intervenants.php?notif=vous avez ajouté votre intervenant&type=success');
      } catch (\Throwable $th) {
        $db->rollBack();
        header('Location: ../intervenants.php?notif=' . $th->getMessage() . '&type=danger');
      }
    }
    break;
  case 'del':
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
      try {
        $sql = "DELETE FROM speakers WHERE id = " . $_GET["id"];
        $req = $db->prepare($sql);
        if (!$req->execute()) {
          throw new Error("impossible de supprimer l'intervenant");
        }
        header('Location: ../intervenants.php?notif=vous avez supprimé votre intervenant&type=success');
      } catch (\Throwable $th) {
        header('Location: ../intervenants.php?notif=' . $th->getMessage() . '&type=danger');
      }
    }
    break;
  case 'edit':
    if (
      isset($_POST["lastname"]) && !empty($_POST["lastname"])
      && isset($_POST["firstname"]) && !empty($_POST["firstname"])
      && isset($_POST["subjects_ids"]) && !empty($_POST["subjects_ids"])
      && isset($_GET["id"]) && !empty($_GET["id"])
    ) {
      try {
        $db->beginTransaction();
        $speakerID = $_GET["id"];
        $sql = "UPDATE speakers SET lastname = ?, firstname = ? WHERE id = " . $speakerID;
        $req = $db->prepare($sql);
        $req->bindValue(1, $_POST["lastname"], PDO::PARAM_STR);
        $req->bindValue(2, $_POST["firstname"], PDO::PARAM_STR);

        if (!$req->execute()) {
          throw new Error("impossible de modifier l'intervenant");
        }

        $sql = "DELETE FROM speakers_subjects WHERE speaker_id = " . $speakerID;
        $req = $db->prepare($sql);
        if (!$req->execute()) {
          throw new Error("une erreur s'est produite pendant la modification des matières");
        }

        foreach ($_POST["subjects_ids"] as $key => $subID) {
          $sql = "INSERT INTO speakers_subjects (speaker_id, subject_id) VALUES(?, ?)";
          $req = $db->prepare($sql);
          $req->bindValue(1, $speakerID, PDO::PARAM_STR);
          $req->bindValue(2, $subID, PDO::PARAM_STR);
          if (!$req->execute()) {
            throw new Error("une erreur s'est produite pendant la création des matières");
          }
        }

        $db->commit();
        header('Location: ../intervenants.php?notif=vous avez modifié votre intervenant&type=success');
      } catch (\Throwable $th) {
        $db->rollBack();
        header('Location: ../intervenants.php?notif=' . $th->getMessage() . '&type=danger');
      }
    }
    break;
  default:
    header("Location: ../404.html");
    break;
}
