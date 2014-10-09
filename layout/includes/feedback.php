<div id="divFeedback">
    <div id="divFeedCabecera">
        <h4>Feedback</h4>
    </div>
    <div id="divFeedCuerpo">
      <!-- Si es usuario INVITADO, o no es USUARIO muestro el form completo -->
      <?php if(isguestuser() or ($USER->id == 0)):?>
        <form id="frmContacto" name="frmContacto" method="post" action="<?php dirname(__FILE__).'/includes/envioMail.php'?>">
            <div><input name="first_name" type="text" id="first_name" size="40" placeholder="Nombre" /></div>
            <div><input name="last_name" type="text" id="last_name" size="40" placeholder="Apellido" /></div>
            <div><input name="email" type="text" id="email" size="40" placeholder="E-mail" /></div>
            <div><textarea name="comments" maxlength="500" id="comments" placeholder="Comentarios"></textarea></div>
            <div><input name="btnEnviar" id="btnEnviar" type="submit" value="Enviar"></div>
            <!--<table id="tableFormNoUser">
                <tr>
                    <td>
                        <label for="first_name">Nombre: *</label>
                    </td>
                    <td>
                        <input type="text" name="first_name" maxlength="50" size="25">
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label for="last_name">Apellido: *</label>
                    </td>
                    <td>
                        <input type="text" name="last_name" maxlength="50" size="25">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Dirección de E-mail: *</label>
                    </td>
                    <td>
                        <input type="text" name="email" maxlength="80" size="35">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="comments">Comentarios: *</label>
                    </td>
                    <td>
                        <textarea name="comments" maxlength="500" cols="30" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right">
                        <input type="submit" value="Enviar">
                    </td>
                </tr>
            </table>-->
        </form>
      <?php else: ?>
      <!-- Si es USUARIO muestro el form reducido -->
            <h3>ES USUARIO</h3>
            <?php echo "UserId: ".$USER->id ?>
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