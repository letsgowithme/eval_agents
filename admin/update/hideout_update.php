<?php
  require_once "../../includes/DB.php";

$up_id = $_GET["id"];
if(isset($_POST["submit"])){
 
  $code = $_POST["code"];
  $address = $_POST["address"];
  $hideoutType = $_POST["hideoutType"];
  $country = $_POST["country"];
  $city = $_POST["city"];


    $sql = "UPDATE hideout SET code='$code', address='$address', hideoutType='$hideoutType', country='$country', city='$city' WHERE id='$up_id'";

    $query = $dbConnect->query($sql); 
    $Execute = $query->execute();
    if($Execute){
      echo "<p style=\"background: darkgrey; color: white; font-weight: bold;\" class=\"text-center p-2 fs-4\">La planque modifiée sous le numéro ". $up_id."</p>";
      header("Location: ../lists/hideouts.php");
      
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
$sql = "SELECT * FROM hideout WHERE id = '$up_id'";
$query = $dbConnect->query($sql);

while($row = $query->fetch()){
  $id = $row["id"];
  $code = $row["code"];
  $address = $row["address"];
  $hideoutType = $row["hideoutType"];
  $user_country = $row["country"];
  $user_city = $row["city"];
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
 
      <!-- ******************Ville de La planque****************** -->
      <div class="mb-3">
   <label for="city" class="form-label fw-bold my-2 fs-4" style="color: #01013d;">Ville</label> 
  <input type="text" name="city" id="city"  value="<?php echo $user_city ?>">
    </div>
  
   <!-- ******************Type de La planque****************** -->
   <div class="mb-3">
   <label for="hideoutType" class="form-label fw-bold my-2 fs-4" style="color: #01013d;">Type de la planque</label> 
  <input type="text" name="hideoutType" id="hideoutType"  value="<?php echo $hideoutType ?>">
    </div>
  


      <!-- **************Pays de la mission************* -->
        <div class="mb-3">
          <label for="country" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Pays</label>
          <input type="hidden" name="country" id="user_country" value="<?php echo $user_country ?>">
          <?php include_once "../lists/countries_list.php"; ?>
          <select name="country" id="country" class="fs-5">
            <?php
            foreach ($countries as $country) {
              $country_title = $country['name'];
              if ($country_title == $user_country) {
                $selected = "selected";
              } else {
                $selected = "";
              }
              echo "<option value=" . $country_title . " " . $selected . ">" . $country_title . "</option>";
            }

            ?>
        </div>
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
