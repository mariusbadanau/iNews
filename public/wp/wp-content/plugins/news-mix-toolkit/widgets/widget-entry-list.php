<?php

class News_Mix_Toolkit_Widget_Entry_List extends Kopa_Widget {

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

		$this->widget_cssclass    = 'kopa-entry-list-widget clearfix';
		$this->widget_description = esc_html__( 'A Featured Articles Widget.', 'news-mix-toolkit' );
		$this->widget_id          = 'kopa_widget_entry_list';
		$this->widget_name        = esc_html__( '[News Mix] - Entry List', 'news-mix-toolkit' );
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
                    'popular'      => esc_html__('Popular by View Count', 'news-mix-toolkit' ),
					'date'         => esc_html__( 'Date', 'news-mix-toolkit' ),
					'random'       => esc_html__( 'Random', 'news-mix-toolkit' ),
					'most_comment' => esc_html__( 'Number of comments', 'news-mix-toolkit' ),
				),
			),
			'posts_per_page' => array(
				'type'    => 'number',
				'std'     => '5',
				'label'   => esc_html__( 'Number of posts:', 'news-mix-toolkit' ),
				'min'     => '1',
			),
            'excerpt_length' => array(
                'type'  => 'number',
                'std'   => 20,
                'label' => __( 'Excerpt length:', 'news-mix-toolkit' ),
                'desc' => __( 'Enter <b>0</b> to hide the excerpt.', 'news-mix-toolkit' ),
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
            echo sprintf( '%s', $before_title . $title . $after_title );

       	if ( $posts->have_posts() ) : 
            $post_index = 1;
            while ( $posts->have_posts() ) : $posts->the_post();
                    if ( $post_index == 1 ) : // show the thumbnail of the first post
                ?>
                    <article class="entry-item">
                        <div class="entry-thumb">
                            <?php if ( get_post_format() == 'gallery' ) : ?>

                                <div class="entry-thumb-slider flexslider">
                                    <ul class="slides">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <li><img src="<?php echo news_mix_lite_get_image_src(get_the_ID(),'kopa-image-size-4'); ?>" alt="<?php echo get_the_title(); ?>"></li>
                                        <?php endif;

                                        $gallery = news_mix_lite_content_get_gallery( get_the_content() );
                                        
                                        if (isset( $gallery[0] )) 
                                            $gallery = $gallery[0];
                                        else 
                                            $gallery = '';

                                        if ( isset($gallery['shortcode']) ) 
                                            $shortcode = $gallery['shortcode'];
                                        else 
                                            $shortcode = '';

                                        // get gallery string ids
                                        preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
                                        if ( isset( $gallery_string_ids[0][0] ) )
                                            $gallery_string_ids = $gallery_string_ids[0][0];
                                        else 
                                            $gallery_string_ids = '';

                                        // get array of image id
                                        preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
                                        if ( isset( $gallery_ids[0] ) )
                                            $gallery_ids = $gallery_ids[0];
                                        else 
                                            $gallery_ids = '';

                                        if ( ! empty( $gallery_ids ) ) :
                                            foreach ( $gallery_ids as $gallery_id ) :
                                                if ( wp_attachment_is_image( $gallery_id ) )
                                                    echo '<li>' . wp_get_attachment_image( $gallery_id, 'kopa-image-size-4' ) . '</li>';
                                            endforeach;
                                        endif;
                                        
                                        ?>
                                    </ul><!--slides-->
                                </div><!--entry-thumb-slider-->

                            <?php elseif ( get_post_format() == 'video' ) : 
                                    $video = news_mix_lite_content_get_video( get_the_content() );
                                    if ( isset( $video[0] ) ) :
                                        $video = $video[0];

                                        if ( isset( $video['url'] ) && ! empty( $video['url'] ) ) :
                            ?>
                                            <a class="play-icon" href="<?php echo esc_url( $video['url'] ); ?>" rel="prettyPhoto[<?php echo esc_attr( $this->get_field_id( 'video' ) ); ?>]"></a>
                            <?php 
                                        endif; // endif isset( $video['url']
                                    endif; // endif isset( $video[0] )
                            ?>
                                    <a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) { ?>
                                        <img src="<?php echo news_mix_lite_get_image_src(get_the_ID(),'kopa-image-size-4'); // 53x53 ?>" alt="<?php echo get_the_title(); ?>">
                                    <?php } elseif ( isset( $video['url'] ) && isset( $video['type'] ) ) {
                                        echo '<img src="'.news_mix_lite_get_video_thumbnails_url( $video['type'], $video['url'] ).'">';
                                    } ?></a>
                            <?php 
                            else : ?>
                                <?php if ( has_post_thumbnail() ) : ?> 
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo news_mix_lite_get_image_src(get_the_ID(),'kopa-image-size-4'); // 53x53 ?>" alt="<?php echo get_the_title(); ?>">
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="entry-content">
                            <header>
                                <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                <span class="entry-date"><span class="kopa-minus"></span><?php the_time( get_option( 'date_format' ) ); ?></span>
                            </header>
                            <?php
                                $excerpt_tmp = get_the_excerpt();
                                if((int)$excerpt_length){ 
                                    $excerpt = wp_trim_words(strip_shortcodes($excerpt_tmp), $excerpt_length, '');
                                    echo ($excerpt) ? apply_filters( 'the_content', $excerpt ) : '';
                                }
                            ?>
                        </div>
                    </article><!--entry-item-->

                <?php 
                        echo ( $posts->post_count > 1 ) ? '<ul class="older-post">' : ''; 

                    else : // $post_index != 1 ( the rest posts )
                ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                        <?php
                            $excerpt_tmp = get_the_excerpt();
                            if((int)$excerpt_length){ 
                                $excerpt = wp_trim_words(strip_shortcodes($excerpt_tmp), $excerpt_length, '');
                                echo ($excerpt) ? apply_filters( 'the_content', $excerpt ) : '';
                            }
                        ?>
                    </li>
                <?php 
                    endif; // endif $post_index == 1

                    $post_index++; // increase post index by 1

            endwhile; // endwhile $posts->have_posts()
            
            echo ( $posts->post_count > 1 ) ? '</ul><!-- .older-post -->' : '';  

        else : // if ! $posts->have_posts()

            esc_html_e( 'No Posts Found', 'news-mix-toolkit' );

        endif;

        wp_reset_postdata();

		echo wp_kses_post( $after_widget );

	}

}
register_widget( 'News_Mix_Toolkit_Widget_Entry_List' );