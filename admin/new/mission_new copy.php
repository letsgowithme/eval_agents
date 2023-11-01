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


// contacts
$sql_s4 = "SELECT * FROM person WHERE userType='contact' ORDER BY firstname ASC"; 
$query_s4 = $dbConnect->query($sql_s4);
$query_s4->execute();
// targets
$sql_s5 = "SELECT * FROM person WHERE userType='cible'  ORDER BY lastname ASC"; 
$query_s5 = $dbConnect->query($sql_s5);
$query_s5->execute();



//on traite le formulaire
if(!empty($_POST)){
  if(isset($_POST["title"], $_POST["description"], $_POST["startDate"], $_POST["endDate"], $_POST["countryList"], $_POST["mis_hideouts"], $_POST["missionStatus"], $_POST["codeName"], $_POST["mmt_missionTypeId"]) &&!empty($_POST["title"]) &&!empty($_POST["description"]) &&!empty($_POST["startDate"]) &&!empty($_POST["endDate"]) &&!empty($_POST["countryList"]) &&!empty($_POST["missionStatus"]) &&!empty($_POST["codeName"]) &&!empty($_POST["mmt_missionTypeId"])){
   


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
$targets = serialize($_POST["targets"]);
$mis_hideouts = serialize($_POST["mis_hideouts"]);

// ***************************************************

$sql_i1 = "INSERT INTO mission(title, description, startDate, endDate, country, missionStatus, codeName) 
VALUES(:title, :description, :startDate, :endDate, :country, :missionStatus, :codeName)";

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

// Remplir table mission_misionType
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


// header("Location: ../lists/missions_adm.php");
echo "<p>La mission ajoutée sous le numéro ". $id."</p>";
echo "<a href='missions_adm.php'>Retour</a>";
exit;

  }else{
    die("Le formulaire est incomplet");
  }
}
// }


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
                    url: "ajaxData.php",
                    data: 'countryList='+countryList,
                    success:function(response){
                   
                  $("#hideout").html(response);
                  }
                  })
             }else{
              $("#hideout").html("<option value=''>Pas de planques dans ce pays></option>");
             }
      });     
    });    
    
      //afficher les agents avec specialité choisie
      $("#speciality").on("change", function(){
             var speciality = $("#speciality").val();
             var agents = $("#agents").val();
             if(speciality){
                  $.ajax({
                    type: "POST",
                    url: "ajaxData.php",
                    data: 'speciality='+speciality,
                    success:function(response){
                   alert(response);
                  // $("#agents").html(response);
                  }
                  })
             }else{
              $("#agents").html("<option value=''>Pas d'agents avec la spécialité requise></option>");
             }
      });     
           </script>
</head>
<div class="body_page_new py-4">
 <div class="p-4" style="max-width: 1000px;">

