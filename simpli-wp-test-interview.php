<?php
/*
Plugin Name: simpli-wp-test-interview
Description: TEST
Author: Simplifia
Version: 1.0
*/

namespace SimpliCeremonyStreamingPlugin;
use \SimpliCeremonyStreamingPlugin\Models\Singleton;

include_once plugin_dir_path(__FILE__).'/Autoloader.php';
include_once plugin_dir_path(__FILE__).'/Models/Singleton.php';

class SimpliCeremonyStreamingPlugin extends Singleton
{

    public function __construct()
    {
        include_once plugin_dir_path( __FILE__ ).'/CeremonyStreaming.php';
        new CeremonyStreamingPlugin();
        register_block_type(plugin_dir_path( __FILE__ ) . '/build/demo');
        register_block_type(plugin_dir_path( __FILE__ ) . '/build/clemblock');

    }

}
Autoloader::register();
\SimpliCeremonyStreamingPlugin\SimpliCeremonyStreamingPlugin::GetInstance();


function ClementNewPage() {
    $my_post = array(
      'post_title'    => wp_strip_all_tags( "Clement's new page" ),
      'post_content'  => 'For Simplifia technical test',
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type'     => 'page',
    );
    wp_insert_post( $my_post );
}

register_activation_hook(__FILE__, __NAMESPACE__. '\\ClementNewPage');

add_filter('the_content', __NAMESPACE__ . '\\ClementNewPageReplaceContent');

function ClementNewPageReplaceContent($content) {
    if ( is_page('clements-new-page') ) {
        ob_start();
        include plugin_dir_path(__FILE__) . 'Views/ClementsNewPage.php';
        return ob_get_clean();
    }

    return $content;
}

