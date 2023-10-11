<?php 
require_once "includes/DB.php";
?>
<label for="missionStatus" class="form-label fw-bold my-2 fs-5">Status</label>
          <div class="mb-3"> 
              <?php include_once "../../mission_status_list.php"; ?>
              <select name="missionStatus" id="missionStatus">
                <?php
              foreach ($statuses as $status) {
                echo '<option value="'.$status["name"].'" name="<?= $status["name"] ?>'.$status["name"].'</option>';
            }
              ?>
              </select>
          </div>