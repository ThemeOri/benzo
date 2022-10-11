<?php
global $pagenow;
$post_status = self::count_posts();
$publish_generic_el = isset($post_status->publish) ? $post_status->publish : 0;
$trash_generic_el = 0;
$current_url = admin_url('admin.php?page=generic-elements-admin');
$publish_url = add_query_arg('status', 'enabled', $current_url);
$disabled_url = add_query_arg('status', 'disabled', $current_url);
$trash_url = add_query_arg('status', 'trash', $current_url);
$empty_trash_url = add_query_arg('delete_all', true, $current_url);
$get_enabled_post = 0;
$get_disabled_post = 0;
$total_generic_el = $get_enabled_post + $get_disabled_post;
?>

<div class="generic-elements-admin-wrapper">
    <?php do_action('generic_el_admin_header'); ?>
    <div class="generic-elements-admin-notice">
        <?php ?>
    </div>


    <div class="generic-elements-admin-menu">
        <ul>
            <li <?php echo $all_active_class; ?>><a href="<?php echo esc_url($current_url); ?>">All (<?php echo $total_generic_el; ?>)</a></li>
            <?php if ($get_enabled_post > 0) : ?>
                <li <?php echo $enabled_active_class; ?>><a href="<?php echo esc_url($publish_url); ?>"><?php _e('Enabled', 'generic-elements'); ?> (<?php echo $get_enabled_post; ?>)</a></li>
            <?php endif; ?>
            <?php if ($get_disabled_post > 0) : ?>
                <li <?php echo $disabled_active_class; ?>><a href="<?php echo esc_url($disabled_url); ?>"><?php _e('Disabled', 'generic-elements'); ?> (<?php echo $get_disabled_post; ?>)</a></li>
            <?php endif; ?>
            <?php if ($trash_generic_el > 0) : ?>
                <li <?php echo $trash_active_class; ?>><a href="<?php echo esc_url($trash_url); ?>"><?php _e('Trash', 'generic-elements'); ?> (<?php echo $trash_generic_el; ?>)</a></li>
                <?php if (isset($_GET['status']) && $_GET['status'] === 'trash') : ?>
                    <li class="generic-el-empty-trash-btn"><a href="<?php echo esc_url($empty_trash_url); ?>"><?php _e('Empty Trash', 'generic-elements'); ?></a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </div>

    <div class="generic-elements-admin-items">
        <table class="wp-list-table widefat fixed striped generic_el-list">
            <thead>
                <tr>
                    <?php
                    if (!empty($table_header)) {
                        foreach ($table_header as $title) {
                            echo '<td>' . $title . '</td>';
                        }
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $trash_btn_title = __('Trash', 'generic-elements');
                $trash_page = false;
                $trashed = false;
                if (count($generic_el_posts) > 0) :
                    $post_type_object = get_post_type_object('generic_el_template');
                    global $generic_el_extension_factory;
                    foreach ($generic_el_posts as $single_generic_el) : // $generic_el->the_post();
                        $idd = $single_generic_el->ID;
                        $duplicate_url = add_query_arg(array(
                            'action' => 'nxduplicate',
                            'post' => $idd,
                            'generic_el_duplicate_nonce' => wp_create_nonce('generic_el_duplicate_nonce'),
                        ), $current_url);
                        $settings = \Generic\Elements\AdminMetabox::get_metabox_settings($idd);
                        $is_enabled = $settings->active_check;
                        $theme_name = 'basic';
                        $type = 'generic_el_template';
                        $generic_el_type = $type;

                        $extension_class = null;
                        $extension = null;
                        if (!empty($extension_class)) {
                            $extension = $extension_class::get_instance();
                        }
                        /**
                         * @since 1.0.3
                         * system re-generating
                         */
                        $regenerate_url = add_query_arg(array(
                            'action' => 'generic_el_regenerate',
                            'generic_el_type' => $generic_el_type,
                            'post' => $idd,
                            'from' => !empty($settings->display_from) ? $settings->display_from : '',
                            'last' => !empty($settings->display_last) ? $settings->display_last : '',
                            'generic_el_regenerate_nonce' => wp_create_nonce('generic_el_regenerate_nonce'),
                        ), $current_url);

                        $is_enabled_before = false;
                        if ($generic_el_type !== 'press_bar' && !false) {
                            $is_enabled_before = false;
                            if ($is_enabled == true) {
                                $is_enabled_before = $is_enabled_before == true ? false : true;
                            }
                            $is_enabled_before = apply_filters('generic_el_enabled_disabled_item', $is_enabled_before);
                        }
                        $edit_with_elementor = false;
                        if ($generic_el_type === 'press_bar') {
                            $post_meta = isset($settings->elementor_type_id) ? $settings->elementor_type_id : false;
                            if (is_numeric($post_meta) && class_exists('\Elementor\Plugin')) {

                                $documents = \Elementor\Plugin::$instance->documents->get($post_meta);
                                if ($documents) {
                                    $edit_with_elementor = $documents->get_edit_url();
                                }
                            }
                        }

                        $status = $single_generic_el->post_status;
                        if ($pagenow === 'admin.php' && isset($_GET['page']) && $_GET['page'] === 'generic-elements-admin') {
                            if (isset($_GET['status']) && $_GET['status'] === 'trash') {
                                $trash_page = true;
                                $trashed = true;
                                if ($status !== 'trash') {
                                    continue;
                                }
                                $trash_btn_title = __('Delete Permanently', 'generic-elements');
                            } elseif (isset($_GET['status']) && $_GET['status'] === 'enabled') {
                                if ($status !== 'publish' || $is_enabled != 1) {
                                    continue;
                                }
                            } elseif (isset($_GET['status']) && $_GET['status'] === 'disabled') {
                                if ($status !== 'publish' || $is_enabled != 0) {
                                    continue;
                                }
                            } else {
                                if ($status === 'trash') {
                                    continue;
                                }
                            }
                        }
                ?>
                        <tr>
                            <td>
                                <div class="generic-elements-admin-title">
                                    <strong>
                                        <?php
                                        if (!$trashed) echo '<a href="post.php?action=edit&post=' . $idd . '">';
                                        echo $single_generic_el->post_title;
                                        if (!$trashed) echo '</a>';
                                        ?>
                                    </strong>
                                    <div class="generic-elements-admin-title-actions">
                                        <?php if (!$trash_page) : ?>
                                            <a class="generic-elements-admin-title-edit" href="post.php?action=edit&post=<?php echo $idd; ?>"><?php _e('Edit', 'generic-elements'); ?></a>
                                            <?php if ($edit_with_elementor !== false) : ?>
                                                <a class="generic-elements-admin-title-edit" href="<?php echo $edit_with_elementor; ?>"><?php _e('Edit with Elementor', 'generic-elements'); ?></a>
                                            <?php endif; ?>
                                            <a class="generic-elements-admin-title-duplicate" href="<?php echo esc_url($duplicate_url); ?>"><?php _e('Duplicate', 'generic-elements'); ?></a>

                                        <?php do_action('generic_el_admin_title_actions', $idd);
                                        else :  ?>
                                            <a class="generic-elements-admin-title-restore" href="<?php echo wp_nonce_url(admin_url(sprintf($post_type_object->_edit_link . '&amp;action=untrash', $idd)), 'untrash-post_' . $idd); ?>"><?php _e('Restore', 'generic-elements'); ?></a>
                                        <?php endif; ?>
                                        <a class="generic-elements-admin-title-trash" href="<?php echo get_delete_post_link($idd, '', $trashed); ?>"><?php echo $trash_btn_title; ?></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="generic-elements-admin-preview">
                                    <?php
                                    $theme_preview = false;
                                    if (is_array($theme_preview)) {
                                        $theme_preview = $theme_preview['source'];
                                    }
                                    if (!empty($theme_preview)) :
                                    ?>
                                        <img width="250px" src="<?php echo $theme_preview; ?>" alt="<?php echo $single_generic_el->post_title; ?>">
                                    <?php $theme_preview = '';
                                    endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="generic-elements-admin-status">
                                    <span class="generic-elements-admin-status-title nxast-enable <?php echo $is_enabled ? 'active' : ''; ?>"><?php echo _e('Enabled', 'generic-elements'); ?></span>
                                    <span class="generic-elements-admin-status-title nxast-disable <?php echo $is_enabled ? '' : 'active'; ?>"><?php echo _e('Disabled', 'generic-elements'); ?></span>
                                    <input type="checkbox" id="generic-el-toggle-<?php echo $idd; ?>" name="_generic_el_meta_active_check" <?php echo $is_enabled ? 'checked="checked"' : ''; ?>>
                                    <?php
                                    if ($is_enabled_before) : ?>
                                        <label data-swal="true" data-post="<?php echo $idd; ?>" data-nonce="<?php echo wp_create_nonce('generic_el_status_nonce'); ?>" for="generic-el-toggle-disable-<?php echo $idd; ?>"></label>
                                    <?php else :  ?>
                                        <label data-swal="false" data-post="<?php echo $idd; ?>" data-nonce="<?php echo wp_create_nonce('generic_el_status_nonce'); ?>" for="generic-el-toggle-<?php echo $idd; ?>"></label>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="generic-elements-admin-type"><?php echo is_array($type) ? $type['source'] : $type; ?></div>
                            </td>
                            <td>
                                <div class="generic-elements-admin-stats"></div>
                            </td>
                            <td>
                                <div class="generic-elements-admin-date">
                                    <?php
                                    if ($status === 'publish') {
                                        echo '<span class="generic-elements-admin-publish-status">' . _e('Published', 'generic-elements') . '</span><br><span class="generic-elements-admin-publish-date">' . $single_generic_el->post_date . '</span>';
                                    }
                                    if ($status === 'trash') {
                                        echo '<span class="generic-elements-admin-publish-status">' . _e('Last Modified', 'generic-elements') . '</span><br><span class="generic-elements-admin-publish-date">' . $single_generic_el->post_date . '</span>';
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>

                <?php
                    endforeach;
                endif;

                if (!$total_generic_el && !$trashed) {
                    echo '<tr><td colspan="6"><div class="generic-elements-admin-not-found"><p>' . __('No generic_el is found.', 'generic-elements') . '</p></div></td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>


    <?php
    /**
     * Pagination
     * @since 1.0.3
     */
    if ($total_page > 1) : ?>
        <div class="generic-elements-admin-items-pagination">
            <ul>
                <?php
                if ($total_page > 1) {
                    if ($paged > 1) {
                        echo '<li class="generic-el-prev-page"><a href="' . $pagination_current_url . '&paged=' . ($paged - 1) . '"><span class="dashicons dashicons-arrow-left-alt2"></span></a></li>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        $active_page = $paged == $i ? 'class="generic-el-current-page"' : '';
                        echo '<li ' . $active_page . '><a href="' . $pagination_current_url . '&paged=' . $i . '">' . $i . '</a></li>';
                    }
                    if ($total_page > $paged) {
                        echo '<li class="generic-el-next-page"><a href="' . $pagination_current_url . '&paged=' . ($paged + 1) . '"><span class="dashicons dashicons-arrow-right-alt2"></span></a></li>';
                    }
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>
</div>