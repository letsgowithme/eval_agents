<?php
$users = true;
require_once "../../includes/DB.php";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
$titre = "Users";
$count = 0;
?>
<link rel="stylesheet" href="../../style/style_in_ad.css">
<link rel="stylesheet" href="../../style/style.css">
<style>
  input {
    margin-bottom: 10px;
  }
   
  label {
    font-size: 1.3em;
  }
 #datatable_wrapper{
  position: absolute!important;
  margin-left: 1%!important;
 }
  .col_wh,
  span,
  th,
  td{
    color: white;
  }
</style>
</head>
<!-- page users begins -->
<div class="body_admin" style="margin-left: 0;">
  <div>
    <h1 class="p-2 title_adm">Liste d'utilisateurs</h1>
    <div class="d-flex">
      <!-- button agents -->
      <a href="../new/agent_new.php" class="btn btn-primary mb-4 me-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
          <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
        </svg>
        <span class="fs-5 ms-1">Agent</span>
      </a>
      <!-- button contacts -->
      <a href="../new/contact_target_new.php" class="btn btn-primary mb-4 me-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
          <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
        </svg>
        <span class="fs-5 ms-1">Contact</span>
      </a>
      <!-- button targets -->
      <a href="../new/contact_target_new.php" class="btn btn-primary mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
          <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
        </svg>
        <span class="fs-5 ms-1">Cible</span>
      </a>
    </div>
  </div>
  <div style="max-width: 70%!important;">
    <table id="datatable" class="display" style="border: 3px solid black; background:  #404144;">
      <thead class="my-4">
        <tr>
          <th class="hide_xs">Id</th>
          <th class="text-center px-4 py-2 hide_xs">Prénom</th>
          <th class="text-center px-4 py-2">Nom</th>
          <th class="text-center px-4 py-2 hide_xs">Nationalité</th>
          <th class="text-center px-4 py-2 hide_xs">Pays</th>
          <th class="text-center px-4 py-2">Type</th>
          <th class="text-center px-4 py-2">Actions</th>
          <th class="text-center px-4 py-2">Détails</th>
        </tr>
      </thead>
      <tbody>
        <?php
        global $dbConnect;
        $sql = "SELECT * FROM person ORDER BY id ASC";
        $query = $dbConnect->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) :
          $count++;
          $id = $row["id"];
          $firstname = $row["firstname"];
          $lastname = $row["lastname"];
          $nationality = $row["nationality"];
          $country = $row["country"];
          $userType = $row["userType"];
        ?>
          <tr>
            <td class="hide_xs"><?php echo  $id ?></td>
            <td class="text-center  px-4 py-2 hide_xs"><?php echo  $firstname ?></td>
            <td class="text-center  px-4 py-2"><?php echo  $lastname ?></td>
            <td class="text-center px-4 py-2 hide_xs"><?php echo  $nationality ?></td>
            <td class="text-center px-4 py-2 hide_xs"><?php echo  $country ?></td>
            <td class="text-center px-4 py-2"><?php echo  $userType ?></td>
            <td class="text-center">
              <a class="btn btn-success" href="../update/user_update.php?id=<?php echo $id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                </svg></a>
              <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $count ?>" class="btn btn-danger" href="../update/delete.php?id=<?php $row["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                </svg></button>
            </td>
            <td class="text-center"><a href="../details/userDetails.php?id=<?php echo $id ?>">Details</a></td>
          </tr>
          <!-- Modal -->
          <div class="modal fade" id="deleteModal<?php echo $count ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Vous voulez vraiment supprimer l'utilisateur numero <?php echo  $id ?> ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <a href="../update/delete.php?id=<?php echo $row["id"] ?>" type="button" class="btn btn-danger">Supprimer</a>
                </div>
              </div>
            </div>
          </div>
          <!-- end modal -->
        <?php endwhile ?>
      </tbody>
    </table>
    </div>

  </div>
  
</div>
  
</div>
<div class="btns_line">
<div class="text-center my-2">
  <button type="button" class="btn"><a href="#up" class=" text-decoration-none btn_up">Vers le haut</a></button>
      </div>
  <div class="text-center my-2">
    <button type="button" class="btn"><a href="../main/admin_index.php" class="text-decoration-none btn_home">Accueil</a></button>
  </div>
        </div>
</div>
       

<div class="footer mt-4">
<?php include_once "../includes/admin_footer.php"; ?>
</div>
