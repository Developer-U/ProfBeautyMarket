<?php
  /*
   * Template name: Registration Form by username
   */
?>

    <form method="post" class="woocommerce-form woocommerce-form-register register">
      <?php do_action( 'woocommerce_register_form_start' ); ?>      

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="email" class="hero-cta__input woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
      </p>    
      <?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
          <input type="password" class="hero-cta__input woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
        </p>
      <?php endif; ?>
      <?php do_action( 'woocommerce_register_form' ); ?>
      <p class="woocommerce-FormRow form-row">
        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
        <button type="submit" class="hero-cta__button woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
      </p>
      <?php do_action( 'woocommerce_register_form_end' ); ?>
    </form>

