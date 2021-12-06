<?php
//check for uuid
if(!isset($_SESSION['inloggen']['uuid'])){
     //redirect to page login
     header("Location:index.php?page=".LOGIN_PAGE."");
     return;
     //check for rol
}elseif(isset($_SESSION['inloggen']['rol']) && $_SESSION['inloggen']['rol'] === 'BLOGER'){
 //instance of class Blogs
 $blogenLijst = new Blogs();
 $blogen = $blogenLijst->getBlogs();
 $blogCounter = count($blogen);
 $body .= "<table style='margin-top:110px;'>"; 
   $body .= "<thead>";
      $body .= "<tr>";
         $body .= "<th>Nr</th>";
         $body .= "<th>Titel</th>";
         $body .= "<th>Onderwerp</th>";
         $body .= "<th>Blogs inhoud</th>";
         $body .= "<th>Publicatie datum</th>";
         $body .= "<th>Aanpassingen</th>";
      $body .= "</tr>";
   $body .= "</thead>";
   foreach($blogenLijst->getBlogs() as $key => $blog):
      $body .= "<tbody>";
          $body .= "<tr>";
             $sr = $key + 1;
             $body .= "<td>".$sr."</td>";
             $body .= "<td>".$blog['titel']."</td>";
             $body .= "<td>".$blog['onderwerp']."</td>";
             $body .= "<td>".$blog['inhoud']."</td>";
             $body .= "<td>".$blog['datum']."</td>";
             $body .= "<td>
                          <form action='".htmlspecialchars('index.php?adminPage='.BLOGEN_DELETEN)."' method='POST'>
                             <input type='hidden' name='uuid' value='".$blog['uuid']."'/>
                             <input type='submit' name='deleteBlog' value='X'/>
                          </form>
                          <a href='index.php?adminPage=".BLOG_WIJZIGING."&uuid=".validateInput($blog['uuid'])."'><button>!</button></a>
                      </td>";
          $body .= "</tr>";
      $body .= "</tbody>";
    endforeach;
 $body .= "</table>";
}//