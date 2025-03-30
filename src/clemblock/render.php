<?php
	$text = $attributes['text'] ?? 'Hello World';
	$backgroundColor = $attributes['backgroundColor'] ?? 'ffffff';
	$borderStyle = $attributes['borderStyle'] ?? '1px solid black';

	$style = "background-color: {$backgroundColor}; border: {$borderStyle}; padding: 1rem;";

?>

<p <?php echo get_block_wrapper_attributes(['style' => $style]); ?>>
	<?php echo wp_kses_post($text); ?>
</p>