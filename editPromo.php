<?php
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: ./index.php");
}

include("./components/header.php");




$sql = "SELECT * FROM promos WHERE id = " . $_GET["id"];
$req = $db->prepare($sql);
$req->execute();
$promo = $req->fetch();



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
                            <li class="breadcrumb-item"><a href="./promos.php">promos</a></li>
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
                        <h3 class="mb-0">Modifier promotion <?= $promo["name"] ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="./traitements/promos.php?action=edit&id=<?= $_GET["id"] ?>" method="POST">
                    <h6 class="heading-small text-muted mb-4">Promotion informations</h6>
                    <div class="pl-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nom de la promo</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="devweb" value="<?= $promo["name"] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="ref">Référence de la promo</label>
                                    <input type="text" name="ref" id="ref" class="form-control" placeholder="RED08203" value="<?= $promo["ref"] ?>">
                                </div>
                            </div>
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
