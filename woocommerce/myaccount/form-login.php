<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
	<!-- account-enter -->
		<section class="account-enter">
            <div class="account-enter__container">

                <?php do_action( 'woocommerce_before_customer_login_form' ); ?>
			    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	                <div class="account-enter__body u-columns col2-set" id="customer_login">

                <?php endif; ?>                
                    
                        <div class="account-enter__col">
                            <div id="customer_login" class="account-enter__form">
                                <div class="account-enter__form-title">Если вы ранее уже регистрировались на сайте</div>
                                <div class="account-enter__form-title">Вход по Email или Имени пользователя</div>
                                <?php wc_get_template('/includes/parts/wc-form-login.php'); ?>
                            </div>
                        </div>

                <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
                        
                        <div class="account-enter__col">
                            <div class="account-enter__form">
                                <div class="account-enter__form-title">Если вы впервые на сайте
                                    пройдите регистрацию
                                </div>
                                                          
                                <article class="form-register" data-target="tel">
                                    <?php wc_get_template('/includes/parts/wc-form-register.php'); ?> 
                                </article>
                        
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
                <?php do_action( 'woocommerce_after_customer_login_form' ); ?>  
            </div>
        </section>
	<!-- account-enter end -->



				
