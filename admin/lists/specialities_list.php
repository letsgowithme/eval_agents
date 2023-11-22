<?php require_once "../../includes/DB.php"; ?>

<div class="mb-3 d-flex mt-4">
  <label for="speciality" class="form-label fw-bold mb-2 fs-4 me-2" style="color: #01013d; width: 120px;">Spécialité</label>
  <select name="speciality[]" id="speciality" multiple="multiple" class="fs-5 pb--2 pe-2" style="min-width: 330px;">
    <?php
    $sql = "SELECT * FROM speciality ORDER BY title ASC";
    $query = $dbConnect->query($sql);
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $specialityId = $row["id"];
      $speciality = $row["title"];
    ?>
      <option class="border" name="<?= $speciality ?>.[]" .><?php echo $speciality ?><span name="<?= $specialityId ?>" class="hidden" value="<?= $specialityId ?>"></span></option>
    <?php
    } ?>
  </select>
</div>