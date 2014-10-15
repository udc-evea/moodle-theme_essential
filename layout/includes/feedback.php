<!php @import url(http://fonts.googleapis.com/css?family=Lobster); ?>

<div id="divFeedback">
    <div id="divFeedCabecera" onclick="verFeedback()">
        <h4>Contáctenos</h4>
    </div>
    <div id="divFeedCuerpo">
      <!-- Si es usuario INVITADO, o no es USUARIO muestro el form completo -->
      <?php if(isguestuser() or ($USER->id == 0)):?>
      <form id="frmContacto" name="frmContacto" method="post" action="<?php echo $CFG->wwwroot.'/theme/essential/layout/includes/envioMail.php'?>">
        <div><input name="first_name" type="text" id="first_name" size="40" placeholder="Nombre (*)" /></div>
        <div><input name="last_name" type="text" id="last_name" size="40" placeholder="Apellido (*)" /></div>
        <div><input name="email" type="text" id="email" size="40" placeholder="E-mail (*)" /></div>
        <div><textarea name="comments" maxlength="500" minlenght="10" id="comments" placeholder="Comentarios (*)"></textarea></div>
        <div><input name="btnEnviar" id="btnEnviar" onclick="validacion()" type="button" value="Enviar"></div>
        <div><input name="urlInterno" type="text" id="urlInterno" size="100" value="<?php echo $CFG->wwwroot ?>" style="visibility: hidden" /></div>
      </form>
      <?php else: ?>
      <!-- Si es USUARIO muestro el form reducido -->
      <form id="frmContacto" name="frmContacto" method="post" action="<?php echo $CFG->wwwroot.'/theme/essential/layout/includes/envioMail.php'?>">
        <div><textarea name="comments" maxlength="500" id="comments" placeholder="Comentarios" style="min-height: 170px;max-height: 170px;min-width: 180px; max-width: 180px;"></textarea></div>
        <div><input name="btnEnviar" id="btnEnviar" type="button" onclick="validacion()" value="Enviar"></div>
        <div><input name="first_name" type="text" id="first_name" size="40" value="<?php echo $USER->firstname ?>" style="visibility: hidden" /></div>
        <div><input name="last_name" type="text" id="last_name" size="40" value="<?php echo $USER->lastname ?>" style="visibility: hidden" /></div>
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
        //valido el nombre
   	if (document.frmContacto.first_name.value.length <= 3){
            //alert("Tiene que escribir su nombre");
            $("#first_name").css('border','1px solid red');
            document.frmContacto.first_name.focus();
            return 0;
   	}else{
            $("#first_name").css('border','none');
        }
        //valido el apellido
        if (document.frmContacto.last_name.value.length <= 3){
            //alert("Tiene que escribir su apellido");
            $("#last_name").css('border','1px solid red');
            document.frmContacto.last_name.focus();
            return 0;
   	}else{
            $("#last_name").css('border','none');
        }
        //valido el email
        var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var email = document.frmContacto.email.value;
        var tamañoEmail = document.frmContacto.email.value.length;
        
            if ((!expr.test(email)) || (tamañoEmail <= 7)){
                //alert("el mail esta mal: "+tamañoEmail);
                $("#email").css('border','1px solid red');
                return 0;
            }else{
                $("#email").css('border','none');
            }        
        //valido el comentario
        if ((document.frmContacto.comments.value.length <= 3) || (document.frmContacto.comments.value.length > 500)){
            //alert("Tiene que escribir su apellido");
            $("#comments").css('border','1px solid red');
            document.frmContacto.comments.focus();
            return 0;
   	}else{
            $("#comments").css('border','none');
        }
   	//el formulario se envia 
   	//alert("Muchas gracias por enviar el formulario"); 
   	document.frmContacto.submit();
     
    }
</script>