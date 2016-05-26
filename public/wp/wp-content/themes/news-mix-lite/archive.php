<?php

$header_affix = apply_filters('news_mix_lite_get_header', '');
$footer_affix = apply_filters('news_mix_lite_get_footer', '');

$is_override_default_template = apply_filters('news_mix_lite_is_override_default_template', false);

get_header($header_affix);

do_action('news_mix_lite_load_template');

if(!$is_override_default_template){
	if($news_mix_lite_current_layout = news_mix_lite_get_template_setting()){
		get_template_part("templates/archive/{$news_mix_lite_current_layout['layout_id']}");
	}else{
		get_template_part("templates/archive/default");
	}
}

get_footer($footer_affix);