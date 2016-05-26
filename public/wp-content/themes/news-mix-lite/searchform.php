<form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="search-form clearfix">
    <p class="input-search-form clearfix">
        <input type="text" name="s" placeholder="<?php esc_html_e( 'Search', 'news-mix-lite' ); ?>" value="<?php echo get_search_query(); ?>" class="search-form-field" size="40">
        <input type="submit" value="<?php esc_html_e('Search', 'news-mix-lite'); ?>" class="submit">
    </p>
</form>