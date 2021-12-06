<?php
//include config.inc.php
include_once('config.inc.php');
// class AdminMenu
class AdminMenu{
    //method adminMenus
    public function adminMenus(){
        $adminMenu = '<div id="adminMenuContainer">';
          $adminMenu .= "<div id='adminMenuContainerTwo'>";
            $adminMenu .= "<div id='adminMenuBox'>";
              $adminMenu .= "<a class='dashboardLoguit' href='index.php?adminPage=".DASHBOARD."'>Dashboard</a> ";
              $adminMenu .= "<a class='dashboardLoguit' href='index.php?adminPage=".PROFILE_ADMIN."'>Profile</a> ";
              $adminMenu .= "<a class='dashboardLoguit' href='index.php?page=".LOG_OUT_PAGE."'>Uitloggen</a> ";
            $adminMenu .= "</div>";
          $adminMenu .= "</div>";
        $adminMenu .= "</div>";
        return $adminMenu;
    }
}