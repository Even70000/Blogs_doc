<?php 
//display message
if(isset($_SESSION['SUCCES'])){
    $body .= "<p id='meldingSucces'><b>". $_SESSION['SUCCES'] . "</b></p>";
    unset($_SESSION['SUCCES']);

 }elseif(isset($_SESSION['ERROR'])){
    $body .= "<p id='meldingErorr'><b>". $_SESSION['ERROR'] ."</b></p>";
    unset($_SESSION['ERROR']);
 }
