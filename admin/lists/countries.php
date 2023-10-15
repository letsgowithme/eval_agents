<?php 
require_once "../../includes/DB.php";
?>
<label for="country" class="form-label fw-bold my-2 fs-5">Pays</label>
          <div class="mb-3">     
              <?php include_once "../lists/countries_list.php"; ?>
              <select name="country" id="country">
                <?php
              foreach ($countries as $country) {
                echo '<option value="'.$country["name"].'" name="<?= $country["name"] ?>'.$country["name"].'</option>';
            }
              ?>
              </select>
          </div>