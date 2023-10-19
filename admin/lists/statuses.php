<?php 
require_once "../../includes/DB.php";
?>
<label for="missionStatus" class="form-label fw-bold my-2 fs-4">Status</label>
          <div class="mb-3"> 
              <?php include_once "../lists/mission_status_list.php"; ?>
              <select name="missionStatus" id="missionStatus" class="fs-4 w-25">
                <?php
              foreach ($statuses as $status) {
                echo '<option value="'.$status["name"].'" name="<?= $status["name"] ?>'.$status["name"].'</option>';
            }
              ?>
              </select>
          </div>