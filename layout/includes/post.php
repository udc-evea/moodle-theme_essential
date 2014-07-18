<?php

    //session_start();

    //if(isset($_SESSION['name'])){
        $text = $_POST['text'];
        $user = $_POST['name'];

        $fp = fopen("log.html", 'a');
        //fwrite($fp, "<div class='msgln'><b style='font-size: 8pt;color: gray;font-family: Arial;'>(".date("d/m/Y G:i:s").")</b><b style='font-size: 10pt;color: red;font-family: Arial;'> ".$user."</b>: <br><p style='font-size: 10pt;font-family: Arial;'>".stripslashes(htmlspecialchars($text))."</p><hr></div>");
        fwrite($fp, "<div class='msgln'><b id='lineaChatFecha'>(".date("d/m/Y G:i:s").")</b><b id='lineaChatNameUser'> ".$user."</b>: <br><p>".stripslashes(htmlspecialchars($text))."</p><hr></div>");
        fclose($fp);
    //}
?>