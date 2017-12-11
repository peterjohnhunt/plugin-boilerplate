<?php
	$section = 'PLUGIN_SLUG';
	$values  = get_option($section);
	$field   = 'field';
	$value   = isset($values[$field]) ? $values[$field] : '';
?>
<input type="text" name="<?php echo $section; ?>[<?php echo $field; ?>]" value="<?php echo $value; ?>">