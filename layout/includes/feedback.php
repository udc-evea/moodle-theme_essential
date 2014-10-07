<div id="divFeedback">
    <div id="divFeedCabecera">
        <p>Cabecera</p>
    </div>
    <div id="divFeedCuerpo">
        <p>Cuerpo</p>
    <!--                 <form name="frmContacto" method="post" action="<?php dirname(__FILE__).'/includes/envioMail.php'?>">
                        <table width="500px">
                        <tr>
                        <td>
                        <label for="first_name">Nombre: *</label>
                        </td>
                        <td>
                        <input type="text" name="first_name" maxlength="50" size="25">
                        </td>
                        </tr>
                        <tr>
                        <td valign="top"">
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
                        </table>
                     </form>
    -->
    </div>
</div>            



<script>
    //$("#divFeedCuerpo").toggle('slide','right',1800);
    //$("#divFeedCuerpo").slideToggle(1800);
    $("#divFeedCuerpo").animate({width: 'toggle'});
</script>