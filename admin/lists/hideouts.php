<?php
$hideouts = true;
require_once "../../includes/DB.php";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
$titre = "Hideouts";
$count = 0;
$list = [];
$sql = "SELECT id FROM hideout";
$query = $dbConnect->prepare($sql);
$query->execute();
foreach ($query->fetchAll(PDO::FETCH_NUM) as $tabValues) {
  foreach ($tabValues as $tabElement) {
    $list[] = $tabElement;
  }
}
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
  .body_admin{
    background-color: #b2b2b5;
  }
  .col_wh,
  span,
  th,
  td{
    color: white;
  }
</style>
</head>
<div class="p-3 body_admin ">
  <div>
    <h1>Planques</h1>
    <a href="../new/hideout_new.php" class="btn btn-primary mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
      </svg>
    </a>

  <div class="p-4 body_admin_block container-fluid" 
style="max-width: 70%!important; min-width: 30%!important;"
>
  <div>
    <table id="datatable" class="display" style="border: 3px solid black;">
      <thead class="my-4">
        <tr>
          <th class="text-center fs-5 px-4 py-2 hide_xs">Id</th>
          <th class="text-center fs-5 px-4 py-2 hide_xs">Code</th>
          <th class="text-center fs-5 px-4 py-2 hide_xs">Adresse</th>
          <th class="text-center fs-5 px-4 py-2">Ville</th>
          <th class="text-center fs-5 px-4 py-2">Pays</th>
          <th class="text-center fs-5 px-4 py-2 hide_xs">Type</th>
          <th class="text-center fs-5 px-4 py-2">Actions</th>
        </tr>
      </thead>
      </tr>
      <?php
      global $dbConnect;
      $sql = "SELECT * FROM  hideout";
      $query = $dbConnect->query($sql);
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) :
        $count++;
        $id = $row["id"];
        $code = $row["code"];
        $address = $row["address"];
        $hideoutType = $row["hideoutType"];
        $country = $row["country"];
        $city = $row["city"];
      ?>
        <tr>
          <td class="text-center px-4 py-2 hide_xs"><?php echo $id ?></td>
          <td class="text-center px-4 py-2 hide_xs"><?php echo  $code ?></td>
          <td class="text-center px-4 py-2 hide_xs"><?php echo $address ?></td>
          <td class="text-center px-4 py-2"><?php echo $city ?></td>
          <td class="text-center px-4 py-2"><?php echo $country ?></td>
          <td class="text-center px-4 py-2 hide_xs"><?php echo $hideoutType ?></td>
          <td class="text-center">
            <a class="btn btn-success" href="../update/hideout_update.php?id=<?php echo $id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
              </svg></a>
            <button type="button" data-bs-toggle="modal" <?php if (in_array($row["id"], $list)) {
                                                            echo "disabled";
                                                          } ?> data-bs-target="#deleteModal<?php echo $count ?>" class="btn btn-danger" href="../update/delete.php?idHideout=<?php $row["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
              </svg></button>
          </td>
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
                Vous voulez vraiment supprimer la planque numero <?php echo  $id ?> ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="../update/delete.php?idHideout=<?php echo $row["id"] ?>" type="button" class="btn btn-danger">Supprimer</a>
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
<div class="text-center my-2">
  <button type="button" class="btn"><a href="#up" class=" text-decoration-none btn_up">Vers le haut</a></button>
      </div>
  <div class="text-center my-2">
    <button type="button" class="btn"><a href="../main/admin_index.php" class="text-decoration-none btn_home">Accueil</a></button>
  </div>
</div>
<?php include_once "../../includes/footer.php"; ?>