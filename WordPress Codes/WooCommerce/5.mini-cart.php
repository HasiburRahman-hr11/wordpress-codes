<?php


/* -------------
    // Mini Cart 
 ---------------*/
add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {
    ob_start();
    ?>
    <div class="fl-mini-cart">
        <?php woocommerce_mini_cart(); ?>
    </div>

    <?php $fragments['div.fl-mini-cart'] = ob_get_clean();

    return $fragments;
} );

remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

function my_woocommerce_widget_shopping_cart_button_view_cart() {
    echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward">' . esc_html__( 'কার্ট', 'woocommerce' ) . '</a>';
}
function my_woocommerce_widget_shopping_cart_proceed_to_checkout() {
    echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout wc-forward">' . esc_html__( 'চেকআউট', 'woocommerce' ) . '</a>';
}
add_action( 'woocommerce_widget_shopping_cart_buttons', 'my_woocommerce_widget_shopping_cart_button_view_cart', 10 );
add_action( 'woocommerce_widget_shopping_cart_buttons', 'my_woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

function woocommerce_widget_shopping_cart_subtotal() {
    echo '<strong>' . esc_html__( 'মোট:', 'woocommerce' ) . '</strong> ' . WC()->cart->get_cart_subtotal(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  }
add_action( 'woocommerce_widget_shopping_cart_total','woocommerce_widget_shopping_cart_subtotal',10 );

/* ------------------
    // Mini Cart End 
 -------------------*/