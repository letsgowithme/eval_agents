<?php require_once "includes/DB.php"; ?>
<div class="mb-3 d-flex">
          <label for="speciality" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d;">Spécialité d'agent</label>
<select name="speciality[]" id="speciality" multiple="multiple">
    <!-- <option>Choisir:</option> -->
<?php 
$sql = "SELECT * FROM `speciality` ORDER BY `title` ASC";
$query = $dbConnect->query($sql);
$query->execute();
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  echo $row['speciality'];
  
  $specialityId = $row["id"];
  $speciality = $row["title"];
  ?>
  <option name="<?= $speciality ?>"><?php echo $speciality ?><span name="<?= $specialityId ?>" class="hidden" value="<?= $specialityId ?>"></span></option>
  

  <?php 
}?>
</select>
</div>


      

              