<?php 
require_once "../../includes/DB.php";
?>
<div class="mb-3">
          <label for="missionType" class="form-label fw-bold my-2 fs-4" style="color: #01013d;">Type de mission</label><br>
<select name="missionType" id="missionType" class="fs-4 w-25">
    <option>Choisir:</option>
<?php 
$sql = "SELECT * FROM `missionType`";
$query = $dbConnect->query($sql);
$query->execute();
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $missionTypeId = $row["id"];
  $missionType = $row["title"];
  ?>
    <option name="<?= $missionType ?>"><?php echo $missionType ?><span name="<?= $missionTypeId ?>" class="hidden" value="<?= $missionTypeId ?>"></span></option>
  <?php 
}?>
</select>


         

              