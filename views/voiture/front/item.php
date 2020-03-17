<div class="card col-md-4 col-sm-12">
  <div class="card-body">
    <h3 class="card-title"><?php echo $voiture["nom"]; ?></h3>
    <p class="card-text">
      <h4><?php echo $voiture["annee_sortie"];  ?></h4>
      <?php echo $voiture['nb_km']; ?> KM<br />
      Prix : <?php echo $voiture['prix']; ?>€
    </p>
  </div>
</div>