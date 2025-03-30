<?php
	$text = $attributes['text'] ?? 'Hello World';
?>
<p <?php echo get_block_wrapper_attributes(); ?>>
    <?php echo wp_kses_post($text); ?>
</p>