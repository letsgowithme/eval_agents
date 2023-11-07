<?php 
require_once "../../includes/DB.php";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
$titre = "Mission";
$sql_s1 = "SELECT * FROM missionType ORDER BY title ASC";
$query_s1 = $dbConnect->prepare($sql_s1);
$query_s1->execute();

$sql_s2 = "SELECT * FROM speciality ORDER BY title ASC";
$query_s2 = $dbConnect->query($sql_s2);
$query_s2->execute();

$sql_s4 = "SELECT * FROM person WHERE userType='contact' ORDER BY firstname ASC"; 
$query_s4 = $dbConnect->query($sql_s4);
$query_s4->execute();

$sql_s5 = "SELECT * FROM person WHERE userType='cible'  ORDER BY lastname ASC"; 
$query_s5 = $dbConnect->query($sql_s5);
$query_s5->execute();

$sql_s7 = "SELECT * FROM person WHERE userType='agent'  ORDER BY lastname ASC"; 
$query_s7 = $dbConnect->query($sql_s7);
$query_s7->execute();

//on traite le formulaire
if(!empty($_POST)){
  if(isset($_POST["title"], $_POST["description"], $_POST["startDate"], $_POST["endDate"], $_POST["countryList"], $_POST["mis_hideouts"], $_POST["missionStatus"], $_POST["codeName"], $_POST["mmt_missionTypeId"], $_POST["agents"], $_POST["contacts"], $_POST["targets"]) &&!empty($_POST["title"]) &&!empty($_POST["description"]) &&!empty($_POST["startDate"]) &&!empty($_POST["endDate"]) &&!empty($_POST["countryList"]) &&!empty($_POST["missionStatus"]) &&!empty($_POST["codeName"]) &&!empty($_POST["mmt_missionTypeId"]) &&!empty($_POST["agents"])  &&!empty($_POST["targets"]) &&!empty($_POST["contacts"])){

$title = strip_tags($_POST["title"]);
$description = strip_tags($_POST["description"]);
$startDate = strip_tags($_POST["startDate"]);
$endDate = strip_tags($_POST["endDate"]);
$country = strip_tags($_POST["countryList"]);

$missionStatus = strip_tags($_POST["missionStatus"]);
$codeName = strip_tags($_POST["codeName"]);
$mmt_missionTypeId = strip_tags($_POST["mmt_missionTypeId"]);
$specialityId = strip_tags($_POST["speciality"]);
$agents = serialize($_POST["agents"]);
$contacts = serialize($_POST["contacts"]);
$mis_hideouts = serialize($_POST["mis_hideouts"]);
$targets = serialize($_POST["targets"]);
// ***************************************************

$sql_i1 = "INSERT INTO mission(title, description, startDate, endDate, country, missionStatus, codeName) 
VALUES(:title, :description, :startDate, :endDate, :country, :missionStatus, :codeName);";

$query_i1 = $dbConnect->prepare($sql_i1);

$query_i1->bindValue(':title', $title, PDO::PARAM_STR);
$query_i1->bindValue(':description', $description, PDO::PARAM_STR);
$query_i1->bindValue(':startDate', $startDate, PDO::PARAM_STR);
$query_i1->bindValue(':endDate', $endDate, PDO::PARAM_STR);
$query_i1->bindValue(':country', $country, PDO::PARAM_STR);
$query_i1->bindValue(':missionStatus', $missionStatus, PDO::PARAM_STR);
$query_i1->bindValue(':codeName', $codeName, PDO::PARAM_STR);

if(!$query_i1->execute()){
  die("Failed to insert INTO mission");
}
$id = $dbConnect->lastInsertId();
$mmt_missionId = $dbConnect->lastInsertId();

$sql_i2 = "INSERT INTO mission_missionType (mmt_missionId, mmt_missionTypeId) VALUES('$mmt_missionId', '$mmt_missionTypeId');";
$query_i2 = $dbConnect->prepare($sql_i2);
$query_i2->execute();


$sql_i3 = "INSERT INTO mission_speciality (mission_Id, mis_spec_id) VALUES('$mmt_missionId', '$specialityId');";
$query_i3 = $dbConnect->prepare($sql_i3);
$query_i3->execute();

$sql_i4 = "INSERT INTO mission_agents (ma_mission_id, agents) VALUES('$mmt_missionId', '$agents');";
$query_i4 = $dbConnect->prepare($sql_i4);
$query_i4->execute();

$sql_i5 = "INSERT INTO mission_contacts (mc_mission_id, contacts) VALUES('$mmt_missionId', '$contacts');";
$query_i5 = $dbConnect->prepare($sql_i5);
$query_i5->execute();

$sql_i6 = "INSERT INTO mission_targets (mt_mission_id, targets) VALUES('$mmt_missionId', '$targets');";
$query_i6 = $dbConnect->prepare($sql_i6);
$query_i6->execute();

$sql_i7 = "INSERT INTO mission_hideouts (missionId, mis_hideouts) VALUES('$mmt_missionId', '$mis_hideouts');";
$query_i7 = $dbConnect->prepare($sql_i7);
$query_i7->execute();
echo "<p>La mission ajoutée sous le numéro ". $id."</p>";
echo "<a href='missions_adm.php'>Retour</a>";
exit;
  }else{
    die("Le formulaire est incomplet");
  }
}
?>
<link rel="stylesheet" href="../../style/style_in_ad.css">
<link rel="stylesheet" href="../../style/style.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
      $("#countryList").on("change", function(){
             var countryList = $("#countryList").val();
             var hideout = $("#hideout").val();
             if(countryList){
                  $.ajax({
                    type: "POST",
                    url: "../ajax/ajaxData.php",
                    data: 'countryList='+countryList,
                    success:function(response){
                   
                  $("#hideout").html(response);
                  }
                  })
             }else{
              $("#hideout").html("<option value=''>Pas de planques dans ce pays></option>");
             }
      });     
      // ***************************************
      $("#countryList").on("change", function(){
             var countryList = $("#countryList").val();
             var contacts = $("#contacts").val();
             if(countryList){
                  $.ajax({
                    type: "POST",
                    url: "../ajax/ajaxData2.php",
                    data: 'countryList='+countryList,
                    success:function(response){
                  
                  $("#contacts").html(response);
                  }
                  })
             }else{
              $("#contacts").html("<option value=''>Pas de contacts dans ce pays></option>");
             }
      });   
       
  
      //  *********************************************
      $("#targets").on("click", function(){
             var agents = $("#agents").val();
             var targets = $("#targets").val();
             if(targets){
                  $.ajax({
                    type: "POST",
                    url: "../ajax/ajaxData2.php",
                    data: 'targets='+targets,
                    success:function(response){
                  //  alert(response);
              
                   
                  $("#agents").html(response);
                  }
                  })
             }else{
              $("#agents").html("<option value=''>Pas d'agents requis></option>");
             }
      });  
    // ****************************************************
    $("#description").on("click", function(){
             var title = $("#title").val();
             if(title){
                  $.ajax({
                    type: "POST",
                    url: "../ajax/ajaxData3.php",
                    data: 'title='+title,
                    success:function(response){
                  //  alert(response);
                  $("#title").html(response);
                  }
                  })
             }
      });   
     
       
                // afficher les agents avec specialité choisie
            $("#speciality").on("change", function(){
             var speciality = $("#speciality").val();
             var agents = $("#agents").val();
             if(speciality){
                  $.ajax({
                    type: "POST",
                    url: "../ajax/ajaxData2.php",
                    data: 'speciality='+speciality,
                    success:function(response){
                  //  alert(response);
                 
                  $("#agents").html(response);
                  }
                  })
             }else{
              $("#agents").html("<option value=''>Pas d'agents avec la spécialité requise></option>");
             }
      });   

    }); 
           </script>
 <style>
  .tx_color {
 color: #01013d!important;
          }
 </style>
