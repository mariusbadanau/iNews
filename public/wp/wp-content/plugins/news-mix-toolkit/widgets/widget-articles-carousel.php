<?php

class News_Mix_Toolkit_Widget_Articles_Carousel extends Kopa_Widget {

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

		$this->widget_cssclass    = 'kopa-carousel-widget';
		$this->widget_description = esc_html__( 'An Articles Carousel Widget.', 'news-mix-toolkit' );
		$this->widget_id          = 'kopa_widget_articles_carousel';
		$this->widget_name        = esc_html__( '[News Mix] - Articles Carousel.', 'news-mix-toolkit' );
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
				'std'     => '8',
				'label'   => esc_html__( 'Number of posts:', 'news-mix-toolkit' ),
				'min'     => '1',
			),
			'scroll_items'  => array(
                'type'  => 'number',
                'std'   => '1',
                'label' => esc_html__( 'Scroll Items:', 'news-mix-toolkit' ),
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

       	if ( $posts->have_posts() ) : ?>
            <div class="list-carousel responsive" >
                <ul class="kopa-featured-news-carousel" data-prev-id="#<?php echo esc_attr( $this->get_field_id('prev-1') ); ?>" data-next-id="#<?php echo esc_attr( $this->get_field_id('next-1') ); ?>" data-pagination-id="#<?php echo esc_attr( $this->get_field_id('pager2')); ?>" data-scroll-items="<?php echo esc_attr( $instance['scroll_items'] ); ?>">

                    <?php while ( $posts->have_posts() ) : $posts->the_post(); 
						$thumbnail_id = get_post_thumbnail_id();
						$thumbnail    = wp_get_attachment_image( $thumbnail_id, 'kopa-image-size-2' ); // 234 x 169
                    ?>
                    <li>
                        <article class="entry-item clearfix">
                            <div class="entry-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if ( get_post_format() == 'video' ) : 
                                        $video = news_mix_lite_content_get_video( get_the_content() );

                                        if ( isset( $video[0] ) ) {
                                            $video = $video[0];
                                        } else {
                                            $video = '';
                                        }

                                        if ( has_post_thumbnail() ) {
                                            echo sprintf( '%s', $thumbnail );
                                        } elseif ( isset( $video['type'] ) && isset( $video['url'] ) ) {
                                            echo '<img src="'.news_mix_lite_get_video_thumbnails_url( $video['type'], $video['url'] ).'">';
                                        }
                                    ?>

                                    <?php elseif ( get_post_format() == 'gallery' ) : 

                                        if ( has_post_thumbnail() ) {
                                            echo sprintf( '%s', $thumbnail );
                                        } else {
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

                                            if ( ! empty( $gallery_ids ) ) {
                                                foreach ( $gallery_ids as $gallery_id ) {
                                                    if ( wp_attachment_is_image( $gallery_id ) ) {
                                                        echo wp_get_attachment_image( $gallery_id, 'kopa-image-size-2' ); // 234x169
                                                        break;
                                                    }
                                                }
                                            } 
                                        }
                                    ?>

                                    <?php else : ?>
                                        <?php if ( has_post_thumbnail() ) {
                                            echo sprintf( '%s', $thumbnail );
                                        } ?>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="entry-content">
                                <header>
                                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                    <span class="entry-date"><span class="kopa-minus"></span> <?php the_time( get_option('date_format') ); ?></span>
                                </header>
                                <?php the_excerpt(); ?>
                            </div><!--entry-content-->
                        </article><!--entry-item-->
                    </li>
                    <?php endwhile; ?>
                </ul><!--kopa-featured-news-carousel-->
                <div class="clearfix"></div>
                <div class="carousel-nav clearfix">
                    <a id="<?php echo esc_attr( $this->get_field_id('prev-1') ); ?>" class="carousel-prev" href="#">&lt;</a>
                    <a id="<?php echo esc_attr( $this->get_field_id('next-1') ); ?>" class="carousel-next" href="#">&gt;</a>
                </div>
                <div id="<?php echo esc_attr( $this->get_field_id('pager2') ); ?>" class="pager"></div>
            </div><!--list-carousel-->
            <?php
        endif; // endif $posts->have_posts()

        wp_reset_postdata();

		echo wp_kses_post( $after_widget );

	}

}
register_widget( 'News_Mix_Toolkit_Widget_Articles_Carousel' );