<?php
	$values   = get_option($option);
	$selected = isset($values[$slug]) ? $values[$slug] : '';
?>
<?php if ( $choices ): ?>
	<select name="<?php echo $option; ?>[<?php echo $slug; ?>]">
		<?php foreach ($choices as $value => $label): ?>
			<?php
				$atts = $value == $selected ? 'selected ' : '';
			?>
			<option <?php echo $atts; ?>value="<?php echo $value; ?>"><?php echo $label; ?></option>
		<?php endforeach; ?>
	</select>
<?php endif; ?>