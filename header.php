<?php
/**
 * Header — document head, loader, cursor and the sticky site header.
 *
 * @package MrCloneAI
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>document.documentElement.classList.remove('no-js');</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="scroll-progress" id="scrollProgress"></div>
<div class="cursor-dot" id="curDot" aria-hidden="true"></div>
<div class="cursor-ring" id="curRing" aria-hidden="true"></div>
<div class="grain" aria-hidden="true"></div>

<div class="loader" id="loader" aria-hidden="true">
	<div class="l-brand">Mr.Clone.AI</div>
	<div class="l-count"><span id="lNum">0</span></div>
	<div class="l-bar"><i id="lBar"></i></div>
</div>

<header class="site-header">
	<a href="#hero" class="brand">MR.CLONE<em>.AI</em></a>
	<a href="<?php echo mrclone_booking_url(); ?>" target="_blank" rel="noopener" class="header-cta">Free Consultation</a>
</header>
