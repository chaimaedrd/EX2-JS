<?php
      $bienvenue="Bonsoir et bienvenue ".$_SESSION["prenomNom"]." dans votre espace personnel";
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="style.css" />
   </head>
   <body>
      <h2><?php echo $bienvenue?></h2>
      [ <a href="deconnexion.php">Se déconnecter</a> ]
   </body>
</html>
