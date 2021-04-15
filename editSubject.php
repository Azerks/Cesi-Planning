<?php
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: ./index.php");
}

include("./components/header.php");



$sql = "SELECT * FROM subjects WHERE id = " . $_GET["id"];
$req = $db->prepare($sql);
$req->execute();
$subject = $req->fetch();


$sql = "SELECT * FROM speakers";
$req = $db->prepare($sql);
$req->execute();
$speakers = $req->fetchAll();

$sql = "SELECT * FROM speakers_subjects WHERE subject_id = " . $_GET["id"];
$req = $db->prepare($sql);
$req->execute();
$speakers_subjects = $req->fetchAll();
// ["5", "6","9"]
$checked_speakers = [];
foreach ($speakers_subjects as $key => $ss) {
    array_push($checked_speakers, $ss["speaker_id"]);
}


?>

    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">

                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="./index.php"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="./subjects.php">Matières</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
    <div class="row">

        <!---------------------------------------------------------------------------------------------------------------------------

                                             METTRE LE CONTENU DE VOTRE PAGE CI-DESSOUS

        --------------------------------------------------------------------------------------------------------------------------->
        <div class="card col-12">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Modifier matière <?= $subject["name"] ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="./traitements/subjects.php?action=edit&id=<?= $_GET["id"] ?>" method="POST">
                    <h6 class="heading-small text-muted mb-4">Matière informations</h6>
                    <div class="pl-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nom de la matière</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="devweb"
                                           value="<?= $subject["name"] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="ref">Référence de la matière</label>
                                    <input type="text" name="ref" id="ref" class="form-control" placeholder="RED08203"
                                           value="<?= $subject["ref"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <?php foreach ($speakers as $key => $sub) { ?>
                                <div class="custom-control custom-checkbox col-md-1">
                                    <input <?= in_array($sub["id"], $checked_speakers) ? "checked" : "" ?> type="checkbox" class="custom-control-input" id="subject-<?= $sub["id"] ?>" name="speakers_ids[]" value="<?= $sub["id"]  ?>">
                                    <label class="custom-control-label text-uppercase" for="subject-<?= $sub["id"] ?>"><?= $sub["firstname"]  ?></label>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!---------------------------------------------------------------------------------------------------------------------------

                                                METTRE LE CONTENU DE VOTRE PAGE CI-DESSUS

      --------------------------------------------------------------------------------------------------------------------------->
    </div>

<?php include("./components/footer.php") ?>
