<?php
require_once __DIR__ . '/db.php';

/**
 * Récupère les voitures visibles dans un tableau associatif
 *
 * @return array
 */
function getVoituresVisibles(?string $search): array
{
  $pdo = getPdo();
  $query = "SELECT * FROM voiture WHERE visible = 1";

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
 * Récupère toutes les voitures
 *
 * @return void
 */
function getVoitures()
{
  $pdo = getPdo();
  $query = "SELECT * FROM voiture";
  $stmt = $pdo->query($query);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

function calculPrix(int $anneeSortie, int $nbKm): float
{
  return $anneeSortie - ($nbKm / 1000);
}
