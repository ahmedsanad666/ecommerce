


<nav class="navbar navbar-expand-lg   navbar-dark bg-dark">

<div class="container">
  <a class="navbar-brand" href="dashboard.php"><?php echo lang('admin')?></a>

  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="app-nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="app-nav">
    <ul class="navbar-nav mr-auto">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#"><?php echo lang('home')?> <span class="sr-only">(current)</span></a>
      </li> -->




      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('Categories')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('Items')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="members.php"><?php echo lang('Members')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('Statistics')?></a>
      </li>



      

      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    
<ul class="nav navbar-nav navbar-right">
    <li class="nav-item dropdown navbar-right">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          SAnad
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="members.php?do=Edit&userId=<?php echo $_SESSION['id']?> "><?php echo lang('Edit Profile')?> </a>
          <a class="dropdown-item" href="#"> <?php echo lang('settings')?></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logOut.php"> <?php echo lang('Log Out')?></a>
        </div>
      </li>
      </ul>
  </div>
  </div>

</nav>