<?php 
	$success=false;
    if($_POST){
        wp_set_password($_POST['new-pass'], $_POST['userid']);
        $success=true;
	}
?>

<?php  if ( is_user_logged_in() ) { ?>
<?php if($success==true) { echo'<p class="space-err">Password Changed Successfully</p>'; }?>
<p><input type="password" name="new-pass" id="npass" value="<?php //echo $results->cTeamMember2; ?>"/></p>   
<p><input type="password" name="confirm-pass" id="cpass" value="<?php //echo $results->cTeamMember2; ?>"/></p>   
<input type="hidden" name="userid" id="userid" value="<?php  echo  get_current_user_id(); ?>">          
<input type="submit" value="SAVE" />
<?php  } ?>


<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#changepass').submit(function(event){
       
            data =  jQuery('#npass').val();
            var len = data.length;
           
            if(jQuery('#changepass').val() == '' ){
				alert("Please enter the new password");
				Prevent form submission
				event.preventDefault();         
            }

            if(len < 6) {
                alert("Password cannot be less than 6 characters");
                // Prevent form submission
                event.preventDefault();
            }
            
            if(jQuery('#npass').val() != jQuery('#cpass').val()) {
                alert("Password and Confirm Password don't match");
                // Prevent form submission
                event.preventDefault();
            }
            
        });
    });
</script>