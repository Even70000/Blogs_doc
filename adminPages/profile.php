<?php 
//check for users uuid
if(!isset($_SESSION['inloggen']['uuid'])){
    //redirect to page login
    header("Location:index.php?page=".LOGIN_PAGE."");
    return;
    //check for rol
}elseif(isset($_SESSION['inloggen']['rol']) && $_SESSION['inloggen']['rol'] === 'BLOGER'){
    $body = "<div id='profileContainer'>";
      $body .= "<div id='profileContainerTwo'>";
        $body .= "<div id='pasfotoContainer'>";
          $body .= "<p class='fotoPara'><b>FOTO</b></p>";
        $body .= "</div>";
        $body .= "<div id='gegevensContainer'>";
          //instace of class Gegevens
          $profile = new Gegevens();
          $result  = $profile->getGegevensByUuid($_SESSION['inloggen']['uuid']);
          for($i = $result; $result >= $i; $i++):
             $body .= "<p><b>Naam</b>: ". $result['naam'] ."</p>";
             $body .= "<p><b>E-mail</b>: ". $result['email'] ."</p>";
             $body .= "<p><b>Rol</b>: ". $result['gebruikers_rol']."</p>";
             $body .= "<a href=''><button>Profile aanpassen</button></a>";
             break;
          endfor;
        $body .= "</div>";
      $body .= "</div>";
    $body .= "</div>";
}