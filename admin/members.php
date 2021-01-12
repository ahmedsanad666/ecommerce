<?php



/*
================= manage members page =================== 

=== u can ad | edit| delete mambers from here 


*/







session_start();
if (isset($_SESSION['username'])){


  $pageTitle ="Members";

  include "init.php";


  $do = (isset($_GET['do'])) ?  $_GET['do'] : 'manage'; 



// ...................................start manage page
if ($do == 'manage'){
    
  //manage page


 
  //select all users from database except admins which GroupId = 1

  $stmt = $con->prepare("SELECT* FROM  user WHERE GroupID != 1 ");

  $stmt->execute();

  $rows = $stmt->fetchAll();


 ?>
<!-- start html in manage page  -->
<h2 class="text-center my-3">Welcome in Manage Page</h2>


<div class="container manage-table my-3 p-3">
    <div class='table-responsive'>


    <table class="main-table text-center table table-bordered">
      <tr>
        <td>#Id</td>
        <td>Username</td>
        <td>Email</td>
        <td>Full Name</td>
        <td>Registed Date</td>
        <td>Controle</td>
      </tr>
      <!-- .............. -->
<?php  
foreach($rows as $row){
  echo '<tr>';

          echo '<td>' . $row['id'] . '</td>';
          echo '<td>' . $row['username'] . '</td>';
          echo '<td>' . $row['Email'] . '</td>';
          echo '<td>' . $row['FullName'] . '</td>';
          echo '<td>' . $row['FullName'] . '</td>';
          echo '<td><div class="controls">  
          
          
          <a href="members.php?do=Edit&userId='. $row['id'].'" class="btn btn-success">Edit</a>
          <a href="members.php?do=delete&userId='.$row['id'].'" class="btn btn-danger confirm">Delete</a></div></td>';
  echo '</tr>';

  
  
}
?>

      <!-- ////////////// -->
      
      </table>
      
    </div>

    <button class="btn btn-danger"> <i class="fas fa-plus-circle mr-2" ></i><a href="?do=add">Add New Member</a></button>

</div>


 <?php

}elseif($do == 'delete'){



  // if($_SERVER['REQUEST_METHOD']=== 'GET'){
$userId = isset($_GET['userId']) && is_numeric($_GET['userId']) ? $_GET['userId'] : 0;



$stmt = $con->prepare("SELECT* FROM user WHERE id = ? LIMIT 1");

$stmt->execute(array($userId));

$count = $stmt->rowCount();

if($count > 0){

  $stmt= $con->prepare("DELETE FROM user WHERE id = ?");

  $stmt->execute(array($userId));

  echo '<div class="container my-3">';

  echo '<div class="alert alert-success">' . $count . ' user hass been deleted <div/>';
echo '</div>';
}

    

    

  // }



}elseif( $do== 'add' ){ //add page
    
    
  ?>
  <!-- stating html in add page  -->
  
  <h2 class="text-center my-3">welcome in add members page</h2>
  
  
  
  <div class="container Add">
  
  <form method='POST' action='?do=insert' >
  
  
  
  <!-- ................. -->
    <div class="row mb-3">
      <label for="inputEmail3"  class="col-sm-2 col-form-label">Username </label>
      <div class="col-sm-10">
        <input type="text" placeholder="Input Username" name='username' class="form-control" required="required" autocomplete='off'>
       
      </div>
    </div>
    <!-- ................... -->
    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label" >Password</label>
      <div class="col-sm-10">
        <input type="password" value=''  required="required" placeholder='Inter New Password' name='newPassword' class="form-control password"   autocomplete='off' >
        <span class="show_pass"><i class="fas fa-eye"></i></span>
      </div>
    </div>
    <!--................ -->
    <div class="row mb-3">
      <label for="inputPassword3"  class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" name="email" required="required" placeholder="Inter Email" class="form-control" id="inputPassword3">
      </div>
    </div>
    <!--................ -->
   
    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Full  Name</label>
      <div class="col-sm-10">
        <input type="text" name='fullname'  required="required"placeholder="Inter Full Name" class="form-control" id="inputPassword3">
      </div>
    </div>
    <!--................ -->
   
    <input type="submit" class="btn btn-primary"  value='Add Member'></input>
  </form>
  
   </div>
  
  
  
  <?php
  

  // start iinsert pageeeee 
}elseif($do=='insert'){



/// start chck out conditon 
if($_SERVER['REQUEST_METHOD'] === 'POST'){


  // get the new variables from the form 
      
  $New_Username = $_POST['username'];
  $New_password =  $_POST['newPassword'];
  $Sha_password = sha1( $_POST['newPassword']);
  $New_Email = $_POST['email'];
  $New_FullName = $_POST['fullname'];

  
  
  
  // ERROR FORM 
  $form_errors = array();
  
  if(empty($New_Username)){
    $form_errors[] =  "<div class='alert alert-danger    my-3'> username can't be <strong>empty</strong> </div>";
  
  };
  if(strlen($New_Username) < 5){
    $form_errors[] =  "<div class='alert alert-danger    my-3'> username can't be <strong>less than 5 letters</strong> </div>";

  }
  if(empty($New_password)){
    $form_errors[] =  "<div class='alert alert-danger    my-3'> username can't be <strong>empty</strong> </div>";
  
  };
  if (empty($New_Email)){
    $form_errors[] =  "<div class='alert alert-danger   my-3'> Email can't be <strong>empty</strong> </div>";
  };
  if (empty($New_FullName)){
    $form_errors[] =   "<div class='alert alert-danger  my-3'> full name can't be <strong>empty</strong> </div>";
  };
  
  foreach ($form_errors as $error){
    echo $error . '</br>';
  };
  // end error form 



  if(empty($form_errors)){
  

    

$check = check_exsistance('username','user',$New_Username);
  
if($check == 1){
  echo  'user name already exsit';
}else{
  $stmt = $con->prepare("INSERT INTO user(username, FullName, password, Email) 
  VALUES(:username, :FullName, :password, :Email)");



$stmt->execute(array(

'username'  => $New_Username,
'FullName' => $New_FullName,
'password' => $Sha_password,
'Email' => $New_Email
));
// SUCESS MESSAGE

echo '<div class="alert alert-success" role="alert">' .
$stmt->rowCount() .
'record inserted 
</div>';

}
   

     

  
    
  
  }
  
  
  
    
  }else{
    $erroMassage = 'Sorry You Cant Browse This Page Directely';

    redirectHome($erroMassage,6);

  }

  

  /// end insert page 
}elseif($do == 'Edit'){   // edit page
    
  $userId = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0;
  
  $stmt = $con->prepare("SELECT * FROM user WHERE id = ? LIMIT 1" );
  $stmt->execute(array($userId));
  
  $row = $stmt->fetch();
  
  $count= $stmt->rowCount();
  
  if ($count > 0){
  
  ?>
  
  <!-- ..............................staart html in edit page.................. -->
  
  <h1 class="text-center my-3">Edit Member</h1>
  
  <div class="container EditM">
  
  <form method='POST' action='?do=Update' method="POST ">
  
  
  
  <input type="hidden" name='userId' class="form-control" value = '<?php  echo $userId ?>' >
  
  
  
  <!-- ................. -->
    <div class="row mb-3">
      <label for="inputEmail3"  class="col-sm-2 col-form-label">Username </label>
      <div class="col-sm-10">
        <input type="text" name='username' class="form-control" required="required" value='<?php echo $row['username'] ?>' autocomplete='off'>
      </div>
    </div>
    <!-- ................... -->
    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label" >Password</label>
      <div class="col-sm-10">
        <input type="hidden" name='oldPassword' value = '<?php echo $row['password']?>' >
        <input type="password" value='' name='newPassword' class="form-control password"   autocomplete='off'>
        <span class="show_pass"><i class="fas fa-eye"></i></span>
      </div>
    </div>
    <!--................ -->
    <div class="row mb-3">
      <label for="inputPassword3"  class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" name="email" required="required"  value = '<?php echo  $row['Email'] ?>'  class="form-control" id="inputPassword3">
      </div>
    </div>
    <!--................ -->
   
    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Full  Name</label>
      <div class="col-sm-10">
        <input type="text" name='fullname'  required="required" value = '<?php  echo $row['FullName'] ?>'  class="form-control" id="inputPassword3">
      </div>
    </div>
    <!--................ -->
   
    <input type="submit" class="btn btn-primary"  value='Save'></input>
  </form>
  
   </div>
  
  
  <?php
  
  
  
  
  }else{
    echo "THER IS NO SUCH ID ";
  }
  
  
  
      
  
  // start update page 
  }elseif($do == 'Update'){ // upsate page 


/// start chck out conditon 
if($_SERVER['REQUEST_METHOD'] === 'POST'){


// get the new variables from the form 
    
$id = $_POST['userId'];
$New_Username = $_POST['username'];
$New_password = empty($_POST['newPassword']) ?  $_POST['oldPassword'] : sha1( $_POST['newPassword']);
$New_Email = $_POST['email'];
$New_FullName = $_POST['fullname'];



// ERROR FORM 
$form_errors = array();

if(empty($New_Username)){
  $form_errors[] =  "<div class='alert alert-danger    my-3'> username can't be <strong>empty</strong> </div>";

};
if (empty($New_Email)){
  $form_errors[] =  "<div class='alert alert-danger   my-3'> Email can't be <strong>empty</strong> </div>";
};
if (empty($New_FullName)){
  $form_errors[] =   "<div class='alert alert-danger  my-3'> full name can't be <strong>empty</strong> </div>";
};

foreach ($form_errors as $error){
  echo $error . '</br>';
};

if(empty($form_errors)){


  $stmt = $con->prepare("UPDATE user SET username = ? , Email = ? ,  FullName =? , password = ? WHERE id = ?");

  $stmt->execute(array($New_Username , $New_Email, $New_FullName , $New_password, $id));


  // SUCESS MESSAGE

  echo $stmt->rowCount() . 'record has been updated successrfully ';



}



  
}
// end chck out conditon 

  }

  // end update page 
    
  














  


  include $tpl . "footer.php";

}else{
 header('location:index.php');
}


?>
          