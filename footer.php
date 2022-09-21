<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package kerwaapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'kerwaapp_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>


</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>


    <!-- load barba (UMD version) -->
    <script src="https://unpkg.com/@barba/core"></script>

    <!-- load gsap animation library (minified version) -->
    <script src="https://unpkg.com/gsap@latest/dist/gsap.min.js"></script>

    <!-- init barba with a simple opacity transition -->
    <script type="text/javascript">
      barba.init({
        transitions: [{
          name: 'opacity-transition',
          leave(data) {
            return gsap.to(data.current.container, {
              opacity: 0
            });
          },
          enter(data) {
            return gsap.from(data.next.container, {
              opacity: 0
            });
          }
        }],
        views: [{
          namespace: 'home',
          before() {
            // update the menu based on user navigation
            //menu.update();
          },
          enter() {
            // refresh the parallax based on new page content
            //parallax.refresh();
            //tlClose.play();
          },
          beforeEnter({ next }) {
            /*
            // prevent Google Map API script from being loaded multiple times
            if (typeof window.createMap === 'function') {
              window.createMap();
            } else {
              window.createMap = () => {
                // create your map here using the Map API
                // Map, LatLng, InfoWindow, etc.
              };
              */

              // load the Google Map API script
              /*let script = document.createElement('script');
              script.src = 'https://app.kerwacrew.de/wp-content/cache/autoptimize/js/autoptimize_3ab2fc8ea1fc9c347ac37f7a84166d64.js';
              next.container.appendChild(script);*/
            //}
          }
        }]
      });
      barba.hooks.enter(() => {
        // Neu initialisieren bei betreten der Seite
        window.scrollTo(0, 0);
        //$('.accordion').accordionLiveFilter();
        //$('.listSwipe').listSwipe();
        initListSwipe();
        initMenu();
        initLiveSearch();
        accordionLiveFilter();
        backToTop();
        checklistNumbering();
        saveToLocalStorage();
        shareButton();
        initSpeakerBot();
      });
      $('.menu-item a').on('click', function(){
        barba.hooks.after(() => {
          if(tlClose.progress() < 1){
            menuContainer.css('background','none'); // new
            tlClose.play();
            $('body').css('overflow', 'auto');
          } else {
            menuContainer.css('background','none'); // new
            tlClose.restart();
            $('body').css('overflow', 'auto');
          }
        });
      });
	  </script>
	
</body>

</html>

