<?php
/**
 * Header — document head and the sticky nav.
 *
 * @package MrCloneAI
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="nav">
  <div class="wrap">
    <a class="mark" href="<?php echo esc_url( mrclone_anchor( 'top' ) ); ?>" aria-label="MrClone.AI home">MrClone<i>.</i>AI</a>
    <nav aria-label="Main"><ul>
      <li><a href="<?php echo esc_url( mrclone_anchor( 'twin' ) ); ?>">The Twin</a></li>
      <li><a href="<?php echo esc_url( mrclone_anchor( 'results' ) ); ?>">Results</a></li>
      <li><a href="<?php echo esc_url( mrclone_anchor( 'plans' ) ); ?>">Plans</a></li>
      <li><a href="<?php echo esc_url( mrclone_anchor( 'faq' ) ); ?>">FAQ</a></li>
    </ul></nav>
    <a class="btn btn-primary" href="<?php echo esc_url( mrclone_anchor( 'apply' ) ); ?>" data-plan="">Apply</a>
  </div>
</header>
