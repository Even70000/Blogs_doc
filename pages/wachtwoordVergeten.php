<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $reset = new WachtwoordResseten();
  if($reset->sendLink($_POST['resetEmail'])){
    $_SESSION['SUCCES'] = 'Er is een link naar uw email gestuurd klik daarop voor nieuwe wachtwoord';
    header("Location:index.php?page=".WACHTWOORD_VERGETEN_PAGE."");
    return;
  }else{
    $_SESSION['ERROR'] = 'Er is iets fout gegaan!';
    header("Location:index.php?page=".WACHTWOORD_VERGETEN_PAGE."");
    return;
  }
 
} 

$body = "<div>";
  $body .= "<div>";
    $body .= "<div class='melding'>";
      // include the file that displays the Message error or succes
      include_once(MELDING);
      //
    $body .= "</div>";
    $body .= "<div>";
      $body .= "<form action='' method='POST'>";
        $body .= "<p>Voer e-mailadres in om wachtwoordlink te krijgen</p>";
        $body .= "<input type='text' name='resetEmail' placeholder='Email'/>";
        $body .= "<button type='submit' name='wachtwoordResetEmail'>Verzenden</button>";
      $body .= "</form>";
    $body .= "</div>";
  $body .= "</div>";
$body .= "</div>";