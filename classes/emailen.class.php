<?php 
class Email{
    public function sendEmail($naam,$email,$onderwerp,$Bezoekerbericht){
        $van = $email;
        $to = "501922@vistacollege.nl";
         //headers for html format
         $headers = "MIME-Version: 1.0" . "\r\n";
         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
         
        $bericht = "<html>";
             $bericht .= "<body>";
                $bericht .= "<h4>U heeft een email gekregen van: ".$naam."</h4>";
                $bericht .= "Email: ".$van." scroll naar onder voor de inhoud.";
                $bericht .= "<p>Beste meneer Even,</p>";
                $bericht .= "<p>".$Bezoekerbericht."</p>";
                $bericht .= "<p>Met vriendelijke groeten,</p>";
                $bericht .= "<p>".$naam."</p>";
             $bericht .= "</body>";
        $bericht .= "</html>";
        return mail($to,$onderwerp,$bericht,$headers);
    }
}