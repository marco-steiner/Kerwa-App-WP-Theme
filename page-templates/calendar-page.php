<?php
/**
 * Template Name: Calendar Page
 *
 * Template for displaying a calendar
 *
 * @package kerwaapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod( 'kerwaapp_container_type' );
?>

<div data-barba="container" data-barba-namespace="kerwakalender">
    <div id="beer2">
        <div class="cup">
            <div></div>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
            <i class="bolha"></i>
        </div>
    </div>

    <div class="wrapper contentSection" id="full-width-page-wrapper">

        <h1><?php echo the_title(); ?></h1>

        <div class="<?php echo esc_attr( $container ); ?> containerSmall" id="content">

            <div class="row">

                <div class="col-md-12 content-area" id="primary">

                    <main class="site-main" id="main" role="main">

                        <?php
                            $today = date("Y-m-d");
                            $today = strtotime( "$today 00:00:00" ); // Uhrzeit auf 0:00 Uhr
                            $_posts = new WP_Query( array(
                                'post_status' => array( 'publish', 'future' ),
                                'post_type'	=> 'event',
                                'no_found_rows' => true, // ohne pagination
                                'posts_per_page'    => -1,
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
                                    <article class="timeTableEntry">
                                        <div class="calendar">
                                            <div class="calendarHead">
                                                <?php echo date( 'M', $event_start_date ); ?>
                                            </div>
                                            <div class="calendarContent">
                                                <?php echo date( 'd', $event_start_date ); ?>
                                            </div>
                                        </div>
                                        <div class="timeTableItemList">
                                            <div class="timeTableItem">
                                                <b><?php the_title(); ?></b><br>
                                                <?php echo date( 'd. F', $event_start_date ); ?> - <?php echo date( 'd. F Y', $event_end_date ); ?>
                                            </div>
                                        </div>
                                    </article>
                                    <div class="clear"></div>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>

                        <!-- Vergangene Events -->
                        <?php
                            $today = date("Y-m-d");
                            $today = strtotime( "$today 00:00:00" ); // Uhrzeit auf 0:00 Uhr
                            $_posts = new WP_Query( array(
                                'post_status' => array( 'publish', 'future' ),
                                'post_type'	=> 'event',
                                'no_found_rows' => true, // ohne pagination
                                'posts_per_page'    => -1,
                                'meta_key' => 'event-end-date',
                                'orderby' => 'meta_value',
                                'order' => 'ASC',
                                'meta_query' => array(
                                    array(
                                        'key' => 'event-end-date',
                                        'meta-value' => $value,
                                        'value' => $today,
                                        'compare' => '<',
                                        'type' => 'NUMERIC'
                                    )
                                )
                            ));

                            if( $_posts->have_posts() ) :
                                ?>
                                <br>
                                <h1>Vergangene Kerwas</h1>
                                <?php
                                while ( $_posts->have_posts() ) : $_posts->the_post();
                                    $event_start_date = get_post_meta( $post->ID, 'event-start-date', true );
                                    $event_end_date = get_post_meta( $post->ID, 'event-end-date', true );
                                    $event_start_date = ! empty( $event_start_date ) ? $event_start_date : time();
                                    $event_end_date = ! empty( $event_end_date ) ? $event_end_date : $event_start_date;
                                    ?>
                                    <article class="timeTableEntry">
                                        <div class="calendar">
                                            <div class="calendarHead">
                                                <?php echo date( 'M', $event_start_date ); ?>
                                            </div>
                                            <div class="calendarContent">
                                                <?php echo date( 'd', $event_start_date ); ?>
                                            </div>
                                        </div>
                                        <div class="timeTableItemList">
                                            <div class="timeTableItem">
                                                <b><?php the_title(); ?></b><br>
                                                <?php echo date( 'd. F', $event_start_date ); ?> - <?php echo date( 'd. F Y', $event_end_date ); ?>
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
