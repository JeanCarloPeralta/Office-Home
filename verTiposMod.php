<?php        

$ampli = false;
$remode= false;
$mobili=false;

While($tipo = mysqli_fetch_array($listaTipo))
{
  $tip = $tipo['tipoTrabajo'];

    switch($tip){
      case "Ampliación":
        $ampli = true;
      break;
      case "Mobiliaro":
        $mobili = true;
      break;
      case "RemodelaciónT":
        $remode = true;
    } 
}?>     
        
<div class="form-check form-check-row divMargin">
  <input class="form-check-input" type="checkbox" value="Ampliación" name=CheckT[] id="Checkbox5" <?php echo ($ampli === TRUE ? "checked":"") ?> >
  <label class="form-check-label letra" for="Checkbox5">Ampliación</label>
</div>
       
<div class="form-check form-check-row divMargin">
  <input class="form-check-input" type="checkbox" value="Mobiliaro" name=CheckT[] id="Checkbox6" <?php echo ($mobili === TRUE ? "checked":"") ?> >
  <label class="form-check-label letra" for="Checkbox6">Cambiar solo mobiliaro</label>
</div>     
        
<div class="form-check form-check-row divMargin">
  <input class="form-check-input" type="checkbox" value="RemodelaciónT" name=CheckT[] id="Checkbox7"  <?php echo ($remode === TRUE ? "checked":"") ?>  >
  <label class="form-check-label letra" for="Checkbox7">Remodelación total</label>
</div>      