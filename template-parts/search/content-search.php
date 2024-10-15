<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 6.1.0
 */


// Exit if accessed directly
defined('ABSPATH') || exit;

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="card horizontal mb-4">
    <div class="row g-0">

      <?php if (has_post_thumbnail()) : ?>
        <div class="col-lg-6 col-xl-5 col-xxl-4">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium', array('class' => 'card-img-lg-start')); ?>
          </a>
        </div>
      <?php endif; ?>

      <div class="col">
        <div class="card-body">

          <?php bootscore_category_badge(); ?>

          <a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
            <?php the_title('<h2 class="blog-post-title h5">', '</h2>'); ?>
          </a>

          <?php if ('post' === get_post_type()) : ?>
            <p class="meta small mb-2 text-body-secondary">
              <?php
              bootscore_date();
              bootscore_author();
              bootscore_comments();
              bootscore_edit();
              ?>
            </p>
          <?php endif; ?>

          <p class="card-text">
            <a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
              <?= strip_tags(get_the_excerpt()); ?>
            </a>
          </p>
          
          <p class="card-text">
            <a class="<?= apply_filters('bootscore/class/loop/read-more', 'read-more', 'content-search'); ?>" href="<?php the_permalink(); ?>">
              <?= apply_filters('bootscore/loop/read-more/text', __('Read more »', 'bootscore', 'content-search')); ?>
            </a>
          </p>

          <?php bootscore_tags(); ?>

        </div>
      </div>
    </div>
  </div>

</article>
<!-- #post-<?php the_ID(); ?> -->