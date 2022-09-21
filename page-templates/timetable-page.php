<?php
/**
 * Template Name: Timetable Page
 *
 * Template for displaying a timetable
 *
 * @package kerwaapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod( 'kerwaapp_container_type' );
?>

<div data-barba="container" data-barba-namespace="Zeitplan">

    <div class="wrapper contentSection" id="full-width-page-wrapper">

        <h1><?php echo the_title(); ?></h1>

        <div class="<?php echo esc_attr( $container ); ?> containerSmall" id="content">

            <div class="row">

                <div class="col-md-12 content-area" id="primary">

                    <main class="site-main" id="main" role="main">

                        <?php
                            $_posts = new WP_Query( array(
                                'post_status' => array( 'publish', 'future' ),
                                'post_type'         => 'timetableblock',
                                'orderby' => 'date',
                                'order' => 'ASC',
                                'posts_per_page'    => -1
                            ));

                            if( $_posts->have_posts() ) :
                                while ( $_posts->have_posts() ) : $_posts->the_post();
                                    ?>
                                    <article class="timeTableEntry">
                                        <div class="calendar">
                                            <div class="calendarHead">
                                                <?php the_time('D'); ?>
                                            </div>
                                            <div class="calendarContent">
                                                <?php the_time('d'); ?>
                                            </div>
                                        </div>
                                        <div class="timeTableItemList">
                                            <div class="timeTableItem">
                                                <?php the_content(); ?>
                                            </div>
                                        </div>
                                    </article>
                                    <div class="clear"></div>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>

                    </main><!-- #main -->

                </div><!-- #primary -->

            </div><!-- .row end -->

        </div><!-- #content -->

    </div><!-- #full-width-page-wrapper -->

</div>

<?php get_footer(); ?>
