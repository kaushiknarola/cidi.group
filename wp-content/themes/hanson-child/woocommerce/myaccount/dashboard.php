<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
	// Default Dashboard Text
	printf(
		// translators: 1: user display name 2: logout url
		__( 'Hi %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url() )
	);

	// Default Dashboard Text
	printf(
		__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
*/

/**
 * Woo Commerce My Account -> Dashboard ( My Dashboard )
 * @author KK
 * @return Display Table on My Dashboard Page.
 */
	$customer_orders = get_posts(array(
		'numberposts' => -1,
		'meta_key' => '_customer_user',
		'orderby' => 'date',
		'order' => 'DESC',
		'meta_value' => get_current_user_id(),
		'post_type' => wc_get_order_types(),
		'post_status' => array_keys(wc_get_order_statuses()), 'post_status' => array('wc-completed'),
	));
	
	if($customer_orders) {
?>
		<table class="theme-table table-striped borderless">
			<caption class="cap-title">Purchases</caption>
			<thead>
				<tr>
					<th>Order</th>
					<th>Order Date</th>
					<th>Order Completion Date</th>
					<th>Amount</th>
					<th>Interest</th>
					<th>Duration</th>
					<th>Return</th>
					<th>Repayment Date</th>
					<th>Repayment Amount</th>
				</tr>
			</thead>
			<tbody>
<?php
		$grand_total = $grand_return = $grand_total_return = $total = 0;
		foreach ($customer_orders as $customer_order) {
			$order_result = wc_get_order($customer_order);
			$order_data = $order_result->get_data();
			$order_items = $order_result->get_items();
			$total = $order_result->get_total();
			$order_date = $order_data['date_created']->date('m/d/Y');
			$order_paid_date = $order_result->get_date_paid()->date('m/d/Y');
			foreach ($order_items as $item_id => $item_data) {
				$duration = $order_result->get_item_meta($item_id, 'duration', true);
				$interest = $order_result->get_item_meta($item_id, 'interest_rate', true);
			}

			$return = $total * $interest * $duration / 100;
			$temp_date = strtotime($order_paid_date);
			$new_date = strtotime('+ '.$duration.'+14 days', $temp_date);
			$repayment_date = date('m/d/Y', $new_date);
			$return_amount = $total + $return;

			$grand_total = $total + $grand_total;
			$grand_return = $grand_return + $return;
			$grand_total_return = $grand_total_return + $return_amount;
			echo '<tr>
					<td><a href="/my-account/view-order/'.$customer_order->ID.'/">#'.$customer_order->ID.'</a></td>
					<td>'.$order_date.'</td>
					<td>'.$order_paid_date.'</td>
					<td>'.$total.'</td>
					<td>'.$interest.'</td>
					<td>'.$duration.'</td>
					<td>'.number_format($return,2,'.','').'</td>
					<td>'.$repayment_date.'</td>
					<td>'.number_format($return_amount,2,'.','').'</td>
				</tr>';
		}
?>
				<tr>
					<td>Total</td>
					<td> - </td>
					<td> - </td>
					<td><?php echo number_format($grand_total,2,'.',''); ?></td>
					<td> - </td>
					<td> - </td>
					<td><?php echo number_format($grand_return,2,'.',''); ?></td>
					<td> - </td>
					<td><?php echo number_format($grand_total_return,2,'.',''); ?></td>
				</tr>
			</tbody>
		</table>
		<br />

		<table class="theme-table table-striped borderless td-center">
		<caption class="cap-title">Repayments Status</caption>
			<thead>
				<tr>
					<th>Order</th>
					<th style="width: 70%">Interest repayments received held by cidi</th>
					<th> % </th>
					<th>Fully Repaid</th>
				</tr>
			</thead>
			<tbody>
<?php
		foreach ($customer_orders as $customer_order) {
			$order_result = wc_get_order($customer_order);
			$order_data = $order_result->get_data();
			$order_items = $order_result->get_items();
			//$order_date = $order_data['date_created']->date('m/d/Y');
			$order_date = $order_result->get_date_paid()->date('m/d/Y');
			$flag = '';

			foreach ($order_items as $item_id => $item_data) {
				$duration = $order_result->get_item_meta($item_id, 'duration', true);
				$interest = $order_result->get_item_meta($item_id, 'interest_rate', true);
			}
			
			$date1 = date_create($order_date);
			$date2 = date_create('now');
			$diff = date_diff($date1,$date2);
			$current_month = round($diff->days / 30);
			$percentageRounded = round( $current_month / ( $duration * 12 ) * 100 );
			if($percentageRounded >= 100) {
				$percentageRounded = 100;
				$flag = 'Yes';
			} else {
				$flag = 'No';
			}

			echo '<tr>
					<td><a href="/my-account/view-order/'.$customer_order->ID.'/">#'.$customer_order->ID.'</a></td>
					<td>
						<div class="status_main_bg">
							<div class="status_color_bg" style="width:'.$percentageRounded.'%;" ></div>
						</div>
					</td>
					<td>'.$percentageRounded.'%</td>
					<td>'.$flag.'</td>
				  </tr>';
		}
?>
			</tbody>
		</table>
<?php
	$total = 0;
	foreach ($customer_orders as $customer_order) {
		$orderq = wc_get_order($customer_order);
		$total = $total + $orderq->get_total();
	}
?>
		<br />
		<table class="borderless border-none theme-bg">
		<caption class="cap-title">Impact you generated</caption>
		<tbody>
			<tr>
				<td class="s-title">Employment created</td>
				<td class="s-data"><?php echo ($total / 1000 ); ?></td>
			</tr>
			<tr>
				<td class="s-title">Families supported</td>
				<td class="s-data"><?php echo ($total / 1000 ); ?></td>
			</tr>
			<tr>
				<td class="s-title">Children supported</td>
				<td class="s-data"><?php echo (($total / 1000 ) * 3 ); ?></td>
			</tr>
			<tr>
				<td class="s-title">Livelihoods supported</td>
				<td class="s-data"><?php echo (($total / 1000 ) * 5 ); ?></td>
			</tr>
		</tbody>
	</table>
	<br/>
<?php
	} else {
		printf(
		__( 'Your Dashboard is empty, when you make your first purchase you will be shown, your purchases,  your legal documents and the impact you generate through your purchase', 'woocommerce' )
		);
	}
?>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
