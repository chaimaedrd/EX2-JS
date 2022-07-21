<?php 
   @$login=$_POST["login"];
   @$pass=md5($_POST["pass"]);
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider) && isset($pass) && isset($login)){
      include("connexion.php");
      $sel=$pdo->prepare("select * from utilisateurs where login=? and pass=? limit 1");
      $sel->execute(array($login,$pass));
      $tab=$sel->fetchAll();
      if(count($tab)>0){
         $_SESSION["prenomNom"]=strtolower($tab[0]["prenom"])." ".strtoupper($tab[0]["nom"]);
         $_SESSION["autoriser"]="oui";
         include_once("session.php");
      }
      else
      {
         $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s)',$login);
      }
   }
?>
<?php if(!isset($_SESSION['autoriser'])):?>
   <!DOCTYPE html>
   <html>
      <head>
         <meta charset="utf-8" />
         <link rel="stylesheet" href="style.css" />
      </head>
      <body onLoad="document.fo.login.focus()">
         <h1>Authentification [ <a href="inscription.php">Créer un compte</a> ]</h1>
         <?php if(isset($errorMessage)) : ?>
         <div class="erreur"><?php echo $errorMessage ?></div>
         <?php endif; ?>
         <form name="fo" method="post" action="home.php">
            <input type="text" name="login" placeholder="Login" /><br />
            <input type="password" name="pass" placeholder="Mot de passe" /><br />

            <input type="submit" name="valider" value="S'authentifier" />
         </form>
      </body>
   </html>
<?php endif;?>

