<?php
//include config.inc.php
include_once('config.inc.php');
//clas mainmenu
class MainMenu{
   //method mainmenus
    public function mainMenus(){
      $mainMenus = "<div id='navbarContainer'>";
        $mainMenus .= "<div id='navbarContainerTwo'>";
          $mainMenus .= "<div id='blogsContactPageLinkBox'>";
            $mainMenus .= "<div id='blogsContactPageLinkBoxTwo'>";
              $mainMenus .= "<a class='blogContactPageLink' href='index.php?page=".BLOGS_PAGE."'>Blogs</a> ";
              $mainMenus .= "<a class='blogContactPageLink' href='index.php?page=".CONTACT_PAGE."'>Contact</a>";
            $mainMenus .= "</div>";
          $mainMenus .= "</div>";
          $mainMenus .= "<div id='regestratieLoginPageLinkBox'>";
            $mainMenus .= "<div id='regestratieLoginPageLinkBoxTwo'>";
              $mainMenus .= "<a class='registeerLoginPageLink' href='index.php?page=".REGISTRATIE_PAGE."'>Registratie</a> |";
              $mainMenus .= "<a class='registeerLoginPageLink' href='index.php?page=".LOGIN_PAGE."'>Login</a>";
            $mainMenus .= "</div>";
          $mainMenus .= "</div>";
        $mainMenus .= "</div>";
      $mainMenus .= "</div>";
      return $mainMenus;
    }//

     // menus for members
     public function mainMenusLid(){
      $mainMenusLid = "<div id='mainMenusLidContainer'>";
       $mainMenusLid .= "<div id='mainMenusLidContainerTwo'>";
          $mainMenusLid .= "<div id='mainMenusLidBox'>";
            $mainMenusLid .= "<a class='blogsLoguit' href='index.php?page=".BLOGS_PAGE."'>Blogs</a> ";
            $mainMenusLid .= "<a class='blogsLoguit' href='index.php?page=".MIJN_BLOGS_PAGE."'>Mijn blogs</a> ";
            $mainMenusLid .= "<a class='blogsLoguit' href='index.php?page=".PROFILE_PAGE."'>Profile</a> ";
            $mainMenusLid .= "<a class='blogsLoguit' href='index.php?page=".LOG_OUT_PAGE."'>Uitloggen</a> ";
          $mainMenusLid .= "</div>";
        $mainMenusLid .= "</div>";
      $mainMenusLid .= "</div>";
      return $mainMenusLid;
     }

}
