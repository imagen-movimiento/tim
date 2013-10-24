<?php
/**
 * Content Single
 *
 * Loop content in single post template (single.php)
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 4.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header>
		<hgroup>
			<h2><?php the_title(); ?></h2>
		</hgroup>
	</header>

<div class="large-4 columns">
	<?php if ( has_post_thumbnail()) : ?>
	<a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('medium'); ?></a>
</div>
	

        <?php endif; ?>
	<div class="large-8 columns">
	<?php the_content(); ?>
        </div>
	<footer>

		<p><?php wp_link_pages(); ?></p>

		<h6><?php _e('Posted Under:', 'foundation' );?> <?php the_category(', '); ?></h6>
		<?php the_tags('<span class="radius secondary label">','</span><span class="radius secondary label">','</span>'); ?>

		<?php get_template_part('author-box'); ?>
		<?php comments_template(); ?>

	</footer>

</article>

<hr />
