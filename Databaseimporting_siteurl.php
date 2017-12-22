---------------------------------IMPORT LARGE DATABASE USING COMMAND PROMT --------------------------------
select the folder mysql in terminal (cmd in windows)
c:\xampp\mysql\bin\

Run This
C:\xampp\mysql\bin>    mysql -u {username} -p {databasename} < file directory/file_name.sql

 (file directory/filename.fileextn)

---------------------------------Change the site and home url--------------------
change it in wp config file
<?php
define('WP_HOME','https://www.localhost/mutts/store/');
define('WP_SITEURL','https://www.localhost/mutts/store/');
?>

----------------------------------Change folder to assests--------------------------------------
/*Changes the name of the WP_content FOLDER*/
<?php
define ('WP_CONTENT_FOLDERNAME', 'assets');
define ('WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME);
define ('WP_SITEURL', 'https://'. $_Server['HTTP_HOST'].'/');
define ('WP_CONTENT_URL' ,WP_SITEURL.WP_CONTENT_FOLDERNAME);

/*Changes the name of the upload folder*/
define('UPLOADS',''.'files');
