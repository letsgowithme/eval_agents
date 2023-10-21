<?php
  require_once "../../includes/DB.php";

$spec_up_id = $_GET["id"];
if(isset($_POST["submit"])){
 
  $title = $_POST["title"];
 
    $sql = "UPDATE `speciality` SET title='$title' WHERE id='$spec_up_id'";

    $query = $dbConnect->query($sql); 
    $Execute = $query->execute();
    if($Execute){
      echo "<p style=\"background: darkgrey;\" class=\"text-center text-white p-2 fs-4\">La spécialité modifiée sous le numéro ". $spec_up_id."<a class=\"ms-2 text-white\" href='../lists/specialities.php'>Liste de spécialités</a></p>";
    }
}

$titre = "Modifier la spécialité";
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
$sql = "SELECT * FROM `speciality` WHERE `id` = '$spec_up_id'";
$query = $dbConnect->query($sql);

while($row = $query->fetch()){
  $id = $row["id"];
  $title = $row["title"];
 
}

  ?>
<div class="p-4">
  <div>
<div><h1>Modifier la spécialité</h1></div> 
  
<form method="post" action="speciality_update.php?id=<?php echo $spec_up_id; ?>">
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
