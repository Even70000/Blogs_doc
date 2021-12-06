<?php 
//check for uuid
if(!isset($_SESSION['inloggen']['uuid'])){
    //redirect to page login
    header("Location:index.php?page=".LOGIN_PAGE."");
    return;
    //check for rol
}elseif(isset($_SESSION['inloggen']['rol']) && $_SESSION['inloggen']['rol'] === 'BLOGER'){
  if(isset($_GET['uuid'])){ // if isset blogs uuid 
    $uuid           = validateInput($_GET['uuid']);
    $titel          = '';
    $blogOnderwerp  = '';
    $blogsInhoud    = '';

    if(isset($_POST['blogWijzigen'])){
      if(empty($_POST['blogOnderwerp'])){
        $_SESSION['ERROR'] = "onderwerp is vereist";
        header("Location:index.php?adminPage=".BLOG_WIJZIGING."");
        return;
      }
      $titel               = validateInput($_POST['titel']);
      $blogOnderwerp       = validateInput($_POST['blogOnderwerp']);
      $blogsInhoud         = validateInput($_POST['blogsInhoud']);

      // instanse of class Blogs
      $blogToevoegen = new Blogs;
      // call method updateBlogs
      //update data
      $blogToevoegen->updateBlogsByUuid($uuid,$titel,$blogOnderwerp,$blogsInhoud);
      $blogGet = new Blogs;
      $_SESSION['SUCCES'] = 'Blog gewijzigd';
      header("Location:index.php?adminPage=".DASHBOARD."");
      return;
    }//
    // form for modifying blog
   $body = "<div>";
    $body .= "<div>";
      $body .= "<div>";
      // include the file that displays the Message error or succes
      include_once(MELDING);
      //
      // get data ...
      $blogenLijst = new Blogs();
      $inhoud = $blogenLijst->getBlogByUuid($uuid);
      for($i = $inhoud; $inhoud <= $i; $i++):
         $body .= "<form action='' method='POST' enctype='multipart/form-data'>";
            $body .= "<input type='text' name='titel' placeholder='Titel' value='".validateInput($inhoud['titel'])."'/><br />";
            $body .= "<input type='text' name='blogOnderwerp' placeholder='Onderwerp' value='".validateInput($inhoud['onderwerp'])."'/><br />";
            $body .= "<textarea name='blogsInhoud'placeholder='type jou blog inhoud hier...' >'".validateInput($inhoud['inhoud'])."'</textarea><br />";
            $body .= "<button type='submit' name='blogWijzigen'>Wijziging toepassen</button>";
            $body .= "<button><a href='index.php?adminPage=".DASHBOARD."'>Annuleren</a></button>";
         $body .= "</form>";
         break;
      endfor;
      $body .= "</div>";
    $body .= "</div>";
   $body .= "</div>";
 }else{
    header("Location:index.php?adminPage=".DASHBOARD."");
    $_SESSION['ERROR'] = 'Geen blog geselecteerd';
  }// end if else 
}//end elseif