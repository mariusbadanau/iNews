<?php

class News_Mix_Toolkit_Widget_Flexslider extends Kopa_Widget {

	public function __construct() {

		$all_cats = get_categories();
		$categories = array('' => esc_html__('-- None --', 'news-mix-toolkit'));
		foreach ( $all_cats as $cat ) {
			$categories[ $cat->slug ] = $cat->name;
		}

		$all_tags = get_tags();
		$tags = array('' => esc_html__('-- None --', 'news-mix-toolkit'));
		foreach( $all_tags as $tag ) {
			$tags[ $tag->slug ] = $tag->name;
		}

		$this->widget_cssclass    = 'home-slider-widget';
		$this->widget_description = esc_html__( 'A Posts Slider Widget.', 'news-mix-toolkit' );
		$this->widget_id          = 'kopa_widget_flexslider';
		$this->widget_name        = esc_html__( '[News Mix] - Flexslider', 'news-mix-toolkit' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title:', 'news-mix-toolkit' ),
			),
			'categories' => array(
				'type'    => 'multiselect',
				'std'     => '',
				'label'   => esc_html__( 'Categories:', 'news-mix-toolkit' ),
				'options' => $categories,
				'size'    => '5',
			),
			'relation'    => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Relation:', 'news-mix-toolkit' ),
				'std'     => 'OR',
				'options' => array(
					'AND' => esc_html__( 'AND', 'news-mix-toolkit' ),
					'OR'  => esc_html__( 'OR', 'news-mix-toolkit' ),
				),
			),
			'tags' => array(
				'type'    => 'multiselect',
				'std'     => '',
				'label'   => esc_html__( 'Tags:', 'news-mix-toolkit' ),
				'options' => $tags,
				'size'    => '5',
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'date',
				'label' => esc_html__( 'Orderby:', 'news-mix-toolkit' ),
				'options' => array(
					'date'         => esc_html__( 'Date', 'news-mix-toolkit' ),
					'random'       => esc_html__( 'Random', 'news-mix-toolkit' ),
					'most_comment' => esc_html__( 'Number of comments', 'news-mix-toolkit' ),
				),
			),
			'number_of_article' => array(
				'type'    => 'number',
				'std'     => '10',
				'label'   => esc_html__( 'Number of posts:', 'news-mix-toolkit' ),
				'min'     => '1',
			),
            'animation' => array(
                'type'  => 'select',
                'std'   => 'slide',
                'label' => esc_html__( 'Animation:', 'news-mix-toolkit' ),
                'options' => array(
                    'slide' => esc_html__( 'Slide', 'news-mix-toolkit' ),
                    'fade'  => esc_html__( 'Fade', 'news-mix-toolkit' )
                ),
            ),
            'direction' => array(
                'type'  => 'select',
                'std'   => 'horizontal',
                'label' => esc_html__( 'Direction:', 'news-mix-toolkit' ),
                'options' => array(
                    'horizontal'         => esc_html__( 'Horizontal', 'news-mix-toolkit' )
                ),
            ),
            'slideshow_speed' => array(
                'type'  => 'number',
                'std'   => '7000',
                'label' => esc_html__( 'Slideshow Speed:', 'news-mix-toolkit' )
            ),
            'animation_speed' => array(
                'type'  => 'number',
                'std'   => '600',
                'label' => esc_html__( 'Animation Speed:', 'news-mix-toolkit' )
            ),
            'is_auto_play' => array(
                'type'  => 'select',
                'std'   => 'true',
                'label' => esc_html__( 'Auto Play', 'news-mix-toolkit' ),
                'options' => array(
                    'true'  => esc_html__( 'True', 'news-mix-toolkit' ),
                    'false' => esc_html__( 'False', 'news-mix-toolkit' ),
                )
            ),
            'style' => array(
                'type'  => 'select',
                'std'   => 'true',
                'label' => esc_html__( 'Style', 'news-mix-toolkit' ),
                'options' => array(
                    'style_1'  => esc_html__( 'Style 1', 'news-mix-toolkit' ),
                    'style_2' => esc_html__( 'Style 2', 'news-mix-toolkit' ),
                )
            ),
		);
		parent::__construct();
	}

	public function widget( $args, $instance ) {

		extract( $args );

		extract( $instance );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$posts = news_mix_toolkit_widget_posttype_build_query($instance);

		echo wp_kses_post( $before_widget );

		if ( ! empty ( $title ) )
            echo sprintf( '%s', $before_title . '<span data-icon="&#xf040;"></span>' . $title . $after_title );

        if ( $posts->have_posts() ) : ?>
        	<?php 
	        	if( isset( $style ) ){
	        		$style = $style;
	        	}else{
	        		$style = 'style_1';
	        	}
        		if ( $style == 'style_2' ){
                	$class = 'kopa-blog-slider'; 
                }else{
                    $class = 'home-slider';
                }
        	?>
            <div class="<?php echo $class; ?> flexslider" data-animation="<?php echo isset($instance['animation']) ? $instance['animation'] : 'slide' ; ?>" data-direction="<?php echo isset($instance['direction']) ? $instance['direction'] : 'horizontal' ; ?>" data-slideshow_speed="<?php echo ($instance['slideshow_speed']>0)? $instance['slideshow_speed']:1000; ?>" data-animation_speed="<?php echo ($instance['animation_speed']>0)? $instance['animation_speed']:1000; ?>" data-autoplay="<?php echo isset($instance['is_auto_play']) ? $instance['is_auto_play'] : 'true'; ?>">
                <ul class="slides">
                    <?php while ( $posts->have_posts() ) : $posts->the_post();
                        $thumbnail_id = get_post_thumbnail_id();
                        if ( $style == 'style_2' ){
                        	$thumbnail    = wp_get_attachment_image( $thumbnail_id, 'kopa-image-size-6' ); 
                        }else{
	                        $thumbnail    = wp_get_attachment_image( $thumbnail_id, 'kopa-image-size-0' ); // 446 x 411
	                    }
                        if( has_post_thumbnail() ) :
                    ?>
                	<?php if ( $style == 'style_2' ) :  ?>
                		<li>
				            <article class="entry-item">
				                <a href="<?php the_permalink(); ?>"><img src="<?php echo news_mix_lite_get_image_src(get_the_ID(),'kopa-image-size-6'); ?>" alt="<?php echo get_the_title(); ?>"></a>
				                <h3 class="flex-caption"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
				            </article>
				        </li>
                	<?php else: ?>
	                    <li>
	                        <article class="entry-item">
	                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
	                            <?php if ( has_post_thumbnail() ) { 
	                                echo '<a href="'.get_permalink().'">'.$thumbnail.'</a>';
	                            } ?>
	                        </article>
	                    </li>
	                <?php endif; ?>
                    <?php endif; endwhile; ?>
                </ul><!--slides-->
            </div><!--home-slider-->

        <?php
        endif;

        wp_reset_postdata();

		echo wp_kses_post( $after_widget );

	}

}
register_widget( 'News_Mix_Toolkit_Widget_Flexslider' );