<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search"  class="search-input" placeholder="Szukaj..." value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><img src="<?php echo esc_url( get_theme_file_uri().'/inc/images/search-icon.png' ) ?>" alt="search-icon"></button>
</form>