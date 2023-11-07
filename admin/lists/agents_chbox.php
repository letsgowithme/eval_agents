<?php require_once "../../includes/DB.php";
$sql = "SELECT * FROM  user  WHERE  userType = 'agent' ORDER BY  lastname  ASC";
$query = $dbConnect->query($sql);
$query->execute();
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $agentId = $row["id"];
  $agent = $row["title"];
?>
  <div>
    <input type="checkbox" name="agent[]" value="<?php echo $agent ?>" class="agent_choices" selected=false><?php echo $agent ?>
    <span name="<?= $agentId ?>" class="hidden" value="<?= $agentId ?>"></span><br>
  </div>
<?php
}
?>