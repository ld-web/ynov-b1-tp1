<?php
require_once '../functions/db.php';
require_once '../views/layout/header.php';

$insert = null;

if (!empty($_POST) && !empty($_POST['nom']) && !empty($_POST['annee_sortie']) && !empty($_POST['nb_km'])) {
  $nom = $_POST['nom'];
  $anneeSortie = $_POST['annee_sortie'];
  $nbKm = $_POST['nb_km'];

  // Calcul du prix
  $prix = calculPrix($anneeSortie, $nbKm);

  // Récupération d'une instance de PDO
  $pdo = getPdo();

  // Définition, préparation et exécution de la requête
  $query = "INSERT INTO voiture (nom, annee_sortie, nb_km, prix) VALUES (:nom, :anneeSortie, :nbKm, :prix)";
  $stmt = $pdo->prepare($query);
  $insert = $stmt->execute([
    'nom' => $nom,
    'anneeSortie' => $anneeSortie,
    'nbKm' => $nbKm,
    'prix' => $prix
  ]);
}
?>

<h1>Nouvelle voiture</h1>

<?php if ($insert) { ?>
  <div class="alert alert-success" role="alert">
    La voiture a bien été enregistrée ! <a href="/">Retour à la liste</a>
  </div>
<?php } ?>

<?php if ($insert === false) { ?>
  <div class="alert alert-danger" role="alert">
    Une erreur est survenue
  </div>
<?php } ?>


<form method="POST">
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom..." />
  </div>
  <div class="form-group">
    <label for="annee_sortie">Année de sortie</label>
    <input type="number" class="form-control" id="annee_sortie" name="annee_sortie" placeholder="Année de sortie..." />
  </div>
  <div class="form-group">
    <label for="nb_km">Nombre de kilomètres</label>
    <input type="number" class="form-control" id="nb_km" name="nb_km" placeholder="Nombre de kilomètres..." />
  </div>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

<?php require_once '../views/layout/footer.php'; ?>