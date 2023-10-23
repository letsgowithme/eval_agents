<?php
  require_once "../../includes/DB.php";

// $up_id = $_GET["id"];
if(isset($_POST["submit"])){
 
  $code = $_POST["code"];
  $address = $_POST["address"];
  $hideoutType = $_POST["hideoutType"];
  $country = $_POST["country"];


    $sql = "UPDATE `hideout` SET code='$code', address='$address', hideoutType='$hideoutType', country='$country' WHERE id='$up_id'";

    $query = $dbConnect->query($sql); 
    $Execute = $query->execute();
    if($Execute){
      echo "<p style=\"background: darkgrey; color: white; font-weight: bold;\" class=\"text-center p-2 fs-4\">La planque modifiée sous le numéro ". $up_id."<a class=\"fs-4 ms-3 text-bold text-dark\" href='../lists/hideouts.php'>Retour</a></p>";
      
    }
}

$titre = "Modifier la planque";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
?>
  <link href="../../style/style.css" rel="stylesheet" type="text/css">
  <link href="../../style/style_in_ad.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../logo.png">
</head>
<div class="body_page_new">

  <?php 
global $dbConnect;
// require_once "../../includes/DB.php";
$sql = "SELECT * FROM `hideout` WHERE `id` = '$up_id'";
$query = $dbConnect->query($sql);

while($row = $query->fetch()){
  $id = $row["id"];
  $code = $row["code"];
  $address = $row["address"];
  $hideoutType = $row["hideoutType"];
  $country = $row["country"];
}

  ?>
<div class="container">
<div class="d-flex justify-content-between mt-3 mb-3 mx-2">
<div><h1>Modifier la planque</h1></div> 

</div>    
<form method="post" action="hideout_update.php?id=<?php echo $up_id; ?>">
<div class="mb-3">
  <!-- ******************Code de La planque****************** -->
  <div class="mb-3">
<label for="code" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Code de la planque</label>
    <input type="text" name="code" id="code" value="<?php echo $code ?>">
   </div>
   <!-- ******************Adresse de La planque****************** -->
   <div class="mb-3">
    <label for="address" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">address</label>
    <input type="text" name="address" id="address" value="<?php echo $address ?>">
   </div>
 
   <!-- ******************Type de La planque****************** -->
   <div class="mb-3">
   <label for="hideoutType" class="form-label fw-bold my-2 fs-4" style="color: #01013d;">Type de la planque</label> 
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
