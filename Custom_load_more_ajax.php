<?php //Register a Custom Post type and the Custom taxonomies - Add posts in the backend 

add_action( 'init', 'create_posttype' );
function create_posttype() {
  register_post_type( 'cars',
    array(
      'name'=> 'Cars',
       'menu_position' => 2,
      'labels' => array(
        'name' => __( 'Cars' ),
        'singular_name' => __( 'Cars' ),
             ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'cars'),
      'capability_type' => 'post',
       'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
    )
  );
} 

add_action( 'init', 'create_book_tax' );

function create_book_tax() {
	register_taxonomy(
		'Types',
		'cars',
		array(
			'label' => __( 'Add Types' ),
			'rewrite' => array( 'slug' => 'types' ),
			'hierarchical' => true,
		)
	);
}

?>



<?php  //Code In Function.php 
function loadAjaxUrl() { ?>
	<script type="text/javascript">
	    var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
	</script>

<?php 
}
add_action('wp_enqueue_scripts', 'loadAjaxUrl');
add_action('wp_ajax_ajaxLoadPosts', 'ajaxLoadPosts');
add_action('wp_ajax_nopriv_ajaxLoadPosts', 'ajaxLoadPosts');

function ajaxLoadPosts() {
	$from = $_GET['from'];                           
      query_posts('posts_per_page=-1'); 
	    $args = array('post_type' => 'cars');
		$loop = new WP_Query($args);
        if($loop -> have_posts() ) { $i = 1;
          while ($loop -> have_posts()) : $loop -> the_post(); ?>
          <?php if( $i >= $from && $i < $from + 1 ){ ?>
            <div class="cars_page_load">
            	<br/>
                <h1><a class="title" href="<?php the_permalink() ?>"><b><?php the_title(); ?></b></a></h1>
                <div class="cat_list">
                    Catgeories:   <?php the_terms( $post->ID, 'Types', 'Types: ', ' / ' ); ?>
                </div>    
                <br/>            
                <div>
                    <?php the_content(); ?>
                </div>
                <div>
                    <?php the_post_thumbnail( 'full' ); ?>
                </div>               
            </div>            
            <?php } $i++;
          endwhile;
        }
        wp_reset_query();  // Restore global post data stomped by the_post().
die();
}
?>



<?php 
// Add Code in the template file
	$args = array('post_type' => 'cars', 'posts_per_page' => 1);
	$loop = new WP_Query($args);
?>
<style>
  button{margin:30px auto; width:200px; float:none; display: block;}
</style>

<div class="wrap">
	<div id="primary" class="content-area cars_page">
		<main id="load_posts" class="site-main" role="main">
			  <?php while ($loop->have_posts()) : ?>
			  	<?php $loop->the_post(); ?>
              	<h1>
              		<a href="<?php the_permalink(); ?>">
              			<b><?php  the_title(); ?></b>
              		</a>
              	</h1>
                <p>
                  <?php the_terms( $post->ID, 'Types', 'Types: ', ' / ' ); ?>
                </p>
              	<div>
              		<?php the_content(); ?>
          		</div>
              	<div>
              		<?php the_post_thumbnail(); ?>              			
              	</div>
                
              <?php endwhile; 
              wp_reset_postdata(); ?> 
              
		</main>
    <div class="preloader">
      <img src="<?php bloginfo('template_directory'); ?>/assets/images/loading.gif" class="preloader-img" style="display:none"/>
      <button id="load_more">Load More</button>
    </div>
      
	</div>
</div>

<?php 
 $totalPosts = wp_count_posts('cars'); 
?>
<script>
jQuery(document).ready(function($){
   var totalPosts = "<?php echo $totalPosts->publish; ?>";
   var fromPost = 2;
   $('#load_more').click(function(){
       $('.preloader-img').css('display','block');
       
       jQuery.ajax({
               url: "<?php echo admin_url('admin-ajax.php'); ?>?from="+fromPost,
               type: 'POST',
               data: {
               action: 'ajaxLoadPosts'
               },
               dataType: 'html',
               success: function(response) {
                if(fromPost == totalPosts){
                   $('#load_more').text('No more posts to display');
               }
               else{
                  $('.preloader-img').css('display','none');
                   jQuery('#load_more').before(response);
                   fromPost = fromPost + 1;
               }

               }
           });
   return false;
   });
});
</script>

