<?php
require_once "../../includes/DB.php";

$idMission = $_GET["id"];
$sql = "SELECT * FROM missionType";
$query = $dbConnect->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM mission_missionType WHERE mmt_missionId='$idMission'";
$query2 = $dbConnect->prepare($sql2);
$query2->execute();

while ($row = $query2->fetch(PDO::FETCH_ASSOC)) :
  $mmt_missionId = $row["mmt_missionId"];
  $mmt_missionTypeId = $row["mmt_missionTypeId"];
endwhile;
var_dump($mmt_missionTypeId);
$sql3 = "SELECT title FROM missionType WHERE id='$mmt_missionTypeId'";
$query3 = $dbConnect->prepare($sql3);
$query3->execute();
$missionType = $query3->fetch();
$missionTypeTitle = $missionType[0];
var_dump($missionTypeTitle);

// end missionType


if (isset($_POST["submit"])) {

  $title = $_POST["title"];
  $description = $_POST["description"];
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];
  $country = $_POST["country"];
  $missionStatus = $_POST["missionStatus"];
  $codeName = $_POST["codeName"];
  $mmt_missionTypeId = strip_tags($_POST["mmt_missionTypeId"]);


  $sql4 = "UPDATE mission SET title='$title', description='$description', startDate='$startDate', endDate='$endDate', country='$country', missionStatus='$missionStatus', codeName='$codeName' WHERE id='$idMission'";

  $query4 = $dbConnect->query($sql4);
  $Execute = $query4->execute();
  if ($Execute) {
    echo "<p style=\"background: darkgrey; color: white; font-weight: bold;\" class=\"text-center p-2\">La mission modifiée sous le numéro " . $idMission .
      "<a class=\"fs-4 ms-3 text-bold text-dark\" href='../lists/missions_adm.php'>Retour</a></p>";

    // header("Location: ../lists/missions_adm.php");


  }
  $sql5 = "UPDATE mission_missionType SET mmt_missionTypeId='$mmt_missionTypeId' WHERE mmt_missionId='$idMission'";

  $query5 = $dbConnect->query($sql5);
  $Execute = $query5->execute();
}

$titre = "Modifier la mission";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link href="../../style/style_in_ad.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">
</head>
<?php
global $dbConnect;
// require_once "../../includes/DB.php";
$sql6 = "SELECT * FROM `mission` WHERE `id` = '$idMission'";
$query6 = $dbConnect->query($sql6);
$query6->execute();
while ($row = $query6->fetch()) {
  $id = $row["id"];
  $title = $row["title"];
  $description = $row["description"];
  $startDate = $row["startDate"];
  $endDate = $row["endDate"];
  $user_country = $row["country"];
  $missionStatus = $row["missionStatus"];
  $codeName = $row["codeName"];
}

?>

<div class="py-4 body_page_new">
  <div>
    <h1>Modifier la mission</h1>


    <form method="post" action="mission_update.php?id=<?php echo $idMission; ?>">
      <div class="mb-3">
        <!-- ******************titre de la mission****************** -->
        <div class="mb-3">
          <label for="title" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Titre</label>
          <input type="text" class="form-control w-50" name="title" id="title" value="<?php echo $title ?>">
        </div>
        <!-- ******************Description de la mission****************** -->
        <div class="mb-3 d-flex" style="align-items: start;">
          <label for="description" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Description</label>
          <textarea name="description" id="description" cols="54" rows="10"><?php echo $description ?></textarea>
        </div>
        <!-- ******************startDate de La mission****************** -->
        <div class="mb-3 d-flex">
          <label for="startDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de debut</label>
          <button type="button" class="fs-6 me-4" onclick="startDateBtn()" value="<?php echo $startDate ?>" name="btnStartDate" id="btnStartDate"><?php echo $startDate ?></button>
          <input type="dateTime" style="display: none;" name="startDate" id="startDate" placeholder="<?php echo $startDate ?>" value="<?php echo $startDate ?>">


        </div>
        <!-- ******************endDate de La mission****************** -->
        <div class="mb-3 d-flex">
          <label for="endDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de debut</label>
          <button type="button" class="fs-6 me-4" onclick="endDateBtn()" value="<?php echo $endDate ?>" name="btnStartDate" id="btnStartDate"><?php echo $endDate ?></button>
          <input type="dateTime" style="display: none;" name="endDate" id="endDate" placeholder="<?php echo $endDate ?>" value="<?php echo $endDate ?>">
        </div>
        <!-- ******************Pays de la mission****************** -->
        <div class="mb-3">
          <label for="country" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Pays</label>
          <input type="hidden" name="country" id="user_country" value="<?php echo $user_country ?>">
          <?php include_once "../lists/countries_list.php"; ?>
          <select name="country" id="country" class="fs-5">
            <?php
            foreach ($countries as $country) {
              $country_title = $country['name'];
              if ($country_title == $user_country) {
                $selected = "selected";
              } else {
                $selected = "";
              }
              echo "<option value=" . $country_title . " " . $selected . ">" . $country_title . "</option>";
            }

            ?>
        </div>
        <script>
          let change_country_btn = document.getElementById("change_country_btn");
          let countries_list = document.getElementById("countries_list");
          change_country_btn.addEventListener("click", function() {
            countries_list.style.display = "block";
          });
        </script>

        </select>
      </div>
      <!-- ******************missionStatus de La mission****************** -->
      <div class="mb-3">
        <label for="missionStatus" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Status</label>
        <input type="text" name="missionStatus" id="missionStatus" value="<?php echo $missionStatus ?>">
      </div>
      <!-- ****************codeName de La mission****************** -->
      <div class="mb-3">
        <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label>
        <input type="text" name="codeName" id="codeName" value="<?php echo $codeName ?>">
      </div>
      <!-- **********Type de mission*********** -->
      <div class="mb-3">
        <label for="missionType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type de mission</label>
        <input type="hidden" name="missionType" id="missionType" value="<?= $mmt_missionTypeId ?>" />
        <select class="form-control w-50" name="mmt_missionTypeId">
          <?php
          foreach ($result as $tab) {
            $mt_id = $tab['id'];
            $mt_title = $tab['title'];
            if ($mt_id == $mmt_missionTypeId) {
              $selected = "selected";
            } else {
              $selected = "";
            }
            echo "<option value=" . $mt_id . " " . $selected . ">" . $mt_title . "</option>";
          }

          ?>
        </select>
      </div>







      <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Enregistrer</button>
    </form>

  </div>

  <script>
    // var d = new Date();
    // document.getElementById("startDate").valueAsDate=d;
    // document.getElementById("endDate").valueAsDate=d;
  </script>

  <!-- <script>
  let startDate =document.getElementById("startDate");
  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
 
formatDate(startDate);
    </script> -->
  <script>
    function startDateBtn() {
      var startDateBtn = document.getElementById("startDateBtn");
      var startDate = document.getElementById("startDate");
      if (startDate.style.display === "none") {
        startDate.style.display = "block";
      } else if (startDate.style.display === "block") {
        startDate.style.display = "none";
      }
    }

    function endDateBtn() {
      var endDateBtn = document.getElementById("endDateBtn");
      var endDate = document.getElementById("endDate");
      if (endDate.style.display === "none") {
        endDate.style.display = "block";
      } else if (endDate.style.display === "block") {
        endDate.style.display = "none";
      }
    }
  </script>
  <?php
  include_once "../includes/admin_footer.php";
  ?>