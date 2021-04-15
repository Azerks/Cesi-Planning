<?php
include("../components/db.php");


switch ($_GET["action"]) {
    case 'add':
        if (
            isset($_POST["name"]) && !empty($_POST["name"])
            && isset($_POST["ref"]) && !empty($_POST["ref"])
            && isset($_POST["speakers_ids"]) && !empty($_POST["speakers_ids"])
        ) {
            try {
                $db->beginTransaction();
                $sql = "INSERT INTO subjects (name, ref) VALUES(?, ?)";
                $req = $db->prepare($sql);
                $req->bindValue(1, $_POST["name"], PDO::PARAM_STR);
                $req->bindValue(2, $_POST["ref"], PDO::PARAM_STR);

                if (!$req->execute()) {
                    throw new Error("impossible de créer une matières");
                }

                $subjectID = $db->lastInsertId();
                foreach ($_POST["speakers_ids"] as $key => $speakerID) {
                    $sql = "INSERT INTO speakers_subjects (speaker_id, subject_id) VALUES(?, ?)";
                    $req = $db->prepare($sql);
                    $req->bindValue(1, $speakerID, PDO::PARAM_STR);
                    $req->bindValue(2, $subjectID, PDO::PARAM_STR);
                    if (!$req->execute()) {
                        throw new Error("une erreur s'est produite pendant la création de la relation intervenants / Matières");
                    }
                }

                $db->commit();
                header('Location: ../subjects.php?notif=Vous avez ajouté votre matières&type=success');

            } catch (\Throwable $th) {
                $db->rollBack();
                header('Location: ../subjects.php?notif=' . $th->getMessage() . '&type=danger');
            }
        } else {
            header('Location: ../subjects.php?notif=' . "Champs invalides" . '&type=danger');
        }
        break;
    case 'del':
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            try {
                $sql = "DELETE FROM subjects WHERE id = " . $_GET["id"];
                $req = $db->prepare($sql);
                if ($req->execute()) {
                    header('Location: ../subjects.php');
                }
            } catch (\Throwable $th) {
                header('Location: ../subjects.php?notif=' . "Champs invalides" . '&type=danger');
            }
        } else {
            header('Location: ../subjects.php?notif=' . "Champs invalides" . '&type=danger');
        }
        break;
    case 'edit':

        if (
            isset($_POST["name"]) && !empty($_POST["name"])
            && isset($_POST["ref"]) && !empty($_POST["ref"])
            && isset($_GET["id"]) && !empty($_GET["id"])
            && isset($_POST["speakers_ids"]) && !empty($_POST["speakers_ids"])
        ) {
            try {
                $db->beginTransaction();
                $subjectID = $_GET["id"];
                $sql = "UPDATE subjects SET name = ?, ref = ? WHERE id = " . $subjectID;
                $req = $db->prepare($sql);
                $req->bindValue(1, $_POST["name"], PDO::PARAM_STR);
                $req->bindValue(2, $_POST["ref"], PDO::PARAM_STR);

                if (!$req->execute()) {
                    throw new Error("impossible de modifier la matière");
                }

                $sql = "DELETE FROM speakers_subjects WHERE subject_id = " . $subjectID;
                $req = $db->prepare($sql);
                if (!$req->execute()) {
                    throw new Error("une erreur s'est produite pendant la modification des intervenants");
                }


                foreach ($_POST["speakers_ids"] as $key => $speakersID) {
                    $sql = "INSERT INTO speakers_subjects (speaker_id, subject_id) VALUES(?, ?)";
                    $req = $db->prepare($sql);
                    $req->bindValue(1, $speakersID, PDO::PARAM_STR);
                    $req->bindValue(2, $subjectID, PDO::PARAM_STR);
                    if (!$req->execute()) {
                        throw new Error("une erreur s'est produite pendant la création des matières");
                    }
                }

                $db->commit();
                header('Location: ../subjects.php?notif=Vous avez modifié votre intervenant&type=success');
            } catch (\Throwable $th) {
                $db->rollBack();
                header('Location: ../subjects.php?notif=' . $th->getMessage() . '&type=danger');
            }
        } else {
            header('Location: ../subjects.php?notif=' . "Champs invalides" . '&type=danger');
        }
        break;
    default:
        header("Location: ../404.html");
        break;
}
