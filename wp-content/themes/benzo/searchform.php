<?php
/**
 * Template for displaying search forms
 *
 * @package Benzo
 */
?>
<div class="benzo-search-form">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="search" class="search-field"
		       placeholder="<?php echo esc_attr_x( 'Enter your keyword', 'placeholder', 'benzo' ); ?>"
		       value="<?php echo get_search_query() ?>" name="s"
		       title="<?php echo esc_attr_x( 'Enter your keyword', 'label', 'benzo' ); ?>"/>
		<button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
	</form>
</div>