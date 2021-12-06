<?php 
if(isset($_POST['registrerenBtn'])):// post the posted data below
    // check for filds if wether they ar empty
    if(empty($_POST['naam']) || empty($_POST['email'] || empty($_POST['wachtwoord'] || empty($_POST['wachtwoordBevestiging'])))){
         //make sessions for inputes to be abale to use it by returning to the same page
         $_SESSION['NAAM_REG']            = $_POST['naam'];
         $_SESSION['EMAIL_REG']           = $_POST['email'];
         $_SESSION['WACHTWOORD_REG']      = $_POST['wachtwoord'];
         $_SESSION['WACHTWOORD_BEVE_REG'] = $_POST['wachtwoordBevestiging'];
         $_SESSION['ERROR'] = 'Alle velden moeten worden ingevuld!';//error message
         //header to get back to this page wis error message
         header("Location:index.php?page=".REGISTRATIE_PAGE."");
         return;
         //
         //check wether email is valid
    }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        //set sessions for inputs
        $_SESSION['NAAM_REG']            = $_POST['naam'];
        $_SESSION['EMAIL_REG']           = $_POST['email'];
        $_SESSION['WACHTWOORD_REG']      = $_POST['wachtwoord'];
        $_SESSION['WACHTWOORD_BEVE_REG'] = $_POST['wachtwoordBevestiging'];
        $_SESSION['ERROR'] = 'ongeldig email!';
        //header to get back to this page wis error message
        header("Location:index.php?page=".REGISTRATIE_PAGE."");
        return;
         //
        
    }elseif(empty($_POST['wachtwoordBevestiging'])){
        $_SESSION['NAAM_REG']            = $_POST['naam'];
        $_SESSION['EMAIL_REG']           = $_POST['email'];
        $_SESSION['WACHTWOORD_REG']      = $_POST['wachtwoord'];
        $_SESSION['WACHTWOORD_BEVE_REG'] = $_POST['wachtwoordBevestiging'];
        $_SESSION['ERROR'] = 'Alle velden moeten worden ingevuld!';//error message
        //header to get back to this page wis error message
        header("Location:index.php?page=".REGISTRATIE_PAGE."");
        return;
    //check wether the given password are equl 
    }elseif($_POST['wachtwoord'] !== $_POST['wachtwoordBevestiging']){
        $_SESSION['NAAM_REG']            = $_POST['naam'];
        $_SESSION['EMAIL_REG']           = $_POST['email'];
        $_SESSION['WACHTWOORD_REG']      = $_POST['wachtwoord'];
        $_SESSION['WACHTWOORD_BEVE_REG'] = $_POST['wachtwoordBevestiging'];
        $_SESSION['ERROR'] = 'Wachtwoord is niet gelijk!';
        //header to get back to this page wis error message
        header("Location:index.php?page=".REGISTRATIE_PAGE."");
        return;
         //
    }else{
       $uuid                   = uuid();
       $naam                   = validateInput($_POST['naam']);
       $email                  = validateInput($_POST['email']);
       $wachtwoord             = validateInput($_POST['wachtwoord']);
       $wachtwoordBevestiging  = validateInput($_POST['wachtwoordBevestiging']);
       //hash the given password
       $wachtwoordHash         = password_hash($wachtwoordBevestiging, PASSWORD_DEFAULT);
       //instance of class Gegevens
       $addGegevens = new Gegevens();
       // the method takes the posted data as parameter
       if($addGegevens->addGegevens($uuid,$naam,$email,$wachtwoordHash)){
           $_SESSION['SUCCES'] = 'Registratie gelukt u kunt <a href=index.php?page='.LOGIN_PAGE.'>inloggen</a>';
           header("Location:index.php?page=".REGISTRATIE_PAGE."");
           return;
       }//
    }//
endif;
$body = "<div id='contactContainer'>";
   $body .= "<div id='contactContainerTwo'>";
        $body .= "<div id='contactContainerThree'>";
            // register form
            $body .= "<form action='' method='POST'>";
                $body .= "<fieldset>";
                   $body .= "<legend><h3>Registreren</h3></legend>";
                    // include the file that displays the Message error or succes
                    include_once(MELDING);
                    //
                    if(isset($_SESSION['NAAM_REG']) || isset($_SESSION['EMAIL_REG']) || isset($_SESSION['WACHTWOORD_REG']) || isset($_SESSION['WACHTWOORD_BEVE_REG'])){
                        $body .= "<input type='text' name='naam' value='".$_SESSION['NAAM_REG']."'  placeholder='Naam'/><br />";
                        $body .= "<input type='text' name='email' value='".$_SESSION['EMAIL_REG']."' placeholder='jou@email.com'/><br />";
                        $body .= "<input type='password' name='wachtwoord' value='".$_SESSION['WACHTWOORD_REG']."' placeholder='wachtwoord'/><br />";
                        $body .= "<input type='password' name='wachtwoordBevestiging' value='".$_SESSION['WACHTWOORD_BEVE_REG']."' placeholder='wachtwoord bevestiging'/><br />";
                        session_unset();
                    }else{
                        $body .= "<input type='text' name='naam'  placeholder='Naam'/><br />";
                        $body .= "<input type='text' name='email' placeholder='jou@email.com'/><br />";
                        $body .= "<input type='password' name='wachtwoord' placeholder='wachtwoord'/><br />";
                        $body .= "<input type='password' name='wachtwoordBevestiging' placeholder='wachtwoord bevestiging'/><br />";
                    }
                   $body .= "<input type='submit' name='registrerenBtn' value='Registreren'/>";
                $body .= "</fieldset>";
            $body .= "</form>";
        $body .= "</div>";
    $body .= "</div>";
$body .= "</div>";