<?php
require_once '../functions/voitures.php';
require_once '../views/layout/header.php';

// if (isset($_GET['search'])) {
//   $search = $_GET['search'];
// } else {
//   $search = null;
// }
// Equivalent à :
$search = $_GET['search'] ?? null;

$voitures = getVoituresVisibles($search);
?>

<!-- CONTENU -->
<h1>Liste des voitures</h1>

<!-- FORMULAIRE DE RECHERCHE -->
<form>
  <div class="form-group row">
    <div class="col-sm-10">
      <input type="text" class="form-control" id="search" placeholder="Recherche..." name="search" value="<?php echo $search; ?>" />
    </div>
    <div class="col-sm-2">
      <button type="submit" class="btn btn-primary">Rechercher</button>
    </div>
  </div>
</form>
<!-- /FORMULAIRE DE RECHERCHE -->

<div class="row">
  <?php
  foreach ($voitures as $voiture) {
    require '../views/voiture/front/item.php';
  }

  if (empty($voitures)) { ?>
    <div class="alert alert-danger col-12" role="alert">
      Aucun résultat n'a été trouvé !
    </div>
  <?php } ?>
</div>
<!-- /CONTENU -->

<?php require_once '../views/layout/footer.php'; ?>