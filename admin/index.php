
<!-- include content  -->
<?php

session_start();

$pageTitle = "Admin";
$noNavBar = "";
include "init.php";





// check if user comming from HTTP Post Request using $_SERVER['request_method']

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['user'];
    $hashpass = sha1($_POST['password']);
    // $hashpass = sha1($password);

    // chek if this  user exist in ur database 

    $stmt = $con->prepare("SELECT username, password, id , Email
    
    
    FROM 
    
      
       user

     WHERE
      username=?
      
       AND
       
        password=?
        
         AND 
         
         GroupID=1

         LIMIT 1"
         
        );

    $stmt->execute(array($username, $hashpass));

    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    
    //if cont > 0 => this database containt this record of user name 
if($count > 0){
   $_SESSION['username'] = $username; // resister session name
   $_SESSION['password'] = $hashpass; // resister session name
$_SESSION['id'] = $row['id'];    // regester sesssion id 

$_SESSION['email']=$row['Email'];
   header('location: dashboard.php');//redirect to dashboard page
   exit();

// print_r($row);

} 
}
?>






<!-- conent  -->
<form class="login" action ="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
<input type="text" placeholder="user name" class="form-control" name="user" autocomplete="off" >

<input type="password" placeholder="password"  class="form-control" name="password" autocomplete="new-password">

<input type="submit" value="login"  class="btn btn-danger btn-block">
</form>

<!-- end conent  -->





 <!-- footer  -->
<?php

include $tpl."footer.php";


?>

