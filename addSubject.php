<?php
include("./components/header.php");
include('./components/db.php');

$sql = "SELECT * FROM speakers";
$req = $db->prepare($sql);
$req->execute();
$speakers = $req->fetchAll();
?>

<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="./subjects.php">subjects</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ajout</li>
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
                        <h3 class="mb-0">Ajouter matière </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="./traitements/subjects.php?action=add" method="POST">
                    <h6 class="heading-small text-muted mb-4">Matière informations</h6>
                    <div class="pl-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nom de la matière</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="PHP">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="ref">Référence de la matière</label>
                                    <input type="text" name="ref" id="ref" class="form-control" placeholder="phplicence3">
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <?php foreach ($speakers as $key => $spk) { ?>
                                <div class="custom-control custom-checkbox col-md-1">
                                    <input type="checkbox" class="custom-control-input" id="subject-<?= $spk["id"] ?>" name="speakers_ids[]" value="<?= $spk["id"]  ?>">
                                    <label class="custom-control-label text-uppercase" for="subject-<?= $spk["id"] ?>"><?= $spk["firstname"]  ?></label>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <!---------------------------------------------------------------------------------------------------------------------------

                                             METTRE LE CONTENU DE VOTRE PAGE CI-DESSOUS

        --------------------------------------------------------------------------------------------------------------------------->


    </div>

    <?php include("./components/footer.php") ?>
