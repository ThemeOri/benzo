<?php
/**
 * Template Required plugins
 *
 * Required plugins Template for admin panel
 *
 * @package Benzo
 */

if ( ! class_exists( 'TGMPA_List_Table' ) ) {
    return;
}

$plugin_table = new TGMPA_List_Table;

wp_clean_plugins_cache( false );
?>
<div class="benzo-required-plugin-wrapper tgmpa wrap">
    <?php $plugin_table->prepare_items();?>

    <?php $plugin_table->views();?>

    <form id="tgmpa-plugins" action="" method="post">
        <input type="hidden" name="tgmpa-page" value="tgmpa-install-plugins" />
        <input type="hidden" name="plugin_status" value="<?php echo esc_attr( $plugin_table->view_context ); ?>" />
        <?php $plugin_table->display();?>
    </form>
</div>