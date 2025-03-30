<?php
	$text = $attributes['text'] ?? 'Hello World';
	$backgroundColor = $attributes['backgroundColor'] ?? 'ffffff';
	$borderStyle = $borderStyle['backgroundColor'] ?? '1px solid black';


?>
<p <?php echo get_block_wrapper_attributes(); ?>>
    <?php echo wp_kses_post($text); ?>
</p>

<style>
		
</style>