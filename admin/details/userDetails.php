<?php
$user_details = true;
require_once "../../includes/DB.php";
//on demarre la session php


//on verifie s'il ya un id
if (!isset($_GET["id"]) || empty($_GET["id"])) {
  header("Location: user_details.php");
  exit;
}


$id = $_GET["id"];

$sql = "SELECT * FROM person WHERE id = '$id'";
$query = $dbConnect->query($sql);
$query->execute();
$row = $query->fetch();
$userType = $row['userType'];

if($userType == 'agent') {
$sql1 = "SELECT * FROM agents WHERE id_user_agent='$id'";
$query1_1 = $dbConnect->query($sql1);
$query1_1->execute();

$sql2 = "SELECT * FROM agents WHERE id_user_agent='$id'";
$query2 = $dbConnect->query($sql2);
$query2->execute();
// $query1_1->fetch(PDO::FETCH_ASSOC);
$row2 = $query2->fetch(PDO::FETCH_ASSOC);
 $code_id = $row2['code_id'];
}

//ici on a la nationalité



include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";

?>
<link rel="stylesheet" href="../../style/style_in_ad.css">
<link rel="stylesheet" href="../../style/style.css">

</head>
<div class="body_page_new py-4">

  <div style="max-width: 70%!important;">
    <h1 style="color: #1c1c22; background: #bdbdc2;">Utilisateur numéro <?= strip_tags($row['id']) ?></h1>


    <table width="100%" border="2" cellspacing="5" cellpadding="15" style="background: #1c1c22; color: #b2b2b5; padding: 10px;" class="mt-4 fs-5">
      <tr class="text-center">
        <td class="w-50 text-center">Nom</td>
        <td><?= ($row['lastname']) ?></td>
      </tr>
      <tr class="text-center">
        <td>Prénom</td>
        <td><?= ($row['firstname']) ?></td>
      </tr>
      <tr class="text-center">
        <td>Date de naissance</td>
        <td><?= ($row['birthdate']) ?></td>
      </tr>
      <tr class="text-center">
        <td>Nationalité</td>
        <td><?= ($row['nationality']) ?></td>
      </tr>
      <tr class="text-center">
        <td>Nom de code</td>
        <td><?= ($row['codeName']) ?></td>
      </tr>

      <tr class="text-center">
        <td>Type</td>
        <td id="userType" value="<?= $userType ?>"><?= $userType ?></td>
      </tr>
      <?php
      if($userType == 'agent'):
        ?>
      <tr class="text-center" id="agent_specialities">
        <td>Specialitiés</td>
        <?php
        while ($row = $query1_1->fetch(PDO::FETCH_ASSOC)) :
          $specialities = unserialize($row["specialities"]);
        ?>
          <td class="text-center px-4 py-2">
            <?php
            foreach ($specialities as $speciality) :
              echo  $speciality . "<br/>";
            endforeach;
            ?>
          </td>
        <?php
        endwhile;
        ?>

      </tr>
      <tr class="text-center" id="agent_code_id">
        <td>Nom de code</td>
        <td id="code_id" value="<?= $code_id ?>"><?= $row2['code_id'] ?></td>

        </td>
      </tr>
      <?php endif; ?>
    </table>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- <script>
  $(document).ready(function () {
    if($("#userType").val() != "agent"){
      alert($("#userType").val());
      $("#agent_specialities").addClass("hidden");
      $("#agent_code_id").addClass("hidden");
    }else{
      $("#agent_specialities").addClass("visible");
      $("#agent_code_id").addClass("visible");
    }
   
  });

</script> -->
<div style="position: fixed; bottom: 0; left: 50%; transform: translateX(-50%);">
  <?php
  include_once "../../includes/footer.php";
  ?>
