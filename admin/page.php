<?php

/*
categories => [manage / edit / update / add/ insert / delet/ statistics ]

*/




$do = isset($_GET['do']) ?  $do = $_GET['do']  : $do = 'manage';


// if  page is main page 

if($do == 'manage'){

    echo 'welcom in manage page ';
}

elseif($do == 'add'){

    echo 'ur in add category page ';
}

elseif($do == 'insert'){

    echo 'ur in insert category page ';
}



else{
    echo 'erro there is no page with this name ';
}
?>