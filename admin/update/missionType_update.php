<?php
  require_once "../../includes/DB.php";

$misType_up_id = $_GET["id"];
if(isset($_POST["submit"])){
 
  $title = $_POST["title"];
 
    $sql = "UPDATE `missionType` SET title='$title' WHERE id='$misType_up_id'";

    $query = $dbConnect->query($sql); 
    $Execute = $query->execute();
    if($Execute){
      echo "<p style=\"background: darkgrey;\" class=\"text-center text-white p-2 fs-4\">Le type de mission modifié sous le numéro ". $misType_up_id."<a class=\"ms-2 text-white\" href='../lists/specialities.php'>Liste de spécialités</a></p>";
    }
}

$titre = "Modifier le type de mission";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
?>
  <link href="../../style/style.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../logo.png">
</head>
<div class="body_page_new">

  <?php 
global $dbConnect;
// require_once "../../includes/DB.php";
$sql = "SELECT * FROM `missionType` WHERE `id` = '$misType_up_id'";
$query = $dbConnect->query($sql);

while($row = $query->fetch()){
  $id = $row["id"];
  $title = $row["title"];
 
}

  ?>
<div class="p-4">
  <div>
<div><h1>Modifier le type de mission</h1></div> 
  
<form method="post" action="missionType_update.php?id=<?php echo $misType_up_id; ?>">
<div class="mb-3">
  <!-- ******************Code de La planque****************** -->
  <div class="mb-3">
<label for="title" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Titre</label>
    <input type="text" name="title" id="title" value="<?php echo $title ?>">
   </div>
 
   <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Enregistrer</button>
</form>
<div>
</div>
</div>

<?php
include_once "../includes/admin_footer.php";
?>
