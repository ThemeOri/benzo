<?php

/**
 * Provide a admin area view for the generic elements plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https:/bdevs.net/
 * @since      1.0.3
 *
 * @package    generic_el
 * @subpackage generic_el/admin/templates
 */

$totaltabs = count(self::$_meta_fields);

?>

<div class="ui tabular menu">
    <?php

    foreach (self::$_meta_fields as $id => $tab) :
        $active = ($id == 'location') ? ' active' : '';
        $class = isset($tab['icon']) ? ' generic-el-has-icon' : '';
        $class .= $active;
    ?>
        <div class="item <?php echo $class; ?>" data-tab="<?php echo $id; ?>">
            <?php if (isset($tab['icon'])) : ?>
                <span class="tab-icon">
                    <img src="<?php echo GENERIC_ELEMENTS_ADMIN_ASSETS . '/img/icons/' . $tab['icon']; ?>" alt="<?php echo $tab['title']; ?>">
                </span>
            <?php endif; ?>
            <span class="tab-title"><?php echo $tab['title']; ?></span>
        </div>
    <?php endforeach; ?>
</div>

<?php
$tabid = 1;
foreach (self::$_meta_fields as $id => $tab) :
    $active = ($id == 'location') ? ' active ' : '';
?>
    <div class="ui tab <?php echo $active; ?>" data-tab="<?php echo $id ?>">
        <?php
        // if the file exists, require it
        $file = str_replace('_', '-', strtolower($id));
        $filepath = GENERIC_ELEMENTS_TEMPLATES . '/metadata-' . $file . '.php';
        if (file_exists($filepath)) {
            require_once $filepath;
        }
        ?>
    </div>
<?php endforeach; ?>