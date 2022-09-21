<?php
/**
 * Template Name: Search Page
 *
 * Template for displaying a page with searchable content
 *
 * @package kerwaapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod( 'kerwaapp_container_type' );
?>

<div data-barba="container" data-barba-namespace="kerwalieder">
    <!--
    <div class="container globalPositionAbsolute">
        <div class="searchBarWrapper">
            <input id="liveSearchInput" class="searchInput" placeholder="Suchen">
        </div>
    </div>
    -->

    <div class="wrapper contentSection searchSection" id="full-width-page-wrapper">
        <h1><?php echo the_title(); ?></h1>

        <div class="<?php echo esc_attr( $container ); ?>" id="content">

            <div class="searchBarWrapper">
                <input id="liveSearchInput" class="searchInput" placeholder="Suchen">
            </div>

            <div class="row">

                <div class="col-md-12 content-area" id="primary">

                    <main class="site-main" id="main" role="main">

                        <ul class="accordion accordionContainer" data-alf="#liveSearchInput">
                            <?php
                                $_terms = get_terms( array('textblockcategory') );
                                $i = 1;

                                foreach ($_terms as $term) :

                                    $term_slug = $term->slug;
                                    $_posts = new WP_Query( array(
                                        'post_type'         => 'textblock',
                                        'posts_per_page'    => -1,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'textblockcategory',
                                                'field'    => 'slug',
                                                'terms'    => $term_slug,
                                            ),
                                        ),
                                    ));

                                    if( $_posts->have_posts() ) :
                                        echo '<li class="textCategoryEntry">';
                                            echo '<label class="accordionTitle">'. $term->name .'<div class="arrow"><span></span><span></span></div></label>';
                                            echo '<ul class="accordionItemList listSwipe">';
                                                while ( $_posts->have_posts() ) : $_posts->the_post();
                                                ?>
                                                    <li id="accordionItem<?php echo $i ?>" class="accordionItem">
                                                        <div class="shareBtn circlesTrigger"><div class="circles"></div></div>
                                                        <div class="like"></div>
                                                        <span class="speakText">
                                                            <?php the_content(); ?>
                                                        </span>
                                                        <div class="speak speakIcon action"><span></span></div>
                                                    </li>
                                                    <hr class="line">
                                                <?php
                                                $i++;
                                                endwhile;
                                            echo '</ul>';
                                        echo '</li>';

                                    endif;
                                    wp_reset_postdata();

                                    $i++;
                                endforeach;

                                echo '<li class="textCategoryEntry">';
                                    echo '<label class="accordionTitle">Lieblinge<div class="arrow"><span></span><span></span></div></label>';
                                    echo '<ul class="accordionItemList listSwipe bestof">';
                                        echo '<li class="accordionItem">Keine Likes vorhanden</li>';
                                    echo '</ul>';
                                echo '</li>';
                            ?>
                        </ul> <!-- .accordionContainer -->

                    </main><!-- #main -->

                </div><!-- #primary -->

            </div><!-- .row end -->

        </div><!-- #content -->

    </div><!-- #full-width-page-wrapper -->

</div>

<?php get_footer(); ?>
