<?php
//include database
include_once('database.class.php');
//create class login 
class Login extends Database{
    public function loginValidation($email, $wachtwoord){
       $query = "SELECT gegevens.uuid , gegevens.naam, gegevens.email , gegevens.wachtwoord , rol.gebruikers_rol
       FROM gegevens JOIN rol ON gegevens.rol_id = rol.id WHERE gegevens.email = :email";
       $stmt = Database::connection()->prepare($query);
       $stmt->bindValue(":email",$email);
       $stmt->execute();
       $result = $stmt->fetch();
       // check wether the email exist
       if($result === false){
          $_SESSION['LOGIN_VALIDATION_EMAIL'] = validateInput($_POST['email']);
          $_SESSION['LOGIN_VALIDATION_WACHTWOORD'] = validateInput($_POST['wachtwoord']);
           //set error
           $_SESSION['ERROR'] = 'Er is iets fout gegaan!';
           //return int login page with the error above
           header("Location:index.php?page=".LOGIN_PAGE."");
           return;
       }else{
           //get password from database
          $wachtwoordDb = $result['wachtwoord'];
          //verify password
          $validateWachtwoord = password_verify($wachtwoord,$wachtwoordDb);
          if($validateWachtwoord){//if verify is true set sessions
            $_SESSION['inloggen']['uuid']  = $result['uuid'];
            $_SESSION['inloggen']['rol']   = $result['gebruikers_rol'];
            $_SESSION['gebruiker']['naam'] = $result['naam'];
            $_SESSION['gebruiker']['email'] = $result['email'];
            //ifesle statement to navigate the users according their rol
            if($_SESSION['inloggen']['rol'] === 'BLOGER'){
                //succes melding
                $_SESSION['SUCCES'] = 'Welkom '.$_SESSION['gebruiker']['naam'].' jij bent ingelogd.';
                header("Location:index.php?adminPage=".DASHBOARD."");
                return;
            }elseif($_SESSION['inloggen']['rol'] === 'BEZOEKER'){
                //succes melding
                $_SESSION['SUCCES'] = 'Welkom '.$_SESSION['gebruiker']['naam'].' jij bent ingelogd.';
                header("Location:index.php?page=".BLOGS_PAGE."");
                return;
            }//
          }else{
            $_SESSION['LOGIN_VALIDATION_EMAIL'] = validateInput($_POST['email']);
            $_SESSION['LOGIN_VALIDATION_WACHTWOORD'] = validateInput($_POST['wachtwoord']);
            $_SESSION['ERROR'] = 'Er is iets fout gegaan!';
            header("Location:index.php?page=".LOGIN_PAGE."");
            return;
          }
       }//
    }//

    //method for logging uit
    public function logOut(){
        session_start();
        session_destroy();
        header("Location:index.php?page=".LOGIN_PAGE."");
        return;
    }
}//