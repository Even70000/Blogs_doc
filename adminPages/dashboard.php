<?php
//check for uuid
if(!isset($_SESSION['inloggen']['uuid'])){
    //redirect to page login
    header("Location:index.php?page=".LOGIN_PAGE."");
    return;
    //check for rol
}elseif(isset($_SESSION['inloggen']['rol']) && $_SESSION['inloggen']['rol'] === 'BLOGER'){
   $body = "<div id='dashboardContainer'>";
      $body .= "<div class='meldinggen'>";
        // include the file that displays the Message error or succes
        include_once(MELDING);
      $body .= "</div>";
      //
      $reacties = new Reactie;
      $aantalCommentaren = count($reacties->getCommentaren());
      $body .= "<div id='dashboardContainerTwo'>"; 
        $body .= "<div id='dashboardBoxOne'>";
         $body .= "<a href='index.php?adminPage=".BLOG_TOEVOEGEN."'>
                       <div id='dashboardBoxOneLink'>
                          <p id='dashboardBoxOneLinkPara'>
                          Nieuwe blog toevoegen <br /><br />
                          +</p>
                       </div>
                     </a>";
            $body .= "<a href='index.php?adminPage=".COMMENTAREN_LIJST."'>
                      <div id='dashboardBoxOneLinkTwo'>
                          Commentaren overzicht
                          <hr />
                          Er zijn ".$aantalCommentaren." commentaren
                      </div>
                   </a>";
        $body .= "</div>";
        $body .= "<div id='dashboardBoxTwo'>";
            $body .= "<div id='dashboardBoxTwoTable'>";
               // inclue the file to get the list of blogen
               include(BLOGEN_LIJST);
            $body .= "</div>";
        $body .= "</div>";
      $body .= "</div>";
   $body .= "</div>";
  
}//