<h1>Ajouter une mission</h1>  
 
        <form class="form" action="mission_new.php" method="post">
          <div class="mb-3">
            <!-- **************title************* -->
            <label for="title" class="form-label fw-bold my-2 fs-5 text-light">Titre</label>
            <input type="text" class="form-control" style="max-width: 400px;"  name="title" id="title" value=""  required=true>
          </div>
          <!-- **************description************* -->
          <label for="description" class="form-label fw-bold my-2 fs-5 text-light" >Déscription</label>
          <div class="mb-3">
            <textarea id="description" name="description" rows="5" cols="44">
            </textarea>
          </div>
          <!-- **************startDate************* -->

          <div class="mb-3">
            <label for="startDate" class="form-label fw-bold my-2 fs-5 text-light">Date de debut</label>
            <input type="date" class="form-control" style="max-width: 400px;" name="startDate" id="startDate" value="" required>
          </div>
          <!-- **************endDate************* -->

          <div class="mb-3">
            <label for="endDate" class="form-label fw-bold my-2 fs-5 text-light">Date de la fin</label>
            <input type="date" class="form-control" style="max-width: 400px;" name="endDate" id="endDate" value="" required>
          </div>

           <!--  ***************COUNTRY****************** -->

           <label for="countryList" class="form-label fw-bold my-2 fs-5" id="pays_label">Pays</label>
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
             <label for="hideout" class="form-label fw-bold my-2 fs-5">Planques</label>
          <div class="mb-3">     
              <select name="mis_hideouts[]" multiple="multiple" id="hideout" class="fs-5 w-50 h-auto">
                <?php
                while ($row = $query_s6->fetch(PDO::FETCH_ASSOC)):
                $hideoutId = $row["id"];
                $hideoutType = $row["hideoutType"];
                $hideout_country = $row["country"];
                $hideout_city = $row["city"];
                
              if($country == $hideout_country){
                $selected="selected";
                }else{ 
               $selected=""; 
               } 
                echo '<option id="'.$hideout_country.'" value="'.$hideout_country.'" "'.$selected." ".' name="'.$hideoutId.'">'.$hideout_country." - ".$hideout_city." - ".$hideoutType.'</option>';
                endwhile;
                var_dump($country);
              ?>
              </select>
          </div>
         <!-- <*****************status************************** -->
         <div class="mb-3">
         <label for="status" class="form-label fw-bold my-2 fs-5 text-light">Status</label>
            <input type="text" class="form-control" style="max-width: 400px;"  name="status" id="status" value=""  required=true>
          </div>
         <!-- *************Nom de code******************* -->
          <div class="mb-3">
            <label for="codeName" class="form-label fw-bold my-2 fs-5 text-light">Nome de code</label>
            <input type="text" class="form-control"  style="max-width: 400px;" name="codeName" id="codeName" value="" required>
          </div>
          
         <!-- *****************missionType************** -->
           <label for="missionType" class="form-label fw-bold my-2 fs-5 text-light">Type de mission</label>
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

          <!-- ************Speciality **************** -->
          <div class="mb-3 mt-4">
          <label for="speciality" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Spécialité</label>
        <br>
          <select name="speciality" id="speciality"  class="fs-5 pb--2 pe-2" style="min-width: 330px;">
          <!-- <option>Choisir</option> -->
          <?php 
       while ($row = $query_s2->fetch(PDO::FETCH_ASSOC)) {

        $specialityId = $row["id"];
        $specialityTitle = $row["title"];
        echo "<option class=\"spec\"  value=".$specialityId." id=".$specialityTitle.">".$specialityTitle."</option>"; 
      }
          ?>
          </select>
          </div>
        <!-- ****************Agents******************* -->
        <div><input type="" id="special_chosen" value=""></div>
        <div class="mb-3 d-flex mt-4">
        
          <label for="agents" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;" id="agent_label">Agents</label>
          <select name="agents[]" multiple="multiple" id="agents" class="fs-5 pb--2 pe-2" style="min-width: 330px;">

            <!-- recuperer que les agents -->
          <?php 
           $sql_s3 = "SELECT * FROM person, agents"; 
           $query_s3 = $dbConnect->query($sql_s3);
           $query_s3->execute();
        while($row = $query_s3->fetch(PDO::FETCH_ASSOC)):
         $agentId = $row["id"];
         $lastname = $row["lastname"];
         $firstname = $row["firstname"];   
         $specilities = unserialize($row["specilities"]);
         
         echo "<option class=\"py-1 user_spec\"  value=".$agentId." ".$selected." ".">".$user_spec_id." - ".$firstname." ".$lastname."</option><hr>"; 
        endwhile;
          ?>
          
      
          </select>
          </div>
          <!-- ************************************** -->
          <!-- ****************Contacts******************* -->
        <div class="mb-3 d-flex mt-4">
          <label for="contacts" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Contacts</label>
          <select name="contacts[]" multiple="multiple" id="contacts" class="fs-5 pb--2 pe-2" style="min-width: 330px;">

            <!-- recuperer que les agents -->
          <?php 
       while($row = $query_s4->fetch(PDO::FETCH_ASSOC)):
        $contactId = $row["id"];
        $lastname = $row["lastname"];
        $firstname = $row["firstname"];   
        $nation = $row["nationality"];
        echo "<option class=\"py-1\" value=".$contactId.">".$firstname." ".$lastname." - ".$nation."</option><hr>"; 
      endwhile;
          ?>
          </select>
          </div>
          <!-- ****************Targets******************* -->
        <div class="mb-3 d-flex mt-4">
          <label for="targets" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Cibles</label>
          <select name="targets[]" multiple="multiple" id="targets" class="fs-5 pb--2 pe-2" style="min-width: 330px;">

            <!-- recuperer que les agents -->
          <?php 
       while($row = $query_s5->fetch(PDO::FETCH_ASSOC)):
        $targetId = $row["id"];
        $lastname = $row["lastname"];
        $firstname = $row["firstname"];   
        $nation = $row["nationality"];
         echo "<option class=\"py-1\" value=".$targetId.">".$firstname." ".$lastname." - ".$nation."</option><hr>"; 
      endwhile;
          ?>
          </select>
          </div>
          
          <?php
                  include_once "btn_create.php";
                  ?>
        </form>
        <button type="button" class="btn btn-primary" id="btn_reload">Réinisialiser</button>
        </div>
   
        <?php
       
  ?>
