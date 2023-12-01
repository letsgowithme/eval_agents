<?php
require_once "../../includes/DB.php";
$spec_up_id = $_GET["id"];
if (isset($_POST["submit"])) {
  $title = $_POST["title"];
  $sql = "UPDATE  speciality  SET title='$title' WHERE id='$spec_up_id'";
  $query = $dbConnect->query($sql);
  $Execute = $query->execute();
  if ($Execute) {
    header("Location: ../lists/specialities.php");
  }
}
$titre = "Modifier la spécialité";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">
</head>
<div class="body_page_new">
  <?php
  global $dbConnect;
  // require_once "../../includes/DB.php";
  $sql2 = "SELECT * FROM  speciality  WHERE  id  = '$spec_up_id'";
  $query2 = $dbConnect->query($sql2);
  while ($row = $query2->fetch()) {
    $id = $row["id"];
    $title = $row["title"];
  }
  ?>
  <div class="p-4" style="height: 90vh;">
    <div>
      <div>
        <h1>Modifier la spécialité numéro <?= $spec_up_id ?></h1>
      </div>
      <form method="post" action="speciality_update.php?id=<?php echo $spec_up_id; ?>">
        <div class="mb-3">
          <!-- ******************Code de La planque****************** -->
          <label for="title" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Titre</label>
          <input type="text" name="title" id="title" value="<?php echo $title ?>">
        </div>
        <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Enregistrer</button>
      </form>
      <div>
      </div>
    </div>
  </div>
    <?php
    include_once "../includes/admin_footer.php";
    ?>
  