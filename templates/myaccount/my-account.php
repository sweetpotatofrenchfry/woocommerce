<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages(); ?>

<p class="myaccount_user"><?php printf( __( 'Hello, <strong>%s</strong>. From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">change your password</a>.', 'woocommerce' ), $current_user->display_name, get_permalink( woocommerce_get_page_id( 'change_password' ) ) ); ?></p>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php if ( $downloads = $woocommerce->customer->get_downloadable_products() ) : ?>

<h2><?php _e( 'Available downloads', 'woocommerce' ); ?></h2>

<ul class="digital-downloads">
	<?php foreach ( $downloads as $download ) : ?>
		
		<li>
			<?php  
				do_action( 'woocommerce_available_download_start', $download );

				if ( is_numeric( $download['downloads_remaining'] ) )
					echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'woocommerce' ), $download['downloads_remaining'] ) . '</span> ', $download );
				
				echo apply_filters( 'woocommerce_available_download_link', '<a href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download );
			
				do_action( 'woocommerce_available_download_end', $download ); 
			?>
		</li>
		
	<?php endforeach; ?>
</ul>

<?php endif; ?>

<h2><?php _e( 'Recent Orders', 'woocommerce' ); ?></h2>

<?php woocommerce_get_template( 'myaccount/my-orders.php', array( 'recent_orders' => $recent_orders ) ); ?>

<h2><?php _e( 'My Address', 'woocommerce' ); ?></h2>

<p class="myaccount_address"><?php _e( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ); ?></p>

<?php woocommerce_get_template( 'myaccount/my-address.php' ); ?>

<?php do_action( 'woocommerce_after_my_account' ); ?>