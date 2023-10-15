
<select name="codeName" id="codeName">
    <option>Choisir:</option>
<?php 
require_once "includes/DB.php";
$sql = "SELECT * FROM `code_name`";
$query = $dbConnect->query($sql);
$query->execute();
// $codeNames = $query->fetchALL(PDO::FETCH_ASSOC);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $codeNameId = $row["codeNameId"];
  $codeName = $row["codeName"];
  ?>
  <option name="<?= $codeName ?>"><?php echo $codeName ?></option>
  <option name="<?= $codeNameId ?>"><?php echo $codeNameId ?></option>
  <?php }?>
              </select>


         

              