</head>
<div class="body_page_new py-4">
 <div class="p-4" style="max-width: 1000px;">

<h1>Ajouter une mission</h1>  
 
        <form class="form" action="mission_new.php" method="post">
          <div class="mb-3">
            <!-- **************title************* -->
            <label for="title" class="form-label fw-bold my-2 fs-5 tx_color">Titre</label>
            <input type="text" class="form-control" style="max-width: 400px;"  name="title" id="title" value=""  required=true>
          </div>
          <!-- **************description************* -->
          <label for="description" class="form-label fw-bold my-2 fs-5 tx_color" >Déscription</label>
          <div class="mb-3">
            <textarea id="description" name="description" rows="5" cols="44">
            </textarea>
          </div>
          <!-- **************startDate************* -->

          <div class="mb-3">
            <label for="startDate" class="form-label fw-bold my-2 fs-5 tx_color">Date de debut</label>
            <input type="date" class="form-control" style="max-width: 200px;" name="startDate" id="startDate" value="" >
          </div>
        
          <!-- **************endDate************* -->

          <div class="mb-3">
            <label for="endDate" class="form-label fw-bold my-2 fs-5 tx_color">Date de la fin</label>
            <input type="date" class="form-control" style="max-width: 200px;" name="endDate" id="endDate" value="" >
          </div>
  <!-- <*****************status************************** -->
  <label for="status" class="form-label fw-bold my-2 fs-5 tx_color" id="statusTitle">Status</label>
          <div class="mb-3">              
              <select name="missionStatus" id="status" class="fs-5 w-25">
              <!-- <option value=""></option>; -->
               <option value="En préparation">En préparation</option>;
               <option value="En cours">En cours</option>;
               <option value="Terminé">Terminé</option>;
               <option value="Échec">Échec</option>;
              </select> 
          </div>
        
      <!--  ***************COUNTRY****************** -->

           <label for="countryList" class="form-label fw-bold my-2 fs-5 tx_color" id="pays_label">Pays</label>
          <div class="mb-3">     
              <?php include_once "../lists/countries_list.php"; ?>
              
              <select name="countryList" id="countryList" class="fs-5 w-25">
                <?php
              foreach ($countries as $country) {
                $country_n = $country["name"];
                ?>
               <option value="<?php echo $country_n ?>"><?php echo $country_n ?></option>;
               <?php
            }
              ?> 
              </select> 
          </div>
      <!-- **************hideouts***************** -->
             <?php
             $sql_s6 = "SELECT * FROM hideout";
            $query_s6 = $dbConnect->query($sql_s6);
            $query_s6->execute();
           ?>  
             <label for="hideout" class="form-label fw-bold my-2 fs-5 tx_color">Planques</label>
          <div class="mb-3">     
              <select name="mis_hideouts[]" multiple="multiple" id="hideout" class="fs-5 w-75 h-auto">
                <?php
              //   while ($row = $query_s6->fetch(PDO::FETCH_ASSOC)):
              //   $hideoutId = $row["id"];
              //   $hideoutType = $row["hideoutType"];
              //   $hideout_country = $row["country"];
              //   $hideout_city = $row["city"];
                
              // if($country == $hideout_country){
              //   $selected="selected";
              //   }else{ 
              //  $selected=""; 
              //  } 
                // echo '<option id="'.$hideout_country.'" value="'.$hideout_country.'" "'.$selected." ".' name="'.$hideoutId.'">'.$hideout_country." - ".$hideout_city." - ".$hideoutType.'</option>';
                // endwhile;
               
              ?>
              </select>
          </div>
       <!-- ****************Contacts******************* -->
       <div class="mb-3 mt-4">
          <label for="contacts" class="form-label fw-bold mb-2 fs-5 me-2 tx_color" style="width: 120px;">Contacts</label><br>
          <select name="contacts[]" multiple="multiple" id="contacts" class="fs-5 pb--2 pe-2" style="min-width: 330px;">

            <!-- recuperer les contacts avec ajax-->
       
          </select>
          </div>
          
         <!-- *************Nom de code******************* -->
          <div class="mb-3">
            <label for="codeName" class="form-label fw-bold my-2 fs-5 tx_color">Nome de code</label>
            <input type="text" class="form-control"  style="max-width: 400px;" name="codeName" id="codeName" value="" required>
          </div>
          
         <!-- *****************missionType************** -->
           <label for="missionType" class="form-label fw-bold my-2 fs-5 tx_color">Type de mission</label>
           <select class="form-control"  style="max-width: 400px;" name="mmt_missionTypeId" required id="missionType">
           <option value="Choisir"></option>
           <?php 
           
           while ($row = $query_s1->fetch(PDO::FETCH_ASSOC)) {
            $mt_id = $row["id"];
            $mt_title = $row["title"];
            echo "<option value=".$mt_id."><span>".$mt_title."</span></option>";
          }
           // echo '<pre>';
            // var_dump($speciality);
            // echo '</pre>';

         ?>      
           </select>
  <!-- ****************Targets******************* -->
  <div class="mb-3 d-flex mt-4">
          <label for="targets" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Cibles</label>
          <select name="targets[]" multiple="multiple" id="targets" class="fs-5 pb--2 pe-2" style="min-width: 330px;">

            <!-- recuperer les cibles -->
          <?php 
       while($row = $query_s5->fetch(PDO::FETCH_ASSOC)):
        $targetId = $row["id"];
        $lastname = $row["lastname"];
        $firstname = $row["firstname"];   
        $nation = $row["nationality"];
         echo "<option class=\"py-1\" value=". $row["id"].">".$firstname." ".$lastname." - ".$nation."</option><hr>"; 
      endwhile;
          ?>
          </select>
          </div>
          <!-- ************Speciality **************** -->
          <div class="mb-3 mt-4">
          <label for="speciality" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d;">Spécialité requise</label>
        <br>
          <select name="speciality" id="speciality"  class="fs-5 pb--2 pe-2" style="min-width: 330px;">
          <option></option>
          <?php 
       while ($row = $query_s2->fetch(PDO::FETCH_ASSOC)) {

        $specialityId = $row["id"];
        $specialityTitle = $row["title"];
        // echo "<option class=\"spec\"  value=".$specialityTitle." id=".$specialityTitle.". name=".$specialityId.">".$specialityTitle."</option>"; 
        echo "<option class=\"spec\"  value=".$specialityId."  name=".$specialityTitle.">".$specialityTitle."</option>"; 

      }
          ?>
          </select>
          </div>
        
         <!-- ****************Adents******************* -->
         <div class="mb-3 d-flex mt-4">
          <label for="agents" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Agents</label>
          <select name="agents[]" multiple="multiple" id="agents" class="fs-5 pe-2" style="min-width: 330px;">
     
            <!-- recuperer que les agents avec ajax-->
     
          </select>
          </div>
          <?php
                  include_once "btn_create.php";
            ?>
        </form>
        <button type="button" class="btn btn-primary" id="btn_reload">Réinisialiser</button>
        </div>
   
</div>
<script>
$(document).ready(function () {
$("#btn_reload").click(function () {
location.reload(true);
});
});
</script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>  
        <?php
        include_once "../includes/admin_footer.php";
        ?>
