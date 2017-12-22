--------------language attribute---------------
<html <?php language_attributes(); ?>>  

------------------Ping Back Url--------------
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
Pingbacks (also known as trackbacks) are a form of automated comment for a page or post, created when another WordPress blog links to that page or post.

----------------get the blog name and logo text---------------
<title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>
use this if dosent work  - add_theme_support( ‘title-tag’ );

-------------------------adding the defalt body class or page class to the page ------------------
<body <?php body_class(); ?>>
        //body content goes here....
</body>

-------------------------------------------------dynamic menu-----------------------------------
<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'nav', 'theme_location' => 'primary-menu') ); 

  //Add support for WordPress 3.0's custom menus
  add_action( 'init', 'register_my_menu' );
   
  //Register area for custom menu
  function register_my_menu() {
      register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
  }

?>