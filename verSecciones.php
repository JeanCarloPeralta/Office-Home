<?php         

        While($sec = mysqli_fetch_array($listaSecciones))
        {
          $set = $sec['secciones'];
          if($set=="Cocina"){
        ?>
        <div class="form-check form-check-row divMargin col-2">
          <input class="form-check-input" type="checkbox" id="Checkbox1" value="opcion1" disabled="true" <?php echo "checked=checked" ?>>
          <label class="form-check-label letra" for="Checkbox1">Cocina</label>
        </div>
        <?php } if ($set=="Sala"){?>
          <div class="form-check form-check-row divMargin col-2">
          <input class="form-check-input" type="checkbox" id="Checkbox2" value="opcion2" disabled="true" <?php echo "checked=checked"?>>
          <label class="form-check-label letra" for="Checkbox2">Sala</label>
        </div>
        <?php } if ($set=="Baño"){?>
          <div class="form-check form-check-row divMargin col-2">
          <input class="form-check-input" type="checkbox" id="Checkbox3" value="opcion3" disabled="true"  <?php echo "checked=checked"?>>
          <label class="form-check-label letra" for="Checkbox3">Baño</label>
        </div>  
        <?php } if ($set=="Dormitorio"){?>
          <div class="form-check form-check-row divMargin">
          <input class="form-check-input" type="checkbox" id="Checkbox4" value="opcion3" disabled="true" <?php echo "checked=checked"?>>
          <label class="form-check-label letra" for="Checkbox4">Dormitorio</label>
        </div>   
        <?php } }?>     