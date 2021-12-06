<?php 
session_start();
// class pagePagebuilder
class Page{
   // constructur method
   public function __construct(){
     //include config.inc.php
     require_once('config.inc.php');
     //include header.inc.php
     require_once('header.inc.php');
     //include mainMenu.inc.php
     require_once('mainMenu.inc.php');
     //include adminMenu.inc.php
     require_once('adminMenu.inc.php');
     //include validateInput.inc.php
     require_once('validateInput.inc.php');
     //include uuid genrator
     require_once('uuidGen.inc.php');
     // include class blogs.class.php 
     require_once(BLOGS_CLASS);
     // include class data.class.php
     require_once(DATA_CLASS);
     //include class login.class.php
     require_once(REACTION_CLASS);
     //include login.class.php
     require_once(LOGIN_CLASS);
     //include class emailen.class.php
     require_once(EMAILEN_CLASS);
     //include file class wachtwoordReset.class.php
     require_once(WACTWOORD_RESET_CLASS);
   }
   // getPage method;
   public function getChosenPage($page){
        //include chosen page
        include($page);
        $html = "";
        $html .= "<!DOCTYPE html>";
        $html .= "<html>";
        $headrs = new Headers();
        $html .= $headrs->getHeaders();
          $html .= "<body>";
            $html .= "<div id='navbar'>";
               //check for uuid
               if(isset($_SESSION['inloggen']['uuid']) && isset($_SESSION['inloggen']['rol'])){
                 //check for rol
                  if($_SESSION['inloggen']['rol'] === 'BLOGER'){
                    $adminMenus = new AdminMenu();
                    $html .= $adminMenus->adminMenus();
                    //check for rol
                  }elseif($_SESSION['inloggen']['rol'] === 'BEZOEKER'){
                    $mainMenusLid = new MainMenu();
                    $html .= $mainMenusLid->mainMenusLid();
                  }
                }else{
                  //displays the main menu
                  $mainMenus = new MainMenu();
                  $html .= $mainMenus->mainMenus();
                }
            $html .= "</div>";
            //the div below outputs the content of all pages 
            $html .= "<div id='content'>";
                $html .= $body;
            $html .= "</div>";
          $html .= "</body>";
        $html .= "</html>";
        return $html;
   }
}
