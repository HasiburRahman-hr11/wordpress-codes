<?php 


/* ------------------
// Link in Attributes
--------------------*/

// How to apply : [atts value](atts link)

/**
 * Register term fields
 */
add_action('init', 'register_attributes_url_meta');
function register_attributes_url_meta()
{
    if(function_exists('wc_get_attribute_taxonomies')){
        $attributes = wc_get_attribute_taxonomies();

        foreach ($attributes as $tax) {
            $name = wc_attribute_taxonomy_name($tax->attribute_name);

            add_action($name . '_add_form_fields', 'add_attribute_url_meta_field');
            add_action($name . '_edit_form_fields', 'edit_attribute_url_meta_field', 10);
            add_action('edit_' . $name, 'save_attribute_url');
            add_action('create_' . $name, 'save_attribute_url');
        }
    }
    
}

/**
 * Add term fields form
 */
function add_attribute_url_meta_field()
{
    wp_nonce_field(basename(__FILE__), 'attrbute_url_meta_nonce');
?>
    <div class="form-field">
        <label for="attribute_url"><?php _e('URL', 'domain'); ?></label>
        <input type="url" name="attribute_url" id="attribute_url" value="" />
    </div>
<?php
}

/**
 * Edit term fields form
 */

function edit_attribute_url_meta_field($term)
{

    $url = get_term_meta($term->term_id, 'attribute_url', true);
    wp_nonce_field(basename(__FILE__), 'attrbute_url_meta_nonce');
?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="attribute_url"><?php _e('URL', 'domain'); ?></label></th>
        <td>
            <input type="url" name="attribute_url" id="attribute_url" value="<?php echo esc_url($url); ?>" />
        </td>
    </tr>
    <?php
}

/**
 * Save term fields
 */

function save_attribute_url($term_id)
{
    if (!isset($_POST['attribute_url']) || !wp_verify_nonce($_POST['attrbute_url_meta_nonce'], basename(__FILE__))) {
        return;
    }

    $old_url = get_term_meta($term_id, 'attribute_url', true);
    $new_url = esc_url($_POST['attribute_url']);


    if (!empty($old_url) && $new_url === '') {
        delete_term_meta($term_id, 'attribute_url');
    } else if ($old_url !== $new_url) {
        update_term_meta($term_id, 'attribute_url', $new_url, $old_url);
    }
}

/**
 * Show term URL
 */

add_filter('woocommerce_attribute', 'make_product_atts_linkable', 10, 3);

function make_product_atts_linkable($text, $attribute, $values)
{
    $vals = array();

    if ($attribute->is_taxonomy()) {
        foreach ($attribute->get_options() as $i => $id) {
            if ($url = get_term_meta($id, 'attribute_url', true)) {
                $vals[] = '<a href="' . esc_url($url) . '">' . esc_html(get_term_field('name', $id)) . '</a>';
            } else {
                $vals[] = $values[$i];
            }
        }
    } else {
        foreach ($attribute->get_options() as $value) {
            $vals[] = preg_replace_callback('/\[([^\]]+)\]\(([^) ]+)(?: "([^"]+)"|)\)/', function ($matches) {
                $title = (!empty($matches[3])) ? ' title="' . esc_attr($matches[3]) . '"' : '';
                return '<a href="' . esc_url($matches[2]) . '"' . $title . '>' . esc_html($matches[1]) . '</a>';
            }, $value);
        }
    }

    return wpautop(wptexturize(implode(', ', $vals)));
    //return implode( ', ', $vals ); // Use this or the above. Up to you..
}

// How to apply : [atts value](atts link)
