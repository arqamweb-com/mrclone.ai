<?php
/**
 * 404 template.
 *
 * @package MrCloneAI
 */

get_header();
?>

<main id="top">
  <section class="notfound">
    <div class="wrap">
      <h1 class="grad">404</h1>
      <p>This page slipped out of frame.</p>
      <div class="hero-ctas">
        <a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to home</a>
        <a class="btn btn-link" href="<?php echo esc_url( mrclone_anchor( 'apply' ) ); ?>">Apply</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
