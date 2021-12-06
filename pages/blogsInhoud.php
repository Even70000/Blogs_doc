<?php 
if($_SERVER['REQUEST_METHOD'] === "POST"){
    //declare the posted data to variabele
    $commentaarUuid   = uuid();
    $gebruikersUuid   = validateInput($_POST['gebruikersUuid']);
    $blogsUuid        = validateInput($_POST['blogUuid']);
    $statusCommentaar = validateInput($_POST['statusCommentaar']);
    /* */
    //check for button that is pressed of someone who is not logged in
    if(isset($_POST['commentaarBtnNietIngelogged']) || isset($_POST['leukBtnNietIngelogged']) || isset($_POST['nietLeukBtnNietIngelogged'])){
        $_SESSION['ERROR'] = 'Eerste inloggen om je mening te kunnen geven!';
        header("Location:index.php?page=".BLOGS_INHOUD_PAGE."&uuid=".validateInput($_GET['uuid'])."");
        return;
    }
    if(isset($_POST['commentaarBtn'])){
        //declare the posted data to variabele
        $_SESSION['COMMENTAAR'] = validateInput($_POST['commentaar']); 
    }elseif(isset($_POST['leukBtn'])){
        $_SESSION['MENING'] = validateInput($_POST['leuk']);
       
    }elseif(isset($_POST['nietLeukBtn'])){
        $_SESSION['MENING'] = validateInput($_POST['nietLeuk']); 
    }
    //
    if(isset($_SESSION['MENING'])){
        $mening = $_SESSION['MENING'];
        //insctance of class Reactie
        $leukNieLeuk = new Reactie();
        $leukNieLeuk->addLeukEnNietLeuk($mening,$blogsUuid,$gebruikersUuid);
        unset($_SESSION['MENING']);
        //redirct to the same page
        $_SESSION['SUCCES'] = 'Bedankt voor jou mening '.$_SESSION['gebruiker']['naam'];
        header("Location:index.php?page=".BLOGS_INHOUD_PAGE."&uuid=".validateInput($_GET['uuid'])."");
        return;
    }elseif(isset($_SESSION['COMMENTAAR'])){
        
        $commentaar = $_SESSION['COMMENTAAR'];
        //insctance of class Reactie
        $reactie = new Reactie();
        $reactie->addCommentaar($commentaarUuid,$commentaar,$blogsUuid,$gebruikersUuid, $statusCommentaar);
        
        //redirct to the same page
        $_SESSION['SUCCES'] = 'Bedankt voor jou mening '.$_SESSION['gebruiker']['naam'];
        header("Location:index.php?page=".BLOGS_INHOUD_PAGE."&uuid=".validateInput($_GET['uuid'])."");
        return;
    }
}//

