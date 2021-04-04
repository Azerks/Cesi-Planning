<?php



if (
  isset($_GET["subjects"]) && !empty($_GET["subjects"])
  && isset($_GET["speaker_id"]) && !empty($_GET["speaker_id"])
) {

  try {
    $db->beginTransaction();
    foreach ($_GET["subjects"] as $key => $sub) {
      $sql = "INSERT INTO speakers_subjects (speaker_id, subject_id) VALUES(?, ?)";
      $req = $db->prepare($sql);
      $req->bindValue(1, $_GET["speaker_id"], PDO::PARAM_INT);
      $req->bindValue(2, $sub, PDO::PARAM_INT);

      if (!$req->execute()) {
        throw new Error("enable to add speakers_subjects");
      }
    }
    $db->commit();
  } catch (\Throwable $th) {
    $db->rollBack();
  }
}

try {
  $db = new PDO('mysql:dbname=cesi_app;host=localhost;charset=UTF8', 'root', '');
} catch (\Throwable $th) {
  var_dump($th);
  die();
}

$id = 5;
$sql = "SELECT * FROM speakers WHERE id = $id";
$req = $db->prepare($sql);
$req->execute();
$speaker = $req->fetch();

$sql = "SELECT * FROM subjects";
$req = $db->prepare($sql);
$req->execute();
$subjects = $req->fetchAll();

$sql = "SELECT * FROM speakers_subjects WHERE speaker_id = $id";
$req = $db->prepare($sql);
$req->execute();
$speakers_subjects = $req->fetchAll();
$subjectsIDS = [];
foreach ($speakers_subjects as $key => $ss) {
  array_push($subjectsIDS, $ss["subject_id"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1><?= $speaker["firstname"] ?></h1>
  <form method="get">
    <input type="hidden" name="speaker_id" value="<?= $speaker["id"] ?>">

    <?php foreach ($subjects as $key => $subject) { ?>
      <div class="custom-control custom-checkbox">
        <input <?= in_array($subject["id"], $subjectsIDS) ? "checked" : "" ?> type="checkbox" value="<?= $subject["id"] ?>" name="subjects[]" class="custom-control-input">
        <label class="custom-control-label"><?= $subject["name"] ?></label>
      </div>
    <?php } ?>
    <input type="submit">
  </form>
</body>

</html>
