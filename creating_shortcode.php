--------------------------------------To create the Short code----------------------------------
-------------Calling the shortcode--------------------
<?php echo do_shortcode("[my_shortcode]");

//Function that creates the short code 
function create_shortdode(){
 return 'Enter the text you want to diplsay';
}
add_shortcode('my_shortcode','create_shortdode');

function create_shortdode($atts , $content = null){
 
 print_r($atts); 
 //alows you give attribute in the shortcode returns an array.

}

add_shortcode('my_shortcode' , 'create_shortcode')

?>
Ref link : https://www.elegantthemes.com/blog/tips-tricks/how-to-create-shortcodes-in-wordpress