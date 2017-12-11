<?php
	$values   = get_option($option);
	$selected = isset($values[$slug]) ? $values[$slug] : '';
?>
<?php if ( $choices ): ?>
	<?php foreach ($choices as $value => $label): ?>
		<?php
			$atts = $value == $selected ? 'checked ' : '';
		?>
		<input <?php echo $atts; ?>type="radio" name="<?php echo $option; ?>[<?php echo $slug; ?>]" value="<?php echo $value; ?>"><?php echo $label; ?><br>
	<?php endforeach; ?>
<?php endif; ?>