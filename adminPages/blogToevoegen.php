<?php 
//check for uuid
if(!isset($_SESSION['inloggen']['uuid'])){
     //redirect to page login
     header("Location:index.php?page=".LOGIN_PAGE."");
     return;
     //check for rol
}elseif(isset($_SESSION['inloggen']['rol']) && $_SESSION['inloggen']['rol'] === 'BLOGER'){
  $titel          = '';
  $blogOnderwerp  = '';
  $blogsInhoud    = '';
  if(isset($_POST['blogPubliceren'])){
     if(empty($_POST['blogOnderwerp'])){
         $_SESSION['ERROR'] = "onderwerp is vereist";
         header("Location:index.php?adminPage=".BLOG_TOEVOEGEN."");
         return;
      }
      $uuid                = uuid();
      $titel               = validateInput($_POST['titel']);
      $blogOnderwerp       = validateInput($_POST['blogOnderwerp']);
      $blogsInhoud         = validateInput($_POST['blogsInhoud']);
     

      // instanse of class Blogs
      $blogToevoegen = new Blogs;
      // call method addBlogs
      $blogToevoegen->addBlogs($uuid,$titel,$blogOnderwerp,$blogsInhoud);
      $blogGet = new Blogs;
      // set succes message and return it
      $_SESSION['SUCCES']  = 'blog gepubliceerd';
      header("Location:index.php?adminPage=".BLOG_TOEVOEGEN."");
      return;
   }//
  //
  $body = '';
  // form for publushing blog
 $body .= "<div>";
 // include the file that displays the Message error or succes
 include_once(MELDING);
 //
   $body .= "<div>";
      $body .= "<div>";
         $body .= "<form action='' method='POST' enctype='multipart/form-data'>";
            $body .= "<input type='text' name='titel' placeholder='Titel'/><br />";
            $body .= "<input type='text' name='blogOnderwerp' placeholder='Onderwerp'/><br />";
            $body .= "<textarea name='blogsInhoud'placeholder='type jou blog inhoud hier...'></textarea><br />";
            $body .= "<button type='submit' name='blogPubliceren'>Publiceren</button>";
            $body .= "<button><a href='index.php?adminPage=".DASHBOARD."'>Annuleren</a></button>";
         $body .= "</form>";
      $body .= "</div>";
   $body .= "</div>";
 $body .= "</div>";
}//end elseif