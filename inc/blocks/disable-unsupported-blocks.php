<?php

/**
 * Experimantal: Disable unsupported blocks and patterns - Whitelist
 *
 * @package Bootscore
 * @version 6.2.0
 */


// Exit if accessed directly
defined('ABSPATH') || exit;


/**
 * Allow only supported blocks.
 */
add_filter('allowed_block_types_all', function ($allowed_blocks, $editor_context) {
  $supported_blocks = [

    // Text
    'core/paragraph',
    'core/heading',
    'core/list',
    'core/list-item',
    'core/quote',
    'core/code',
    'core/preformatted',
    'core/table',
    'core/freeform',

    // Media
    'core/image',
    'core/gallery',
    'core/audio',
    'core/video',

    // Design
    'core/button',
    'core/buttons',
    'core/group',
    'core/separator',
    'core/spacer',

    // Widgets
    'core/archives',
    'core/calendar',
    'core/categories',
    'core/html',
    'core/latest-comments',
    'core/latest-posts',
    'core/search',
    'core/shortcode',

    // Embeds
    'core/embed',

    // WooCommerce
    'woocommerce/product-categories',
    'woocommerce/classic-shortcode',
    'woocommerce/cart',
    'woocommerce/checkout',
  ];

  // Restrict in post editor or block-based widgets screen
  if (
    !empty($editor_context->post) ||
    (is_admin() && ($screen = get_current_screen()) && $screen->id === 'widgets')
  ) {
    return $supported_blocks;
  }

  return $allowed_blocks;
}, 10, 2);


/**
 * Disable all core block patterns.
 */
add_action('init', function () {
  remove_theme_support('core-block-patterns');
}, 9);

add_action('admin_init', function () {
  remove_theme_support('core-block-patterns');
});


/**
 * Disable all WooCommerce block patterns.
 */
add_action('wp_loaded', function () {
  if (!class_exists('WP_Block_Patterns_Registry')) {
    return;
  }

  $registry = WP_Block_Patterns_Registry::get_instance();
  $patterns = $registry->get_all_registered();

  foreach ($patterns as $pattern) {
    if (isset($pattern['name'])) {
      $name = $pattern['name'];
      if (
        strpos($name, 'woocommerce/') === 0 ||
        strpos($name, 'woocommerce-blocks/') === 0
      ) {
        unregister_block_pattern($name);
      }
    }
  }
}, 20);

/**
 * Disable all WooCommerce patterns.
 */
function bootscore_disable_all_woocommerce_patterns() {
  if (!class_exists('WP_Block_Patterns_Registry')) {
    return;
  }

  $registry = WP_Block_Patterns_Registry::get_instance();
  foreach ($registry->get_all_registered() as $pattern) {
    if (isset($pattern['name'])) {
      $name = $pattern['name'];
      if (strpos($name, 'woocommerce/') === 0 || strpos($name, 'woocommerce-blocks/') === 0) {
        unregister_block_pattern($name);
      }
    }
  }
}
add_action('init', 'bootscore_disable_all_woocommerce_patterns', 20);
