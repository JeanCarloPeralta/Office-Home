function Validar(){
    if(ValidarSecciones()===true){
        if(ValidarTrabajos()===true){
            if(ValidarOtros()){
                return true; //va true en la ultima
            }else{
                return false
            }
           
        }else{
            return false;
        }
        
    }else{
        return false;
    }
    
}

function ValidarSecciones(){

    if( ( $('#Checkbox1').is(':checked') ) || ($ ('#Checkbox2').is(':checked') ) || ( $('#Checkbox3').is(':checked') ) || ( $('#Checkbox4').is(':checked') ) )
    {
        return true;
    }
    else
    {
        Swal.fire({
            icon: 'error',
            title: 'Favor escoger al menos una Sección a Modificar',
            showCloseButton: true,
            showCancelButton: false,           
            confirmButtonColor: '#14BFAC',
            confirmButtonText:'<i class="fa fa-arrow-up" aria-hidden="true"></i> Entendido!'
        })
        return false;
    }
  
    
    
}

function ValidarTrabajos(){
      
    if( ( $('#Checkbox5').is(':checked') ) || ($ ('#Checkbox6').is(':checked') ) || ( $('#Checkbox7').is(':checked') ) )
    {
        return true;
    }
    else
    {
        Swal.fire({
            icon: 'error',
            title: 'Favor escoger al menos un Trabajo a realizar',
            showCloseButton: true,
            showCancelButton: false,
           
            confirmButtonColor: '#14BFAC',
            confirmButtonText:'<i class="fa fa-arrow-up" aria-hidden="true"></i> Entendido!'
        })
        return false;
    }    
}

function ValidarOtros(){

        //cambiar los ids para etiquetas, cambiar el mensaje para mostrar
    if( ( $('#dias').val() !="" )  && ( $('#hora').val() !="" ) && ( $('#ubicacion').val() !="" ) ) 
    {

        document.getElementById("dias").style.borderColor="#14BFAC";
        document.getElementById("hora").style.borderColor="#14BFAC";
        document.getElementById("ubicacion").style.borderColor="#14BFAC";
        return true;
    }
    else
    {
        Swal.fire({
            icon: 'error',
            title: 'Favor completar los espacios, día, hora y ubicación',
            //html: '<b>Trabajo a realizar</b>',
            showCloseButton: true,
            showCancelButton: false,
           
            confirmButtonColor: '#14BFAC',
            confirmButtonText:'<i class="fa fa-arrow-up" aria-hidden="true"></i> Entendido!'
        })

        document.getElementById("dias").style.borderColor="#FF6060";
       document.getElementById("dias").style.borderWidth="medium";
       document.getElementById("hora").style.borderColor="#FF6060";
       document.getElementById("hora").style.borderWidth="medium";
       document.getElementById("ubicacion").style.borderColor="#FF6060";
       document.getElementById("ubicacion").style.borderWidth="medium";
      
        
        return false;
    }
    
}