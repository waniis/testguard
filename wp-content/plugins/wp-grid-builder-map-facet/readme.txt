=== WP Grid Builder - Map Facet ===
Author URI: https://wpgridbuilder.com
Plugin URI: https://wpgridbuilder.com
Contributors: WP Grid Builder, Loïc Blascos
Tags: ecommerce, facet, filter, grid, justified, masonry, metro, post filter, post grid, taxonomy, user, search
Requires at least: 4.7.0
Tested up to: 5.7
Requires PHP: 5.6
Stable tag: 1.1.5
License: GPL-3.0-or-later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Add maps from Google Map, Mapbox or Leaflet to display markers and to filter.

== Description ==

= WP Grid Builder - Map Facet =

Create maps from Google Maps, Mapbox or Leaflet as filterable facets.
This add-on allows to display markers (posts, terms or users) on a map from longitude and lagitude coordinates.
It can optionally filter content when panning the map.

This add-on also includes a Geolocation facet that allows you to search and filter by a location from Google or Mapbox APIs.
It is also possible to detect current user’s location thanks to browser Geolocation API (user’s location can be approximated based on the user’s IP).

**Key Features:**

* Google Maps API support
* Mapbox API support
* Leaflet API support (open-source)
* Geolocation field (Google & Mapbox APIs)
* Support marker clustering
* Support map panning to filter
* Compatible with Advanced Custom Fields

== Changelog ==

= 1.1.5 - April 7, 2021 =

* Fixed    Missing source when retrieving marker content in some contexts.

= 1.1.4 - February 9, 2021 =

* Updated  Map library assets (CSS/JS).
* Fixed    Issue when dragging Leaflet map on load.
* Fixed    Non-composited animations of pan to search checkbox.

= 1.1.3 - January 11, 2021 =

* Added    Geolocation distance block for the card builder and shortcode.
* Added    Possibility to sort by geolocation distance when content is filtered.
* Updated  Leaflet library assets and JS gestures library for Leaflet.
* Fixed    Issue with highlighted marker icon when overriding idle icon in geoJSON.

= 1.1.2 - November 23, 2020 =

* Fixed    Issue when resetting posts data in marker popup.
* Fixed    Issue with PHP 5.6 and facets detection in the page.
* Fixed    Issue with Rest API response.

= 1.1.1 - October 19, 2020 =

* Added    Compatibility with Elementor editor.
* Fixed    Issue with async or defer attribute on scripts.
* Fixed    CSS issue with autocomplete button colors.
* Fixed    CSS issue with pan to search tooltip.
* Fixed    Issue with Google Map width in grid sidebars on mobile devices.

= 1.1.0 - July 15, 2020 =

* Added    Geolocation facet (Google & Mapbox APIs).
* Fixed    Issue with Mapbox map filtering position.

= 1.0.4 - April 14, 2020 =

* Improved Map facet can now index any array containing lat and lng properties.
* Added    French translation of backend and frontend.
* Fixed    Issue with default marker icon in Leaflet map.

= 1.0.3 - March 25, 2020 =

* updated  Leaflet and Google Map assets.
* Fixed    JS issue when destroying Map instances.
* Fixed    JS issue when initializing Map after destroying it if no facet content.
* Fixed    JS issue with highlight marker events and multiple Map instances.

= 1.0.2 - February 10, 2020 =

* Added    Compatibility with Multilingual add-on.

= 1.0.1 - November 18, 2019 =

* Added    New facet option to display "Pan to Search" checkbox over the map.
* Added    New facet option to highlight marker icon when hovering cards in grid.
* Added    Map grid and card demos available from the importer of WP Grid Builder (plugin Dashboard).

= 1.0.0 - November 4, 2019 =

* Initial release \o/
