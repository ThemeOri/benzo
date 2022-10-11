<?php

/**
 * compact setup for default theme
 *
 * @package generic-elements
 */

namespace Generic\Elements;

/**
 * This is Astra theme compatibility.
 */
class Theme_Generic_El_Template
{
	/**
	 *  This is Initiator
	 */
	public function __construct()
	{
		add_action('wp', [$this, 'hooks']);
	}

	/**
	 * Run all the Actions / Filters.
	 */

	public function hooks()
	{

		$templates = get_generic_el_templates();

		if (!empty($templates->posts)) {
			/**
			 * Hide hader.php template file.
			 */
			add_action('get_header', [$this, 'override_header']);

			/**
			 * Hide footer.php template file.
			 */
			add_action('get_footer', [$this, 'override_footer']);

			/**
			 * Display generic-el footer in the replaced header.
			 */
			add_action('generic_el_footer', [$this, 'generic_el_footer_render']);

			/**
			 * Display generic-el header in the replaced header.
			 */
			add_action('generic_el_header', [$this, 'generic_el_header_render']);

			/**
			 * Display generic-el breadcrumb in the replaced breadcrumb.
			 */
			if (is_show_breadcumb()) {
				add_action('generic_el_breadcrumb', [$this, 'generic_el_breadcrumb_render']);
			}
		}
	}

	/**
	 * Overriding the header function in the elementor way.
	 *
	 * @since 1.0.3
	 *
	 * @return void
	 */

	public function override_header()
	{
		require GENERIC_ELEMENTS_PATH . '/themes/templates/generic-el-header.php';
		$templates   = [];
		$templates[] = 'header.php';
		//Running wp_head hooks avoid again.
		remove_all_actions('wp_head');
		ob_start();
		locate_template($templates, true);
		ob_get_clean();
	}

	/**
	 * Overriding the footer function in the elementor way.
	 *
	 * @since 1.0.3
	 *
	 * @return void
	 */
	public function override_footer()
	{
		require GENERIC_ELEMENTS_PATH . '/themes/templates/generic-el-footer.php';
		$templates   = [];
		$templates[] = 'footer.php';
		//Running wp_footer hooks avoid again.
		remove_all_actions('wp_footer');
		ob_start();
		locate_template($templates, true);
		ob_get_clean();
	}


	/**
	 * Generic elements header render function
	 */
	public function generic_el_header_render()
	{

?>
		<header id="header-wrap">
			<?php \Generic\Elements\TemplateGenerator::get_header_template(); ?>
		</header>

	<?php

	}


	/**
	 * Generic elements breadcrumb render function
	 */
	public function generic_el_breadcrumb_render()
	{

	?>
		<div id="page-title-area">
			<?php \Generic\Elements\TemplateGenerator::get_breadcrumb_template(); ?>
		</div>

	<?php

	}


	/**
	 * Generic elements footer render function
	 */

	public function generic_el_footer_render()
	{

	?>
		<footer id="footer-wrap">
			<?php \Generic\Elements\TemplateGenerator::get_footer_template(); ?>
		</footer>
<?php

	}
}

new Theme_Generic_El_Template();
