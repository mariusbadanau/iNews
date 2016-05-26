<?php

if (!function_exists('news_mix_lite_ajax_set_view_count')) {

    function news_mix_lite_ajax_set_view_count() {
        check_ajax_referer('news_mix_lite_set_view_count', 'wpnonce');
        if (!empty($_POST['post_id'])) {
            $post_id = (int) $_POST['post_id'];
            $data = news_mix_lite_set_view_count($post_id);
            echo json_encode($data);
        }
        die();
    }

    add_action('wp_ajax_news_mix_lite_ajax_set_view_count', 'news_mix_lite_ajax_set_view_count');
    add_action('wp_ajax_nopriv_news_mix_lite_ajax_set_view_count', 'news_mix_lite_ajax_set_view_count');
}