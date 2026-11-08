<?php
/**
 * Footer — text-only footer and wp_footer().
 *
 * @package MrCloneAI
 */

?>
<footer class="site-footer">
	<div>MR.CLONE<span class="em">.AI</span> — Dubai, UAE and Global &nbsp;&middot;&nbsp; Serving UAE &amp; US</div>
	<div class="serif-line">&ldquo;Still you. Just not alone.&rdquo; &mdash; Ramses Othman, Founder</div>
	<div class="site-credit mx-auto max-w-7xl px-4 md:px-6 py-6 text-xs text-muted-foreground text-center">
        &copy;
        <span id="y"><?php echo esc_html(wp_date('Y')); ?></span> <?php bloginfo( 'name' ); ?><?php echo esc_html(__('. All rights reserved.', 'arqamweb')) ?>
        <span aria-hidden="true"> · </span>
        <?php echo esc_html(__('Developed by', 'arqamweb')) ?>
        <a href="https://www.arqamweb.com" class="arqam-credit hover:text-emerald"><?php echo esc_html(__('Arqam Web', 'arqamweb')) ?></a>

        <style>
            .arqam-credit:hover {
                color: var(--emerald);
            }
            .arqam-credit:focus-visible {
                outline: 2px solid gold;
                outline-offset: 3px;
            }
        </style>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
