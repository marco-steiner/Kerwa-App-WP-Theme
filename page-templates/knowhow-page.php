<?php
/**
 * Template Name: Know How Page
 *
 * Template for displaying a page
 *
 * @package kerwaapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod( 'kerwaapp_container_type' );
?>

<div data-barba="container" data-barba-namespace="informationen">

    <div class="wrapper contentSection" id="full-width-page-wrapper">
        <h1><?php echo the_title(); ?></h1>

        <div class="<?php echo esc_attr( $container ); ?>" id="content">

            <div class="row">

                <div class="col-md-12 content-area" id="primary">

                    <main class="site-main" id="main" role="main">

                        <ul class="accordion accordionContainer">
                            <?php
                            $_posts = new WP_Query( array(
                                'post_type'         => 'knowhow',
                                'posts_per_page'    => -1
                            ));

                            if( $_posts->have_posts() ) :
                                while ( $_posts->have_posts() ) : $_posts->the_post();
                                    ?>
                                    <li class="textCategoryEntry">
                                        <label class="accordionTitle">
                                            <?php the_title(); ?>
                                            <div class="arrow"><span></span><span></span></div>
                                        </label>
                                        <ul class="accordionItemList">
                                            <li class="accordionItem">
                                                <?php the_content(); ?>
                                            </li>
                                            <hr class="line">
                                        </ul>
                                    </li>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </ul><!-- .accordionContainer -->

                    </main><!-- #main -->

                </div><!-- #primary -->

            </div><!-- .row end -->

        </div><!-- #content -->

    </div><!-- #full-width-page-wrapper -->
    
</div>

<?php get_footer(); ?>
