<?php

/**
 * WP User Frotnend Bank gateway
 *
 * @since 2.1.4
 * @package WP User Frontend
 */
class WPUF_Gateway_Bank {

    function __construct() {
        add_action( 'wpuf_gateway_bank', array($this, 'prepare_to_send') );
        add_action( 'wpuf_options_payment', array($this, 'payment_options') );
        add_action( 'wpuf_gateway_bank_order_submit', array($this, 'order_notify_admin') );
        add_action( 'wpuf_gateway_bank_order_complete', array($this, 'order_notify_user'), 10, 2 );
    }

    /**
     * Adds paypal specific options to the admin panel
     *
     * @param type $options
     * @return string
     */
    function payment_options( $options ) {
        $pages = wpuf_get_pages();

        $options[] = array(
            'name' => 'gate_instruct_bank',
            'label' => __( 'Bank Instruction', 'wp-user-frontend' ),
            'type' => 'textarea',
            'default' => "Make your payment directly into our bank account."
        );

        $options[] = array(
            'name' => 'bank_success',
            'label' => __( 'Bank Payment Success Page', 'wp-user-frontend' ),
            'desc' => __( 'After payment users will be redirected here', 'wp-user-frontend' ),
            'type' => 'select',
            'options' => $pages
        );

        return $options;
    }

    /**
     * Prepare the payment form and send to paypal
     *
     * @since 0.8
     * @param array $data payment info
     */
    function prepare_to_send( $data ) {

        $order_id = wp_insert_post( array(
            'post_type'   => 'wpuf_order',
            'post_status' => 'publish',
            'post_title'  => 'WPUF Bank Order'
        ) );

        $data['price'] = isset( $data['price'] ) ? empty( $data['price'] ) ? 0 : $data['price'] : 0;

        if ( isset( $_POST['coupon_id'] ) && !empty( $_POST['coupon_id'] ) ) {
            $data['price'] = WPUF_Coupons::init()->discount( $data['price'], $_POST['coupon_id'], $data['item_number'] );
        }

        $data['subtotal'] = $data['price'];
        $data['price']    = apply_filters( 'wpuf_payment_amount', $data['price'] );
        $data['tax']      = floatval( $data['price'] ) - floatval( $data['subtotal'] );

        if ( $order_id ) {
            update_post_meta( $order_id, '_data', $data );
        }

        do_action( 'wpuf_gateway_bank_order_submit', $data, $order_id );

        $success = get_permalink( wpuf_get_option( 'bank_success', 'wpuf_payment' ) );
        wp_redirect( $success );
        exit;
    }

    /**
     * Send payment received mail
     *
     * @param array $info payment information
     */
    function order_notify_admin() {

        $subject  = sprintf( __( '[%s] New Bank Order Received', 'wp-user-frontend' ), get_bloginfo( 'name' ) );
        $msg      = sprintf( __( 'New bank order received at %s, please check it out: %s', 'wp-user-frontend' ), get_bloginfo( 'name' ), admin_url( 'admin.php?page=wpuf_transaction' ) );

        $receiver = get_bloginfo( 'admin_email' );
        $subject  = apply_filters( 'wpuf_mail_bank_admin_subject', $subject );
        $msg      = apply_filters( 'wpuf_mail_bank_admin_body', $msg );

        wp_mail( $receiver, $subject, $msg );
    }

    /**
     * Send payment confirm mail to the user
     *
     * @param array $info payment information
     */
    function order_notify_user( $transaction, $order_id ) {
        $user = get_user_by( 'id', $transaction['user_id'] );

        if ( ! $user ) {
            return;
        }

        $subject = sprintf( __( '[%s] Payment Received', 'wp-user-frontend' ), get_bloginfo( 'name' ) );
        $msg     = sprintf( __( 'Hello %s,', 'wp-user-frontend' ), $user->display_name ) . "\r\n";
        $msg     .= __( 'We have received your bank payment.', 'wp-user-frontend' ). "\r\n\r\n";
        $msg     .= __( 'Thanks for being with us.', 'wp-user-frontend' ). "\r\n";

        $subject = apply_filters( 'wpuf_mail_bank_user_subject', $subject );
        $msg     = apply_filters( 'wpuf_mail_bank_user_body', $msg );

        wp_mail( $user->user_email, $subject, $msg );

        // finally delete the order post
        wp_delete_post( $order_id, true );
    }

}

$wpuf_gateway_bank = new WPUF_Gateway_Bank();