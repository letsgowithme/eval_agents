<?php 
//on demarre la session php
session_start();
//on traite le formulaire
if(!empty($_POST)){
  if(isset($_POST["title"]) &&!empty($_POST["title"])){
$title = strip_tags($_POST["title"]);

require_once "../../includes/DB.php";

$sql = "INSERT INTO `speciality`(`title`) 
VALUES(:title)";

$query = $dbConnect->prepare($sql);

$query->bindValue(':title', $title, PDO::PARAM_STR);

if(!$query->execute()){
  die("Failed to insert INTO `Spécialité`");
}
$id = $dbConnect->lastInsertId();

echo "<p style=\"background: red;\" class=\"text-center p-2\">Spécialité ajoutée sous le numéro ". $id."</p>";
echo "<p style=\"background: red;\" class=\"text-center p-2\">Retour à la page de création dans 5 seconds. Sinon appuyez sur le lien : <a href='speciality_new.php'>Retour</a></p>";
 
?>
<script>
  function backToPage() {
    window.location.href = "speciality_new.php";
  }
setTimeout(backToPage, 5000);
  </script>

<?php
  }else{
    die("Le formulaire est incomplet");
  }
}

include_once "../../includes/admin_header.php";
include_once "../../includes/admin_navbar.php";
$titre = "Spécialité";
?>
</head>
<body class="body_page">
  <div class="container">
<form class="form" action="speciality_new.php" method="post">
  <div class="mb-3">
    <label for="title" class="form-label fw-bold my-4 fs-2" style="color: #01013d;">Spécialité</label>
    <input type="text" class="form-control w-50" name="title" value="">
  <button type="submit" class="btn btn-primary my-4 fs-4 fw-bold" name="Submit">Créer</button>
</form>

<div>
<button type="button" class="login my-4 fs-4 fw-bold" data-toggle="tooltip" data-placement="top">
  <a href="../admin_index.php">Admin</a>
</button>
</div>
<?php
include_once "../../includes/admin_footer.php";
?>
