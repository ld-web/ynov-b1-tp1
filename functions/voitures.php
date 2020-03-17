<?php
require_once '../functions/db.php';

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

function calculPrix(int $anneeSortie, int $nbKm): float
{
  return $anneeSortie - ($nbKm / 1000);
}
