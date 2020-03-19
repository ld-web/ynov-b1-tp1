<?php require_once '../../views/layout/header.php'; ?>

<h1>Connexion</h1>
<h4>Identifiez-vous pour accéder à l'administration</h4>

<form method="POST">
  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="Login..." />
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe..." />
  </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>

<?php require_once '../../views/layout/footer.php'; ?>