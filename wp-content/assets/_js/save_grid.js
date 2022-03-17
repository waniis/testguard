


wpgb.facets.on( 'map.beforeInit', function( instance ) {

	// Change maxZoom options.
	instance.options.maxZoom = 18;

} );


var coord;
var map;

const gotoId=(id)=>{
	
	coord.forEach((c)=>{
	if(c.properties.id==id){
		var geo=c.geometry.coordinates
		map.panTo(new google.maps.LatLng(geo[1],geo[0]));
		map.setZoom(9);
	}

	})
}


wpgb.facets.on( 'map.afterInit', function( instance ) {
	console.log('loaded')
	coord=instance.facet.geoJSON.features;
	map=instance.map;

} );


var initReady=true;
var id;



wpgb.grid.on( 'layout', function( items ) {
	if(initReady){
		initReady=false

		items.forEach((item)=>{
				item.node.addEventListener('click',(e)=>{
					id=parseInt(e.currentTarget.classList[2].substring(10))			
					gotoId(id);
				})
		})
	}
} );




wpgb.facets.on( 'map.marker.click', function( instance, feature ) {
	console.log( 'marker ID', feature.properties.id )
	console.log(feature)

		console.log(instance.markers)
} );



