<!php @import url(http://fonts.googleapis.com/css?family=Lobster); ?>

<div id="divFeedback">
    <div id="divFeedCabecera">
        <h4>Contáctenos</h4>
    </div>
    <div id="divFeedCuerpo">
      <!-- Si es usuario INVITADO, o no es USUARIO muestro el form completo -->
      <?php if(isguestuser() or ($USER->id == 0)):?>
      <form id="frmContacto" name="frmContacto" method="post" action="<?php echo $CFG->wwwroot.'/theme/essential/layout/includes/envioMail.php'?>">
        <div><input name="first_name" type="text" id="first_name" size="40" placeholder="Apellido y nombre (*)" /></div>
        <div><input name="email" type="text" id="email" size="40" placeholder="E-mail (*)" /></div>
        <div><textarea name="modificaciones" type="text" id="modificaciones" size="500" placeholder="Que modificaciones le harias al aula? (*)" style="min-height: 20px;max-height: 50px;"></textarea></div>
        <div><textarea name="comoModificar" type="text" id="comoModificar" maxlength="500" placeholder="Como los harias?" style="min-height: 20px;max-height: 50px;"></textarea></div>
        <div><input name="btnEnviar" id="btnEnviar" onclick="validacion()" type="button" value="Enviar"></div>
        <div><input name="urlInterno" type="text" id="urlInterno" size="100" value="<?php echo $CFG->wwwroot ?>" style="visibility: hidden" /></div>
      </form>
      <?php else: ?>
      <!-- Si es USUARIO muestro el form reducido -->
      <form id="frmContacto" name="frmContacto" method="post" action="<?php echo $CFG->wwwroot.'/theme/essential/layout/includes/envioMail.php'?>">
        <div><textarea name="modificaciones" type="text" id="modificaciones" size="500" placeholder="Que modificaciones le harias al aula? (*)" style="min-height: 80px;max-height: 80px;"></textarea></div>
        <div><textarea name="comoModificar" type="text" maxlength="500" id="comoModificar" placeholder="Como los harias?" style="min-height: 80px;max-height: 80px;"></textarea></div>
        <div><input name="btnEnviar" id="btnEnviar" type="button" onclick="validacion2()" value="Enviar"></div>
        <div><input name="first_name" type="text" id="first_name" size="40" value="<?php echo $USER->firstname ?>" style="visibility: hidden" /></div>
        <div><input name="email" type="text" id="email" size="40" value="<?php echo $USER->email ?>" style="visibility: hidden" /></div>
        <div><input name="urlInterno" type="text" id="urlInterno" size="100" value="<?php echo $CFG->wwwroot ?>" style="visibility: hidden" /></div>
      </form>
      <?php endif; ?>
    </div>
</div>            


<script>
    //$("#divFeedCuerpo").toggle('slide','right',1800);
    //$("#divFeedCuerpo").slideToggle(1800);
    //oculto el cuerpo del feedback - donde esta el formulario!
    $("#divFeedCuerpo").animate({width: 'toggle'},{direction: 'right'},4500);
    
    //function verFeedback(){
    //    $("#divFeedCuerpo").animate({width: 'toggle'},{direction: 'right'},5000);
    //};
    $("#divFeedCabecera").bind({
          click: function() {
                $("#divFeedCuerpo").fadeToggle("fast");
                },
          blur: function() {
                $("document").fadeOut("fast");
                }
    });
    
    
    function validacion(){
        //valido el apellido y nombre
   	if (document.frmContacto.first_name.value.length <= 8){
            //alert("Tiene que escribir su nombre");
            $("#first_name").css('border','2px solid red');
            document.frmContacto.first_name.focus();
            return 0;
   	}else{
            $("#first_name").css('border','none');
        }
        //valido el email
        var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var email = document.frmContacto.email.value;
        var tamañoEmail = document.frmContacto.email.value.length;
            if ((!expr.test(email)) || (tamañoEmail <= 7)){
                //alert("el mail esta mal: "+tamañoEmail);
                $("#email").css('border','2px solid red');
                return 0;
            }else{
                $("#email").css('border','none');
            }
        //valido las modificaciones
        if (document.frmContacto.modificaciones.value.length <= 10){
            $("#modificaciones").css('border','2px solid red');
            document.frmContacto.modificaciones.focus();
            return 0;
   	}else{
            $("#modificaciones").css('border','none');
        }
        //valido como haria las modificaciones
        /*if ((document.frmContacto.comoModificar.value.length <= 5) || (document.frmContacto.comoModificar.value.length > 500)){
            $("#comoModificar").css('border','1px solid red');
            document.frmContacto.comoModificar.focus();
            return 0;
   	}else{
            $("#comoModificar").css('border','none');
        }*/
   	//el formulario se envia 
   	document.frmContacto.submit();
     
    }
    
    function validacion2(){
        //valido las modificaciones
        if (document.frmContacto.modificaciones.value.length <= 10){
            $("#modificaciones").css('border','2px solid red');
            document.frmContacto.modificaciones.focus();
            return 0;
   	}else{
            $("#modificaciones").css('border','none');
        }
   	document.frmContacto.submit();
    }
    
</script>