=== Taxonomy/Term and Role based Discounts for WooCommerce ===
Contributors: webdados
Donate link: https://www.paypal.me/Wonderm00n
Tags: woocommerce, ecommerce, e-commerce, webdados, wpml, discounts, discount, bulk, promotion, promotions, marketing, special offers, deals, dynamic princing, sales, category discount, taxanomy discounts, taxonomy, category, tag discount, tag, percentage discount, dynamic pricing, roles, role
Author URI: https://www.webdados.pt
Plugin URI: https://www.webdados.pt/wordpress/plugins/taxonomy-term-based-discounts-for-woocommerce/
Requires at least: 4.7
Tested up to: 5.7
Stable tag: 2.0.0

Lets you configure discounts/pricing rules for products based on any product taxonomy terms and WordPress user roles

== Description ==

Lets you configure discounts/pricing rules for products based on any WooCommerce product taxonomy terms (built-in or custom), in a very simple way.

The discount can be applied for all the users, logged in users or only for certain WordPress user roles.

Allows you to set a start and end date for each discount.

* WPML compatible (ability to set discounts on different languages terms, not tested with multi-currency).
* WooCommerce Subscriptions experimental support.

= Discount types =
* Percentage: apply an absolute percentage discount to all the products on a specific taxonomy term;
* Buy x get y free: offer y items when x (of the same product) are bought;

