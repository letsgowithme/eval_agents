<?php 
//on demarre la session php
//on traite le formulaire
if(!empty($_POST)){
  if(isset($_POST["code"], $_POST["address"], $_POST["city"], $_POST["country"], $_POST["hideoutType"]) &&!empty($_POST["code"]) &&!empty($_POST["code"]) &&!empty($_POST["address"]) &&!empty($_POST["city"]) &&!empty($_POST["country"]) &&!empty($_POST["hideoutType"])){
$code = strip_tags($_POST["code"]);
$address = strip_tags($_POST["address"]);
$hideoutType = strip_tags($_POST["hideoutType"]);
$country = strip_tags($_POST["country"]);
$city = strip_tags($_POST["city"]);

require_once "../../includes/DB.php";

$sql = "INSERT INTO hideout(code, address, hideoutType, country, city) VALUES(:code, :address, :hideoutType, :country, :city)";

$query = $dbConnect->prepare($sql);

$query->bindValue(':code', $code, PDO::PARAM_STR);
$query->bindValue(':address', $address, PDO::PARAM_STR);
$query->bindValue(':hideoutType', $hideoutType, PDO::PARAM_STR);
$query->bindValue(':country', $country, PDO::PARAM_STR);
$query->bindValue(':city', $city, PDO::PARAM_STR);

if(!$query->execute()){
  die("Failed to insert INTO hideout");
}
$id = $dbConnect->lastInsertId();

// header("Location: nationality.php");
echo "<p>La planque ajoutée sous le numéro ". $id."</p>";
echo "<a href='../lists/hideouts.php'>Retour</a>";
exit;

  }else{
    die("Le formulaire est incomplet");
  }
}
$titre = "Add hideout";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";

?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">

<style>
  input {
    font-size: 1.3em;
    margin-bottom: 10px;
  }

  label {
    width: 220px;

    color: #b2b2b5;
    padding: 5px;
  }
</style>
</head>
<div class="body_page_new">
  <div class="container ms-4">
  <div class="d-flex justify-content-between mt-3 mb-3 mx-2">
  <div><h1>Créer une planque</h1></div> 

 
  </div>  
        <form class="form" action="hideout_new.php" method="post">
          <div class="mb-2">
            <label for="code" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Code</label>
            <input type="text" class="form-control w-50" name="code" id="code" value="">
          </div>
          <div class="mb-2">
            <label for="address" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Adresse</label>
            <input type="text" class="form-control w-50" name="address" id="address" value="">
          </div>
          <div class="mb-2">
            <label for="city" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Ville</label>
            <input type="text" class="form-control w-50" name="city" id="city" value="">
          </div>
          <div class="mb-2">
            <label for="hideoutType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type</label>
            <input type="text" class="form-control w-50" name="hideoutType" id="hideoutType" value="">
          </div>

          <div class="mb-2">
          <label for="country" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Pays</label><br>
          <?php include_once "../lists/countries_list.php"; ?>
          <select name="country" id="country" class="fs-5 form-control w-50">
            <?php
          foreach ($countries as $country) {
            echo '<option value="'.$country["name"].'" name="<?= $country["name"] ?>'.$country["name"].'</option>';
        }
          ?>
          </select>
        </div>
   <?php
include_once "btn_create.php";
?>
 
</form>
      </div>
      </div>
<?php
include_once "../includes/admin_footer.php";
?>
</div>