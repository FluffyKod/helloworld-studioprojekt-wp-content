add_action( 'wp_enqueue_scripts', 'melos_boxed_child_enqueue_styles' );
function melos_boxed_child_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( 'parenthandle' ), 
        wp_get_theme()->get('Version') // this only works if you have Version in the style header
    );
}