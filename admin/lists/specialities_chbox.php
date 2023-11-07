<?php require_once "../../includes/DB.php"; 
$sql = "SELECT * FROM speciality ORDER BY title ASC";
$query = $dbConnect->query($sql);
$query->execute();
?>

<?php
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  // $specialityId = $row["id"];
  $speciality = $row["title"];
  ?>
  <input type="checkbox" name="specialities[]" value="<?php echo $speciality ?>" class="choices mx-2" selected=false><?php echo $speciality ?><br>

 <?php
}

?>



      

              