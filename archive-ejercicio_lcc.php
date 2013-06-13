<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 
Template Name: Ejercicios LCC
 
 */


// get_header(); ?>


        <div class="texto_scroll">
            <div class="texto">
                <div class="texto_centrado">

                    <?php 

                    echo the_content();



                    echo '<h3>Tópicos:</h3>';
                    echo '<h3>Tópicos:</h3>';

                    $query = new WP_Query('post_type=topico_lcc');
                    
                    
                    while ($query->have_posts()) : $query->the_post();

                        $postStr = '';
                        $nombre = $post->post_title;
                        $extracto = apply_filters("the_excerpt",get_the_excerpt() );
                        $slug = $post->post_name;
                        $link = get_permalink($post->ID);
                        $postStr .= makeDiv("","titulo",makeLink( $nombre, $link ));
                        $postStr .= makeDiv("","extracto",$extracto);
                        
                        $postStr = makeDiv("","entrada topico",$postStr);

                        echo $postStr;

                    endwhile;
                


                    ?>


                                                                        
                </div><!--texto_centrado -->

                </div><!--texto -->
        </div><!--texto_scroll -->
        
    <footer>
    </footer>
</article>


