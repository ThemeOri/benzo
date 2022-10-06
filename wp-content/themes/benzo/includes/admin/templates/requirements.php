<?php
/**
 * Template Requirements
 *
 * Requirements Template for admin panel
 *
 * @package Benzo
 */

global $wpdb;
$php_requirements = 7.0;
$memory_limit_requirements = 134217728;
$max_upload_size = 134217728;
$max_input_vars_requirements = 3000;
$max_input_time_requirements = 600;
$max_execution_time_requirements = 600;
?>

<div class="benzo-requirements-wrapper">
    <table class="benzo-panel-table info_table widefat">
        <thead>
            <tr>
                <th colspan="4"><?php esc_html_e( 'Theme Config', 'benzo' );?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php esc_html_e( 'Theme Name', 'benzo' );?>:</td>
                <td><?php echo esc_html( wp_get_theme()->get( 'Name' ) ); ?></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Version', 'benzo' );?>:</td>
                <td><?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Author', 'benzo' );?>:</td>
                <td><?php echo esc_html( wp_get_theme()->get( 'Author' ) ); ?></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Author URL', 'benzo' );?>:</td>
            <td>
                <a href="<?php echo esc_url_raw( wp_get_theme()->get( 'AuthorURI' ) ) ?>" target="_blank">
                    <?php echo esc_html( wp_get_theme()->get( 'AuthorURI' ) ); ?>
                </a>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="benzo-panel-table info_table widefat">
        <thead>
            <tr>
                <th colspan="4"><?php esc_html_e( 'Server Settings', 'benzo' );?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php esc_html_e( 'PHP Version', 'benzo' );?>:</td>
                <td>
                    <?php if ( version_compare( phpversion(), $php_requirements, '<' ) ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                            echo esc_html( phpversion() );
                            esc_html_e( '- We recommend a minimum PHP version of ', 'benzo' );
                            echo esc_html( $php_requirements );
                        ?>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( phpversion() ); ?>
                    </span>
                    <?php endif;?>
                </td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'PHP Post Max Size', 'benzo' );?>:</td>
                <td>
                    <span class="message-info message-info-info">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                            esc_html_e( 'You cannot upload images, themes and plugins that have a size bigger than this value: ', 'benzo' );
                            echo esc_html( size_format( $this->let_to_num(  ( ini_get( 'post_max_size' ) ) ) ) );
                        ?>
                        <br/>
                        <a target="_blank" href="http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/">
                            <?php esc_html_e( 'To know how you to change this please check this guide', 'benzo' );?>
                        </a>
                    </span>
                </td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'PHP Max Execution Time Limit', 'benzo' );?>:</td>
                <td>
                    <?php if ( $max_execution_time_requirements > ini_get( 'max_execution_time' ) ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                            echo esc_html( ini_get( 'max_execution_time' ) );
                            esc_html_e( '- We recommend setting max execution time to at least ', 'benzo' );
                            echo esc_html( $max_execution_time_requirements );
                        ?>
                        <br/>
                        <a target="_blank" href="http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/">
                            <?php esc_html_e( 'To see how you can change this please check this guide', 'benzo' );?>
                        </a>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( ini_get( 'max_execution_time' ) ); ?>
                    </span>
                    <?php endif;?>
                </td>
            </tr>
            <tr>
				<td><?php esc_html_e( 'PHP Max Input Time', 'benzo' );?>:</td>
				<td>
                    <?php if ( $max_input_time_requirements > ini_get( 'max_input_time' ) ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                            echo esc_html( ini_get( 'max_input_time' ) );
                            esc_html_e( '- We recommend setting max execution time to at least ', 'benzo' );
                            echo esc_html( $max_input_time_requirements );
                        ?>
                        <br/>
                        <a target="_blank" href="http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/">
                            <?php esc_html_e( 'To see how you can change this please check this guide', 'benzo' );?>
                        </a>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( ini_get( 'max_input_time' ) ); ?>
                    </span>
                    <?php endif;?>
                </td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'PHP Max Input Vars', 'benzo' );?>:</td>
				<td>
                    <?php if ( $max_input_vars_requirements > ini_get( 'max_input_vars' ) ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                                echo esc_html( ini_get( 'max_input_vars' ) );
                                esc_html_e( '- We recommend setting max execution time to at least ', 'benzo' );
                                echo esc_html( $max_input_vars_requirements );
                                ?>
                        <br/>
                        <a target="_blank" href="https://betterstudio.com/blog/increase-max-input-vars-limit/">
                            <?php esc_html_e( 'To see how you can change this please check this guide', 'benzo' );?>
                        </a>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( ini_get( 'max_input_vars' ) ); ?>
                    </span>
                    <?php endif;?>
                </td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'MySql Version', 'benzo' );?>:</td>
				<td><?php echo ( ! empty( $wpdb->is_mysql ) ? $wpdb->db_version() : '' ); ?></td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'Max upload size', 'benzo' );?>:</td>
				<td>
					<?php if ( $max_upload_size > wp_max_upload_size() ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                            <?php
                                echo esc_html( size_format( wp_max_upload_size() ) );
                                esc_html_e( '- We recommend minimum value: 128 MB.', 'benzo' );
                            ?>
                        <br/>
                        <a target="_blank" href="http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/">
                            <?php esc_html_e( 'To see how you can change this please check this guide', 'benzo' );?>
                        </a>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( size_format( wp_max_upload_size() ) ); ?>
                    </span>
                    <?php endif;?>
				</td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'SimpleXML', 'benzo' );?>:</td>
				<td>
					<?php if ( ! extension_loaded( 'simplexml' ) ): ?>
                    <span class="message-info message-info-error">
                        <?php esc_html_e( 'To ensure successful installation of demo content The SimpleXML extension should be installed on your web server. Please contact your hosting provider to install and activate SimpleXML extension.', 'benzo' ) ?>
                    </span>
					<?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html__( 'Enabled', 'benzo' ); ?>
                    </span>
					<?php endif;?>
				</td>
            </tr>
        </tbody>
    </table>

	<table class="benzo-panel-table info_table widefat">
        <thead>
            <tr>
                <th colspan="4"><?php esc_html_e( 'WordPress Settings', 'benzo' );?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php esc_html_e( 'Home URL', 'benzo' );?>:</td>
				<td><?php echo esc_html( home_url( '/' ) ); ?></td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'Site Url', 'benzo' );?>:</td>
				<td><?php echo esc_html( site_url( '/' ) ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Version', 'benzo' );?>:</td>
				<td><?php echo esc_html( get_bloginfo( 'version' ) ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Memory Limit', 'benzo' );?>:</td>
				<td>
					<?php if ( $memory_limit_requirements > $this->memory_limit() ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                            echo esc_html( size_format( $this->memory_limit() ) );
                            esc_html_e( '- .We recommend setting memory to be at least 128MB', 'benzo' );
                        ?>
                        <br/>
                        <a target="_blank" href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP">
                            <?php esc_html_e( 'To see how you can change this please check this guide', 'benzo' );?>
                        </a>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( size_format( $this->memory_limit() ) ); ?>
                    </span>
                    <?php endif;?>
				</td>
			</tr>
            <tr>
		    	<td>
		    		<?php echo esc_html( 'WP_DEBUG' );?>
		    	</td>

		    	<td>
		    		<?php if ( defined( 'WP_DEBUG' ) and WP_DEBUG === true ): ?>
                    <?php echo esc_html__( 'WP_DEBUG is enabled.', 'benzo' ); ?>
                    <a target="_blank" href="https://wordpress.org/support/article/debugging-in-wordpress/">
                        <?php echo esc_html__( ' How to disable WP_DEBUG mode.', 'benzo' ); ?>
                    </a>
		    		<?php else: ?>
                    <?php echo esc_html__( 'WP_DEBUG is disabled.', 'benzo' ); ?>
		    		<?php endif;?>
		    	</td>
		    </tr>
        </tbody>
    </table>
</div>