<?php
  require_once "../../includes/DB.php";

$up_id = $_GET["id"];
if(isset($_POST["submit"])){
 
  $title = $_POST["title"];
  $description = $_POST["description"];
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];
  $country = $_POST["country"];
  $missionStatus = $_POST["missionStatus"];
  $codeName = $_POST["codeName"];


    $sql = "UPDATE `mission` SET title='$title', description='$description', startDate='$startDate', endDate='$endDate', country='$country', missionStatus='$missionStatus', codeName='$codeName' WHERE id='$up_id'";

    $query = $dbConnect->query($sql); 
    $Execute = $query->execute();
    if($Execute){
      echo "<p style=\"background: lightblue;\" class=\"text-center p-2\">La mission modifiée sous le numéro ". $up_id."</p>";
      echo "<p style=\"background: lightblue;\" class=\"text-center p-2\"><a href='../../missions.php'>Retour</a></p>";
    }
}

$titre = "Modifier la mission";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
?>
  <link href="../../style/style.css" rel="stylesheet" type="text/css">
  <link href="../../style/style_in_ad.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../logo.png">
</head>
<div class="body_home body_page">

  <?php 
global $dbConnect;
// require_once "../../includes/DB.php";
$sql = "SELECT * FROM `mission` WHERE `id` = '$up_id'";
$query = $dbConnect->query($sql);

while($row = $query->fetch()){
  $id = $row["id"];
  $title = $row["title"];
  $description = $row["description"];
  $startDate = $row["startDate"];
  $endDate = $row["endDate"];
  $country = $row["country"];
  $missionStatus = $row["missionStatus"];
  $codeName = $row["codeName"];

}

 ?>

  
<!-- <div class="container">
<div class="d-flex justify-content-between mt-3 mb-3 mx-2"> -->
<div class="py-4">
<div>
<h1>Modifier la mission</h1>
  
    
<form method="post" action="mission_update.php?id=<?php echo $up_id; ?>">
<div class="mb-3">
  <!-- ******************titre de la mission****************** -->
  <div class="mb-3">
            <label for="title" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Titre</label>
            <input type="text" class="form-control w-50" name="title" id="title" value="<?php echo $title ?>">
          </div>
   <!-- ******************Description de la mission****************** -->
   <div class="mb-3 d-flex" style="align-items: start;" >
    <label for="description" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Description</label>
   <textarea name="description" id="description" cols="54" rows="10"><?php echo $description ?></textarea>
   </div>
   <!-- ******************startDate de La mission****************** -->
   <div class="mb-3 d-flex">
   <label for="startDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de debut</label> 
   <button type="button" class="fs-6 me-4" onclick="startDateBtn()" value="<?php echo $startDate ?>" name="btnStartDate" id="btnStartDate"><?php echo $startDate ?></button>
  <input type="dateTime" style="display: none;" name="startDate" id="startDate" placeholder="<?php echo $startDate ?>" value="<?php echo $startDate ?>">
 
    </div>
       <!-- ******************endDate de La mission****************** -->
   <div class="mb-3 d-flex">
   <label for="endDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de debut</label> 
   <button type="button" class="fs-6 me-4" onclick="endDateBtn()" value="<?php echo $endDate ?>" name="btnStartDate" id="btnStartDate"><?php echo $endDate ?></button>
  <input type="dateTime" style="display: none;" name="endDate" id="endDate" placeholder="<?php echo $endDate ?>" value="<?php echo $endDate ?>">
  </div>
   <!-- ******************Pays de la mission****************** -->
   <div class="mb-3">
    <label for="country" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Pays</label>
    <input type="text" name="country" id="country" value="<?php echo $country ?>"><button type="button" id="change_country_btn" onclick="toggleList()">Changer</button>
   </div>
   <div id="countries_list" style="display: none;">
       <?php include_once "../lists/countries_list.php"; ?>
    <select name="country_list" id="country_list" class="fs-5">
      <?php
    foreach ($countries as $country) {
      echo '<option value="'.$country["name"].'" name="<?= $country["name"] ?>'.$country["name"].'</option>';
  }
    ?>
    </select>
   </div>
 <!-- ******************missionStatus de La mission****************** -->
 <div class="mb-3">
   <label for="missionStatus" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Status</label> 
  <input type="text" name="missionStatus" id="missionStatus" placeholder="YYYY-MM-DD" value="<?php echo $missionStatus ?>">
    </div>
     <!-- ******************codeName de La mission****************** -->
   <div class="mb-3">
   <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label> 
  <input type="text" name="codeName" id="codeName" placeholder="YYYY-MM-DD" value="<?php echo $codeName ?>">
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
// var d = new Date();
// document.getElementById("startDate").valueAsDate=d;
// document.getElementById("endDate").valueAsDate=d;

  </script>

<!-- <script>
  let startDate =document.getElementById("startDate");
  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
 
formatDate(startDate);
    </script> -->
<script>
  function toggleList() {
  var change_country_btn = document.getElementById("change_country_btn"); 
  var countries_list = document.getElementById("countries_list");
  if (countries_list.style.display === "none") {
    countries_list.style.display = "block";
  } else if(countries_list.style.display === "block") {
    countries_list.style.display = "none";
  }
}
function startDateBtn() {
  var startDateBtn = document.getElementById("startDateBtn"); 
  var startDate = document.getElementById("startDate");
  if (startDate.style.display === "none") {
    startDate.style.display = "block";
  } else if(startDate.style.display === "block") {
    startDate.style.display = "none";
  }
}
function endDateBtn() {
  var endDateBtn = document.getElementById("endDateBtn"); 
  var endDate = document.getElementById("endDate");
  if (endDate.style.display === "none") {
    endDate.style.display = "block";
  } else if(endDate.style.display === "block") {
    endDate.style.display = "none";
  }
}

  </script>
<?php
include_once "../includes/admin_footer.php";
?>
