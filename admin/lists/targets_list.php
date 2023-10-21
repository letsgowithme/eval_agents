<?php require_once "../../includes/DB.php"; ?>
<div class="mb-3 d-flex mt-4">
          <label for="target" class="form-label fw-bold mb-2 fs-4 me-2 text-light" style="width: 120px;">Cibles</label>
<select name="targets[]" id="targets" multiple="multiple" class="fs-5 pb--2 pe-2"  style="min-width: 330px;">
    <!-- <option>Choisir:</option> -->
<?php 
$sql = "SELECT * FROM `user` WHERE `userType`= 'cible' ORDER BY `lastname` ASC";
$query = $dbConnect->query($sql);
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $mT_user_id = $row["id"];
  $firstname = $row["firstname"];
  $lastname = $row["lastname"];
  ?>
  <option  class="border" name="target"><?php echo $firstname."  ". 
  $lastname?><span name="<?= $mT_user_id ?>" class="hidden" 
  value="<?= $mT_user_id ?>"></span></option> 
  <?php 
  
}?>
</select>
</div>
      

              