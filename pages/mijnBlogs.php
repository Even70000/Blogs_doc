<?php 
//check for users uuid
if(!isset($_SESSION['inloggen']['uuid'])){
    //redirect to page login
    header("Location:index.php?page=".LOGIN_PAGE."");
    return;
    //check for rol
}elseif(isset($_SESSION['inloggen']['rol']) && $_SESSION['inloggen']['rol'] === 'BEZOEKER'){
    $body = "<div>";
      $body .= "<div>";
        $body .= "<div>";
            if($body){
              $body .= "<form action='' method='POST'>";
                $body .= "<fieldset>";
                  $body .= "<legend>Vraag voor toesteming</legend>";
                  $body .= "<p><b>Seleteer hieronder een thema:</b></p>";
                  $body .= "<select>";
                    $body .= "<option>Technologie</option>";
                    $body .= "<option>Boeken</option>";
                    $body .= "<option>Crypto</option>";
                  $body .= "</select>";
                  $body .= "<p><b>Hoevaak ga je Bloggen:</b></p>";
                  $body .= "<input type='radio' id='elkeDag' name='hoevaakBloggen' value='Dagelijks'/>";
                  $body .= "<label for='elkeDag'>Dagelijks</label>";
                  $body .= "<input type='radio' id='elkWeek' name='hoevaakBloggen' value='Wekelijks'/>";
                  $body .= "<label for='elkWeek'>Wekelijks</label>";
                  $body .= "<input type='radio' id='elkMaand' name='hoevaakBloggen' value='Maandelijks'/>";
                  $body .= "<label for='elkMaand'>Maandelijks</label>";
                  $body .= "<p><b>Beschrijf kort wat je hiermee wilt bereiken:</b></p>";
                  $body .= "<textarea></textarea><br />";
                  $body .= "<button type='submit' name='toestemingVragenBtn'>Verzenden</button>";
                $body .= "</fieldset>";
              $body .= "</form>";
              $body .= "<div>";
                $body .= "<div>";
                $body .= "</div>";
              $body .= "</div>";
            }elseif($body){

            }///end toesteming if
        $body .= "</div>";
      $body .= "</div>";
    $body .= "</div>";
}