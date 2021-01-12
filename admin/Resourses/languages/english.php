<?php

// creating a global func to translate ur website

function lang ( $phrase ) {

    static $lang = array(

        //dashboard page and   nav bar links

        'admin'           => 'Admin',
        'home'            => 'Home',
        'Categories'      => 'Categories',
        'Edit Profile'    => 'Edit Profile',
        'settings'        => 'settings',
        'Members'         => 'Members',
        'Items'           => 'Items',
        'Statistics'      => 'Statistics',
        
        'Log Out'         => 'Lot Out',
       
    );

   return $lang[$phrase];
}



?>