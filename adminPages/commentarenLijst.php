<?php
//check for uuid
if(!isset($_SESSION['inloggen']['uuid'])){
    //redirect to page login
    header("Location:index.php?page=".LOGIN_PAGE."");
    return;
    //check for rol
}elseif(isset($_SESSION['inloggen']['rol']) && $_SESSION['inloggen']['rol'] === 'BLOGER'){
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $commentaarUuid   = validateInput($_POST['uuid']);
      $commentaarStatus = validateInput($_POST['commentaarStatus']);
      $commentaarInhoud = validateInput($_POST['commentaarInhoud']);
      //check for the pressed button
      if(isset($_POST['toestaanBtn']) || isset($_POST['nietToestaanBtn'])){
         //we can change between the two buttons
         switch($commentaarStatus){
            case 'niet toegestaan':
               $commentaarStatus = 2;
               break;
            case 'toegestaan':
               $commentaarStatus = 1;
               break;
         }//
        //check for the pressed button
      }elseif(!isset($_POST['toestaanBtn']) || !isset($_POST['nietToestaanBtn'])){
         //we can change between the two buttons
         switch($commentaarStatus){
            case 'niet toegestaan':
               $commentaarStatus = 1;
               break;
            case 'toegestaan':
               $commentaarStatus = 2;
               break;
         }//
      }
     //instance of clss Reactie
     $updateReactie = new Reactie();
     $updateReactie->updateCommentaarByUuid($commentaarUuid,$commentaarStatus,$commentaarInhoud);
     //set succes message
      $_SESSION['SUCCES'] = 'Commentaar is aangepast';
      //redirect to the same page
      header("Location:index.php?adminPage=".COMMENTAREN_LIJST."");
      return;
     
   }
   //
   //$reacties->getCommentaren();
   $body = "<div>";
      $body .= "<div>";
         // include the file that displays the Message error or succes
         include_once(MELDING);
         //
         $body .= "<div>";
            // get commentaren
            // instance of class gegevens
            $reacties = new Reactie;
            foreach($reacties->getCommentaren() as $reactie):
               $body .= "<div>";
                  $body .= "<b>Naam:</b> ".$reactie['naam'] ."<br />";
                  $body .= "<b>E-mail:</b> ".$reactie['email'] ."<br />";
                  $body .= "<b>Status commentaar:</b><br />";
                  //check the status of commentaar wether it is published
                  if($reactie['reactie_status'] === 'niet toegestaan'){
                     $body .= "Niet toegestaan voor publicatie<br />";
                  }elseif($reactie['reactie_status'] === 'toegestaan'){
                     $body .= "Toegestaan voor publicatie<br />";
                  }
                  $body .= "<form action='' method='POST'>";
                     $body .= "<b>Commentaar op:</b> ".$reactie['titel']."<br />";
                     $body .= "<input type='hidden' name='uuid' value='".validateInput($reactie['uuid'])."'/>";
                     $body .= "<input type='hidden' name='commentaarStatus' value='".validateInput($reactie['reactie_status'])."'/>";
                     $body .= "<textarea name='commentaarInhoud'>".$reactie['commentaar']."</textarea><br />";
                     $body .= "<button type='submit' name='aanpassenBtn'>Aanpassen</button>";
                     //check the status of commentaar wether it is published
                     // so that we can change between the two buttons
                     if($reactie['reactie_status'] === 'niet toegestaan'){
                        // if niet toegestaan display button Toestaan
                        $body .= "<button type='submit' name='toestaanBtn'>Toestaan</button>";
                     }elseif($reactie['reactie_status'] === 'toegestaan'){
                        //if toegestaan display button toestaan
                        $body .= "<button type='submit' name='nietToestaanBtn'>Niet toestaan</button>";
                     }
                     $body .= "<button><a href='index.php?adminPage=".DASHBOARD."'>Terug</a></button>";
                  $body .= "</form>";
               $body .= "</div>";
            endforeach;
         $body .= "</div>";
      $body .= "</div>";
   $body .= "</div>";
}//