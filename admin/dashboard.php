<?php
session_start();


if(isset($_SESSION['username'])){  

    
     
    $pageTitle ="Dashboard";

    include "init.php";

    echo 'welcome' ." ". $_SESSION['username'] . 'ur id  is ' . ' ' . $_SESSION['id'] . '</br>';
    
    echo $_SESSION['email'];



    include $tpl ."footer.php";


}else{
  
    header("location: index.php");

    exit();
  
}




?>