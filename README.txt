=== BELO Add to Cart Redirect for Woocommerce ===

Contributors:      cylas
Requires at least: 5.2 or higher
Tested up to:      6.1
Requires PHP:      5.6
Stable tag:        1.0.0
Donate link: belocodes@gmail.com
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Tags:              add to cart redirect, cart, checkout redirect, variation product cart redirect, single product cart redirect, global product cart redirect

Redirects customers to custom pages/location such as the checkout page for faster conversions and other purposes such as terms-of-use pages.

== Description ==

The BELO Add to Cart Redirect for Woocommerce plugin is a special tool used to redirect customers to desired locations on the site such as the checkout page after a product is added to the cart to boost conversion and sales. Other common use cases include redirecting customers to the terms and conditions or end-user license agreement pages.

Currently the plugin includes the following add to cart redirect modules:

* **Global redirect:** This sets a redirect for all products on the site.
* **Simple product redirect:** This sets a redirect location for only simple products.
* **Parent variation product redirect:** This sets a redirect location for all variation child products on the site.
* **Parent variation redirect:** This sets a redirect location for individual varation products on the site.
* **Grouped product redirect:** This sets a redirect location for only grouped products.

== Installation ==

= Installation from within WordPress =

1. Visit **Plugins > Add New**.
2. Search for **BELO Add to Cart Redirect for Woocommerce**.
3. Install and activate the BELO Add to Cart Redirect for Woocommerce plugin.

= Manual installation =

1. Upload the entire `belo-add-to-cart-redirect-for-woocommerce` folder to the `/wp-content/plugins/` directory.
2. Visit **Plugins**.
3. Activate the BELO Add to Cart Redirect for Woocommerce plugin.

= After activation =

1. For the global add to cart redirect visit **Woocommerce > Settings > Add To Cart Redirect** tab and then select the add to cart redirect location and enable it.
2. For the simple and parent variation products visit the **Product data > General > Add To Cart Redirect** section and then select the add to cart redirect location and update the product.
3. For the grouped products visit the **Product data > Inventory > Add To Cart Redirect** section and then select the add to cart redirect location and update the product.
4. For the variation child products visit each variation's edit section and locate the **Add To Cart Redirect** section and then select the add to cart redirect location and save changes and finally update the product.

= Execution priority =
* If the global redirect is set and enabled, it will override all other individual product redirects. Most common use cases include redirecting to the checkout page after add to cart for all products.
* If the global redirect is disabled, the individual product redirect configurations will be used. For variation products, the parent redirect can be configured as well as the child redirects. If you want to redirect all child variations to the same location, you can simply just set the parent variation redirect. By default all child variations redirect to the parent variation redirect. However, redirect can be changed and configured to any desired location for each of the child variations.

= Support for translation =
* If you are using wpml for translation, support is included in the BELO Add to Cart Redirect for Woocommerce for the global setting. This implies that you only have to set the redirect in the admin default editing language. The translation of this redirect is automatically picked up and used for the different languages on your site. The redirect in the product edit pages needs to be set for each language.
 

== Frequently Asked Questions ==

= What is the purpose of this plugin? =

The primary purpose of the BELO Add to Cart Redirect for Woocommerce plugin is to add the add to cart redirect support to a woocommerce site. This is achived at either the global level for all products or the individual product level. This plugin enables you to boost your conversion and sales by eliminating the longer default processes and giving you full control to the redirection that ocurs after a product is added to the cart.

 
= Where can I submit my plugin feedback? =

Especially since this is a collection of WordPress core feature plugins, providing feedback is encouraged and much appreciated! You can submit your feedback either in the [plugin support forum](https://wordpress.org/support/plugin/belo-add-to-cart-redirect-for-woocommerce/) or, if you have a specific issue to report, in its [GitHub repository](https://github.com/WordPress/belo-add-to-cart-redirect-for-woocommerce).

= How can I contribute to the plugin? =

Contributions welcome! There are several ways to contribute:

* Raise an issue or submit a pull request in the [Github repository for the plugin](https://github.com/WordPress/belo-add-to-cart-redirect-for-woocommerce)
* Translate the plugin into your language at [translate.wordpress.org](https://translate.wordpress.org/projects/wp-plugins/belo-add-to-cart-redirect-for-woocommerce)
* Join the weekly chat (Tuesdays at 16:00 UTC) in the [#performance channel on Slack](https://wordpress.slack.com/archives/belo-add-to-cart-redirect-for-woocommerce)

== Screenshots ==

1. Global add to cart redirect screen.
2. The dropdown select interface is depicted in this screenshot. It can be observed that the search functionality is included.
3. The add to cart redirect section for the simple products.
4. The add to cart redirect for the parent variation product. 
5. The child variation product's add to cart section. The default value is set to "Same as parent" which can be set as shown in the previous screenshot.
6. The add to cart redirect section for grouped products. The add to cart redirect fields are located under the inventory section of the product data.
== Changelog ==
 
= 1.0.0 =
Initial release


