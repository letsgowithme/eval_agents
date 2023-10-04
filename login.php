<?php
require_once("Include/Db.php");
if (isset($_POST["Submit"])) {
    if(!empty($_POST["email"])&&!empty($_POST["password"])) {
      $email = $_POST["email"];
      $password = $_POST["password"];
      global $dbConnect;
    }else {
      echo "Please enter";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
 <!-- importer le fichier de style -->
 </head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="style/login.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
 <body>
 <div class="container">
 <!-- zone de connexion -->
 
 <form action="verification.php" method="POST">
 <h1>Connexion</h1>
 
 <label><b>E-mail</b></label>
 <input type="email" placeholder="Entrer votre adresse mail" name="email" required>

 <label><b>Mot de passe</b></label>
 <input type="password" placeholder="Entrer le mot de passe" name="password" required>

 <input type="submit" id='submit' value='LOGIN' name="Submit">
 <?php
 if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
 echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>
 </form>
 <a href='principale.php?deconnexion=true' class="mt-4"><span>Déconnexion</span></a>
 
 <!-- tester si l'utilisateur est connecté -->
 <?php
 session_start();
 if(isset($_GET['deconnexion']))
 { 
 if($_GET['deconnexion']==true)
 { 
 session_unset();
 header("location:login.php");
 }
 }
 else if($_SESSION['username'] !== ""){
 $user = $_SESSION['username'];
 // afficher un message
 echo "<br>Bonjour $user, vous êtes connectés";
 }
 ?>
  <button type="button" class="btn btn-primary mt-4 text-center"><a href="index.php" class="text-light">Accueil</a></button>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 </body>
</html>
