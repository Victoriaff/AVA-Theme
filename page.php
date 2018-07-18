<?php
/**
 * The page template file
 */

$header_class = 'transparent';

get_header(); ?>

<?php the_post();
	the_content();?>
<?php get_footer();
