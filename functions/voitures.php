<?php
require_once __DIR__ . '/db.php';

/**
 * Récupère toutes les voitures et les renvoies sous forme de tableau associatif
 * TODO: prévoir le cas où on veut afficher toutes les voitures + avoir un $search pour la recherche par nom
 *
 * @var string $visible "all"|"visible"|"not_visible"
 * @return void
 */
function getVoitures(string $visible, ?string $search = null): array
{
  $pdo = getPdo();
  $query = "SELECT * FROM voiture";

  // if ($visible == "visible" || $visible == "not_visible") {
  //   $query .= " WHERE visible = " . (($visible == "visible") ? "1" : "0");
  // }
  if ($visible == "visible") {
    $query .= " WHERE visible = 1";
  }

  if ($visible == 'not_visible') {
    $query .= " WHERE visible = 0";
  }

  if ($search !== null) {
    $query = $query . " AND nom LIKE :search";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['search' => "%$search%"]);
  } else {
    $stmt = $pdo->query($query);
  }

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Récupère une voiture sous forme de tableau associatif
 *
 * @param integer $id
 * @return array
 */
function getVoiture(int $id): ?array
{
  $pdo = getPdo();
  $query = "SELECT * FROM voiture WHERE id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['id' => $id]);

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
    return null;
  }

  return $row;
}

function insertVoiture(string $nom, int $anneeSortie, int $nbKm): bool
{
  // Calcul du prix
  $prix = calculPrix($anneeSortie, $nbKm);

  // Récupération d'une instance de PDO
  $pdo = getPdo();

  // Définition, préparation et exécution de la requête
  $query = "INSERT INTO voiture (nom, annee_sortie, nb_km, prix) VALUES (:nom, :anneeSortie, :nbKm, :prix)";
  $stmt = $pdo->prepare($query);
  return $stmt->execute([
    'nom' => $nom,
    'anneeSortie' => $anneeSortie,
    'nbKm' => $nbKm,
    'prix' => $prix
  ]);
}

function updateVoitureLucas($voiture): bool
{
  $pdo = getPdo();
  $id = $voiture['id'];
  $nom = $voiture['nom'];
  $annee_sortie = $voiture['annee'];
  $kms = $voiture['kilometre'];
  $visible = $voiture['visible'];

  //TODO: ajouter calcul du prix et injection du prix dans la MAJ

  $query = "UPDATE voiture SET nom = :nom, annee_sortie = :annee, nb_km = :nb_km, visible = :visible WHERE id = :id";
  $stmt = $pdo->prepare($query);
  return $stmt->execute([':nom' => $nom, ':annee' => $annee_sortie, ':nb_km' => $kms, ':visible' => $visible, 'id' => $id]);
}

function updateVoitureRemi(int $id, string $nom, int $anneeSortie, int $nbKm, int $visible = 0): bool
{
  // Calcul du prix
  $prix = calculPrix($anneeSortie, $nbKm);

  // Récupération d'une instance de PDO
  $pdo = getPdo();

  // Définition, préparation et exécution de la requête
  $query = "UPDATE voiture SET nom = :nom, annee_sortie = :annee_sortie, nb_km= :nb_km, prix= :prix, visible= :visible WHERE id=:id";
  $stmt = $pdo->prepare($query);
  return $stmt->execute(array(':nom' => $nom, ':annee_sortie' => $anneeSortie, ':nb_km' => $nbKm, ':prix' => $prix, ':visible' => $visible, ':id' => $id));
}

function calculPrix(int $anneeSortie, int $nbKm): float
{
  return $anneeSortie - ($nbKm / 1000);
}
