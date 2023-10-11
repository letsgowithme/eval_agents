<?php require_once "includes/DB.php"; ?>
<div class="mb-3 d-flex">
          <label for="speciality" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d;">Spécialité d'agent</label>

    <!-- <option>Choisir:</option> -->
<?php 
$sql = "SELECT * FROM `speciality` ORDER BY `title` ASC";
$query = $dbConnect->query($sql);
$query->execute();
// $tab=$query->fetchAll();
$specialities =[];
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

  $specialityId = $row["id"];
  $speciality = $row["title"];
  $specialities[] =  $speciality;
  
  //  echo print_r($specialities);

  
}
$spec_array = implode(",", $specialities);
  echo print_r($spec_array);
  ?>
</select>
</div>


      

              