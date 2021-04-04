<?php
include("./components/header.php");


$sql = "SELECT * FROM subjects";
$req = $db->prepare($sql);
$req->execute();
$subjects = $req->fetchAll();

function getSpeakers($db, $subject_id)
{
    $sql = "SELECT * FROM speakers JOIN speakers_subjects ss on speakers.id = ss.speaker_id WHERE subject_id = $subject_id";
    $req = $db->prepare($sql);
    $req->execute();
    return $req->fetchAll();
}
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
              <li class="breadcrumb-item"><a href="./index.php"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Matières</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="./addSubject.php" class="btn btn-sm btn-neutral">Ajouter matière</a>
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
    <?php if (
        isset($_GET["notif"]) && !empty($_GET["notif"])
        && isset($_GET["type"]) && !empty($_GET["type"])
    ) { ?>

        <div class="alert alert-<?= $_GET["type"] ?> alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><?= $_GET["notif"] ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php } ?>
  <div class="row">



    <!---------------------------------------------------------------------------------------------------------------------------

                                             METTRE LE CONTENU DE VOTRE PAGE CI-DESSOUS

        --------------------------------------------------------------------------------------------------------------------------->


    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Liste des Matières</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">Nom de la matière</th>
                <th scope="col" class="sort" data-sort="budget">Ref de la matière</th>
                <th scope="col" class="sort" data-sort="budget">Intervenants</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($subjects as $key => $subject) { ?>
                <tr>
                  <th>
                    <?= $subject["name"] ?>
                  </th>
                  <td>
                    <?= $subject["ref"] ?>
                  </td>
                    <td>
                        <?php foreach (getSpeakers($db,  $subject["id"]) as $key => $sub) { ?>
                            <a href="./editIntervenant.php?id=<?= $sub["id"] ?>" class="badge badge-primary badge-md"><?= $sub["firstname"] ?></a>
                        <?php } ?>
                    </td>
                  <td class="text-right">
                    <a class="text-white btn btn-primary" href="./editSubject.php?id=<?= $subject["id"] ?>"><i class="ni ni-settings-gear-65 text-white"></i></a>
                    <a class="text-white btn btn-danger" href="./traitements/subjects.php?action=del&id=<?= $subject["id"] ?>"><i class="ni ni-fat-remove text-white"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>



    <!---------------------------------------------------------------------------------------------------------------------------

                                             METTRE LE CONTENU DE VOTRE PAGE CI-DESSOUS

        --------------------------------------------------------------------------------------------------------------------------->

  </div>

  <?php include("./components/footer.php") ?>
