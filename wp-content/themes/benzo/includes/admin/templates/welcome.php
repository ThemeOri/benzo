<?php
/**
 * Template Welcome
 *
 * Welcome Template for admin panel
 *
 * @package Benzo
 */

$allowed_html = [
    'a' => [
        'href'   => true,
        'target' => true,
    ],
];

?>

<div class="benzo-welcome-wrapper">
    <div class="benzo-welcome-title">
        <h1><?php esc_html_e( 'Welcome to', 'benzo' );?>
            <?php echo BENZO_NAME; ?>
        </h1>
        <span class="benzo-version-theme">
            <?php esc_html_e( 'Version - ', 'benzo' );?>
            <?php echo BENZO_VERSION; ?>
        </span>
        <span class="benzo-welcome-subtitle">
            <?php
                echo sprintf( esc_html__( '%s is already installed and ready to use! Let\'s build something impressive.', 'benzo' ), BENZO_NAME );
            ?>
        </span>
    </div>
    <div class="benzo-welcome-step-box">
        <div class="step-box-left">
            <div class="theme-screenshot">
                <img src="<?php echo esc_url( get_template_directory_uri() . "/screenshot.png" ); ?>">
            </div>
        </div>
        <div class="step-box-right">
            <h4 class="step-subtitle">
                <?php
                    echo sprintf(
                        wp_kses( __( 'Just complete the steps below and you will be able to use all functionalities of %s theme by <a href="%s" target="_blank">WebTend</a>', 'benzo' ), $allowed_html ),
                        BENZO_NAME,
                        esc_url( 'https://www.templatemonster.com/authors/webtend/' )
                    );
                ?>
            </h4>
            <ul>
                <li>
                    <span class="step-title">
                        <?php esc_html_e( 'Step 1', 'benzo' );?>
                    </span>
                    <?php
                        echo sprintf(
                            wp_kses( __( 'Check <a href="%s">requirements</a> to avoid errors with your WordPress.', 'benzo' ), $allowed_html ),
                            esc_url( admin_url( 'admin.php?page=benzo_requirements' ) )
                        );
                    ?>
                </li>
                <li>
                    <span class="step-title">
                        <?php esc_html_e( 'Step 2', 'benzo' );?>
                    </span>
                    <?php esc_html_e( 'Install Required and recommended plugins.', 'benzo' );?>
                </li>
                <li>
                    <span class="step-title">
                        <?php esc_html_e( 'Step 3', 'benzo' );?>
                    </span>
                    <?php esc_html_e( 'Import demo content', 'benzo' );?>
                </li>
            </ul>
        </div>
    </div>
</div>