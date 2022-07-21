<?php
   @$nom=$_POST["nom"];
   @$prenom=$_POST["prenom"];
   @$login=$_POST["login"];
   @$pass=$_POST["pw"];
   @$repass=$_POST["pwc"];
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
      if(empty($nom)) {$erreur="Nom laissé vide!"; @$nom;}
      elseif(empty($prenom)) {$erreur="Prénom laissé vide!"; @$prenom;}
      elseif(empty($login)) {$erreur="Login laissé vide!"; @$login;}
      elseif(empty($pass)){ $erreur="Mot de passe laissé vide!";@$pass;}
      elseif($pass!=$repass) {$erreur="Mots de passe non identiques!"; @$repass;}
      else{
         include("connexion.php");
         $sel=$pdo->prepare("select id from utilisateurs where login=? limit 1");
         $sel->execute(array($login));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="Login existe déjà!";
         else{
            $ins=$pdo->prepare("insert into utilisateurs(nom,prenom,login,pass) values(?,?,?,?)");
            if($ins->execute(array($nom,$prenom,$login,md5($pass))))
               header("location:login.php");
         }   
      }
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      
        <link rel="stylesheet" href="style.css" />
        <script type="text/javascript" src="script.js"></script>
   </head>
   <body>
      <h1>Inscription</h1>
      <div class="erreur"><?php echo $erreur ?></div>
      <form name="fo" method="post" action="" onsubmit="effacer()">
         <input type="text" name="nom" placeholder="Nom" value="<?php echo $nom?>" onblur="validateNom()"/><br />
         <span class="erreurspan" id="errornom"></span>
         <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom?>"onblur="validatePrenom()" /><br />
         <span class="erreurspan" id="errorprenom"></span>
         <input type="text" name="login" placeholder="Login" value="<?php echo $login?>" onblur="validateLogin()"/><br />
         <span class="erreurspan" id="errorlogin"></span>
         <input type="password" name="pw" placeholder="Mot de passe" onblur="validatePw()" /><br />
         <span class="erreurspan" id="errorpw"></span>
         <input type="password" name="pwc" placeholder="Confirmer Mot de passe" oninput="validatePwc()" /><br />
         <span class="erreurspan" id="errorname"></span>
         <input type="submit" name="valider" value="S'authentifier" />
      </form>
   </body>

</html>

