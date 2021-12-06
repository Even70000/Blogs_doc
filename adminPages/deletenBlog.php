<?php 
//check for uuid
if(!isset($_SESSION['inloggen']['uuid'])){
     //redirect to page login
     header("Location:index.php?page=".LOGIN_PAGE."");
     return;
     //check for rol
}elseif(isset($_SESSION['inloggen']['rol']) && $_SESSION['inloggen']['rol'] === 'BLOGER'){
    if(isset($_POST['deleteBlog'])){
        $uuid   = validateInput($_POST['uuid']);

        $deleteBlog = new Blogs();
        $deleteBlog->deleteBlogsByUuid($uuid);
        $_SESSION['SUCCES'] = 'Blog is verwijdert';
        header("Location:index.php?adminPage=".DASHBOARD."");
        return;
    }
}//