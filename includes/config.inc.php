<?php 
//diroctarys configuration
define("ADMINPAGES_PATH"    ,"adminPages/");
define("PAGES_PATH"         ,"pages/");
define("CLASSES_PATH"       ,"classes/");
define("CSS_PATH"           ,"css/");
define("IMAGES_PATH"        ,"images/");
define("INCLUDES"           ,"includes/");

//files configuration
//classes files
define("BLOGS_CLASS"       ,CLASSES_PATH     ."blogs.class.php");
define("DATA_CLASS"        ,CLASSES_PATH     ."gegevens.class.php");
define("DATABASE_CLASS"    ,CLASSES_PATH     ."database.class.php");
define("EMAILEN_CLASS"     ,CLASSES_PATH     ."emailen.class.php");
define("LOGIN_CLASS"       ,CLASSES_PATH     ."login.class.php");
define("REACTION_CLASS"    ,CLASSES_PATH     ."reaction.class.php");
define("LEDEN_CLASS"       ,CLASSES_PATH     ."leden.class.php");

define("WACTWOORD_RESET_CLASS"   ,CLASSES_PATH     ."wachtwoordReset.class.php");

//css file
define("STYLE_CSS"          ,CSS_PATH       .'style.css');

// pages files 
define("BLOGS_PAGE"         ,PAGES_PATH     ."blogs.php");
define("BLOGS_INHOUD_PAGE"  ,PAGES_PATH     ."blogsInhoud.php");
define("CONTACT_PAGE"       ,PAGES_PATH     ."contact.php");
define("LOGIN_PAGE"         ,PAGES_PATH     ."login.php");
define("LOG_OUT_PAGE"       ,PAGES_PATH     ."uitloggen.php");
define("REGISTRATIE_PAGE"   ,PAGES_PATH     ."registratie.php");
define("MIJN_BLOGS_PAGE"    ,PAGES_PATH     ."mijnBlogs.php");
define("PROFILE_PAGE"       ,PAGES_PATH     ."profile.php");

define("WACHTWOORD_RESET_PAGE"          ,PAGES_PATH     ."wachtwoordReset.php");
define("WACHTWOORD_VERGETEN_PAGE"       ,PAGES_PATH     ."wachtwoordVergeten.php");

// admin files 
define("DASHBOARD"          ,ADMINPAGES_PATH ."dashboard.php");
define("COMMENTAREN_LIJST"  ,ADMINPAGES_PATH ."commentarenLijst.php");
define("BLOG_TOEVOEGEN"     ,ADMINPAGES_PATH ."blogToevoegen.php");
define("BLOG_WIJZIGING"     ,ADMINPAGES_PATH ."blogsWijziging.php");
define("BLOGEN_DELETEN"     ,ADMINPAGES_PATH ."deletenBlog.php");
define("BLOGEN_LIJST"       ,ADMINPAGES_PATH ."blogenLijst.php");
define("PROFILE_ADMIN"      ,ADMINPAGES_PATH ."profile.php");

// file voor meldingen
define("MELDING"            ,INCLUDES        ."meldingen.inc.php");