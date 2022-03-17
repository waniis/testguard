<?php
/**
 * Leaflet Map providers
 *
 * @package   WP Grid Builder - Map Facet
 * @author    Loïc Blascos
 * @copyright 2019-2021 Loïc Blascos
 */

namespace WP_Grid_Builder_Map_Facet\Providers;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return apply_filters(
	'wp_grid_builder_map/leaflet_providers',
	[
		'OpenStreetMap' => [
			'url'      => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
			'options'  => [
				'maxZoom'     => 19,
				'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
			],
			'variants' => [
				'Mapnik' => [],
				'DE'     => [
					'url'     => 'https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png',
					'options' => [
						'maxZoom' => 18,
					],
				],
				'CH'     => [
					'url'     => 'https://tile.osm.ch/switzerland/{z}/{x}/{y}.png',
					'options' => [
						'maxZoom' => 18,
						'bounds'  => [ [ 45, 5 ], [ 48, 11 ] ],
					],
				],
				'France' => [
					'url'     => 'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',
					'options' => [
						'maxZoom'     => 20,
						'attribution' => '&copy; Openstreetmap France | {attribution.OpenStreetMap}',
					],
				],
				'HOT'    => [
					'url'     => 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
					'options' => [
						'attribution' =>
							'{attribution.OpenStreetMap}, ' .
							'Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> ' .
							'hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>',
					],
				],
				'BZH'    => [
					'url'     => 'https://tile.openstreetmap.bzh/br/{z}/{x}/{y}.png',
					'options' => [
						'attribution' => '{attribution.OpenStreetMap}, Tiles courtesy of <a href="http://www.openstreetmap.bzh/" target="_blank">Breton OpenStreetMap Team</a>',
						'bounds'      => [ [ 46.2, -5.5 ], [ 50, 0.7 ] ],
					],
				],
			],
		],
		'OpenTopoMap'   => [
			'url'     => 'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
			'options' => [
				'maxZoom'     => 17,
				'attribution' => 'Map data: {attribution.OpenStreetMap}, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
			],
		],
		'CyclOSM'       => [
			'url'     => 'https://dev.{s}.tile.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png',
			'options' => [
				'maxZoom'     => 20,
				'attribution' => '<a href="https://github.com/cyclosm/cyclosm-cartocss-style/releases" title="CyclOSM - Open Bicycle render">CyclOSM</a> | Map data: {attribution.OpenStreetMap}',
			],
		],
		'OpenMapSurfer' => [
			'url'     => 'https://maps.heigit.org/openmapsurfer/tiles/{variant}/webmercator/{z}/{x}/{y}.png',
			'options' => [
				'maxZoom'     => 19,
				'variant'     => 'roads',
				'attribution' => 'Imagery from <a href="http://giscience.uni-hd.de/">GIScience Research Group @ University of Heidelberg</a> | Map data ',
			],
		],
		'Hydda'         => [
			'url'      => 'https://{s}.tile.openstreetmap.se/hydda/{variant}/{z}/{x}/{y}.png',
			'options'  => [
				'maxZoom'     => 18,
				'variant'     => 'base',
				'attribution' => 'Tiles courtesy of <a href="http://openstreetmap.se/" target="_blank">OpenStreetMap Sweden</a> &mdash; Map data {attribution.OpenStreetMap}',
			],
			'variants' => [
				'Full' => 'full',
				'Base' => 'base',
			],
		],
		'Stamen'        => [
			'url'     => 'https://stamen-tiles-{s}.a.ssl.fastly.net/{variant}/{z}/{x}/{y}{r}.{ext}',
			'options' => [
				'attribution' =>
					'Map tiles by <a href="http://stamen.com">Stamen Design</a>, ' .
					'<a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; ' .
					'Map data {attribution.OpenStreetMap}',
				'subdomains'  => 'abcd',
				'minZoom'     => 0,
				'maxZoom'     => 20,
				'variant'     => 'toner',
				'ext'         => 'png',
			],
		],
		'Esri'          => [
			'url'      => 'https://server.arcgisonline.com/ArcGIS/rest/services/{variant}/MapServer/tile/{z}/{y}/{x}',
			'options'  => [
				'variant'     => 'World_Street_Map',
				'attribution' => 'Tiles &copy; Esri',
			],
			'variants' => [
				'WorldStreetMap'    => [
					'options' => [
						'attribution' =>
							'{attribution.Esri} &mdash; ' .
							'Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012',
					],
				],
				'DeLorme'           => [
					'options' => [
						'variant'     => 'Specialty/DeLorme_World_Base_Map',
						'minZoom'     => 1,
						'maxZoom'     => 11,
						'attribution' => '{attribution.Esri} &mdash; Copyright: &copy;2012 DeLorme',
					],
				],
				'WorldTopoMap'      => [
					'options' => [
						'variant'     => 'World_Topo_Map',
						'attribution' =>
							'{attribution.Esri} &mdash; ' .
							'Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community',
					],
				],
				'WorldImagery'      => [
					'options' => [
						'variant'     => 'World_Imagery',
						'attribution' =>
							'{attribution.Esri} &mdash; ' .
							'Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
					],
				],
				'WorldTerrain'      => [
					'options' => [
						'variant'     => 'World_Terrain_Base',
						'maxZoom'     => 13,
						'attribution' =>
							'{attribution.Esri} &mdash; ' .
							'Source: USGS, Esri, TANA, DeLorme, and NPS',
					],
				],
				'WorldShadedRelief' => [
					'options' => [
						'variant'     => 'World_Shaded_Relief',
						'maxZoom'     => 13,
						'attribution' => '{attribution.Esri} &mdash; Source: Esri',
					],
				],
				'WorldPhysical'     => [
					'options' => [
						'variant'     => 'World_Physical_Map',
						'maxZoom'     => 8,
						'attribution' => '{attribution.Esri} &mdash; Source: US National Park Service',
					],
				],
				'OceanBasemap'      => [
					'options' => [
						'variant'     => 'Ocean_Basemap',
						'maxZoom'     => 13,
						'attribution' => '{attribution.Esri} &mdash; Sources: GEBCO, NOAA, CHS, OSU, UNH, CSUMB, National Geographic, DeLorme, NAVTEQ, and Esri',
					],
				],
				'NatGeoWorldMap'    => [
					'options' => [
						'variant'     => 'NatGeo_World_Map',
						'maxZoom'     => 16,
						'attribution' => '{attribution.Esri} &mdash; National Geographic, Esri, DeLorme, NAVTEQ, UNEP-WCMC, USGS, NASA, ESA, METI, NRCAN, GEBCO, NOAA, iPC',
					],
				],
				'WorldGrayCanvas'   => [
					'options' => [
						'variant'     => 'Canvas/World_Light_Gray_Base',
						'maxZoom'     => 16,
						'attribution' => '{attribution.Esri} &mdash; Esri, DeLorme, NAVTEQ',
					],
				],
			],
		],
		'FreeMapSK'     => [
			'url'     => 'http://t{s}.freemap.sk/T/{z}/{x}/{y}.jpeg',
			'options' => [
				'minZoom'     => 8,
				'maxZoom'     => 16,
				'subdomains'  => '1234',
				'bounds'      => [ [ 47.204642, 15.996093 ], [ 49.830896, 22.576904 ] ],
				'attribution' =>
					'{attribution.OpenStreetMap}, vizualization CC-By-SA 2.0 <a href="http://freemap.sk">Freemap.sk</a>',
			],
		],
		'MtbMap'        => [
			'url'     => 'http://tile.mtbmap.cz/mtbmap_tiles/{z}/{x}/{y}.png',
			'options' => [
				'attribution' =>
					'{attribution.OpenStreetMap} &amp; USGS',
			],
		],
		'CartoDB'       => [
			'url'      => 'https://{s}.basemaps.cartocdn.com/{variant}/{z}/{x}/{y}{r}.png',
			'options'  => [
				'attribution' => '{attribution.OpenStreetMap} &copy; <a href="https://carto.com/attributions">CARTO</a>',
				'subdomains'  => 'abcd',
				'maxZoom'     => 19,
				'variant'     => 'light_all',
			],
			'variants' => [
				'Positron'             => 'light_all',
				'PositronNoLabels'     => 'light_nolabels',
				'PositronOnlyLabels'   => 'light_only_labels',
				'DarkMatter'           => 'dark_all',
				'DarkMatterNoLabels'   => 'dark_nolabels',
				'DarkMatterOnlyLabels' => 'dark_only_labels',
				'Voyager'              => 'rastertiles/voyager',
				'VoyagerNoLabels'      => 'rastertiles/voyager_nolabels',
				'VoyagerOnlyLabels'    => 'rastertiles/voyager_only_labels',
				'VoyagerLabelsUnder'   => 'rastertiles/voyager_labels_under',
			],
		],
		'HikeBike'      => [
			'url'      => 'https://tiles.wmflabs.org/{variant}/{z}/{x}/{y}.png',
			'options'  => [
				'maxZoom'     => 19,
				'attribution' => '{attribution.OpenStreetMap}',
				'variant'     => 'hikebike',
			],
			'variants' => [
				'HikeBike'    => [],
				'HillShading' => [
					'options' => [
						'maxZoom' => 15,
						'variant' => 'hillshading',
					],
				],
			],
		],
		'BasemapAT'     => [
			'url'      => 'https://maps{s}.wien.gv.at/basemap/{variant}/normal/google3857/{z}/{y}/{x}.{format}',
			'options'  => [
				'maxZoom'     => 19,
				'attribution' => 'Datenquelle: <a href="https://www.basemap.at">basemap.at</a>',
				'subdomains'  => [ '', '1', '2', '3', '4' ],
				'format'      => 'png',
				'bounds'      => [ [ 46.358770, 8.782379 ], [ 49.037872, 17.189532 ] ],
				'variant'     => 'geolandbasemap',
			],
			'variants' => [
				'basemap'   => [
					'options' => [
						'maxZoom' => 20, // currently only in Vienna.
						'variant' => 'geolandbasemap',
					],
				],
				'grau'      => 'bmapgrau',
				'overlay'   => 'bmapoverlay',
				'highdpi'   => [
					'options' => [
						'variant' => 'bmaphidpi',
						'format'  => 'jpeg',
					],
				],
				'orthofoto' => [
					'options' => [
						'maxZoom' => 20, // currently only in Vienna.
						'variant' => 'bmaporthofoto30cm',
						'format'  => 'jpeg',
					],
				],
			],
		],
		'nlmaps'        => [
			'url'      => 'https://geodata.nationaalgeoregister.nl/tiles/service/wmts/{variant}/EPSG:3857/{z}/{x}/{y}.png',
			'options'  => [
				'minZoom'     => 6,
				'maxZoom'     => 19,
				'bounds'      => [ [ 50.5, 3.25 ], [ 54, 7.6 ] ],
				'variant'     => 'brtachtergrondkaart',
				'attribution' => 'Kaartgegevens &copy; <a href="kadaster.nl">Kadaster</a>',
			],
			'variants' => [
				'standaard' => 'brtachtergrondkaart',
				'pastel'    => 'brtachtergrondkaartpastel',
				'grijs'     => 'brtachtergrondkaartgrijs',
			],
		],
		'NASAGIBS'      => [
			'url'      => 'https://map1.vis.earthdata.nasa.gov/wmts-webmerc/{variant}/default/{time}/{tilematrixset}{maxZoom}/{z}/{y}/{x}.{format}',
			'options'  => [
				'attribution'   =>
					'Imagery provided by services from the Global Imagery Browse Services (GIBS), operated by the NASA/GSFC/Earth Science Data and Information System ' .
					'(<a href="https://earthdata.nasa.gov">ESDIS</a>) with funding provided by NASA/HQ.',
				'bounds'        => [ [ -85.0511287776, -179.999999975 ], [ 85.0511287776, 179.999999975 ] ],
				'minZoom'       => 1,
				'maxZoom'       => 9,
				'format'        => 'jpg',
				'time'          => '',
				'variant'       => 'MODIS_Terra_CorrectedReflectance_TrueColor',
				'tilematrixset' => 'GoogleMapsCompatible_Level',
			],
			'variants' => [
				'ModisTerraTrueColorCR' => 'MODIS_Terra_CorrectedReflectance_TrueColor',
				'ModisTerraBands367CR'  => 'MODIS_Terra_CorrectedReflectance_Bands367',
				'ViirsEarthAtNight2012' => [
					'options' => [
						'variant' => 'VIIRS_CityLights_2012',
						'maxZoom' => 8,
					],
				],
			],
		],
		'Wikimedia'     => [
			'url'     => 'https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png',
			'options' => [
				'attribution' => '<a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia</a>',
				'minZoom'     => 1,
				'maxZoom'     => 19,
			],
		],
		'OneMapSG'      => [
			'url'      => 'https://maps-{s}.onemap.sg/v3/{variant}/{z}/{x}/{y}.png',
			'options'  => [
				'variant'     => 'Default',
				'minZoom'     => 11,
				'maxZoom'     => 18,
				'bounds'      => [ [ 1.56073, 104.11475 ], [ 1.16, 103.502 ] ],
				'attribution' => '<img src="https://docs.onemap.sg/maps/images/oneMap64-01.png" style="height:20px;width:20px;"/> New OneMap | Map data &copy; contributors, <a href="http://SLA.gov.sg">Singapore Land Authority</a>',
			],
			'variants' => [
				'Default'  => 'Default',
				'Night'    => 'Night',
				'Original' => 'Original',
				'Grey'     => 'Grey',
				'LandLot'  => 'LandLot',
			],
		],
	]
);
