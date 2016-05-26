<?php

class News_Mix_Toolkit_Widget_Articles_Tabs_List extends Kopa_Widget {

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

		$this->widget_cssclass    = 'kopa-article-list-widget';
		$this->widget_description = esc_html__( 'Display tabs of posts for each selected categories.', 'news-mix-toolkit' );
		$this->widget_id          = 'kopa_widget_articles_tabs_list';
		$this->widget_name        = esc_html__( '[News Mix] - Articles Tabs List.', 'news-mix-toolkit' );
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
            'display_type' => array(
                'type'  => 'select',
                'std'   => 'date',
                'label' => esc_html__( 'Display type:', 'news-mix-toolkit' ),
                'options' => array(
                    'ranking'         => esc_html__( 'Ranking Numbers', 'news-mix-toolkit' ),
                    'thumbnail'       => esc_html__( 'Thumbnail', 'news-mix-toolkit' ),
                ),
            ),
		);
		parent::__construct();
	}

	public function widget( $args, $instance ) {

		extract( $args );

		extract( $instance );

        if( $categories[0] == ''){
            unset( $categories[0] );
        }

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        $categories_list = get_terms( 'category' );

		echo wp_kses_post( $before_widget );

		if ( ! empty ( $title ) )
            echo sprintf( '%s', $before_title . $title . $after_title );

       	if ( ! empty( $categories ) ) : ?>

            <div class="list-container-1">
                <ul class="tabs-1 clearfix">
                    <?php 
                    $cat_index = 1;
                    foreach ( $categories as $category ) :
                        $cat = get_category_by_slug( $category ); ?>
                        <li <?php echo ( $cat_index == 1 ? ' class="active"' : '' ); ?>><a href="#<?php echo esc_attr( $this->get_field_id( 'tab' ) ) . '-' . $category ?>"><?php echo wp_kses_post( $cat->name ); ?></a></li>
                    <?php 
                        $cat_index++; // increase category index by 1
                    endforeach; ?>
                </ul><!--tabs-1-->
            </div>
            <div class="tab-container-1">
                <?php foreach ( $categories as $cat_slug ) : 
                    $args = array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field'    => 'slug',
                                'terms'    => $cat_slug,
                            ),
                        ),
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => $instance['posts_per_page']
                    );

                    switch ( $instance['orderby'] ) {
                        case 'popular':
                            $args['meta_key'] = 'news_mix_lite_total_view';
                            $args['orderby']  = 'meta_value_num';
                            break;
                        case 'most_comment':
                            $args['orderby'] = 'comment_count';
                            break;
                        case 'random':
                            $args['orderby'] = 'rand';
                            break;
                        default:
                            $args['orderby'] = 'date';
                            break;
                    }

                    $cat_posts = new WP_Query( $args );

                    if ( $cat_posts->have_posts() ) :
                ?>
                    <div class="tab-content-1 kp-post-format <?php echo ( $display_type == 'thumbnail' ? 'kp-thumbnail-style' : '' ); ?>" id="<?php echo esc_attr( $this->get_field_id('tab') ) . '-' . $cat_slug; ?>">                 
                        <ul>
                            <?php $post_index = 1; 
                            while ( $cat_posts->have_posts() ) : $cat_posts->the_post(); 

                                $thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'kopa-image-size-3' );

                                if ( $post_index == 1 )
                                    $index_class = 'kp-1st-post';
                                elseif ( $post_index == 2 )
                                    $index_class = 'kp-2nd-post';
                                elseif ( $post_index == 3 )
                                    $index_class = 'kp-3rd-post';
                                else
                                    $index_class = 'kp-nth-post';
                            ?>
                                <li>
                                    <article class="entry-item clearfix">
                                        
                                        <?php if ( $display_type == 'ranking' ) : ?>
                                            <span class="entry-thumb <?php echo esc_attr( $index_class ); ?>"><?php echo esc_attr( $post_index ); ?></span>
                                        <?php else : ?>
                                            <span class="entry-thumb"><a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() )
                                                    echo sprintf( '%s', $thumbnail ); // 53 x 53
                                            ?></a></span>
                                        <?php endif; // endif $display_type == ranking ?>

                                        <div class="entry-content">
                                            <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                            <span class="entry-date"><span class="kopa-minus"></span><?php the_time( get_option( 'date_format' ) ); ?></span>

                                            <?php if ( get_post_format() == 'video' ) : 
                                                echo News_Mix_Lite_Icon::getIcon('video-icon fa fa-video-camera','span'); 
                                             endif; ?>
                                        </div>

                                    </article>
                                </li>
                            <?php $post_index++; // increase post index by 1 
                            endwhile; ?>
                        </ul>

                    </div><!--tab-content-1-->
                    <?php endif; 
                    wp_reset_postdata();
                endforeach; ?>
            </div><!--tab-container-1-->
            
            <?php
        endif; // endif $posts->have_posts()

		echo wp_kses_post( $after_widget );

	}

}
register_widget( 'News_Mix_Toolkit_Widget_Articles_Tabs_List' );