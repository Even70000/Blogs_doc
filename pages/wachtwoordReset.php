<?php 
if(isset($_POST['resetWachtwoordBtn'])){
    $email                = validateInput($_POST['email']);
	  $wachtwoord           = validateInput($_POST['wachtwoord']);
    $teResettenWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
    //
    $resetWachtwoord = new WachtwoordResseten(); 
    $resetWachtwoord->resetPassword($email,$teResettenWachtwoord);
    $_SESSION['SUCCES'] = 'Wachtwoord is vernieuwd jij kunt inloggen</a>';
    header("Location:index.php?page=".LOGIN_PAGE."");
    return;
    
}
// ==========================================================
//==========================================================
if(isset($_GET['key']) & isset($_GET['reset'])){
    $email = validateInput($_GET['key']);
    $wachtwoord = validateInput($_GET['reset']);
	$check = new WachtwoordResseten();
    if($check->checkResetPassword($email,$wachtwoord)){
       $body = "<div>";
         $body .= "<div>";
           $body .= "<div>";
                $body .= "<form action='' method='POST'>";
                  $body .= "<input type='hidden' name='email' value='".$email."'/>";	
                  $body .= "<input type='password' name='wachtwoord' placeholder='Nieuwe wachtwoord'/><br />"; 
                  $body .= "<input type='submit' name='resetWachtwoordBtn' value='Verzenden'/>";
                $body .= "</form>";
           $body .= "</div>";
         $body .= "</div>";
       $body .= "</div>";
	}
}else{
$_SESSION['ERROR'] = 'Er is iets fout gegaan';
header("Location:index.php?page=".WACHTWOORD_VERGETEN_PAGE."");
return;
}