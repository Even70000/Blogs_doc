<?php
// include config.inc.php
require_once('includes/config.inc.php');
//include pageBuilder.inc.php
require_once('includes/pageBuilder.inc.php');
// check if isset page 
if(isset($_GET['page'])){
    //declare variabel for the page
    $page = $_GET['page'];

    // check if isset adminpage 
}elseif(isset($_GET['adminPage'])){
    //declare variabel for the page
    $page = $_GET['adminPage'];
}else{
    //defualt page is blogs.php
    $page = BLOGS_PAGE;
}
$chosenPage = new Page();
//the decalerd variabele $page above will be past as parameter
// method below wil return with the content of the chosen page
echo $chosenPage->getChosenPage($page);