//========================================================================================
//============================================================================================
// if else statement check for blogs uuid
if(isset($_GET['uuid'])){
   $uuid  = validateInput($_GET['uuid']);
   $body = "<div id='blogInhoudContainer'>";
       $body .= "<div id='blogInhoudContainerTwo'>";
          // include the file that displays the Message error or succes
          include_once(MELDING);
          //
          // instance of class Blogs
          $blogInhoud = new Blogs();
          $blogsInhoud = $blogInhoud->getBlogByUuid($uuid);
            for($i = $blogsInhoud; $blogsInhoud >= $i; $i++):
               $body .= "<div id='blogInhoudBox'>";
                   $body .= "<div id='blogInhoudBoxOne'>";
                       $body .= "<h1>".$blogsInhoud['titel']."</h1>";
                       $body .= "<p>gepebuliceerd op: ".$blogsInhoud['datum']."</p>";
                       $body .= "<p>".$blogsInhoud['onderwerp']."</p>";
                       $body .= "<p>".$blogsInhoud['inhoud']."</p>";
                   $body .= "</div>";
                   $body .= "<hr />";
                $body .= "</div>";
                break;
            endfor;
            //check if someone is logged in and wether he is BEZOEKER
            if(isset($_SESSION['inloggen']['rol']) && $_SESSION['inloggen']['rol'] === 'BEZOEKER'){
                // uuid of someone who has logged in
                $gebruikerUuid = $_SESSION['inloggen']['uuid'];
                $leuks = new Reactie();
                $aantalLeuks = count($leuks->getLeuk());
                $nietLeuks = new Reactie();
                $aantalNietLeuks = count($nietLeuks->getNietLeuk());
                $body .= "<div id='blogInhoudBoxTwo'>";  
                   $body .= "<form action='' method='POST'>";
                        //users uuid as hidden input
                        $body .= "<input type='hidden' name='gebruikersUuid' value='".validateInput($gebruikerUuid)."'/>";
                        //blogs uuid as hidden input
                        $body .= "<input type='hidden' name='blogUuid' value='".validateInput($blogsInhoud['uuid'])."'/>";
                        // status of the commentaar by defualt not allowed for publication 
                        $body .= "<input type='hidden' name='statusCommentaar' value='1'/>";
                        // input and button for leuk
                        $body .= "<input type='hidden' name='leuk' value='1'/>";
                        $body .= "<button class='meningBtn' type='submit' name='leukBtn'>👍 <b>|</b> ". $aantalLeuks." </button>";
                        //input and button for niet leuk 
                        $body .= "<input type='hidden' name='nietLeuk' value='2'/>";
                        $body .= " <button class='meningBtn' type='submit' name='nietLeukBtn'>👎 <b>|</b> ".$aantalNietLeuks."</button><br />";
                        $body .= "<fildset>";
                            $body .= "<legend>Commentaar</legend>";
                            $body .= "<textarea name='commentaar' placeholder='Type jou commentaar in..'></textarea><br />";
                            //button for submitting comment
                            $body .= "<button type='submit' name='commentaarBtn'>Commentaar plaatsen</button>";
                        $body .= "</fildset>";
                    $body .= "</form>";
                $body .= "</div>";
            }else{
                $leuks = new Reactie();
                $aantalLeuks = count($leuks->getLeuk());
                $nietLeuks = new Reactie();
                $aantalNietLeuks = count($nietLeuks->getNietLeuk());
                $body .= "<div id='blogInhoudBoxTwo'>"; 
                $body .= "<p id='warningPara'>Alleen leden kunnen hun meningen delen!</p>"; 
                $body .= "<form action='' method='POST'>";
                     //users uuid as hidden input
                     $body .= "<input type='hidden' name='gebruikersUuid' value=''/>";
                     //blogs uuid as hidden input
                     $body .= "<input type='hidden' name='blogUuid' value=''/>";
                     // status of the commentaar by defualt not allowed for publication 
                     $body .= "<input type='hidden' name='statusCommentaar' value='1'/>";
                     // input and button for leuk
                     $body .= "<input type='hidden' name='leuk' value='1'/>";
                     $body .= "<button class='meningBtn' type='submit' name='leukBtnNietIngelogged'>👍 <b>|</b> ". $aantalLeuks." </button>";
                     //input and button for niet leuk 
                     $body .= "<input type='hidden' name='nietLeuk' value='2'/>";
                     $body .= " <button class='meningBtn' type='submit' name='nietLeukBtnNietIngelogged'>👎 <b>|</b> ".$aantalNietLeuks."</button><br />";
                     $body .= "<fildset>";
                        // $body .= "<legend>Commentaar</legend>";
                         //$body .= "<textarea name='commentaar' placeholder='Type jou commentaar in..'></textarea><br />";
                         //button for submitting comment
                         $body .= "<button type='submit' name='commentaarBtnNietIngelogged'>Commentaar plaatsen</button>";
                     $body .= "</fildset>";
                 $body .= "</form>";
             $body .= "</div>";
            }//end check logged in
            $body .= "<div>";
                $body .= "<p id='comPara'>Commentaren</p>";
                $showCommentaar = new Reactie();
                foreach($showCommentaar->getCommentaren() as $commentaar):
                    //check wether commentaar is toegestaan
                    if($commentaar['reactie_status'] === 'toegestaan'){
                        $body .= "<div id='commentaarContainer'>";
                          $body .= "<div id='commentaarContainerTwo'>";
                            $body .= "<div id='commentaarBox'>";
                              $body .= "<p><b>".$commentaar['naam']."</b></p>";
                              $body .= $commentaar['datum'];
                              $body .= "<hr/>";
                              $body .= "<div id='commentaarCommentaarBox'>";
                                $body .=  "<p>".$commentaar['commentaar']."</p>";
                              $body .= "</div>";
                            $body .= "</div>";
                          $body .= "</div>";
                       $body .= "</div>";
                    }
                endforeach;
            $body .= "</div>";
        $body .= "</div>";
    $body .= "</div>";
}else{
  header("Location:index.php?page=".BLOGS_PAGE."");
  return;
}
