<?php
/** @var bool $success */
/** @var string $embedCode */
?>
<div class="cb-page">
    <img class="cb-logo" src="<?php echo plugins_url( 'img/ConvertBox-logo-wordpress.png', __FILE__ ); ?>">
	<?php if ( $success === null ): ?>
        <h1 class="cb-page-headline">You’re almost ready to go!</h1>
        <div class="cb-page-subheadline-area">
            <div class="cb-page-subheadline">Simply paste your account's unique code given to you on the</div>
            <div class="cb-page-subheadline">WordPress installation page into the box below and click submit.</div>
        </div>
	<?php endif; ?>
	<?php if ( $success === true ): ?>
        <span class="cb-status-icon cb-success fa fa-check"></span>
        <div class="cb-status-text cb-success">Your unique code has been successfully set!</div>
	<?php endif; ?>
	<?php if ( $success === false ): ?>
        <span class="cb-status-icon cb-fail fa fa-frown-o"></span>
        <div class="cb-status-text cb-fail">This code does not exist; please check you copied it correctly and try again!</div>
	<?php endif; ?>
    <form class="cb-form-wrapper"
          action=""
          method="POST">
          <?php wp_nonce_field('convertbox-code', 'convbox'); ?>
        <label for="convertbox-code" class="cb-hidden">Put your embed code here!</label>
        <input placeholder="Paste your unique code here" class="cb-input-area" id="convertbox-code" type="text" name="convertbox-code"
               value="<?php echo esc_attr( $embedCode ) ?>">
        <input class="cb-submit-button" type="submit">
    </form>
	<?php if ( $success === false || $success === null ): ?>
        <div class="dont-know-area">Don’t know your account's unique code? <a class="cb-link" target="_blank"
                href="https://app.convertbox.com/">Log in to your account</a>, click your profile photo, and click "Installation"!
        </div>
	<?php endif; ?>
</div>
