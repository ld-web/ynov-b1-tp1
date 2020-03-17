<?php
require_once '../../functions/voitures.php';
require_once '../../views/layout/header.php';
?>

<h1>Editer une voiture</h1>

<?php if (!isset($_GET['id'])) { ?>
  <div class="alert alert-danger" role="alert">
    Paramètre manquant : id
  </div>
  <?php
  exit;
}

// Si on arrive à ce stade du script, alors on n'est pas rentré dans le if
// Donc cela signifie qu'on a un paramètre GET id
$id = $_GET['id'];

if (isset($_POST['nom']) && isset($_POST['annee_sortie']) && isset($_POST['nb_km'])) {
  $nom = $_POST['nom'];
  $anneeSortie = $_POST['annee_sortie'];
  $nbKm = $_POST['nb_km'];
  $visible = isset($_POST['visible']) ? 1 : 0;

  // $update = updateVoitureLucas([
  //   'id' => $id,
  //   'nom' => $nom,
  //   'annee' => $anneeSortie,
  //   'kilometre' => $nbKm,
  //   'visible' => $visible
  // ]);

  $update = updateVoitureRemi(
    $id,
    $nom,
    $anneeSortie,
    $nbKm,
    $visible
  );
  
  var_dump($update);
}

$voiture = getVoiture($id);

if ($voiture == null) {?>
  <div class="alert alert-danger" role="alert">
    La voiture demandée n'existe pas
  </div>
  <?php
  exit;
}

?>

<form method="POST">
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom..." value="<?php echo $voiture['nom']; ?>" />
  </div>
  <div class="form-group">
    <label for="annee_sortie">Année de sortie</label>
    <input type="number" class="form-control" id="annee_sortie" name="annee_sortie" placeholder="Année de sortie..." value="<?php echo $voiture['annee_sortie']; ?>" />
  </div>
  <div class="form-group">
    <label for="nb_km">Nombre de kilomètres</label>
    <input type="number" class="form-control" id="nb_km" name="nb_km" placeholder="Nombre de kilomètres..." value="<?php echo $voiture['nb_km']; ?>" />
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="visible" name="visible" <?php if ($voiture['visible'] == 1) { ?>checked<?php } ?> />
    <label class="form-check-label" for="visible">Visible</label>
  </div>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

<?php
require_once '../../views/layout/footer.php';
