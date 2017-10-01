/*Custom Taxonomies */
-------------------------------Register a custom post type: --------------------------

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

------------------------Register a custom taxonmies for the above create posttype: -----------------------------

add_action( 'init', 'create_book_tax' );
function create_book_tax() {
	register_taxonomy(
		'Types',  //-------------------------- Taxonimies Name
		'cars',    //-------------------------- POST TYPE Name
		array(
			'label' => __( 'Add Types' ),
			'rewrite' => array( 'slug' => 'types' ),
			'hierarchical' => true,
		)
	);
}

------------------------Display the taxonomies added to respective posts-------------------------
Under Custom WP_Query Loops

<?php the_terms( $post->ID, 'Types', 'Types: ', ' / ' ); ?>

-------------Create the Taxonomy Template  - taxonomy-Types.php---------------------

<div class="taxonomies_template">
	<div class="wrap">
		<?php $tax = $wp_query->get_queried_object(); ?>
		<h1>
			<?php printf( __( 'Cars under: %s'),  $tax->name  );?>  //--------------Gives Taxonimies Name
		</h1>
		<div class="term-description">
			<?php echo '<b>'.'Series Description: ' .'</b>' . term_description(); ?>  //--------------Gives Taxonimies Descriptions
		</div>
	</div>
	<?php    //--------------Gives post under the taxonomy
		if ( have_posts() ) : 	
			while ( have_posts() ) : the_post(); 	?>
				<div class="post_under_taxanomies">
					
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
					<?php the_post_thumbnail(); ?>
					&nbsp;
				</div>	
			<?php   endwhile;
		endif; 
	 ?>

</div>