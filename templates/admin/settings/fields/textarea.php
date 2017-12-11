<?php
	$values = get_option($option);
	$value  = isset($values[$slug]) ? $values[$slug] : '';
?>
<textarea name="<?php echo $option; ?>[<?php echo $slug; ?>]"><?php echo $value; ?></textarea>