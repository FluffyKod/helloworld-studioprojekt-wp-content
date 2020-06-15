<?php
/**
 * Plugin Name:           GamiPress - MasterStudy LMS integration
 * Plugin URI:            https://wordpress.org/plugins/gamipress-masterstudy-lms-integration/
 * Description:           Connect GamiPress with MasterStudy LMS.
 * Version:               1.0.0
 * Author:                GamiPress
 * Author URI:            https://gamipress.com/
 * Text Domain:           gamipress-masterstudy-lms-integration
 * Domain Path:           /languages/
 * Requires at least:     4.4
 * Tested up to:          5.4
 * License:               GNU AGPL v3.0 (http://www.gnu.org/licenses/agpl.txt)
 *
 * @package               GamiPress\MasterStudy_LMS
 * @author                GamiPress
 * @copyright             Copyright (c) GamiPress
 */

final class GamiPress_MasterStudy_LMS {

    /**
     * @var         GamiPress_MasterStudy_LMS $instance The one true GamiPress_MasterStudy_LMS
     * @since       1.0.0
     */
    private static $instance;

    /**
     * Get active instance
     *
     * @access      public
     * @since       1.0.0
     * @return      GamiPress_MasterStudy_LMS self::$instance The one true GamiPress_MasterStudy_LMS
     */
    public static function instance() {
        if( !self::$instance ) {
            self::$instance = new GamiPress_MasterStudy_LMS();
            self::$instance->constants();
            self::$instance->includes();
            self::$instance->hooks();
            self::$instance->load_textdomain();
        }

        return self::$instance;
    }

    /**
     * Setup plugin constants
     *
     * @access      private
     * @since       1.0.0
     * @return      void
     */
    private function constants() {
        // Plugin version
        define( 'GAMIPRESS_MASTERSTUDY_LMS_VER', '1.0.0' );

        // Plugin path
        define( 'GAMIPRESS_MASTERSTUDY_LMS_DIR', plugin_dir_path( __FILE__ ) );

        // Plugin URL
        define( 'GAMIPRESS_MASTERSTUDY_LMS_URL', plugin_dir_url( __FILE__ ) );
    }

    /**
     * Include plugin files
     *
     * @access      private
     * @since       1.0.0
     * @return      void
     */
    private function includes() {

        if( $this->meets_requirements() ) {

            require_once GAMIPRESS_MASTERSTUDY_LMS_DIR . 'includes/admin.php';
            require_once GAMIPRESS_MASTERSTUDY_LMS_DIR . 'includes/listeners.php';
            require_once GAMIPRESS_MASTERSTUDY_LMS_DIR . 'includes/triggers.php';

        }
    }

    /**
     * Setup plugin hooks
     *
     * @access      private
     * @since       1.0.0
     * @return      void
     */
    private function hooks() {
        // Setup our activation and deactivation hooks
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
    }

    /**
     * Activation hook for the plugin.
     *
     * @since  1.0.0
     */
    public function activate() {

        if( $this->meets_requirements() ) {

        }

    }

    /**
     * Deactivation hook for the plugin.
     *
     * @since  1.0.0
     */
    public function deactivate() {

    }

    /**
     * Plugin admin notices.
     *
     * @since  1.0.0
     */
    public function admin_notices() {

        if ( ! $this->meets_requirements() && ! defined( 'GAMIPRESS_ADMIN_NOTICES' ) ) : ?>

            <div id="message" class="notice notice-error is-dismissible">
                <p>
                    <?php printf(
                        __( 'GamiPress - MasterStudy LMS integration requires %s and %s in order to work. Please install and activate them.', 'gamipress-masterstudy-lms-integration' ),
                        '<a href="https://wordpress.org/plugins/gamipress/" target="_blank">GamiPress</a>',
                        '<a href="https://wordpress.org/plugins/masterstudy-lms-learning-management-system/" target="_blank">MasterStudy LMS</a>'
                    ); ?>
                </p>
            </div>

            <?php define( 'GAMIPRESS_ADMIN_NOTICES', true ); ?>

        <?php endif;

    }

    /**
     * Check if there are all plugin requirements
     *
     * @since  1.0.0
     *
     * @return bool True if installation meets all requirements
     */
    private function meets_requirements() {

        if ( ! class_exists( 'GamiPress' ) ) {
            return false;
        }

        // Requirements on multisite install
        if( is_multisite() && gamipress_is_network_wide_active() && is_main_site() ) {

            // On main site, need to check if integrated plugin is installed on any sub site to load all configuration files
            if( gamipress_is_plugin_active_on_network( 'masterstudy-lms-learning-management-system/masterstudy-lms-learning-management-system.php' ) ) {
                return true;
            }

        }

        if ( ! defined( 'STM_LMS_FILE' ) ) {
            return false;
        }

        return true;

    }

    /**
     * Internationalization
     *
     * @since       1.0.0
     *
     * @return      void
     */
    public function load_textdomain() {

        // Set filter for language directory
        $lang_dir = GAMIPRESS_MASTERSTUDY_LMS_DIR . '/languages/';
        $lang_dir = apply_filters( 'gamipress_masterstudy_lms_languages_directory', $lang_dir );

        // Traditional WordPress plugin locale filter
        $locale = apply_filters( 'plugin_locale', get_locale(), 'gamipress-masterstudy-lms-integration' );
        $mofile = sprintf( '%1$s-%2$s.mo', 'gamipress-masterstudy-lms-integration', $locale );

        // Setup paths to current locale file
        $mofile_local   = $lang_dir . $mofile;
        $mofile_global  = WP_LANG_DIR . '/gamipress-masterstudy-lms-integration/' . $mofile;

        if( file_exists( $mofile_global ) ) {
            // Look in global /wp-content/languages/gamipress-masterstudy-lms-integration/ folder
            load_textdomain( 'gamipress-masterstudy-lms-integration', $mofile_global );
        } elseif( file_exists( $mofile_local ) ) {
            // Look in local /wp-content/plugins/gamipress-masterstudy-lms-integration/languages/ folder
            load_textdomain( 'gamipress-masterstudy-lms-integration', $mofile_local );
        } else {
            // Load the default language files
            load_plugin_textdomain( 'gamipress-masterstudy-lms-integration', false, $lang_dir );
        }

    }

}

/**
 * The main function responsible for returning the one true GamiPress_MasterStudy_LMS instance to functions everywhere
 *
 * @since       1.0.0
 * @return      \GamiPress_MasterStudy_LMS The one true GamiPress_MasterStudy_LMS
 */
function GamiPress_MasterStudy_LMS() {
    return GamiPress_MasterStudy_LMS::instance();
}
add_action( 'plugins_loaded', 'GamiPress_MasterStudy_LMS' );
