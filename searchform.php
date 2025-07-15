<form class="search-form" method="get" action="<?php echo esc_url(home_url('/search')); ?>">
    <label class="sr-only" for="s">Search</label>
    <div class="flex">
        <input type="search" class="search-field" placeholder="<?php esc_attr_e('Search...', 'textdomain'); ?>" 
               value="<?php echo get_search_query(); ?>" name="s" id="s" />
        <button type="submit" class="search-submit">
            <span class="sr-only">Search</span>
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>