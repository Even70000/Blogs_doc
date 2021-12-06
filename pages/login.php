<?php 
if(isset($_POST['inloggenBtn'])):
    if(empty($_POST['email'])){
        //set sessions for input. it will be used when redirect to the same page
        $_SESSION['LOGIN_VALIDATION_EMAIL'] = validateInput($_POST['email']);
        $_SESSION['LOGIN_VALIDATION_WACHTWOORD'] = validateInput($_POST['wachtwoord']);
        $_SESSION['ERROR']  = 'alle velden moete worden ingevuld!';
        header("Location:index.php?page=".LOGIN_PAGE."");
        return;
    }elseif(empty($_POST['wachtwoord'])){
        //set sessions for input 
        $_SESSION['LOGIN_VALIDATION_WACHTWOORD'] = validateInput($_POST['wachtwoord']);
        $_SESSION['LOGIN_VALIDATION_EMAIL'] = validateInput($_POST['email']);
        $_SESSION['ERROR']  = 'alle velden moete worden ingevuld!';
        header("Location:index.php?page=".LOGIN_PAGE."");
        return;
        //validate email
    }elseif((!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))){
        //set session for input
        $_SESSION['LOGIN_VALIDATION_EMAIL'] = validateInput($_POST['email']);
        $_SESSION['LOGIN_VALIDATION_WACHTWOORD'] = validateInput($_POST['wachtwoord']);
        $_SESSION['ERROR'] = 'Er is iets fout gegaan!';
        //return to the same page with error
        header("Location:index.php?page=".LOGIN_PAGE."");
        return;
    }else{
        $email       = validateInput($_POST['email']);
        $wachtwoord  = validateInput($_POST['wachtwoord']);
        //instance of clas Login
        $login = new Login();
        $login = $login->loginValidation($email,$wachtwoord);
        return;
    }
endif;
$body = "<div id='contactContainer'>";
   $body .= "<div id='contactContainerTwo'>";
        $body .= "<div id='contactContainerThree'>";
            $body .= "<form action='' method='POST'>";
                $body .= "<fieldset>";
                   $body .= "<legend><h3>Inloggen</h3></legend>";
                   $body .= "<div class='melding'>";
                     // include the file that displays the Message error or succes
                     include_once(MELDING);
                     //
                   $body .= "</div>";
                   if(isset($_SESSION['LOGIN_VALIDATION_EMAIL'])){
                    $body .= "<input type='text' name='email' value='".$_SESSION['LOGIN_VALIDATION_EMAIL']."' placeholder='jou@email.com'/><br />";
                    $body .= "<input type='password' name='wachtwoord' value='".$_SESSION['LOGIN_VALIDATION_WACHTWOORD']."' placeholder='wachtwoord'/><br />";
                    session_unset();
                   }elseif(isset($_SESSION['LOGIN_VALIDATION_WACHTWOORD'])){
                    $body .= "<input type='text' name='email' value='".$_SESSION['LOGIN_VALIDATION_EMAIL']."' placeholder='jou@email.com'/><br />";
                    $body .= "<input type='password' name='wachtwoord' value='".$_SESSION['LOGIN_VALIDATION_WACHTWOORD']."' placeholder='wachtwoord'/><br />";
                    session_unset();
                   }elseif(isset($_SESSION['ERROR'])){
                    $body .= "<input type='text' name='email' value='".$_SESSION['LOGIN_VALIDATION_EMAIL']."' placeholder='jou@email.com'/><br />";
                    $body .= "<input type='password' name='wachtwoord' value='".$_SESSION['LOGIN_VALIDATION_WACHTWOORD']."' placeholder='wachtwoord'/><br />";
                    session_unset();
                   }else{
                    $body .= "<input type='text' name='email' placeholder='jou@email.com'/><br />";
                    $body .= "<input type='password' name='wachtwoord' placeholder='wachtwoord'/><br />";
                   }
                   $body .= "<input type='submit' name='inloggenBtn' value='Inloggen'/><br />";
                   $body .= "<a href='index.php?page=".WACHTWOORD_VERGETEN_PAGE."'>Wachtwoord vergeten</a>";
                $body .= "</fieldset>";
            $body .= "</form>";
        $body .= "</div>";
    $body .= "</div>";
$body .= "</div>";