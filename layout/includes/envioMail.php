<?php

  // primero hay que incluir la clase phpmailer para poder instanciar
  //un objeto de la misma
  //require($CFG->wwwroot.'/theme/essential/layout/includes/class.phpmailer.php');
  require('class.phpmailer.php');
  require('class.smtp.php');
  //require(dirname(__FILE__).'/class.phpmailer.php');
  //require "includes/class.phpmailer.php";
  //$nombre_archivo = $CFG->wwwroot.'/theme/essential/layout/includes/class.phpmailer.php';
  //$archivo = fopen($nombre_archivo, 'r')
  //  or exit("no se pudo abrir el archivo ($nombre_archivo)");


  if((!empty($_POST['first_name'])) && (!empty($_POST['last_name'])) 
     &&  (!empty($_POST['email'])) && (!empty($_POST['comments']))) {
  
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
  /*
     if(!$exito)
     {
          echo "Problemas enviando correo electrónico a ".$valor;
          echo "<br/>".$mail->ErrorInfo;	
     }
     else
     {
          echo "Mensaje enviado correctamente";
     }      
  */         
}
/* Redirect browser */
$urlInterno = $_POST['urlInterno'];
header("Location:".$urlInterno);
/* Make sure that code below does not get executed when we redirect. */
exit;
 
//PRUEBA DE ENVIO DE DATOS
/*echo "url: ".$urlInterno."<br>";
echo "url: ".$_POST['first_name']."<br>";
echo "url: ".$_POST['last_name']."<br>";
echo "url: ".$_POST['email']."<br>";
echo "url: ".$_POST['comments']."<br>";
*/