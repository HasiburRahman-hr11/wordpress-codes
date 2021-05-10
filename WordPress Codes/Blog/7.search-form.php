<?php

/**
 * Template for displaying search forms in Custom Theme
 *
 * @package WordPress
 * @subpackage Cusotm Theme
 * @since 1.0
 * @version 1.0
 */

?>


<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">

    <div class="form-group">
        <div class="input-group mb-3">
            <input type="text" placeholder="Search Here" value="<?php echo get_search_query(); ?>" name="s">
        </div>
        <button class="hover-button" type="submit">Search</button>
    </div>
    
</form>