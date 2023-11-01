<?php require_once "../../includes/DB.php"; ?>
<div class="mb-3 d-flex mt-4">
          <label for="agents" class="form-label fw-bold mb-2 fs-4 me-2 text-light" style="width: 120px;">Agents</label>
<select name="agents[]" id="agents" multiple="multiple" class="fs-5 pb--2 pe-2"  style="min-width: 330px;">
    <!-- <option>Choisir:</option> -->
<?php 
$sql = "SELECT * FROM `person` WHERE `userType`= 'agent' ORDER BY `lastname` ASC";
$query = $dbConnect->query($sql);
$query->execute();
// $tab=$query->fetchAll();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

  $mA_user_id = $row["id"];
  $firstname = $row["firstname"];
  $lastname = $row["lastname"];
  $specialities = $row["specialities"];
  ?>
  <option class="border" name="<?php echo $mA_user_id ?>"><?php echo $firstname."  ". $lastname."  -  ".$specialities;  ?><span name="<?= $mA_user_id ?>" class="hidden" value="<?= $mA_user_id ?>"></span></option>
  
  <?php 
  
}?>

</select>
</div>


      

              