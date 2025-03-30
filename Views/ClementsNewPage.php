<?php

/*Pistes d'améliorations : 
    - Utilisation de messages type "toast"
    - Vérifications plus profondes du contenu saisi par l'utilisateur
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cpf_nonce']) && wp_verify_nonce($_POST['cpf_nonce'], 'cpf_submit_form')) {
    $title   = sanitize_text_field($_POST['cpf_title']);
    $content = wp_kses_post($_POST['cpf_content']);
    $meta    = sanitize_text_field($_POST['cpf_meta']);

    if(strlen($title)  !== 0|| strlen($content)  !== 0 || strlen($meta)  !== 0){
        $post_id = wp_insert_post([
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'publish',
            'post_type'    => 'post',
        ]);
    }

    if ($post_id && !is_wp_error($post_id)) {
        add_post_meta($post_id, 'mymeta', $meta);
        echo '<div class="notice notice-success">Article publié avec succès !</div>';
    } else {
        echo '<div class="notice notice-error">Erreur lors de la publication, verifiez les informations saisies.</div>';
    }
}
?>


<h2 style="text-align: center;">Mon formulaire pour créer un post et ses metadata</h2>

<form method="post" style="max-width: 500px; margin: 0 auto;">
    <?php wp_nonce_field('cpf_submit_form', 'cpf_nonce'); ?>

    <div class="formDiv">
        <label for="cpf_title">Post name</label>
        <input type="text" id="cpf_title" name="cpf_title" required class="formInput"> 
        
        <label for="cpf_content">Post content</label>
        <input type="text" id="cpf_content" name="cpf_content" required class="formInput">
        
        <label for="cpf_meta">Metadata : mymeta</label>
        <input type="text" id="cpf_meta" name="cpf_meta" required class="formInput">
    </div>

    <div style="text-align: right;">
        <button type="submit" class="formSubmit">
            Submit
        </button>
    </div>
</form>

<style>

.formDiv{
    display: grid; 
    grid-template-columns: 1fr 2fr; 
    gap: 10px; 
    align-items: center; 
    margin-bottom: 10px;
}
.formInput{
    width: 100%; 
    padding: 6px; 
    border: 1px solid #666; 
    border-radius: 6px;
}
.formSubmit{
    padding: 6px 16px; 
    border: 2px solid #666; 
    border-radius: 8px; 
    background: transparent; 
    cursor: pointer;
}
.wp-block-post-title{
    display : none;
}

</style>