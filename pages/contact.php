<?php 
if(isset($_POST['contactBtn'])){
    if(empty($_POST['naam']) || empty($_POST['email']) || empty($_POST['onderwerp']) || empty($_POST['bericht'])){
        $_SESSION['NAAM_CON']      = $_POST['naam'];
        $_SESSION['EMAIL_CON']     = $_POST['email'];
        $_SESSION['ONDERWERP_CON'] = $_POST['onderwerp'];
        $_SESSION['BERICHT']       = $_POST['bericht'];
        //set error message
        $_SESSION['ERROR'] = 'Alle velden moeten worden ingevuld!';
        header("Location:index.php?page=".CONTACT_PAGE."");
        return; 
        //validate email   
    }elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $_SESSION['NAAM_CON']      = $_POST['naam'];
        $_SESSION['EMAIL_CON']     = $_POST['email'];
        $_SESSION['ONDERWERP_CON'] = $_POST['onderwerp'];
        $_SESSION['BERICHT']       = $_POST['bericht'];
        //
        $_SESSION['ERROR'] = 'Ongeldige email!';
        header("Location:index.php?page=".CONTACT_PAGE."");
        return;
    }else{
        $naam                = validateInput($_POST['naam']);
        $bezoekerEmail       = validateInput($_POST['email']);
        $onderwerp           = validateInput($_POST['onderwerp']);
        $bericht             = validateInput($_POST['bericht']);
        
        //instance of class Email
        $email = new Email();
        if($email->sendEmail($naam,$bezoekerEmail,$onderwerp,$bericht)){
            //set succes message
            $_SESSION['SUCCES'] = 'Bedankt! het wordt zo snel mogelijk<br/> 
            beanwordt hou jou email in de gaten.';
            header("Location:index.php?page=".CONTACT_PAGE."");
            return;    
        }else{
            $_SESSION['ERROR'] = 'Niet gelukt';
            header("Location:index.php?page=".CONTACT_PAGE."");
            return;
                
        }
    }//
}//
$body = "<div id='contactContainer'>";
   $body .= "<div id='contactContainerTwo'>";
      $body .= "<div id='contactContainerThree'>";
          $body .= "<form action='' method='POST'>";
               $body .= "<fieldset>";
                  $body .= "<legend><h3>Contact</h3></legend>";
                  // include the file that displays the Message error or succes
                  include_once(MELDING);
                  //
                  if(isset($_SESSION['NAAM_CON']) || isset($_SESSION['EMAIL_CON']) || isset($_SESSION['ONDERWERP_CON']) || isset( $_SESSION['BERICHT'])){
                    $body .= "<input type='text' name='naam' value='".$_SESSION['NAAM_CON']."' placeholder='Naam'/><br />";
                    $body .= "<input type='text' name='email' value='".$_SESSION['EMAIL_CON']."' placeholder='jou@email.com'/><br />";
                    $body .= "<input type='text' name='onderwerp' value='".$_SESSION['ONDERWERP_CON']."' placeholder='Onderwerp'/><br />";
                    $body .= "<textarea name='bericht' placeholder='Type jou bericht hier in...'>". $_SESSION['BERICHT']."</textarea><br />";
                    session_unset();
                  }else{
                    $body .= "<input type='text' name='naam' placeholder='Naam'/><br />";
                    $body .= "<input type='text' name='email' placeholder='jou@email.com'/><br />";
                    $body .= "<input type='text' name='onderwerp' placeholder='Onderwerp'/><br />";
                    $body .= "<textarea name='bericht' placeholder='Type jou bericht hier in...'></textarea><br />";
                  }
                  $body .= "<input type='submit' name='contactBtn' value='Verzenden'/>";
               $body .= "</fieldset>";
          $body .= "</form>";
      $body .= "</div>";
   $body .= "</div>";
$body .= "</div>";