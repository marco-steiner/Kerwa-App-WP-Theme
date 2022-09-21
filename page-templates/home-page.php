<?php
/* Template Name: HomePage */

get_header();
?>
    <div data-barba="container" data-barba-namespace="home">
        <div class="startSliderWrapper">
            <div class="startSlider">
                <?php
                    $today = date("Y-m-d");
                    $today = strtotime( "$today 00:00:00" ); // Uhrzeit auf 0:00 Uhr
                    $_posts = new WP_Query( array(
                        'post_status' => array( 'publish', 'future' ),
                        'post_type'	=> 'event',
                        'no_found_rows' => true, // ohne pagination
                        'posts_per_page'    => 1,
                        'meta_key' => 'event-end-date',
                        'orderby' => 'meta_value',
                        'order' => 'ASC',
                        'meta_query' => array(
                            array(
                                'key' => 'event-end-date',
                                'meta-value' => $value,
                                'value' => $today,
                                'compare' => '>=',
                                'type' => 'NUMERIC'
                            )
                        )
                    ));

                    if( $_posts->have_posts() ) :
                        while ( $_posts->have_posts() ) : $_posts->the_post();
                            $event_start_date = get_post_meta( $post->ID, 'event-start-date', true );
                            $event_end_date = get_post_meta( $post->ID, 'event-end-date', true );
                            $event_start_date = ! empty( $event_start_date ) ? $event_start_date : time();
                            $event_end_date = ! empty( $event_end_date ) ? $event_end_date : $event_start_date;
                            ?>
                            <div class="startSlide">
                                <div class="startSlideContent">
                                    <div class="startSlideTitle">
                                        <?php the_title(); ?>
                                    </div>
                                    <p>
                                        <?php echo date( 'd.m', $event_start_date ); ?> - <?php echo date( 'd.m Y', $event_end_date ); ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
                <?php
                    $_posts = new WP_Query( array(
                        'post_type'         => 'textblock',
                        'posts_per_page'    => 1,
                        'orderby' => 'rand'
                    ));

                    if( $_posts->have_posts() ) :
                        while ( $_posts->have_posts() ) : $_posts->the_post();
                            ?>
                            <div class="startSlide">
                                <div class="startSlideQuote">
                                    “<?php the_content(); ?>”
                                </div>
                            </div>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
                <div class="startSlide">
                    <div class="startSlideContent">
                        <div class="startSlideTitle">
                        🍻 Gas am Glas!
                        </div>
                        <p>
                            Lernt fleißig Kerwalieder
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper startSection contentSection" id="page-wrapper">

            <h1>Willkommen</h1>

            <main id="main" class="site-main container">

                <?php

                /* Start the Loop */
                while ( have_posts() ) :
                    the_content();
                    the_post();

                    get_template_part( 'template-parts/content/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }

                endwhile; // End of the loop.
                ?>
                
            <!--
                <a href="https://app.kerwacrew.de/kerwalieder/">
                    <div class="startContent startContentRight startContentStyle1">
                        <div class="icon">🎺</div>
                        <h2>Kerwa<br>Liedle</h2>
                        <p>Eine Sammlung an Kerwaliedern</p>
                        <div class="circle1"></div>
                        <div class="circle2"></div>
                        <div class="circle3"></div>
                    </div>
                </a>
            -->

            </main><!-- #main -->
        </div><!-- #primary -->
    </div>

<?php
get_footer();
