<div class="main-wrapper">
      <div class="product-top">
        <div class="mobile-previous">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1617021621815" loading="lazy" alt="" class="image-40">
        </div>
        <div class="product-step active">1. Choisir le support</div>
        <div class="product-step">2. Choisir la surface</div>
        <div class="product-step">3. Choisir le matériau</div>
        <div class="product-step">4. Choisir la gamme</div>
        <div class="product-step">5. notre selection</div>
      </div>
      <div class="product-bottom">
        <div class="product-bottom-step active">
          <?php 
            $terms = get_terms([
              'taxonomy' => 'support',
              'hide_empty' => false,
            ]); 
            foreach($terms as $term) :
          ?>
          <div class="project-filter-card" data-slug="<?php echo $term->slug; ?>">
            <div class="project-filter-img-container">
              <img src="<?php the_cat_img($term->term_id, 'full')?>" loading="lazy" alt="" class="project-filter-img">
            </div>
            <div class="project-filter-label"><?php echo $term->name; ?></div>
          </div>
          <?php endforeach; ?>
          <?php 
              wpgb_render_facet(
              	[
              		'id'   => 8,
              		'grid' => 55,
              	]
              );
          ?>
        </div>
        <div class="product-bottom-step">
          <?php 
            $terms = get_terms([
              'taxonomy' => 'surface',
              'hide_empty' => false,
            ]); 
            foreach($terms as $term) :
          ?>
          
          <div class="project-filter-card" data-slug="<?php echo $term->slug; ?>">
            <div class="project-filter-img-container">
              <img src="<?php the_cat_img($term->term_id, 'full')?>" loading="lazy" alt="" class="project-filter-img">
            </div>
            <div class="project-filter-label"><?php echo $term->name; ?></div>
          </div>
          <?php endforeach; ?>
          <?php 
              wpgb_render_facet(
              	[
              		'id'   => 10,
              		'grid' => 55,
              	]
              );
          ?>
        </div>
        <div class="product-bottom-step">
          <?php 
            $terms = get_terms([
              'taxonomy' => 'material',
              'hide_empty' => false,
            ]); 
             // Filtrer le tableau des terms
            $terms = array_filter( $terms, function( $terms ) {
              // Exclusion des slugs de gammes 
              $exclude = ['bfuhp','materiel-btp'];
              // Retour du tableau filtré
              return in_array( $terms->slug, $exclude ) ? false : true;
            } );
            foreach($terms as $term) :
          ?>
          
          <div class="project-filter-card card-material" data-slug="<?php echo $term->slug; ?>">
            <div class="project-filter-img-container">
              <img src="<?php the_cat_img($term->term_id, 'full')?>" loading="lazy" alt="" class="project-filter-img">
            </div>
            <div class="project-filter-label"><?php echo $term->name; ?></div>
          </div>
          <?php endforeach; ?>
          <?php 
              wpgb_render_facet(
              	[
              		'id'   => 9,
              		'grid' => 55,
              	]
              );
          ?>
        </div>
        <div class="product-bottom-step">
          <?php 
          $terms = get_terms( array(
              'taxonomy'   => 'gamme',
              'hide_empty' => false,
          ) );
          
          // Filtrer le tableau des terms
          $terms = array_filter( $terms, function( $terms ) {
            // Exclusion des slugs de gammes 
            $exclude = ['entretien-du-materiel', 'lasures-beton-colorees', 'lasures-de-protections-incolores','traitement-du-beton'];
            // Retour du tableau filtré
            return in_array( $terms->slug, $exclude ) ? false : true;
          } );

            foreach($terms as $term) :
          ?>
          
          <div class="project-filter-card" data-slug="<?php echo $term->slug; ?>">
            <div class="project-filter-img-container">
              <img src="<?php the_cat_img($term->term_id, 'full')?>" loading="lazy" alt="" class="project-filter-img">
            </div>
            <div class="project-filter-label"><?php echo $term->name; ?></div>
          </div>
          <?php endforeach; ?>
          <?php 
              wpgb_render_facet(
              	[
              		'id'   => 7,
              		'grid' => 55,
              	]
              );
          ?>
        </div>
        <div class="product-bottom-step">
          <?php wpgb_render_grid( 55 );?>
        </div>
      </div>
    </div>