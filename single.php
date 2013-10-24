<?php

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header>
	<hgroup>
	    <h2><?php the_title(); ?></h2>
	</hgroup>
    </header>

    <div class="large-3 columns">
	<?php if ( has_post_thumbnail()) { ?>
	    <a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('medium'); ?></a>
        <?php } ?>

    </div>
    

    <div class="large-6 columns">
	<?php var_dump( get_the_content( the_ID() ) ); ?>

    </div>


    <footer>

    </footer>

</article>

<hr />

