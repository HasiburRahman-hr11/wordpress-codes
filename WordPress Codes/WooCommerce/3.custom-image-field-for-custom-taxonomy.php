<?php


/*---------------------------------------------------*/
    // Adding Custom Fields in Custom Taxonomies
/*---------------------------------------------------*/

// Author Taxonomy Image Field


// Add Upload fields to "Add New Taxonomy" form
function add_author_image_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="author_image"><?php _e( 'Author Image:', 'journey' ); ?></label>
		<input type="text" name="author_image[image]" id="author_image[image]" class="author-image" value="<?php echo $authorimage; ?>">
		<input class="upload_image_button button" name="_add_author_image" id="_add_author_image" type="button" value="Select/Upload Image" />
		<script>
			jQuery(document).ready(function() {
				jQuery('#_add_author_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('.author-image').val(attachment.url);
					}
					wp.media.editor.open(this);
					return false;
				});
			});
		</script>
	</div>
<?php
}
add_action( 'product_author_add_form_fields', 'add_author_image_field', 10, 2 );

// Add Upload fields to "Edit Taxonomy" form
function journey_author_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "product_author_$t_id" ); ?>
	
	<tr class="form-field">
	<th scope="row" valign="top"><label for="_author_image"><?php _e( 'Author Image', 'journey' ); ?></label></th>
		<td>
			<?php
				$authorimage = esc_attr( $term_meta['image'] ) ? esc_attr( $term_meta['image'] ) : ''; 
				?>
			<input type="text" name="author_image[image]" id="author_image[image]" class="author-image" value="<?php echo $authorimage; ?>">
			<input class="upload_image_button button" name="_author_image" id="_author_image" type="button" value="Select/Upload Image" />
		</td>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top"></th>
		<td style="height: 150px;">
			<style>
				div.img-wrap {
					background: url('http://placehold.it/150x150') no-repeat center; 
					background-size:contain; 
					max-width: 150px; 
					max-height: 150px; 
                    background-position: center center;
                    background-size: cover;
					width: 100%; 
					height: 100%; 
					overflow:hidden; 
				}
				div.img-wrap img {
					max-width: 150px;
				}
			</style>
			<div class="img-wrap">
				<img src="<?php echo $authorimage; ?>" id="author-img">
			</div>
			<script>
			jQuery(document).ready(function() {
				jQuery('#_author_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('#author-img').attr("src",attachment.url)
						jQuery('.author-image').val(attachment.url)
					}
					wp.media.editor.open(this);
					return false;
				});
			});
			</script>
		</td>
	</tr>
<?php
}
add_action( 'product_author_edit_form_fields', 'journey_author_edit_meta_field', 10, 2 );

// Save Taxonomy Image fields callback function.
function save_author_custom_meta( $term_id ) {
	if ( isset( $_POST['author_image'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "product_author_$t_id" );
		$cat_keys = array_keys( $_POST['author_image'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['author_image'][$key] ) ) {
				$term_meta[$key] = $_POST['author_image'][$key];
			}
		}
		// Save the option array.
		update_option( "product_author_$t_id", $term_meta );
	}
}  
add_action( 'edited_product_author', 'save_author_custom_meta', 10, 2 );  
add_action( 'create_product_author', 'save_author_custom_meta', 10, 2 );