</div>
<!-- <script>
          $(document).ready(function(){
            $country = $("#country");
             $hideout = $("#hideout");
             $chosen_country =  $("#chosen_country");
             $("#country").change(function(){
              $("#pays_label").addClass("btn btn-info");
              $("#hideout").val($country.val()); 
             });
           });
           
         </script> -->

          //          <script>
          // $(document).ready(function(){
          //   $speciality = $("#speciality");
          //    $special_chosen = $("#special_chosen");
          //    $agents = $("#agents");
           
          //    $("#speciality").change(function(){
          //     $("#agent_label").addClass("bg-light");
          //     // if($("#user_speciality").val() == speciality.val()){
          //       $("#special_chosen").val($speciality.val()); 
          //       $("#agents").val($speciality.val()); 
          //     // }
              
          //    });
          //  });
           
         </script>

<!-- <script type="text/javascript">
  let agent = document.getElementById("agent");
let spec = document.getElementsByClassName("spec");
let user_spec =document.getElementsByClassName("user_spec");
agent.addEventListener("change", function(){
  // if(spec == user_spec){
    alert(user_spec.value());
  // }else{
  //   alert(user_spec);
  // }
})
  </script> -->

<!-- </script><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js" 
integrity="sha512-ztxZscxb55lKL+xmWGZEbBHekIzy+1qYKHGZTWZYH1GUwxy0hiA18lW6ORIMj4DHRgvmP/qGcvqwEyFFV7OYVQ==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

<!-- <script>
  $(document).ready(function () {
    var agent = $("agent");
    console.log(jQuery.type(agent));
    $("#speciality").on("change", function () {
    var speciality = $("#speciality").val();
    var user_spec = $(".user_spec").val();
    -->
    // console.log(speciality);
    // console.log(user_spec);
  //  if($("#speciality").text() == $(".user_spec").text()) {
    
    
    
  //  }else{
  //   $(".user_spec").addClass("visible");
  //  }
  
  //     if(speciality == user_spec){
  //     console.log(speciality);
  //     console.log(user_spec);
  //       $(".user_spec").addClass("visible");   
  //     } else {
  //       $(".user_spec").text("Pas de spécialité requise")
  //     $(".user_spec").addClass("hidden");
  //     }
  <!-- });
      });

  </script>

  <script> -->
  $(document).ready(function () {
    $("#speciality").on("change", function (callback) {
    var speciality = $("#speciality").val();
    var user_spec = $(".user_spec").val(); 
    // var agent_info = $(".agent_info");
      console.log(speciality);
      console.log(user_spec);
      // console.log(agent_info);
      if(speciality != user_spec){
        $(".user_spec").addClass("hidden");
        $(".user_spec").text("Pas de spécialité requise")
        callback;
        if(speciality == user_spec){
          $(".user_spec").addClass("visible");
        }
      }
  });
      });

  </script> -->

<script>

$(document).ready(function () {
$("#btn_reload").click(function () {
location.reload(true);
});
});
</script>

        <?php
        include_once "../includes/admin_footer.php";
        ?>
