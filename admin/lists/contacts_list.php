<?php require_once "../../includes/DB.php"; ?>
<div class="mb-3 d-flex mt-4">
          <label for="contacts" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d;">Contacts</label>
<select name="contacts[]" id="contacts" multiple="multiple">
    <!-- <option>Choisir:</option> -->
<?php 
$sql = "SELECT * FROM `user` WHERE `userType`= 'contact' ORDER BY `lastname` ASC";
$query = $dbConnect->query($sql);
$query->execute();
// $tab=$query->fetchAll();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

  $mC_user_id = $row["id"];
  $firstname = $row["firstname"];
  $lastname = $row["lastname"];
 
  ?>
  <option name="contact"><?php echo $firstname."  ". 
  $lastname?><span name="<?= $mC_user_id ?>" class="hidden" 
  value="<?= $mC_user_id ?>"></span></option>
  
  <?php 
  
}?>
</select>
</div>


      

              