<?php       

        While($tipo = mysqli_fetch_array($listaTipo))
        {
          $tip = $tipo['tipoTrabajo'];
          if($tip=="Ampliación"){
        ?>
        <div class="form-check form-check-row divMargin">
          <input class="form-check-input" type="checkbox" id="Checkbox5" checked disabled="true">
          <label class="form-check-label letra" for="Checkbox5">Ampliación</label>
        </div>
        <?php } if ($tip=="Mobiliaro"){?>
        <div class="form-check form-check-row divMargin">
          <input class="form-check-input" type="checkbox" id="Checkbox6" checked disabled="true">
          <label class="form-check-label letra" for="Checkbox6">Cambiar solo mobiliaro</label>
        </div>     
        <?php } if ($tip=="RemodelaciónT"){?>
        <div class="form-check form-check-row divMargin">
          <input class="form-check-input" type="checkbox" id="Checkbox7"  checked disabled="true" >
          <label class="form-check-label letra" for="Checkbox7">Remodelación total</label>
        </div>    
        <?php } }?>     
        
    