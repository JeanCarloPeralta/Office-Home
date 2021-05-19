

<?php         

$cocina = false;
$bano= false;
$sala=false;
$dormitorio=false;

While($sec = mysqli_fetch_array($listaSecciones))
{
  $set = $sec['secciones'];
 
  switch($set){
    case "Cocina":
      $cocina = true;
    break;
    case "Baño":
      $bano = true;
    break;
    case "Sala":
      $sala = true;
    break;
    case "Dormitorio":
      $dormitorio = true;
  }

 } ?> 

<div class="form-check form-check-row divMargin col-2">
  <input class="form-check-input" type="checkbox" id="Checkbox1" name="Checkbox[]" value="Cocina" <?php echo ($cocina === TRUE ? "checked":"") ?>/>
  <label class="form-check-label letra" for="Checkbox1">Cocina</label>
</div>

  <div class="form-check form-check-row divMargin col-2">
  <input class="form-check-input" type="checkbox" id="Checkbox2" value="Sala" name="Checkbox[]" <?php echo ($sala === TRUE ? "checked":"")?>>
  <label class="form-check-label letra" for="Checkbox2">Sala</label>
</div>

  <div class="form-check form-check-row divMargin col-2">
  <input class="form-check-input" type="checkbox" id="Checkbox3" value="Baño" name="Checkbox[]"  <?php echo ($bano === TRUE ? "checked":"")?>>
  <label class="form-check-label letra" for="Checkbox3">Baño</label>
</div>  
  <div class="form-check form-check-row divMargin">
  <input class="form-check-input" type="checkbox" id="Checkbox4" value="Dormitorio" name="Checkbox[]" <?php echo ($dormitorio === TRUE ? "checked":"")?>>
  <label class="form-check-label letra" for="Checkbox4">Dormitorio</label>
</div>   