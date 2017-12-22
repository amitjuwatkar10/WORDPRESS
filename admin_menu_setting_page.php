
-------------------------------To create the ADMIN MENU----------------------------------------
<?php
//Will add the menu in the wp admin
add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
  add_menu_page( 'My Top Level Menu Example', 'Top Level Menu', 'manage_options', 'myplugin/myplugin-admin-page.php', 'myplguin_admin_page', 'dashicons-tickets', 6  );
}

//fuction will print the content of the page in the admin
function myplguin_admin_page(){
  ?>
  <div class="wrap">
    <h2>Welcome To My Plugin</h2>
  </div>
  <?php
}
