<?php




//display page title in each title dynamiclly
function pageTitle(){
 
    
    global $pageTitle;

    if(isset($pageTitle)){
        echo $pageTitle;

    }else{
        echo "Default";
    }


    /*
    **erro fucntion v1.0
    **accept parameters -> $errorMassage , timeout 
    
    */

    function redirectHome ($erroMassage , $timeOut = 3){


        echo "<div class='alert alert-danger'>" . $erroMassage ."</div>" ;
      
        echo "<div class='alert alert-success  my-3'> you will be directed to home pagge after ".$timeOut." seconeds </div>" ;

    
     
header("refresh:$timeOut;url=dashboard.php");

exit();
    }


    /*
    **chek items function v1.0
    **function to chek if item is exist in database or not [function accept parameter]
    **$from = table to select from [users, items , categories]
    **$select = the item to be selected [user , username , category]
    **$value = the value of the selected item which we want to chek if its exsit or not [example: osama, box, electronics]
    */




function check_exsistance( $select , $from, $value){

    global $con;

    $stmt1 = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

    $stmt1->execute(array($value));

    $count1 = $stmt1->rowCount();


    return $count1;

}
}