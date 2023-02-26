<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search"  class="search-input" placeholder="<?php esc_attr_e( 'Search...', 'jl-best-blog' ) ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><img src="<?php echo esc_url( get_theme_file_uri().'/inc/images/search-icon.svg' ) ?>" alt="search-icon"></button>
</form>