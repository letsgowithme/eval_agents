<?php require_once "includes/DB.php"; ?>
<div class="mb-3">
          <label for="speciality" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Spécialité</label><br>
<select name="user" id="user">
    <option>Choisir:</option>
<?php 
$sql = "SELECT * FROM `user`";
$query = $dbConnect->query($sql);
$query->execute();
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $userId = $row["id"];
  $lastname = $row["lastname"];
  $firstname = $row["firstname"];
  $birthdate = $row["birthdate"];
  $nationality = $row["nationality"];
  $codeName = $row["codeName"];
  $userType = $row["userType"];

  ?>
  <option name="<?= $speciality ?>"><?php echo $speciality ?><span name="<?= $specialityId ?>" class="hidden" value="<?= $specialityId ?>"></span></option>
  

  <?php 
}?>
</select>
</div>


      

              