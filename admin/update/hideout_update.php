<?php
  require_once "../../includes/DB.php";

$up_id = $_GET["id"];
if(isset($_POST["submit"])){
 
  $hideoutCode = $_POST["hideoutCode"];
  $hideoutAddress = $_POST["hideoutAddress"];
  $hideoutType = $_POST["hideoutType"];
  $country = $_POST["country"];


    $sql = "UPDATE `hideout` SET hideoutCode='$hideoutCode', hideoutAddress='$hideoutAddress', hideoutType='$hideoutType', country='$country' WHERE id='$up_id'";

    $query = $dbConnect->query($sql); 
    $Execute = $query->execute();
    if($Execute){
      echo "<p style=\"background: lightblue;\" class=\"text-center p-2\">La planque modifié sous le numéro ". $up_id."</p>";
      echo "<p style=\"background: lightblue;\" class=\"text-center p-2\">Retour à la page de création dans 5 seconds. Sinon appuyez sur le lien : <a href='../lists/hideouts.php'>Retour</a></p>";
    }
}

$titre = "Modifier la planque";
include_once "../includes/admin_header.php";
// include_once "../includes/admin_navbar.php";
?>
  <link href="../../style/style.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../logo.png">
</head>
<body class="body_home body_page">

  <?php 
global $dbConnect;
// require_once "../../includes/DB.php";
$sql = "SELECT * FROM `hideout` WHERE `id` = '$up_id'";
$query = $dbConnect->query($sql);

while($row = $query->fetch()){
  $id = $row["id"];
  $hideoutCode = $row["hideoutCode"];
  $hideoutAddress = $row["hideoutAddress"];
  $hideoutType = $row["hideoutType"];
  $country = $row["country"];
}

  ?>
<div class="container">
<div class="d-flex justify-content-between mt-3 mb-3 mx-2">
<div><h1>Modifier la planque</h1></div> 
<div>
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="../lists/hideouts.php" id="up">Planques</a></button>
   
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="../admin_index.php" id="up">Tableau de bord</a></button>
</div>
</div>    
<form method="post" action="hideout_update.php?id=<?php echo $up_id; ?>">
<div class="mb-3">
  <!-- ******************Code de La planque****************** -->
  <div class="mb-3">
<label for="hideoutCode" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Code de la planque</label>
    <input type="text" name="hideoutCode" id="hideoutCode" value="<?php echo $hideoutCode ?>">
   </div>
   <!-- ******************Adresse de La planque****************** -->
   <div class="mb-3">
    <label for="hideoutAddress" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">hideoutAddress</label>
    <input type="text" name="hideoutAddress" id="hideoutAddress" value="<?php echo $hideoutAddress ?>">
   </div>
 
   <!-- ******************Type de La planque****************** -->
   <div class="mb-3">
   <label for="hideoutType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type de la planque</label> 
  <input type="text" name="hideoutType" id="hideoutType" placeholder="YYYY-MM-DD" value="<?php echo $hideoutType ?>">
    </div>
  
   <!-- ******************Pays de la planque****************** -->
   <div class="mb-3">
    <label for="country" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Pays</label>
    <input type="text" name="country" id="country" value="<?php echo $country ?>"><button type="button" id="change_country_btn">Changer</button>
   </div>
   <div id="countries_list" style="display: none;">
       <?php include_once "../lists/countries_list.php"; ?>
    <select name="country" id="country" class="fs-5">
      <?php
    foreach ($countries as $country) {
      echo '<option value="'.$country["name"].'" name="<?= $country["name"] ?>'.$country["name"].'</option>';
  }
    ?>
    </select>
   </div>
   <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Enregistrer</button>
</form>
<div>
<button type="button" class="login my-4 fs-4 fw-bold" data-toggle="tooltip" data-placement="top">
  <a href="../admin_index.php">Admin</a>
</button>
</div>
</div>
<script>
    let change_country_btn = document.getElementById("change_country_btn");
    let countries_list = document.getElementById("countries_list");
    change_country_btn.addEventListener("click", function() {
      countries_list.style.display = "block";  
    });
  </script>
<?php
include_once "../includes/admin_footer.php";
?>
