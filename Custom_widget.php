 <?php
class post_widget extends WP_Widget{	
	function __construct(){
		parent:: __construct('my-post-widget',$name = __('Widget Post'));
	}
	public function form($instance){
		$testname = ! empty( $instance['testname'] ) ? $instance['testname'] : esc_html__( 'New title', 'text_domain' );
?>
		<label style="padding:10px 0; display:block" for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
			<?php esc_attr_e( 'Title:', 'text_domain' ); ?>
		</label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="testname" type="text" value="<?php echo esc_attr( $testname ); ?>">

		<div style="padding:15px 0;">
			<input type="radio" <?php if($instance['sorting']=='rand'){ echo "checked"; }  ?> name="sorting" value="rand">Random
			<input type="radio" <?php if($instance['sorting']=='ASC'){ echo "checked"; }  ?> name="sorting" value="ASC">ASC
			<input type="radio" <?php if($instance['sorting']=='DESC'){ echo "checked"; }  ?>  name="sorting" value="DESC">DESC
		</div>

	<?php }
	public function update( $new_instance, $old_instance ){
		$instance = array();
		$instance['testname'] = ( ! empty( $_POST['testname'] ) ) ? strip_tags( $_POST['testname'] ) : '';
		$instance['sorting'] = ( ! empty( $_POST['sorting'] ) ) ? strip_tags( $_POST['sorting'] ) : '';		
		return $instance; 	
	}
	function widget($args, $instance){
		  extract( $args );
    	$radio_buttons = $instance['sorting'];
		?>
				<div class="custom-widget">
				<?php $abc = new WP_Query(array('post_type'=>'news','post_per_page'=>-1,'orderby'=> $radio_buttons )); ?>
						<?php while($abc -> have_posts()) :  $abc -> the_post();
						 ?>
							<div>	
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="content"><?php the_post_thumbnail(); ?></div>
								<?php the_excerpt(); ?>
							</div>
					<?php endwhile; ?>
				</div>
			<?php 
	}
}
add_action('widgets_init',function(){
	register_widget('post_widget');
});

?>