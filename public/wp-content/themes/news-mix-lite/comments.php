<?php
if (!function_exists('news_mix_lite_comments_callback')) {

    function news_mix_lite_comments_callback($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">   


            <article id="comment-<?php comment_ID(); ?>" class="comment-wrap clearfix">
                <div class="comment-avatar">
                    <?php echo get_avatar($comment->comment_author_email, 110); ?>                                          
                </div>
                <div class="comment-body clearfix">
                    <header class="clearfix">

                        <div class="comment-meta">
                            <span class="author"><?php comment_author_link(); ?></span>
                            <span class="date"><?php comment_time(get_option('date_format')); ?> <?php esc_html_e('at', 'news-mix-lite'); ?> <?php comment_time(get_option('time_format')); ?></span>
                        </div><!-- end:comment-meta -->                        

                        <div class="comment-button">

                            <?php
                            if (current_user_can('moderate_comments')) :
                                edit_comment_link(esc_html__('Edit', 'news-mix-lite'));
                                ?>  
                            <?php endif; ?>

                            <?php 
                            $reply_text = sprintf( '<span>/</span> %s', esc_html__( 'Reply', 'news-mix-lite' ) );
                            comment_reply_link(array_merge($args, array('reply_text' => $reply_text, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>   
                        </div>

                    </header>
                    <p><?php comment_text(true); ?></p>

                    <!-- <a href="#" class="comment-reply-link small-button green-button">Reply</a> -->
                </div><!--comment-body -->
            </article>   
        </li>                                                              

        <?php
    }

}
if (!function_exists('news_mix_lite_comment_form_args')) {

    function news_mix_lite_comment_form_args() {
        global $user_identity;
        $commenter = wp_get_current_commenter();

        $fields = array(
            'author' => '<p class="input-block">               
                <label class="required" for="comment_name" >' . __("Name <span>(required):</span>", 'news-mix-lite') . '</label>
                <input type="text" name="author" id="comment_name"                 
                value="' . esc_attr($commenter['comment_author']) . '">                                               
                </p>',
            'email' => '<p class="input-block">   
                <label for="comment_email" class="required">' . __("Email <span>(required):</span>", 'news-mix-lite') . '</label>                                            
                <input type="email" name="email" id="comment_email"                                                                 
                value="' . esc_attr($commenter['comment_author_email']) . '" >
                </p>',
            'url' => '<p class="input-block">   
                <label for="comment_url" class="required">' . __("Website", 'news-mix-lite') . '</label>                                                            
                <input type="url" name="url" id="comment_url"                 
                value="' . esc_attr($commenter['comment_author_url']) . '" >
                </p>'
        );

        $comment_field = '<p class="textarea-block">
        <label class="required" for="comment_message">' . __('Your comment <span>(required):</span>', 'news-mix-lite') . '</label>        
        <textarea name="comment" id="comment_message"></textarea>
        </p>';

        $args = array(
            'fields' => apply_filters('comment_form_default_fields', $fields),
            'comment_field' => $comment_field,
            'must_log_in' => '<p class="alert">' . sprintf(__('You must be <a href="%1$s" title="Log in">logged in</a> to post a comment.', 'news-mix-lite'), wp_login_url(get_permalink())) . '</p><!-- .alert -->',
            'logged_in_as' => '<p class="log-in-out">' . sprintf(__('Logged in as <a href="%1$s" title="%2$s">%2$s</a>.', 'news-mix-lite'), admin_url('profile.php'), esc_attr($user_identity)) . ' <a href="' . wp_logout_url(get_permalink()) . '" title="' . esc_attr__('Log out of this account', 'news-mix-lite') . '">' . __('Log out &raquo;', 'news-mix-lite') . '</a></p><!-- .log-in-out -->',
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'id_form' => 'comments-form',
            'id_submit' => 'submit-comment',
            'title_reply' => __('<span class="title-line"></span><span class="title-text">Leave a comment</span>', 'news-mix-lite'),
            'title_reply_to' => __('Reply', 'news-mix-lite'),
            'cancel_reply_link' => __('<span class="title-text">Cancel</span>', 'news-mix-lite'),
            'label_submit' => __('Post Comment', 'news-mix-lite'),
        );

        return $args;
    }

}


if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die(__('Please do not load this page directly. Thanks!', 'news-mix-lite'));

if (post_password_required() || !comments_open()):
    return;
else:
    ?>
    <?php if (have_comments()) : ?>  
        <div id="comments">
            <h3>
                <span class="title-line"></span>
                <span class="title-text">
                    <?php comments_number(__('No Comments', 'news-mix-lite'), __('1 Comment', 'news-mix-lite'), __('% Comments', 'news-mix-lite')); ?>
                </span>
            </h3>
            <ol class="comments-list clearfix">
                <?php
                wp_list_comments(array(
                    'walker' => null,
                    'style' => 'ul',
                    'callback' => 'news_mix_lite_comments_callback',
                    'end-callback' => null,
                    'type' => 'all'
                ));
                ?>
            </ol>
            <center class="pagination kopa-comment-pagination"><?php paginate_comments_links(); ?></center>
            <div class="clear"></div>
        </div>
    <?php endif; ?>   
    <?php comment_form(news_mix_lite_comment_form_args()); ?>
<?php endif; ?>

<?php
