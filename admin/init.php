<?php

include 'connect.php';

// this file to create a breife of ur files 
// routs



$tpl = 'Resourses/tempelates/'; // template Directory
$func = 'Resourses/functions/'; // template Directory
$css = 'puplicHTML/css/'; // css Directory
$js = 'puplicHTML/js/'; // js Directory
$lang = 'Resourses/languages/';


// include important files instead of including it in index.php file 

include $func . "functions.php";
include $lang . "english.php"; //  make sure to include language file befor any file 

include $tpl . "header.php";



//creat a simple fun to make php include navbar file in all page expect the one with $nonavbar 

if(!isset($noNavBar)){

    include $tpl . "navbar.php";


};
