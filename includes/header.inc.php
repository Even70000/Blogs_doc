<?php
// include config.inc.php
include_once('config.inc.php');
//class for headers
class Headers{
    // method header
    public function getHeaders(){
        $header = '';
        $header .= "<head>";   
           $header .= "<meta charset='UTF-8'/>";
           $header .= "<link rel='stylesheet' href='".STYLE_CSS."'/>";
           $header .= "<title>Blogs</title>";
        $header .= "</head>";  
        return $header;
    }
}