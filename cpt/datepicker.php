<?php

    // Enqueue Datepicker + jQuery UI CSS
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_style( 'jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
?>

    <script>
    jQuery(document).ready(function(){
    jQuery('.cookies').datepicker({
    dateFormat : 'dd/m - yy'
    });
    });
    </script>

    <input type="text" name="cookie_cookie_date" id="cookie" value="<?php echo $cookie_date; ?>" />


<?php

function display_cookie_meta_box( $cookie ) {
// Enqueue Datepicker + jQuery UI CSS
wp_enqueue_script( 'jquery-ui-datepicker' );
wp_enqueue_style( 'jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);

// Retrieve current date for cookie
$cookie_date = get_post_meta( $cookie->ID, 'cookie_date', true  );
?>


<script>
jQuery(document).ready(function(){
   jQuery('#cookie_date').datepicker({
     dateFormat : 'dd/m - yy'
   });
});
</script>

<table>
<tr>
<td style="width: 100%">The cookie stays in the jar until:</td>
<td>
<input type="text" name="cookie_cookie_date" id="cookie_date" value="<?php echo $cookie_date; ?>" /></td>
</tr>
</table>


<?php 
}
?>