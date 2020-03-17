<?php
require_once '../../functions/voitures.php';
require_once '../../views/layout/header.php';

$visible = $_GET['visible'] ?? "all";
$voitures = getVoitures($visible);
?>

<h1>Administration - Liste des voitures</h1>

<form>
  <div class="form-group">
    <label for="visible">Filtrer</label>
    <select class="form-control" id="visible" name="visible">
      <option value="all" <?php if ($visible == "all") { ?>selected="selected" <?php } ?>>
        Toutes les voitures
      </option>
      <option value="visible" <?php if ($visible == "visible") { ?>selected="selected" <?php } ?>>
        Voitures visibles
      </option>
      <option value="not_visible" <?php if ($visible == "not_visible") { ?>selected="selected" <?php } ?>>
        Voitures non visibles
      </option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Appliquer</button>
</form>

<table class="table table-striped">
  <thead>
    <tr>
      <th></th>
      <th scope="col">ID</th>
      <th scope="col">Nom</th>
      <th scope="col">Année de sortie</th>
      <th scope="col">Nombre de kilomètres</th>
      <th scope="col">Visible</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($voitures as $voiture) { ?>
      <tr>
        <td><a href="/admin/edit.php?id=<?php echo $voiture['ID']; ?>" class="btn btn-warning">Editer</a></td>
        <td><?php echo $voiture['ID']; ?></td>
        <td><?php echo $voiture['nom']; ?></td>
        <td><?php echo $voiture['annee_sortie']; ?></td>
        <td><?php echo $voiture['nb_km']; ?></td>
        <td>
          <?php if ($voiture['visible'] == 1) { ?>
            <span class="badge badge-success">OUI</span>
          <?php } else { ?>
            <span class="badge badge-danger">NON</span>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<?php require_once '../../views/layout/footer.php';
