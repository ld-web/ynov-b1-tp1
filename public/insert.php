<?php

require_once '../functions/db.php';

$pdo = getPdo();

$query = 'INSERT INTO users (login, email, password, active) VALUES (:name, :email, :pass, :is_active)';
$stmt = $pdo->prepare($query);

$insert = $stmt->execute([
    'name' => "Paul",
    'email' => "paul@gmail.com",
    'pass' => password_hash("randompassword", PASSWORD_BCRYPT, ['cost' => 12]),
    'is_active' => 1
]);

echo ($insert) ? "Insertion OK" : "Insertion échouée";