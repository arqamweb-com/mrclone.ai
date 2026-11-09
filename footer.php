<?php
/**
 * Footer — brand, social links, developer credit and wp_footer().
 *
 * @package MrCloneAI
 */

?>
<footer>
  <div class="wrap">
    <div>
      <a class="mark" href="<?php echo esc_url( mrclone_anchor( 'top' ) ); ?>">MrClone<i>.</i>AI</a>
      <p class="tagline">Be Seen. Be Chosen.</p>
      <p style="margin-top:10px">Dubai, UAE · Serving clients worldwide · &copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> MrClone.AI</p>
    </div>
    <nav aria-label="Footer">
      <?php if ( mrclone_opt( 'instagram_url' ) ) : ?>
      <a href="<?php echo esc_url( mrclone_opt( 'instagram_url' ) ); ?>" target="_blank" rel="noopener">Instagram</a>
      <?php endif; ?>
      <?php if ( mrclone_opt( 'linkedin_url' ) ) : ?>
      <a href="<?php echo esc_url( mrclone_opt( 'linkedin_url' ) ); ?>" target="_blank" rel="noopener">LinkedIn</a>
      <?php endif; ?>
      <a href="<?php echo esc_url( mrclone_whatsapp_url() ); ?>" target="_blank" rel="noopener">WhatsApp</a>
      <a href="<?php echo esc_url( mrclone_anchor( 'apply' ) ); ?>">Apply</a>
    </nav>
    <p class="site-credit">
      <?php echo esc_html__( 'All rights reserved.', 'mrclone-ai' ); ?>
      <span aria-hidden="true"> · </span>
      <?php echo esc_html__( 'Developed by', 'mrclone-ai' ); ?>
      <a href="https://www.arqamweb.com" target="_blank" rel="noopener">Arqam Web</a>
    </p>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
