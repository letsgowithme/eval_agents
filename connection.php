<?php
$titre = "Connexion";
include_once "includes/header.php";
include_once "includes/navbar.php";

?>
<body class="body_page">
<form method="post">
<div class="m-4 w-100 fw-bold">
   <div>
    <label for="email" class="w-75">Email</label>
    <input type="email" name="email" id="email" >
   </div>
   <div>
    <label for="password" class="w-75 mt-2">Mot de passe</label>
    <input type="password" name="password" id="password">
   </div>
   <div>
   <button type="submit" class="btn-dark my-4 fs-5 fw-bold p-2" name="submit">Se connecter</button>
   </div>
</div>
  </form>
<?php
include_once "includes/footer.php";
?>