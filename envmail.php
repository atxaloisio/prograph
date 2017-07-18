<?php
$to = "atxaloisio@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@atxsoftware.com.br" . "\r\n" .
"CC: atxaloisio@hotmail.com";

mail($to,$subject,$txt,$headers);
?>