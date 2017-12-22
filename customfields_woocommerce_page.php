-------------------------------to create the custom field on the check out page--------------------------------
<?php 
add_action('woocommerce_after_order_notes','my_custom_checkout_field');
 function my_custom_checkout_field($checkout)
{
echo '<div id="my_custom_checkout_field"><h3>'.__('My Custom Field').'</h3>';
  woocommerce_form_field('my_field_name',array(
    'type'=>'text',
    'class'=> array('my-field-class form-row-wide'),
    'label'=> __('Fill in the field'),
    'placeholder'=>__('Enter something'),
    ),$checkout->get_value('my_field_name'));
  echo '</div>';
}



// to make the the custom required 
add_action('woocommerce_checkout_process','my_custom_checkout_field_process');
function my_custom_checkout_field_process()
{
  global $woocommerce;

  //check is set, if its  not set  add an error
  if (! $_POST['my_field_name'])
    $woocommerce->add_notice(__('PLease enter something into this new shiny field.'));

}

//saving the field and the value to the order table in the database 
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['my_field_name'] ) ) {
        update_post_meta( $order_id, 'My Field', sanitize_text_field( $_POST['my_field_name'] ) );
    }
}

// Display field value on the order edit page

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('My Field').':</strong> ' . get_post_meta( $order->id, 'My Field', true ) . '</p>';
}