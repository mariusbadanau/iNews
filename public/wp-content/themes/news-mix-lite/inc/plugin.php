<?php
add_action('tgmpa_register', 'news_mix_lite_register_required_plugins');

function news_mix_lite_register_required_plugins() {
    $plugins = array(
        array(
            'name'               => 'Kopa Framework',
            'slug'               => 'kopatheme',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => ''
        ),
        array(
            'name'               => 'News Mix Toolkit',
            'slug'               => 'news-mix-toolkit',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        )
    );

    $config = array(
        'has_notices'  => true,
        'is_automatic' => false
    );

    tgmpa($plugins, $config);
}
