<div class="wrap">
	<h1>PLUGIN_LABEL</h1>

	<form method="post" action="options.php">
		<?php settings_fields('PLUGIN_SLUG'); ?>

		<?php do_settings_sections('PLUGIN_SLUG'); ?>

		<?php submit_button(); ?>
	</form>
</div>