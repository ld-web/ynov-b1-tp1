<?php
require_once '../../functions/db.php';
require_once '../../functions/utils.php';

$pdo = getPdo();
$login = ""; // Quoi qu'il arrive, $login sera toujours initialisée à une chaîne vide
$error = false;

if (!empty($_POST['login']) && !empty($_POST['password'])) {
  session_start();
  $login = $_POST['login']; // Si on a une soumission de formulaire, on met à jour $login avec la valeur du champ "login"
  // $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]);
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE login = :login";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    'login' => $login
  ]);

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  // $error = ($row == false);
  // if ($row == false) { // si on n'a pas de ligne de résultat => ($row == false) est évaluée à true
  //   $error = true;
  // } else { // On a bien trouvé un utilisateur, on va donc vérifier son mot de passe
  //   if (password_verify($password, $row['password'])) { // Si la vérification réussit, on se connecte
  //     $_SESSION['state'] = 'connected';
  //     redirect('/admin');
  //   } else { // La vérification du mot de passe a échoué
  //     $error = true;
  //   }
  // }

  if ($row && password_verify($password, $row['password'])) {
    $_SESSION['state'] = 'connected';
    // Il est utile d'enregistrer l'ID de l'utilisateur connecté en session
    // Attention, ne pas enregistrer d'informations sensibles dans la session (mot de passe, email, etc...)
    $_SESSION['user_id'] = $row['ID'];
    redirect('/admin');
  } else {
    $error = true;
  }
} /* else {
  $login = "";
}*/

require_once '../../views/layout/header.php';
?>

<h1>Connexion</h1>
<h4>Identifiez-vous pour accéder à l'administration</h4>

<?php if ($error) { ?>
  <div class="alert alert-danger" role="alert">
    Les informations fournies n'ont pas permis de vous identifier
  </div>
<?php } ?>

<form method="POST">
  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="Login..." value="<?php echo $login; ?>" />
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe..." />
  </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>

<?php require_once '../../views/layout/footer.php'; ?>