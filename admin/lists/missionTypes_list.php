<?php require_once "../../includes/DB.php"; ?>
<div class="mb-3 d-flex mt-4">
    <label for="missionType" class="form-label fw-bold mb-2 fs-4 me-2" style="color: #01013d; width: 120px;">Type de mission</label>
<select name="missionType[]" id="missionType" multiple="multiple" class="fs-5 pb--2 pe-2" style="min-width: 330px;">
    <!-- <option>Choisir:</option> -->
<?php 
$sql = "SELECT * FROM `missionType` ORDER BY `title` ASC";
$query = $dbConnect->query($sql);
$query->execute();
// $tab=$query->fetchAll();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

  $missionTypeId = $row["id"];
  $missionType = $row["title"];
  ?>
  <option  class="border" name="<?= $missionType ?>.[]".><?php echo $missionType ?><span name="<?= $missionTypeId ?>" class="hidden" value="<?= $missionTypeId ?>"></span></option>
  

  <?php 
}?>
</select>
</div>


      