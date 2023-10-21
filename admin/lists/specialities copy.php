<?php 
$specialities=true;
require_once "../../includes/DB.php";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";

$titre = "Specialities";
$count = 0;

?>
<link rel="stylesheet" href="../../style/style_in_ad.css">
<link rel="stylesheet" href="../../style/style.css">
<style>
  input{
    margin-bottom: 10px;
  }
  label{
    font-size: 1.3em;
  }
</style>
</head>
<div class="p-4">
  <div>
<h1>Planques</h1>
<a href="../new/speciality_new.php" class="btn btn-primary mb-4">
<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg>
    </a>
  </div>  
  <div style="max-width: 80%!important;">
    <table id="datatable" class="display" style="border: 3px solid black; background:  #404144;">
      <thead class="my-4">
<tr>

<div class="mb-3 d-flex mt-4">
          <label for="speciality" class="form-label fw-bold mb-2 fs-4 me-2 text-light" style="width: 120px;">Spécialité</label>
<select name="speciality[]" id="speciality" multiple="multiple" class="fs-5 pb--2 pe-2" style="min-width: 330px;">
    <!-- <option>Choisir:</option> -->
<?php 
$sql = "SELECT * FROM `speciality` ORDER BY `title` ASC";
$query = $dbConnect->query($sql);
$query->execute();
// $tab=$query->fetchAll();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

  $specialityId = $row["id"];
  $speciality = $row["title"];
  ?>
  <option  class="border" name="<?= $speciality ?>.[]".><?php echo $speciality ?><span name="<?= $specialityId ?>" class="hidden" value="<?= $specialityId ?>"></span></option>
  

  <?php 
}?>
</select>
</div>


      

              