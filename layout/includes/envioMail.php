<?php    
  // primero hay que incluir la clase phpmailer para poder instanciar
  //un objeto de la misma
  require('class.phpmailer.php');
  require('class.smtp.php');  

if((!empty($_POST['first_name'])) && (!empty($_POST['last_name'])) 
     &&  (!empty($_POST['email'])) && (!empty($_POST['comments']))) {
  
    $FaltanDatos = false; 
     
    //instanciamos un objeto de la clase phpmailer al que llamamos 
    //por ejemplo mail
    $mail = new phpmailer();

    //Definimos las propiedades y llamamos a los métodos 
    //correspondientes del objeto mail

    //Con PluginDir le indicamos a la clase phpmailer donde se 
    //encuentra la clase smtp que como he comentado al principio de 
    //este ejemplo va a estar en el subdirectorio includes  
    //$mail->PluginDir = "";

    //Con la propiedad Mailer le indicamos que vamos a usar un 
    //servidor smtp
    $mail->Mailer = "smtp";

    //Asignamos a Host el nombre de nuestro servidor smtp
    //$mail->Host = "smtp.hotpop.com";
    $mail->Host = "ssl://smtp.gmail.com";
    $mail->Port = 465;

    //Le indicamos que el servidor smtp requiere autenticación
    $mail->SMTPAuth = true;

    //Le decimos cual es nuestro nombre de usuario y password
    $mail->Username = "feedback@udc.edu.ar"; 
    $mail->Password = "cambiar!!!";
    
    //Indicamos cual es nuestra dirección de correo y el nombre que 
    //queremos que vea el usuario que lee nuestro correo
    $mail->From = $_POST['email'];
    $mail->FromName = $_POST['last_name'].", ".$_POST['first_name'];

    //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
    //una cuenta gratuita, por tanto lo pongo a 30  
    $mail->Timeout=20;

    //Indicamos cual es la dirección de destino del correo
    $mail->AddAddress("feedback@udc.edu.ar");

    //Asignamos asunto y cuerpo del mensaje
    //El cuerpo del mensaje lo ponemos en formato html, haciendo 
    //que se vea en negrita
    $mail->Subject = "Comentario de ".$_POST['last_name'].", ".$_POST['first_name']." (".$_POST['email'].")"." en Moodle UDC (Feedback)";
    $mail->Body = "<b>Comentarios:</b> ".$_POST['comments'].".<br><b>Enviado por: </b>".$_POST['last_name'].", ".$_POST['first_name']." (".$_POST['email'].").";

    //Definimos AltBody por si el destinatario del correo no admite email con formato html 
    $mail->AltBody = "Comentarios: ".$_POST['comments'].". Enviado por: ".$_POST['last_name'].", ".$_POST['first_name']." (".$_POST['email'].").";

    //se envia el mensaje, si no ha habido problemas 
    //la variable $exito tendra el valor true
    $exito = $mail->Send();

    //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho 
    //para intentar enviar el mensaje, cada intento se hara 5 segundos despues 
    //del anterior, para ello se usa la funcion sleep	
    $intentos=1;
    while ((!$exito) && ($intentos < 5)) {
          sleep(5);
          //echo $mail->ErrorInfo;
          $exito = $mail->Send();
          $intentos=$intentos+1;
     }
     //defino por defecto que el mail se envió correctamente
     $mailEnviado = true;
     //Compruebo si el mail se envió o hubo algun error
     if(!$exito){
          //echo "Problemas enviando correo electrónico a ".$valor;
          //echo "<br/>".$mail->ErrorInfo;
         $mailEnviado = false;
         $textoH1 = "<h1><b>Se produjo un error al enviar el mail!</b></h1>";
         $textoH3 = "<h3>Analizaremos el error e intentaremos solucionarlo
                        lo mas pronto posible, intenta enviar los comentarios mas tarde.</h3>";
     }else{
         $textoH1 = "<h1><b>El mail se envio correctamente!</b></h1>";
         $textoH3 = "<h3>Muchas gracias por tus comentarios y/o sugerencias, seran tomados en cuenta "
                 . "para el mejoramiento del sitio, atentamente: Universidad Del Chubut.</h3>";
     }
}else{
    $FaltanDatos = true;
    $textoH1 = "<h1><b>Se produjo un error al enviar el mail!</b></h1>";
    $textoH3 = "<h3>Falta completar uno o mas datos para que el mail se envie
                    correctamente. Completelos y vuelva a intentar nuevamente, muchas gracias!.</h3>";
}
/* Redirect browser */
$urlInterno = $_POST['urlInterno'];
//Defino los mensajes al Usuario
$textoRedireccion = "<h4>(la pagina se redirigira automaticamente al inicio)</h4>";
?>
<html>
    <head>
        <title>Comentarios y sugerencias</title>
        <link rel="shortcut icon" href="../../pix/favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../style/essential.css" />
        <link rel="stylesheet" type="text/css" href="../../style/mailPageStyle.css" />
    </head>
    <body>
    <div id="paguinaCompleta">
        <div id="panelCentral">
            <div id="divLogoUdc">
                <img src="../../pix/UdcLogo.png" alt='Logo UDC' title="Logo Universidad Del Chubut">
            </div>            
            <!-- Start Main Regions -->
            <div id="mailMensajeAlUsuario">
                <?php if($FaltanDatos):?>
                    <?php echo $textoH1;?>
                    <?php echo $textoH3;?>
                    <br><br>                    
                    <a id="linkAinicio" href="<?php echo $urlInterno; ?>">Volver al Inicio</a>                    
                    <?php echo $textoRedireccion;?>
                <?php else:?>
                    <?php if($mailEnviado):?>
                        <?php echo $textoH1;?>
                        <?php echo $textoH3;?>
                        <br><br>                    
                        <a id="linkAinicio" href="<?php echo $urlInterno; ?>">Volver al Inicio</a>                    
                        <?php echo $textoRedireccion;?>
                    <?php else:?>
                        <?php echo $textoH1;?>
                        <?php echo $textoH3;?>
                        <br><br>                    
                        <a id="linkAinicio" href="<?php echo $urlInterno; ?>">Volver al Inicio</a>                    
                        <?php echo $textoRedireccion;?>
                    <?php endif;?>
                <?php endif;?>
            </div> 
            <!-- End Main Regions -->
        </div>
    </div>

    <script>
        document.ready(window.setTimeout(location.href = "<?php echo $urlInterno; ?>",18000));
    </script>
    </body>
</html>