= Notes =
* The discounts are applied on a “per cart line” basis (not to sum of the products of the same taxonomy);
* Only one rule is applied per cart line, so setting the priorities correctly is very important;
* When aggregating product variations, the quantity will be the sum of the quantities of all the variations and the discount will be applied to all of them;
* For WPML users, if you want the same discounts to apply on all the languages, you must replicate the rules for each of the terms translations
* You can use the `tdw_rule_add`, `tdw_rule_edit` and `tdw_rule_delete` actions when adding, editing and deleting rules, to do whatever you want like, for example, clearing cache ([check out to to use them here](https://gist.github.com/webdados/98282475fbee2be347eba45ad81cbba5) and send us cool examples of what you’ve done)

== Installation ==

1. Use the included automatic install feature on your WordPress admin panel and search for “Taxonomy / Term based Discounts for WooCommerce”.
2. Activate the plugin through the `Plugins` menu in WordPress
3. Got to `Products`, `Taxonomy Discounts` to set it up


== Frequently Asked Questions ==

= I need help, can I get technical support? =

This is a free plugin. It’s our way of giving back to the wonderful WordPress community.

There’s a support tab on the top of this page, where you can ask the community for help. We’ll try to keep an eye on the forums but we cannot promise to answer support tickets.

If you reach us by email or any other direct contact means, we’ll assume you are in need of urgent, premium, and of course, paid-for support.

= Why is my product not showing the “Sale” badge? =

We can only show the “sale” badge when we are absolutely sure the product will get a discount, no matter how many do you buy.
So, the badge is only shown for percentage base rules with no minimum quantity required.

= How can I show the discount information on the product loop and page? =

This is still beta, so you have to add the actions and priority on where you want to show the discount information to your wp-config.php file:
`//Taxonomy/Term based discounts
define('WCTD_LOOP_DISC_INFO_ACTION', 'woocommerce_after_shop_loop_item_title');
define('WCTD_LOOP_DISC_INFO_PRIO', 7);
define('WCTD_PROD_DISC_INFO_ACTION', 'woocommerce_single_product_summary');
define('WCTD_PROD_DISC_INFO_PRIO', 6);`

This is for Storefront. You may have to tweak the action and priority to better match your theme.

= How can I replace the sale badge with the discount percentage? =

This is still beta, and only works for percentage discounts with a minimum quantity of 0 or 1, and you need to add this to your wp-config.php file:
`//Taxonomy/Term based discounts
define( 'WCTD_PERC_SALE_BADGE', true );`

= How can I get the current product or variation price, with the discount applied, outside the loop? =

You can use the `wctd_get_product_current_price` helper function with the product or variation object or id as the first argument.

You can also pass the quantity as the second argument, so that the calculations are made for percentage discounts with a minimum quantity higher than one or for “buy x get y free” discounts. The returned price will be the price per unit.

This is still beta.

== Changelog ==

= 2.0.0 - 2021-05-10 =
* Moved the settings to Products instead of WooCommerce
* Fix WPML compatibility on the admin
* If the `WCTD_ADVANCED_MODE` constant is set to true, a new “ID” field will be available for discount rules, which can be used by developers to identify a specific discount rule
* New `wctd_get_product_applied_rule` helper function to get the product applied rule, if any
* Added [Woocommerce Google Product Feed compatibility](https://woocommerce.com/products/google-product-feed/)
* Code refactoring
* Tested with WordPress 5.8-alpha-50832 and WooCommerce 5.3.0-rc.2
* Relase sponsored by [Planeta Tangerina](https://www.planetatangerina.com/en/) and [SuportesTV.pt](https://suportestv.pt/)

= 1.5.2 - 2021-03-10 =
* Tested with WordPress 5.8-alpha-50516 and WooCommerce 5.1.0

= 1.5.1 =
* Fix version number on the admin screen
* Technical support clarification
* Tested with WordPress 5.5-beta4-48649 and WooCommerce 4.3.1

= 1.5.0 =
* Fixed a bug which was causing subscriptions to have an incorrect value
* Process variable subscriptions just like regular variable products (Thanks for the heads up @snap-shot)
* Fix product variations aggregation
* Tested with WordPress 5.3.3-alpha-46995 and WooCommerce 3.9.0-rc.2

= 1.4.8 =
* Fixed a bug which was causing this discounted prices not to be shown on variable products (Thanks @drosendo)

= 1.4.7 =
* Fixed a bug which was causing the discounted prices not to be shown on the homepage
* Tested with WordPress 5.3.1-alpha-46771 and WooCommerce 3.8.1

= 1.4.6 =
* Fixed a bug which could cause products not on sale to show the sale badge (Thanks @drosendo)

= 1.4.5 =
* Fixed a bug which was causing PHP Notices (Thanks @drosendo)

= 1.4.4 =
* Tested with WordPress 5.2.5-alpha and WooCommerce 3.8.0

= 1.4.3 =
* New `tdw_custom_product_loop` that you should return true to inside your product custom loops so that the discounted price shows correctly (Thanks vinha.pt)
* Fix version number on the plugin admin interface
* Tested with WooCommerce 3.6.3 and WordPress 5.2.1

= 1.4.2 =
* Stop using the WooCommerce term meta helper functions
* Tested with WooCommerce 3.6.0 RC2 and WordPress 5.1.1

= 1.4.1 =
* Fix: php notice when product prices are set with more decimals than the ones defined on WooCommerce

= 1.4 =
* New `tdw_rule_add`, `tdw_rule_edit` and `tdw_rule_delete` actions when adding, editing or deleting rules (by @onlylowercaselettersandnumbers suggestion)
* Tested with WooCommerce 3.5.4 and WordPress 5.1

= 1.3 =
* New `wctd_get_product_current_price` helper function that developers can use to get the current product or variation price with the discount applied
* Better plugin initialization
* Minor code cleanup
* Tweaks on the admin page
* Fixed `WC tested up to` tag

= 1.2 =
* Beta: If you set the `WCTD_PERC_SALE_BADGE` constant to true, the sale badge will be replaced by the discount percentage, if the minimum quantity is 0 or 1
* Fix: when percentage discount was set for a minimum quantity of 1 and the discount was not shown on archives and single product page
* Fix: when the product had no price a php warning was thrown
* Tested with WooCommerce 3.5.4 and WordPress 5.1 (beta)

= 1.1 =
* It’s now possible to set rules for all users, logged in users or users belonging to specific user roles (sponsored by Amaranto Design)
* Better code indentation/standards
* If you set an integer value on the `WCTD_GET_PRICE_FILTER_PRIO` constant, that priority will be used on the `woocommerce_product_get_price` filter

= 1.0 =
* Now correctly shows the discount inside WooCommerce Product Shortcodes (sponsored by Amaranto Design)
* Small admin UX tweaks
* Tested with WooCommerce 3.5.1 and bumped `WC tested up to` tag
* Reached 1.0 for no special reason :-)

= 0.9.8 =
* Use `add_woocommerce_term_meta` and `update_woocommerce_term_meta` instead of `add_term_meta` and `update_term_meta`
* Bumped `WC tested up to` tag
* Bumped `Requires at least` tag

= 0.9.7 =
* Added the taxonomy internal name on the select field
* Bumped `WC tested up to` tag

= 0.9.6 =
* “Feed KuantoKusta for WooCommerce” (to be released) plugin integration fix

= 0.9.5 =
* Fix: some variation discounts were not applied correctly
* “Feed KuantoKusta for WooCommerce” (to be released) plugin integration

= 0.9 =
* Fix: after calculations, round the discounted price using the default WooCommerce decimal places, in order to avoid totals miscalculations
* Support for start and end date/time activated by default (no need to use the `WCTD_ENABLE_TIME` constant)

= 0.8.1 =
* Tested with WooCommerce 3.3
* Bumped `Tested up to` tag

= 0.8 =
* Fixed a bug where the end date of a discount would not be taken in account because 00:00:00 was assumed instead of 23:59:59;
* Experimental support for start and end date/time (you must define `WCTD_ENABLE_TIME` as true on your wp-config.php file for this feature to be enabled);

= 0.7.4 =
* Removed the translation files from the plugin `languages` folder (the translations are now managed on WordPress.org’s GlotPress tool and will be automatically downloaded from there)
* Tested with WooCommerce 3.2
* Added `WC tested up to` tag on the plugin main file
* Bumped `Tested up to` tag

= 0.7.3 =
* Fixed a bug where some “Buy x get y free” discounts would not be calculated correctly
* Bumped `Tested up to` tag

= 0.7.2 =
* Fixed a bug that would prevent ajax based backend actions to work correctly
* Fixed a (nasty) bug that would duplicate discounts each time the cart was loaded on WooComerce 3.0 and above

= 0.7.1 =
* Fixed a bug that would prevent ajax based frontends to apply discounts
* Fixed a bug where the sale price wouldn’t correctly set on WooCommerce 3.0 cart
* Beta: show sale flash on variable products and sale price on variations (after choosen on the product page)
* Beta: show discount information on the loop and product pages (see the FAQ)

= 0.7 =
* Tested and adapted to work with WooCommerce 3.0.0-rc.2
* Bumped `Tested up to` tag

= 0.6.2.1 =
* Bumped `Tested up to` tag

= 0.6.2 =
* Fix version number;

= 0.6.1 =
* Fix to avoid php notices when old rules don’t have the new “aggregate product variations” setting setup;

= 0.6 =
* New option on tjhe percentage discounts that allow to aggregate different product variations on the cart and count them all as if they were a single product, so that the discount will be applied to all of them;

= 0.5 =
* Increase compatibility with other plugins that manipulate the product value;
* Stop using the $woocommerce global;
* Tested with WordPress 4.6.1;

= 0.4 =
* New `wctd_get_product_ids_on_sale` function to get the product_id of all the products that have an active discount, similar to WooCommerce’s native `wc_get_product_ids_on_sale` (to be used by developers);
* Tested with WordPress 4.5;

= 0.3 =
* First public release;
* Minimum quantity on percentage discounts (leave empty or zero to apply to any quantity);
* Configuration screen changes for better UX;

= 0.2 =
* It’s now possible to disable further coupon discounts on top of our discounts, on a per rule basis:
* Fixed “Cart Discount” will not be allowed if any discounted product is in the cart, because WooCommerce distributes the fixed value over the several cart lines and the final discount would not be the total coupon value, which would not be very clear for the customer;
* The other coupon types, like “Cart % Discount”, “Product Discount” and “Product % Discount” will be applied only on cart lines where there’s no discounted products (that have a rule where “Disable coupons” is activated);

= 0.1 =
* First (non-public) release;