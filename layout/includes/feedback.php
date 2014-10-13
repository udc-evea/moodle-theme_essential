<!php @import url(http://fonts.googleapis.com/css?family=Lobster); ?>

<div id="divFeedback">
    <div id="divFeedCabecera">
        <h4>Contáctenos</h4>
    </div>
    <div id="divFeedCuerpo">
      <!-- Si es usuario INVITADO, o no es USUARIO muestro el form completo -->
      <?php if(isguestuser() or ($USER->id == 0)):?>
      <form id="frmContacto" name="frmContacto" method="post" action="<?php echo $CFG->wwwroot.'/theme/essential/layout/includes/envioMail.php'?>">
        <div><input name="first_name" type="text" id="first_name" size="40" placeholder="Nombre" /></div>
        <div><input name="last_name" type="text" id="last_name" size="40" placeholder="Apellido" /></div>
        <div><input name="email" type="text" id="email" size="40" placeholder="E-mail" /></div>
        <div><textarea name="comments" maxlength="500" id="comments" placeholder="Comentarios"></textarea></div>
        <div><input name="btnEnviar" id="btnEnviar" type="submit" value="Enviar"></div>
        <div><input name="urlInterno" type="text" id="urlInterno" size="100" value="<?php echo $CFG->wwwroot ?>" style="visibility: hidden" /></div>
      </form>
      <?php else: ?>
      <!-- Si es USUARIO muestro el form reducido -->
      <form id="frmContacto" name="frmContacto" method="post" action="<?php echo $CFG->wwwroot.'/theme/essential/layout/includes/envioMail.php'?>">
        <div><textarea name="comments" maxlength="500" id="comments" placeholder="Comentarios" style="min-height: 170px;max-height: 170px;min-width: 180px; max-width: 180px;"></textarea></div>
        <div><input name="btnEnviar" id="btnEnviar" type="submit" value="Enviar"></div>
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
    $("#divFeedCuerpo").animate({width: 'toggle'},{direction: 'right'},4500);
    $("#divFeedCabecera").click(function (){
        $("#divFeedCuerpo").animate({width: 'toggle'},{direction: 'right'},9500);
    });
    
    /*
    var frmvalidator  = new Validator("frmContacto");
    frmvalidator.addValidation("name","req","Please provide your name");
    frmvalidator.addValidation("email","req","Please provide your email");
    frmvalidator.addValidation("email","email",
      "Please enter a valid email address");
    */
</script>