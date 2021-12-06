<?php
// instans of class Blogs
$blogs = new Blogs();
$body = "<div id='blogsContainer'>";
   $body .= "<div id='blogsContainerTwo'>";
          // include the file that displays the Message error or succes
         include_once(MELDING);
         //
        // get title and subject and date of blogs
        foreach($blogs->getBlogs() as $blog){
           $body .= "<div id='blogsBoxOne'>";
               $body .= "<div id='blogsBoxTwo'>";
                // for more information of blogs the link below send the uuid of the chosen blog to blogsinhoud.php
                $body .= "<a id='blogsTitelOnderwerpDatum' href='index.php?page=".BLOGS_INHOUD_PAGE."&uuid=".validateInput($blog['uuid'])."'><div>";
                   $body .= "<h1>".$blog['titel']."</h1>";
                   $body .= "<p>".$blog['onderwerp']."</p>";
                   $body .= "<p> gepubliceerd op: ".$blog['datum']."</p>";
                $body .= "</div></a>";
               $body .= "</div>";
           $body .= "</div>";
       }
   $body .= "</div>";
$body .= "</div>";
