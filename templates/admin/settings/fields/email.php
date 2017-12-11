<?php
	$values = get_option($option);
	$value  = isset($values[$slug]) ? $values[$slug] : '';
?>
<input type="email" name="<?php echo $option; ?>[<?php echo $slug; ?>]" value="<?php echo $value; ?>">