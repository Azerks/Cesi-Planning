<?php
include("./components/header.php");
include("./components/db.php");

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
              <li class="breadcrumb-item"><a href="./index.php"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Intervenants</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="./addIntervenant.php" class="btn btn-sm btn-neutral">Ajouter intervenant</a>
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


    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Liste des intervenants</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">Nom</th>
                <th scope="col" class="sort" data-sort="budget">Prénom</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($speakers as $key => $speaker) { ?>
                <tr>
                  <th>
                    <?= $speaker["lastname"] ?>
                  </th>
                  <td>
                    <?= $speaker["firstname"] ?>
                  </td>
                  <td class="text-right">
                    <a class="text-white btn btn-primary" href="./editIntervenant.php?id=<?= $speaker["id"] ?>"><i class="ni ni-settings-gear-65 text-white"></i></a>
                    <a class="text-white btn btn-danger" href="./traitements/intervenants.php?action=del&id=<?= $speaker["id"] ?>"><i class="ni ni-fat-remove text-white"></i></a>
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