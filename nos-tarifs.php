<?php
$racine = $_SERVER['DOCUMENT_ROOT'];
require_once $racine .'/include/connexion.php';

// Exécution d'une requête, on récupère toues les consommations de disponibles
$requete = "select cc.libcat, c.lib_cons, c.prix_cons from consommation c inner join cat_cons cc on cc.cat = c.cat;";
$resultat = mysqli_query($cnx, $requete) or die(mysqli_error($cnx)); // or die() est pour la détection des erreurs

// On rempli un tableau à deux dimensions à partir du résultat de la requête
$prix_par_categorie = array();
while ($enregistrement = mysqli_fetch_assoc($resultat)) {
  $prix_par_categorie[$enregistrement['libcat']][] = array(
    'libelle' => $enregistrement['lib_cons'],
    'prix' => $enregistrement['prix_cons']
  );
}

// On récupère le nombre de catégories pour gérer l'affichage par colonnes
$nb_categories = count($prix_par_categorie);

?><!DOCTYPE html>
<html lang="fr">
<head>
  <title>Nos prestations - Le Bora-Bora</title>
  <?php include_once $racine .'/include/head.php' ?>
</head>
<body>
  <?php include_once $racine .'/include/header.php' ?>
  
  <!--==============================Méthode 1================================-->
  <section id="content">
    <div class="container_12 top">
      <div class="grid_6 box-1">
        <img src="/img/page1-img2.png" alt="Picto" />
        <div class="extra-wrap">
          <h2>LE BAR</h2>
          <ul class="list-1">
            <?php
            $moitie = ceil($nb_categories / 2);
            reset($prix_par_categorie);

            for ($cpt=0; $cpt<$moitie; $cpt++) {
            ?>
            <li>
              <?php echo key($prix_par_categorie); ?>
              <ul>
                <?php foreach (current($prix_par_categorie) as $consommation) { ?>
                <li><?php echo $consommation['libelle'] .' => '. $consommation['prix'] ?></li>
                <?php } ?>
              </ul>
            </li>
            <?php next($prix_par_categorie); } ?>
          </ul>
        </div>
      </div>
      
      <div class="grid_6 box-1">
        <div class="extra-wrap">
          <ul class="list-1">
            <?php for (; $cpt<$nb_categories; $cpt++) { ?>
            <li>
              <?php echo key($prix_par_categorie); ?>
              <ul>
                <?php foreach (current($prix_par_categorie) as $consommation) { ?>
                <li><?php echo $consommation['libelle'] .' => '. $consommation['prix'] ?></li>
                <?php } ?>
              </ul>
            </li>
            <?php next($prix_par_categorie); } ?>
          </ul>
        </div>
      </div>
      
      <div class="grid_12 box-1">
        <img src="/img/page1-img2.png" alt="Picto" />
        <div class="extra-wrap">
          <h2>...</h2>
            <ul class="list-1">
              <li>
              ...
              <ul>
                <li>...</li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      
      <!--==============================Méthode 2================================-->
      <div class="grid_12 box-2 pad-1">
        <div>
          <p class="text-3">LE BAR</p>
        </div>
      </div>
      
      <div class="grid_6">
        <ul class="list-2 top-5">
          <?php
          $moitie = ceil($nb_categories / 2);
          reset($prix_par_categorie);

          for ($cpt=0; $cpt<$moitie; $cpt++) {
          ?>
          <li>
            <?php echo key($prix_par_categorie); ?>
            <ul>
              <?php foreach (current($prix_par_categorie) as $consommation) { ?>
              <li><?php echo $consommation['libelle'] .' => '. $consommation['prix'] ?></li>
              <?php } ?>
            </ul>
          </li>
          <?php next($prix_par_categorie); } ?>
        </ul>
      </div>

      <div class="grid_6">
        <ul class="list-2 top-5">
          <?php for (; $cpt<$nb_categories; $cpt++) { ?>
          <li>
            <?php echo key($prix_par_categorie); ?>
            <ul>
              <?php foreach (current($prix_par_categorie) as $consommation) { ?>
              <li><?php echo $consommation['libelle'] .' => '. $consommation['prix'] ?></li>
              <?php } ?>
            </ul>
          </li>
          <?php next($prix_par_categorie); } ?>
        </ul>
      </div>
      
      <div class="grid_12 box-2 pad-1">
        <div>
              <p class="text-3">...</p>
          </div>
      </div>
      
      <div class="grid_6">
        <ul class="list-2 top-5">
          <li>
            ...
            <ul>
              <li>...</li>
            </ul>
          </li>
        </ul>
      </div>

      <div class="grid_6">
        <ul class="list-2 top-5">
          <li>
            ...
            <ul>
              <li>...</li>
            </ul>
          </li>
        </ul>
      </div>
      
      <div class="clear"></div>
    </div>
  </section>
  
<!--==============================footer=================================-->
  <?php include_once $racine .'/include/footer.php' ?>
</body>
</html>