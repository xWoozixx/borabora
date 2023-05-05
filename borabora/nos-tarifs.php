<?php
require_once 'include/connexion.php';

// Exécution d'une requête, on récupère toues les consommations de disponibles
$requete = "select cc.lib_cat, c.lib_cons, c.prix_cons from consommation c inner join cat_cons cc on cc.cat = c.cat;";
$resultat = mysqli_query($cnx, $requete) or die(mysqli_error($cnx)); // or die() est pour la détection des erreurs

// On rempli un tableau à deux dimensions à partir du résultat de la requête
$prix_par_categorie = array();
while ($enregistrement = mysqli_fetch_assoc($resultat)) {
  $prix_par_categorie[$enregistrement['lib_cat']][] = array(
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
  <?php include_once 'include/head.php' ?>
</head>
<body>
  <?php include_once 'include/header.php' ?>
  
  <!--==============================Méthode 1================================-->
  <section id="content">
    <div class="container_12 top">
      <div class="grid_6 box-1">
        <img src="img/page1-img2.png" alt="Picto" />
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
      <!--=Le SPA=-->

<?php // Exécution d'une requête, on récupère toutes les prestations de spa disponibles
$requete = "SELECT lib_soin, duree, prix_soin FROM spa;";
$resultat = mysqli_query($cnx, $requete) or die(mysqli_error($cnx)); // or die() est pour la détection des erreurs

// On rempli un tableau à une dimension à partir du résultat de la requête
$prix_par_prestation = array();
while ($enregistrement = mysqli_fetch_assoc($resultat)) {
  $prix_par_prestation[] = array(
    'libelle' => $enregistrement['lib_soin'],
    'duree' => $enregistrement['duree'],
    'prix' => $enregistrement['prix_soin']
  );
}

// On récupère le nombre de prestations pour gérer l'affichage par colonnes
$nb_prestations = count($prix_par_prestation);
?>
<div class="grid_12 box-1">
    <img src="img/page1-img2.png" alt="Picto" />
    <div class="extra-wrap">
      <h2>LE SPA</h2>
      <ul class="list-1">
        <?php for ($i=0; $i<$nb_prestations; $i++) { ?>
        <li><?php echo $prix_par_prestation[$i]['libelle'] .' Durée : '. $prix_par_prestation[$i]['duree'].' min => '. $prix_par_prestation[$i]['prix'] ?></li>
        <?php } ?>
      </ul>
    </div>
  </div>


<!--=Affichage vide

      <div class="grid_12 box-1">
        <img src="img/page1-img2.png" alt="Picto" />
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
=-->
      <!--==============================Méthode 2================================-->
      <!--====
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
  </section>====-->
  
<!--==============================footer=================================-->
  <?php include_once 'include/footer.php' ?>
</body>
</html>