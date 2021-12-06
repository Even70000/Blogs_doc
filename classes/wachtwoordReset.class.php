<?php
//class 
class WachtwoordResseten extends Database{
   //method for sending the link to reset password
  public function sendLink($email){
      $query = "SELECT email,wachtwoord FROM gegevens WHERE email=:email";
      $stmt  = Database::connection()->prepare($query);
      $stmt->bindValue(":email",$email);
      $stmt->execute();
      while($result = $stmt->fetch()){
          $resetEmail      = md5($result['email']);
          $resetWachtwoord = md5($result['wachtwoord']);
      }
      if($resetEmail){
        $link = "<a href='https://probeer.evenezer.nl/challenge_5/index.php?page=".WACHTWOORD_RESET_PAGE."&key=".$resetEmail."&reset=".$resetWachtwoord."'>klick hier voor nieuwe wachtwoord</a>";
     
      $van = 'blogs@blog.inf';
      $aan = $email;
      $onderwerp = 'Wachtwoord resetten';
      //headers for html format
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      $message = "<h1>Beste klant,</h1>";
      $message .= "<p>".$link."</p>";
      $message .= "<p>Met vriendelijke groeten,</p>";
      $message .= "blogs";

    return mail($aan,$onderwerp,$message,$headers);
    }
  } 
	
   //method reset password
   public function checkResetPassword($email,$wachtwoord){
      $query = "SELECT email,wachtwoord FROM gegevens WHERE md5(email)=:email AND md5(wachtwoord)=:wachtwoord";
      $stmt  = Database::connection()->prepare($query);
      $stmt->bindValue(":email",$email);
      $stmt->bindValue(":wachtwoord",$wachtwoord);
      $stmt->execute();
	    $result = $stmt->fetch();
      return $result;
   }
	
   //method for updating new password
   public function resetPassword($email,$teResettenWachtwoord){
     $query = "UPDATE gegevens SET wachtwoord=:wachtwoord WHERE md5(email)=:email";
     $stmt  = Database::connection()->prepare($query);
     $stmt->bindValue(":wachtwoord",$teResettenWachtwoord);
     $stmt->bindValue(":email",$email);
     $stmt->execute();
   }
}