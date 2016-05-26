<?php

add_action('after_setup_theme', 'news_mix_lite_init');

function news_mix_lite_init(){
	add_filter('kopa_customization_init_options', 'news_mix_lite_init_options');
}

function news_mix_lite_init_options($options){

	$all_cats = get_categories();
	$categories = array('' => esc_html__('Latest Posts', 'news-mix-lite'));
	foreach ( $all_cats as $cat ) {
		$categories[ $cat->slug ] = $cat->name;
	}

	#Panels
	$options['panels'][] = array(
		'id'    => 'news_mix_lite_panel_general_setting',
		'title' => esc_html__('General Setting', 'news-mix-lite'));

	#Sections
	$options['sections'][] = array(
    'id'    => 'news_mix_lite_section_logo_setting',
    'panel' => 'news_mix_lite_panel_general_setting',
    'title' => esc_html__('Logo Margin', 'news-mix-lite'));

	$options['sections'][] = array(
    'id'    => 'news_mix_lite_section_general_setting',
    'panel' => 'news_mix_lite_panel_general_setting',
    'title' => esc_html__('General Setting', 'news-mix-lite'));

    $options['sections'][] = array(
    'id'    => 'news_mix_lite_section_blog_slider',
    'title' => esc_html__('Blog Slider', 'news-mix-lite'));

    $options['sections'][] = array(
    'id'    => 'news_mix_lite_section_single_post',
    'title' => esc_html__('Single Post', 'news-mix-lite'));

    $options['sections'][] = array(
    'id'    => 'news_mix_lite_section_social_links',
    'title' => esc_html__('Social Links', 'news-mix-lite'));

    #LOGO Margin
	#1. Top Margin
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_logo_margin_top',
		'label'       => esc_html__('Top margin:', 'news-mix-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_logo_setting',
		'transport'   => 'refresh');
	#2. Top Margin
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_logo_margin_left',
		'label'       => esc_html__('Left margin:', 'news-mix-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_logo_setting',
		'transport'   => 'refresh');
	#3. Right Margin
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_logo_margin_right',
		'label'       => esc_html__('Right margin:', 'news-mix-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_logo_setting',
		'transport'   => 'refresh');
	#4. Bottom Margin
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_logo_margin_bottom',
		'label'       => esc_html__('Bottom margin:', 'news-mix-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_logo_setting',
		'transport'   => 'refresh');

	#GENERAL SETTING
	#1. Headline status
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_display_headline_status',
		'label'       => esc_html__('Header Headline - Status', 'news-mix-lite'),
		'default'     => 'show',
		'description' => esc_html__('Show/Hide headline', 'news-mix-lite'),
		'type'        => 'radio',
		'choices'     => array(
			'show' => esc_html__('Show', 'news-mix-lite'),
			'hide' => esc_html__('Hide', 'news-mix-lite')
		),
		'section'     => 'news_mix_lite_section_general_setting',
		'transport'   => 'refresh');
	#2. Headlite title
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_headline_title',
		'label'       => esc_html__('Header Headline - Title', 'news-mix-lite'),
		'default'     => esc_html__('Breaking News', 'news-mix-lite'),
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_general_setting',
		'transport'   => 'refresh');
	#3. Headlite categories
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_headline_category_id',
		'label'       => esc_html__('Header Headline - Category', 'news-mix-lite'),
		'default'     => '',
		'description' => esc_html__('Choose category to display posts in headline', 'news-mix-lite'),
		'type'        => 'select',
		'choices'     => $categories,
		'section'     => 'news_mix_lite_section_general_setting',
		'transport'   => 'refresh');
	#4. Top banner
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_top_banner_code',
		'label'       => esc_html__('Top Banner', 'news-mix-lite'),
		'default'     => '',
		'description' => esc_html__('Paste your Adsense, BSA or other ad code here to show ads on top banner.', 'news-mix-lite'),
		'type'        => 'textarea',
		'section'     => 'news_mix_lite_section_general_setting',
		'transport'   => 'refresh');
	#5. Footer Logo
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_logo_url',
		'label'       => esc_html__('Footer logo', 'news-mix-lite'),
		'default'     => '',
		'description' => esc_html__('Upload your own logo.', 'news-mix-lite'),
		'type'        => 'upload',
		'section'     => 'news_mix_lite_section_general_setting',
		'transport'   => 'refresh');
	#6. Footer left
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_copyright',
		'label'       => esc_html__('Custom left footer', 'news-mix-lite'),
		'default'     => '',
		'description' => esc_html__('Enter the content you want to display in your left footer (e.g. copyright text).', 'news-mix-lite'),
		'type'        => 'textarea',
		'section'     => 'news_mix_lite_section_general_setting',
		'transport'   => 'refresh');
	#7. Footer right
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_right_footer',
		'label'       => esc_html__('Custom right footer', 'news-mix-lite'),
		'default'     => '',
		'description' => esc_html__('Enter the content you want to display in your right footer (e.g. newsletter subscription form code).', 'news-mix-lite'),
		'type'        => 'textarea',
		'section'     => 'news_mix_lite_section_general_setting',
		'transport'   => 'refresh');
	#7. Show /Hide Search form
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_footer_search_form',
		'label'       => esc_html__('Show / Hide search form', 'news-mix-lite'),
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__('Show', 'news-mix-lite'),
			'hide' => esc_html__('Hide', 'news-mix-lite')
		),
		'type'        => 'radio',
		'section'     => 'news_mix_lite_section_general_setting',
		'transport'   => 'refresh');

	#SINGLE POST
	#1. Post Thumbnail Style
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_post_thumbnail_style',
		'label'       => esc_html__('Post Thumbnail Style', 'news-mix-lite'),
		'description' => '',
		'default'     => 'large',
		'choices'     => array(
			'small' => esc_html__('Small Thumbnail', 'news-mix-lite'),
			'large' => esc_html__('Large Thumbnail', 'news-mix-lite')
		),
		'type'        => 'radio',
		'section'     => 'news_mix_lite_section_single_post',
		'transport'   => 'refresh');
	#2. About author
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_post_about_author',
		'label'       => esc_html__('About Author', 'news-mix-lite'),
		'description' => '',
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__('Show', 'news-mix-lite'),
			'hide' => esc_html__('Hide', 'news-mix-lite')
		),
		'type'        => 'radio',
		'section'     => 'news_mix_lite_section_single_post',
		'transport'   => 'refresh');
	#3. Metadata - Categories
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_post_categories',
		'label'       => esc_html__('Categories', 'news-mix-lite'),
		'description' => '',
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__('Show', 'news-mix-lite'),
			'hide' => esc_html__('Hide', 'news-mix-lite')
		),
		'type'        => 'radio',
		'section'     => 'news_mix_lite_section_single_post',
		'transport'   => 'refresh');
	#4. Metadata - Post date
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_post_date',
		'label'       => esc_html__('Post date', 'news-mix-lite'),
		'description' => '',
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__('Show', 'news-mix-lite'),
			'hide' => esc_html__('Hide', 'news-mix-lite')
		),
		'type'        => 'radio',
		'section'     => 'news_mix_lite_section_single_post',
		'transport'   => 'refresh');
	#5. Metadata - Post author
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_post_author',
		'label'       => esc_html__('Post author', 'news-mix-lite'),
		'description' => '',
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__('Show', 'news-mix-lite'),
			'hide' => esc_html__('Hide', 'news-mix-lite')
		),
		'type'        => 'radio',
		'section'     => 'news_mix_lite_section_single_post',
		'transport'   => 'refresh');
	#6. Metadata - Comment number
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_post_comment',
		'label'       => esc_html__('Comments number', 'news-mix-lite'),
		'description' => '',
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__('Show', 'news-mix-lite'),
			'hide' => esc_html__('Hide', 'news-mix-lite')
		),
		'type'        => 'radio',
		'section'     => 'news_mix_lite_section_single_post',
		'transport'   => 'refresh');
	#7. Metadata - Visit number
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_post_visit',
		'label'       => esc_html__('Visited number', 'news-mix-lite'),
		'description' => '',
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__('Show', 'news-mix-lite'),
			'hide' => esc_html__('Hide', 'news-mix-lite')
		),
		'type'        => 'radio',
		'section'     => 'news_mix_lite_section_single_post',
		'transport'   => 'refresh');
	#8. Get by
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_post_related_get_by',
		'label'       => esc_html__('Related Posts', 'news-mix-lite'),
		'default'     => 'category',
		'description' => esc_html__('GET BY', 'news-mix-lite'),
		'type'        => 'select',
		'choices'     => array(
			'hide'     => esc_html__('-- Hide --', 'news-mix-lite'),
			'post_tag' => esc_html__('Tags', 'news-mix-lite'),
			'category' => esc_html__('Category', 'news-mix-lite')
		),
		'section'     => 'news_mix_lite_section_single_post',
		'transport'   => 'refresh');
	#6. Related Posts - Limit
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_post_related_limit',
		'label'       => esc_html__('Related Posts', 'news-mix-lite'),
		'default'     => 5,
		'description' => esc_html__('LIMIT', 'news-mix-lite'),
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_single_post',
		'transport'   => 'refresh');

	#SOCIAL LINKS
	#1. RSS URL
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_social_links_rss_url',
		'label'       => esc_html__('RSS URL', 'news-mix-lite'),
		'default'     => '',
		'description' => __('Display the RSS feed button with the default RSS feed or enter a custom feed below.<code>Enter "HIDE" if you want to hide it</code>', 'news-mix-lite'),
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_social_links',
		'transport'   => 'refresh');
	#2. FACEBOOK URL
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_social_links_facebook_url',
		'label'       => esc_html__('FACEBOOK URL', 'news-mix-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_social_links',
		'transport'   => 'refresh');
	#3. TWITTER URL
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_social_links_twitter_url',
		'label'       => esc_html__('TWITTER URL', 'news-mix-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_social_links',
		'transport'   => 'refresh');
	#4. DRIBBBLE URL
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_social_links_dribbble_url',
		'label'       => esc_html__('DRIBBBLE URL', 'news-mix-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_social_links',
		'transport'   => 'refresh');
	#5. YOUTUBE URL
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_social_links_youtube_url',
		'label'       => esc_html__('YOUTUBE URL', 'news-mix-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_social_links',
		'transport'   => 'refresh');
	#6. FLICKR URL
	$options['settings'][] = array(
		'settings'    => 'news_mix_lite_options_social_links_flickr_url',
		'label'       => esc_html__('FLICKR URL', 'news-mix-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'news_mix_lite_section_social_links',
		'transport'   => 'refresh');

	return apply_filters( 'news_mix_lite_init_options', $options );
}