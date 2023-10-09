<?php 
//on demarre la session php
session_start();
//on traite le formulaire
if(!empty($_POST)){
  if(isset($_POST["hideoutCode"], $_POST["hideoutAddress"], $_POST["hideoutType"], $_POST["country"]) &&!empty($_POST["hideoutCode"]) &&!empty($_POST["hideoutCode"]) &&!empty($_POST["hideoutAddress"]) &&!empty($_POST["hideoutType"]) &&!empty($_POST["country"])){
$hideoutCode = strip_tags($_POST["hideoutCode"]);
$hideoutAddress = strip_tags($_POST["hideoutAddress"]);
$hideoutType = strip_tags($_POST["hideoutType"]);
$country = strip_tags($_POST["country"]);

require_once "../../includes/DB.php";

$sql = "INSERT INTO `hideout`(`hideoutCode`, `hideoutAddress`, `hideoutType`, `country`) VALUES(:hideoutCode, :hideoutAddress, :hideoutType, :country)";

$query = $dbConnect->prepare($sql);

$query->bindValue(':hideoutCode', $hideoutCode, PDO::PARAM_STR);
$query->bindValue(':hideoutAddress', $hideoutAddress, PDO::PARAM_STR);
$query->bindValue(':hideoutType', $hideoutType, PDO::PARAM_STR);
$query->bindValue(':country', $country, PDO::PARAM_STR);

if(!$query->execute()){
  die("Failed to insert INTO `hideout`");
}
$id = $dbConnect->lastInsertId();

// header("Location: nationality.php");
echo "<p>Le planque ajoutée sous le numéro ". $id."</p>";
echo "<a href='hideout_new.php'>Retour</a>";
exit;

  }else{
    die("Le formulaire est incomplet");
  }
}

include_once "../../includes/admin_header.php";
include_once "../../includes/admin_navbar.php";
$titre = "Planques";
?>
</head>
<body class="body_page">
  <div class="container">
    <h1>Ajouter un planque</h1>
        <form class="form" action="hideout_new.php" method="post">
          <div class="mb-3">
            <label for="hideoutCode" class="form-label fw-bold my-4 fs-2" style="color: #01013d;">Code</label>
            <input type="text" class="form-control w-50" name="hideoutCode" id="hideoutCode" value="">
          </div>
          <div class="mb-3">
            <label for="hideoutAddress" class="form-label fw-bold my-4 fs-2" style="color: #01013d;">Adresse</label>
            <input type="text" class="form-control w-50" name="hideoutAddress" id="hideoutAddress" value="">
          </div>
          <div class="mb-3">
            <label for="hideoutType" class="form-label fw-bold my-4 fs-2" style="color: #01013d;">Type</label>
            <input type="text" class="form-control w-50" name="hideoutType" id="hideoutType" value="">
          </div>

          <div>
    <label for="country">Pays</label>
    <?php include_once "../../countries_list.php"; ?>
    <select name="country" id="country">
      <?php
    foreach ($countries as $country) {
      echo '<option value="'.$country["name"].'" name="<?= $country["name"] ?>'.$country["name"].'</option>';
  }
    ?>
    </select>
   </div>
          
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
