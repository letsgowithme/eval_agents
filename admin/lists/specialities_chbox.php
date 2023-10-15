<?php require_once "../../includes/DB.php"; 
$sql = "SELECT * FROM `speciality` ORDER BY `title` ASC";
$query = $dbConnect->query($sql);
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $specialityId = $row["id"];
  $speciality = $row["title"];
  ?>
  <div>
  <input type="checkbox" name="specialities[]" value="<?php echo $speciality ?>" class="choices" selected=false><?php echo $speciality ?>
  <span name="<?= $specialityId ?>" class="hidden" value="<?= $specialityId ?>"></span><br> 
</div>
 <?php
}

?>



      

              