<?php
/**
 * 404 template.
 *
 * @package MrCloneAI
 */

get_header();
?>

<main>
	<section id="notfound" aria-label="Page not found" style="min-height:70vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:12vh 6vw;">
		<div>
			<h1 style="font-size:clamp(3rem,12vw,8rem);line-height:.9;margin:0 0 .3em;">404</h1>
			<p style="font-size:clamp(1rem,2.4vw,1.4rem);opacity:.8;margin:0 0 2em;">
				This page slipped out of frame.
			</p>
			<a class="btn btn-solid" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to Home</a>
			&nbsp;
			<a class="btn" href="<?php echo mrclone_booking_url(); ?>" target="_blank" rel="noopener">Book a Consultation</a>
		</div>
	</section>
</main>

<?php get_footer(); ?>
