<style>
  .body_admin_block{
    min-height: 100%;
   
  }
</style>
</head>
</div>
<!-- table missions begins -->
<div style="max-width: 70%!important; height: auto;">
    <table id="datatable" class="display" style="border: 3px solid black;">
      <thead>
        <tr>
          <?php if (isset($_SESSION["user"])) :
          ?>
            <th class="text-center col_wh" style="min-width: 10px!important; max-width: 200px!important;">Id</th>
          <?php endif;
          if (!isset($_SESSION["user"])) :
          ?>
            <th class="hidden id_th">Id</th>
          <?php endif;
          ?>
          <th class="text-center col_wh" style="min-width: 30px!important;">Titre</th>
          <?php if (isset($_SESSION["user"])) :
          ?>
            <th class="text-center col_wh th_sec" style="min-width: 40px!important;">Actions</th>
          <?php endif;
          ?>
          <th class="text-center py-3 col_wh th_sec" style="min-width: 30px!important;">Détails</th>
        </tr>
      </thead>
      <tbody>
        <?php
        global $dbConnect;
        $sql = "SELECT * FROM  mission";
        $query = $dbConnect->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) :
          $count++;
          $id = $row["id"];
          $title = $row["title"];
        ?>
          <tr>
            <?php if (isset($_SESSION["user"])) :
            ?>
              <td class="text-center py-3 w-25"><?php echo  $id ?></td>
            <?php endif;
            ?>
            <?php if (!isset($_SESSION["user"])) :
            ?>
              <td class="hidden"><?php echo  $id ?></td>
            <?php endif;
            ?>
            <td class="text-center py-3"><?php echo  $title ?></td>
            <?php if (isset($_SESSION["user"])) :
            ?>
              <td class="text-center">
                <a class="btn btn-success action_icon" href="../update/mission_update.php?id=<?php echo $id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                  </svg></a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $count ?>" class="btn btn-danger action_icon" href="../update/delete.php?idMission=<?php $row["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                  </svg></button>
              </td>
            <?php endif;
            ?>
            <?php if (!isset($_SESSION["user"])) :
            ?>
              <td class="text-center"><a href="mission_details.php?id=<?php echo $id ?>" class="link_details">Details</a></td>
            <?php endif; ?>
            <?php if (isset($_SESSION["user"])) :
            ?>
              <td class="text-center" style="min-width: 40px!important;"><a href="../details/mission_adm_details.php?id=<?php echo $id ?>">Details</a></td>
            <?php endif;
            ?>
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
                  Vous voulez vraiment supprimer la mission numero <?php echo $id ?> ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <a href="../update/delete.php?idMission=<?php echo $row["id"] ?>" type="button" class="btn btn-danger">Supprimer</a>
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
<div class="btns_line">
    <div class="text-center btn_line mb-3">
<a href="#up" class="text-decoration-none btn_up mb-3">Vers le haut</a>
</div>

<div class="text-center btn_line mb-1">
<button type="button" class="btn"><a href="../main/admin_index.php" class="text-decoration-none btn_home">Accueil</a></button>
</div>
</div>

