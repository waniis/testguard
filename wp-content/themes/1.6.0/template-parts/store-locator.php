<?php if(get_u_slug()=="particuliers"){
    $id_grid=5;
}else{
    $id_grid=33; 
}
?>

<div class="store-locator-content">
    <div class="map-col map-filters-container">
      <div class="distributor-top-container">

        <p class="subtitle-white">
            Trouver un distributeur Guard Industrie près de chez vous :
        </p>
      </div>
      <div class="geoloc-distributor">
        <?php  
            wpgb_render_facet(
              	[
              		'id'   => 3,
              		'grid' => $id_grid,
              	]
              ); 
        ?>
      </div>
      <div class="map-grid-container">
          <div class="close-map-results">
              <span class="line"></span>
              <span class="line"></span>
          </div>
        <?php  
           wpgb_render_grid($id_grid);
         ?>
      </div>
    </div>
    <div class="map-col map-container">
       <?php  
        wpgb_render_facet(
          	[
          		'id'   => 4,
          		'grid' => $id_grid,
          	]
          ); 
       ?>
    </div>
</div>