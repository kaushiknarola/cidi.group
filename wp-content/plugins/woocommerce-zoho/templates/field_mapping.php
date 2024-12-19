<?php 
if( !defined( 'ABSPATH' ) ) exit;
 
	/* get config data */
	global $wpdb;
	$config_table=$wpdb->prefix.'woo_zoho_crm';	
	$config_row = $wpdb->get_row( "SELECT * FROM $config_table" );
	/* end get config data */
	if ( current_user_can( 'activate_plugins' ) && current_user_can( 'update_core' ) ) {				
		/* Customer Fields */
		$customerFields = array(
			'nickname' => array(
					'title' => 'Nickname',
					'input_type'  => 'text',
				),
			'first_name' => array(
					'title' => 'First Name',
					'input_type'  => 'text',
				),
			'last_name' => array(
					'title' => 'last Name',
					'input_type'  => 'text',
				),
			'email' => array(
				'title' => 'Email',
				'input_type'  => 'email',
			),
			'description' => array(
					'title' => 'Description',
					'input_type'  => 'textarea',
				),
			'billing_first_name' => array(
					'title' => 'Billing First Name',
					'input_type'  => 'text',
				),
			'billing_last_name' => array(
					'title' => 'Billing Last Name',
					'input_type'  => 'text',
				),
			'billing_address_1' => array(
					'title' => 'Billing Address 1',
					'input_type'  => 'text',
				),
			'billing_city' => array(
					'title' => 'Billing City',
					'input_type'  => 'text',
				),
			'billing_state' => array(
					'title' => 'Billing State',
					'input_type'  => 'text',
				),
			'billing_postcode' => array(
					'title' => 'Billing Postcode',
					'input_type'  => 'text',
				),
			'billing_country' => array(
					'title' => 'Billing Country',
					'input_type'  => 'text',
				),
			'billing_email' => array(
					'title' => 'Billing Email',
					'input_type'  => 'text',
				),
			'billing_phone' => array(
				'title' => 'Billing Phone',
				'input_type'  => 'text',
			),
			'billing_company' => array(
				'title' => 'Billing Company',
				'input_type'  => 'text',
			),
			'shipping_first_name' => array(
				'title' => 'Shipping First Name',
				'input_type'  => 'text',
			),
			'shipping_last_name' => array(
				'title' => 'Shipping Last Name',
				'input_type'  => 'text',
			),
			'shipping_company' => array(
				'title' => 'Shipping Company',
				'input_type'  => 'text',
			),
			'shipping_address_1' => array(
				'title' => 'Shipping Address 1',
				'input_type'  => 'text',
			),
			'shipping_city' => array(
				'title' => 'Shipping City',
				'input_type'  => 'text',
			),
			'shipping_state' => array(
				'title' => 'Shipping State',
				'input_type'  => 'text',
			),
			'shipping_postcode' => array(
				'title' => 'Shipping Postcode',
				'input_type'  => 'text',
			),
			'shipping_country' => array(
				'title' => 'Shipping Country',
				'input_type'  => 'text',
			)	
		);
		/* End Customer Fields */
		
		/* Products Fields */
		$productFields = array(
			'id' => array(
					'title' => 'Id',
					'input_type'  => 'double',
				),
			'name' => array(
					'title' => 'Name',
					'input_type'  => 'text',
				),
			/*'date_created' => array(
					'title' => 'Created Date',
					'input_type'  => 'dateTime',
				),
			'date_modified' => array(
					'title' => 'Modified Date',
					'input_type'  => 'dateTime',
				),*/
			'status' => array(
					'title' => 'Status',
					'input_type'  => 'picklist',
				),
			'featured' => array(
					'title' => 'Featured',
					'input_type'  => 'Double',
				),
			'catalog_visibility' => array(
					'title' => 'Catalog Visibility',
					'input_type'  => 'text',
				),
			'description' => array(
					'title' => 'Description',
					'input_type'  => 'textarea',
				),
			'short_description' => array(
					'title' => 'Short Description',
					'input_type'  => 'textarea',
				),
			'price' => array(
					'title' => 'Price',
					'input_type'  => 'currency',
				),
			'regular_price' => array(
					'title' => 'Regular Price',
					'input_type'  => 'currency',
				),
			'sale_price' => array(
					'title' => 'Sale Price',
					'input_type'  => 'currency',
				),
			'date_on_sale_from' => array(
					'title' => 'Sale Price Dates (From)',
					'input_type'  => 'dateTime',
				),
			'date_on_sale_to' => array(
					'title' => 'Sale Price Dates (To)',
					'input_type'  => 'dateTime',
				),
			'total_sales' => array(
					'title' => 'Total Sales',
					'input_type'  => 'double',
				),
			'tax_status' => array(
					'title' => 'Tax Status',
					'input_type'  => 'double',
				),
			'manage_stock' => array(
					'title' => 'Manage Stock',
					'input_type'  => 'double',
				),
			'stock_quantity' => array(
					'title' => 'Stock Quantity',
					'input_type'  => 'double',
				),
			'stock_status' => array(
					'title' => 'Stock Status',
					'input_type'  => 'double',
				),
			'backorders' => array(
					'title' => 'Backorders',
					'input_type'  => 'double',
				),
			'low_stock_amount' => array(
					'title' => 'Low Stock Amount',
					'input_type'  => 'double',
				),
			'sold_individually' => array(
					'title' => 'Sold Individually',
					'input_type'  => 'double',
				),
			'weight' => array(
					'title' => 'Weight',
					'input_type'  => 'double',
				),
			'length' => array(
					'title' => 'Length',
					'input_type'  => 'double',
				),
			'width' => array(
					'title' => 'Width',
					'input_type'  => 'double',
				),
			'height' => array(
					'title' => 'Height',
					'input_type'  => 'double',
				),
			'category_ids' => array(
					'title' => 'Categories',
					'input_type'  => 'double',
				),
			'purchase_note' => array(
					'title' => 'Purchase Notes',
					'input_type'  => 'textarea',
				),
			'meta_data' => array(
					'title' => 'Custom Fields',
					'input_type'  => 'textarea',
				),
		);

		$customAttributes = get_option( '_transient_wc_attribute_taxonomies');
		if(is_array($customAttributes) && count($customAttributes)){
			foreach($customAttributes as $_customAttribute){
				$key = 'custom_att-'.$_customAttribute->attribute_name;
				$productFields[$key]['title'] = $_customAttribute->attribute_label;
				$productFields[$key]['input_type'] = 'multiselectpicklist';
			}			
		}
		/* End Products Fields */
		/* Orders Fields */
		$orderFields = array(
			'id' => array(
					'title' => 'Id',
					'input_type'  => 'double',
				),
			'status' => array(
					'title' => 'Status',
					'input_type'  => 'picklist',
				),
			'prices_include_tax' => array(
					'title' => 'Prices Include Tax',
					'input_type'  => 'picklist',
				),
			'discount_total' => array(
					'title' => 'Discount Total',
					'input_type'  => 'picklist',
				),
			'discount_tax' => array(
					'title' => 'Discount Tax',
					'input_type'  => 'picklist',
				),
			'shipping_total' => array(
					'title' => 'Shipping Total',
					'input_type'  => 'picklist',
				),
			'shipping_tax' => array(
					'title' => 'Shipping Tax',
					'input_type'  => 'picklist',
				),
			'cart_tax' => array(
					'title' => 'Cart Tax',
					'input_type'  => 'picklist',
				),
			'total' => array(
					'title' => 'Total',
					'input_type'  => 'picklist',
				),
			'total_tax' => array(
					'title' => 'Total Tax',
					'input_type'  => 'picklist',
				),
			'customer_id' => array(
					'title' => 'Customer Id',
					'input_type'  => 'double',
				),
			'order_key' => array(
					'title' => 'Order Key',
					'input_type'  => 'picklist',
				),
			'billing_first_name' => array(
					'title' => 'Billing First Name',
					'input_type'  => 'text',
				),
			'billing_last_name' => array(
					'title' => 'Billing Last Name',
					'input_type'  => 'text',
				),
			'billing_company' => array(
					'title' => 'Billing Company',
					'input_type'  => 'text',
				),
			'billing_address_1' => array(
					'title' => 'Billing Street',
					'input_type'  => 'text',
				),
			'billing_city' => array(
					'title' => 'Billing City',
					'input_type'  => 'text',
				),
			'billing_state' => array(
					'title' => 'Billing State',
					'input_type'  => 'text',
				),
			'billing_postcode' => array(
					'title' => 'Billing Postcode',
					'input_type'  => 'text',
				),
			'billing_country' => array(
					'title' => 'Billing Country',
					'input_type'  => 'text',
				),
			'billing_email' => array(
					'title' => 'Billing Email',
					'input_type'  => 'text',
				),
			'billing_phone' => array(
					'title' => 'Billing Phone',
					'input_type'  => 'text',
				),
			'shipping_first_name' => array(
					'title' => 'Shipping First Name',
					'input_type'  => 'text',
				),
			'shipping_last_name' => array(
					'title' => 'Shipping Last Name',
					'input_type'  => 'text',
				),
			'shipping_company' => array(
					'title' => 'Shipping Company',
					'input_type'  => 'text',
				),
			'shipping_address_1' => array(
					'title' => 'Shipping Street',
					'input_type'  => 'text',
				),
			'shipping_city' => array(
					'title' => 'Shipping City',
					'input_type'  => 'text',
				),
			'shipping_state' => array(
					'title' => 'Shipping State',
					'input_type'  => 'text',
				),
			'shipping_postcode' => array(
					'title' => 'Shipping Postcode',
					'input_type'  => 'text',
				),
			'shipping_country' => array(
					'title' => 'Shipping Country',
					'input_type'  => 'text',
				),
			'payment_method' => array(
					'title' => 'Payment Method',
					'input_type'  => 'picklist',
				),
			'payment_method_title' => array(
					'title' => 'Payment Method Title',
					'input_type'  => 'picklist',
				),
			'transaction_id' => array(
					'title' => 'Transaction Id',
					'input_type'  => 'text',
				),
			'customer_ip_address' => array(
					'title' => 'Customer Ip Address',
					'input_type'  => 'text',
				),
			/* 'customer_user_agent' => array(
					'title' => 'customer_user_agent',
					'input_type'  => 'picklist',
				), */
			'customer_note' => array(
					'title' => 'Customer Note',
					'input_type'  => 'textarea',
				),
			'date_completed' => array(
					'title' => 'Date Completed',
					'input_type'  => 'dateTime',
				),
			'date_paid' => array(
					'title' => 'Date Paid',
					'input_type'  => 'dateTime',
				)/*,
			'duration' => array(
					'title' => 'Duration',
					'input_type'  => 'picklist',
				),
			'interest_rate' => array(
					'title' => 'Interest Rate',
					'input_type'  => 'picklist',
				)*/
			/* 'cart_hash' => array(
					'title' => 'cart_hash',
					'input_type'  => 'picklist',
				) */
		);
		
		
		
		
		/* $customer_orders = get_posts( array( 
											'post_type' => 'shop_order',
											'post_status'    => array_keys( wc_get_order_statuses() ),
											'posts_per_page'    => 1,
										) );

										// Going through each current customer orders
										foreach ( $customer_orders as $customer_order ) {
											$order = wc_get_order( $customer_order );					
											$order_data = $order->get_data(1085);										
											foreach($order_data as $key => $data){
												
												
													foreach($data as $data_key => $data_value){	
														
															echo '<option value="'.$key.'_'.$data_key.'">' .$key.'_'.$data_key. $data_value.'</option>';
																											}
												
												
											}
										} */
		
		
		
		/* End Orders Fields */
?>
		<div class="wrap">
			<?php 	
				echo "<h2>" . esc_html( __( 'Field Mapping', 'woocommerce-zoho-crm' ) ) . "</h2>";
				$field_table = $wpdb->prefix.'woo_zoho_crm_field_mapping';
				$field_row = $wpdb->get_results( "SELECT * FROM $field_table" );
						
				if(isset($_POST['btn-delete'])){	
					$id = sanitize_text_field($_POST['btn-delete']);
					$field_table = $wpdb->prefix.'woo_zoho_crm_field_mapping';
					$field_row = $wpdb->get_results( "DELETE FROM $field_table where `id`=".$id);
					if($field_row > 0){
						echo "<script>swal('Success', 'Successfully Deleted!', 'success').then(function(){
										location.reload();
									});						
							</script>";			
					}
				}
				if(isset($_POST['save'])){	
					global $wpdb;		
					$post_data=array(
						'zoho_field' => sanitize_text_field($_POST['zoho_field_mapping']),
						'zoho_field_type' =>  sanitize_text_field($_POST['zoho_field_type']),
						'woocommerce_field' => sanitize_text_field($_POST['woo_field_mapping']),
						'woo_field_type' =>  sanitize_text_field($_POST['woo_field_type']),
						'status' => sanitize_text_field($_POST['status']),
						'type' => sanitize_text_field($_POST['zoho_module']),
						'description' =>  sanitize_text_field($_POST['description'])
					);
					$wpdb->insert( $field_table, $post_data);
					echo "<meta http-equiv='refresh' content='0'>";
				}	
			?>
			<div class="container-fluid"> 
				<form class="form-horizontal" action="" method="POST">
					<div class="row"> 		
						<div class="col-sm-6">
							<?php echo "<br/><h5>" . esc_html( __( 'Add/Edit Field Mapping', 'woocommerce-zoho-crm' )) . "</h5><br/>"; ?>
							
							<div class="form-group row">
								<label class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Zoho Module', 'woocommerce-zoho-crm' ) ); ?></strong></label>
								<select id="zoho_module" name="zoho_module" class="col-sm-8" required>
									<option value=""><?php echo esc_html( __( 'Please Select Zoho Table', 'woocommerce-zoho-crm' ) ); ?></option>
									<option value="Contacts"><?php echo esc_html( __( 'Contacts', 'woocommerce-zoho-crm' ) ); ?></option>							
									<option value="Products"><?php echo esc_html( __( 'Products', 'woocommerce-zoho-crm' ) ); ?></option>
									<option value="SalesOrders"><?php echo esc_html( __( 'Sales Orders', 'woocommerce-zoho-crm' ) ); ?></option>
								</select>
							</div>	
							<?php
								$zohoobj = new wczcMakeApiCall();
								$method = "GET";
								$data = "";	
							?>							
							<div class="row form-group fields Contacts" id="Contacts">
								<label for="woo-field-mapping" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Woocommerce Field', 'woocommerce-zoho-crm' ) ); ?></strong></label>
								<select name="woo_field_mapping" id="user_meta" class="field-meta col-sm-8" onchange="setTypeOnFieldChange('woo_field_type',this);" required>
									<option value="">Select Woocommerce Field</option>
									<?php
										global $wpdb;
										$selectField = "SELECT woocommerce_field FROM ".$wpdb->prefix."woo_zoho_crm_field_mapping WHERE `type` = 'Contacts'";
										$usedFieldList = $wpdb->get_results($selectField);
										$usedFieldListArray = array();
										foreach($usedFieldList as $_usedFieldKey => $_usedFieldValue){
											$usedFieldListArray[$_usedFieldValue->woocommerce_field] = $_usedFieldValue->woocommerce_field;
										}	
										
										foreach($customerFields as $_key => $_data){
											if (isset($usedFieldListArray[$_key]) && $usedFieldListArray[$_key]){
												echo '<option data-input-type="'.$_data['input_type'].'" value="'.$_key.'" disabled>' . $_data['title'].' ('.ucwords($_data['input_type']).')' . '</option>';
											}else{
												echo '<option data-input-type="'.$_data['input_type'].'" value="'.$_key.'">' . $_data['title'] .' ('.ucwords($_data['input_type']).')' . '</option>';
											}
										}
										
									?>	
								</select>															
								<label for="zoho_field_mapping" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Zoho Field', 'woocommerce-zoho-crm' ) ); ?></strong></label>
								<select name="zoho_field_mapping" id="zoho_contact_field_mapping" class="zoho-field col-sm-8" onchange="setTypeOnFieldChange('zoho_field_type',this);" required>
									<option value="">Select Zoho Field</option>
									<?php
										global $wpdb;
										$selectField = "SELECT zoho_field FROM ".$wpdb->prefix."woo_zoho_crm_field_mapping WHERE `type` = 'Contacts'";
										$usedFieldList = $wpdb->get_results($selectField);
										$usedFieldListArray = array();
										foreach($usedFieldList as $_usedFieldKey => $_usedFieldValue){
											$usedFieldListArray[$_usedFieldValue->zoho_field] = $_usedFieldValue->zoho_field;
										}
										
										$url = $config_row->zoho_server_name. "/crm/v2/settings/fields?module=Contacts";																			
										$data_row = $zohoobj->makeApiCall($url,$method,$data);	
										
										$skipTypeArray = array('profileimage','ownerlookup','lookup');
										$skipFieldArray = array('Modified_Time','Created_Time','Full_Name','Is_Record_Duplicate','Last_Activity_Time');

										foreach($data_row['fields'] as $row){
											if(in_array($row['data_type'],$skipTypeArray)){
												continue;
											}

											if(in_array($row['api_name'],$skipFieldArray)){
												continue;
											}

											if (isset($usedFieldListArray[$row['api_name']]) && $usedFieldListArray[$row['api_name']]){
												echo '<option data-input-type="'.$row['data_type'].'" value="'.$row['api_name'].'" disabled>'.$row['field_label'].' ('.ucwords($row['data_type']).')'.'</option>';
											}else{
												echo '<option data-input-type="'.$row['data_type'].'" value="'.$row['api_name'].'">'.$row['field_label'].' ('.ucwords($row['data_type']).')'.'</option>';
											}											
										}
									?>
								</select>
							</div>
							<div class="row form-group fields Products" id="Products">
								<label for="woo-field-mapping" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Woocommerce Field', 'woocommerce-zoho-crm' ) ); ?></strong></label>
								<select name="woo_field_mapping" id="product_meta" class="field-meta col-sm-8" onchange="setTypeOnFieldChange('woo_field_type',this);" required>
									<option value="">Select Woocommerce Field</option>
									<?php
										global $wpdb;
										$selectField = "SELECT woocommerce_field FROM ".$wpdb->prefix."woo_zoho_crm_field_mapping WHERE `type` = 'Products'";
										$usedFieldList = $wpdb->get_results($selectField);
										$usedFieldListArray = array();
										foreach($usedFieldList as $_usedFieldKey => $_usedFieldValue){
											$usedFieldListArray[$_usedFieldValue->woocommerce_field] = $_usedFieldValue->woocommerce_field;
										}

										foreach($productFields as $_key => $_data){
											if (isset($usedFieldListArray[$_key]) && $usedFieldListArray[$_key]){
												echo '<option data-input-type="'.$_data['input_type'].'" value="'.$_key.'" disabled>' . $_data['title'].' ('.ucwords($_data['input_type']).')' . '</option>';
											}else{
												echo '<option data-input-type="'.$_data['input_type'].'" value="'.$_key.'">' . $_data['title'] .' ('.ucwords($_data['input_type']).')' . '</option>';
											}
										}										
									?>	
								</select>								
								<label for="zoho_field_mapping" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Zoho Field', 'woocommerce-zoho-crm' ) ); ?></strong></label>
								<select name="zoho_field_mapping" id="zoho_product_field_mapping" class="zoho-field col-sm-8" onchange="setTypeOnFieldChange('zoho_field_type',this);" required>
									<option value="">Select Zoho Field</option>
									<?php
										global $wpdb;
										$selectField = "SELECT zoho_field FROM ".$wpdb->prefix."woo_zoho_crm_field_mapping WHERE `type` = 'Products'";
										$usedFieldList = $wpdb->get_results($selectField);
										$usedFieldListArray = array();
										foreach($usedFieldList as $_usedFieldKey => $_usedFieldValue){
											$usedFieldListArray[$_usedFieldValue->zoho_field] = $_usedFieldValue->zoho_field;
										}										
										$url = $config_row->zoho_server_name. "/crm/v2/settings/fields?module=Products";				
										$data_row = $zohoobj->makeApiCall($url,$method,$data);

										$skipTypeArray = array('profileimage','ownerlookup','lookup');
										$skipFieldArray = array('Modified_Time','Created_Time');
						
										foreach($data_row['fields'] as $row){
											if(in_array($row['data_type'],$skipTypeArray)){
												continue;
											}

											if(in_array($row['api_name'],$skipFieldArray)){
												continue;
											}

											if (isset($usedFieldListArray[$row['api_name']]) && $usedFieldListArray[$row['api_name']]){
												echo '<option data-input-type="'.$row['data_type'].'" value="'.$row['api_name'].'" disabled>'.$row['field_label'].' ('.ucwords($row['data_type']).')'.'</option>';
											}else{
												echo '<option data-input-type="'.$row['data_type'].'" value="'.$row['api_name'].'">'.$row['field_label'].' ('.ucwords($row['data_type']).')'.'</option>';
											}											
										}							
									?>
								</select>								
							</div>
							<div class="row form-group fields SalesOrders" id="SalesOrders">
								<label for="woo-field-mapping" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Woocommerce Field', 'woocommerce-zoho-crm' ) ); ?></strong></label>
								<select name="woo_field_mapping" id="woo_salesorder_field_mapping" class="field-meta col-sm-8" onchange="setTypeOnFieldChange('woo_field_type',this);" required>
									<option value="">Select Woocommerce Field</option>
									<?php
										global $wpdb;
										$selectField = "SELECT woocommerce_field FROM ".$wpdb->prefix."woo_zoho_crm_field_mapping WHERE `type` = 'SalesOrders'";
										$usedFieldList = $wpdb->get_results($selectField);
										$usedFieldListArray = array();
										foreach($usedFieldList as $_usedFieldKey => $_usedFieldValue){
											$usedFieldListArray[$_usedFieldValue->woocommerce_field] = $_usedFieldValue->woocommerce_field;
										}									
										
										foreach($orderFields as $_key => $_data){
											if (isset($usedFieldListArray[$_key]) && $usedFieldListArray[$_key]){
												echo '<option data-input-type="'.$_data['input_type'].'" value="'.$_key.'" disabled>' . $_data['title'].' ('.ucwords($_data['input_type']).')' . '</option>';
											}else{
												echo '<option data-input-type="'.$_data['input_type'].'" value="'.$_key.'">' . $_data['title'] .' ('.ucwords($_data['input_type']).')' . '</option>';
											}
										}																						
									?>	
								</select>								
								<label for="zoho_field_mapping" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Zoho Field', 'woocommerce-zoho-crm' ) ); ?></strong></label>
								<select name="zoho_field_mapping" id="zoho_salesorder_field_mapping" class="zoho-field col-sm-8" onchange="setTypeOnFieldChange('zoho_field_type',this);" required>
									<option value="">Select Zoho Field</option>
									<?php
										$selectField = "SELECT zoho_field FROM ".$wpdb->prefix."woo_zoho_crm_field_mapping WHERE `type` = 'SalesOrders'";
										$usedFieldList = $wpdb->get_results($selectField);
										$usedFieldListArray = array();
										foreach($usedFieldList as $_usedFieldKey => $_usedFieldValue){
											$usedFieldListArray[$_usedFieldValue->zoho_field] = $_usedFieldValue->zoho_field;
										}
										
										$url = $config_row->zoho_server_name. "/crm/v2/settings/fields?module=Sales_Orders";										
										$data_row = $zohoobj->makeApiCall($url,$method,$data);
										
										$skipTypeArray = array('profileimage','ownerlookup','lookup');
										$skipFieldArray = array('Modified_Time','Created_Time','SO_Number','Subject','Purchase_Order');
										foreach($data_row['fields'] as $row){
											if(in_array($row['data_type'],$skipTypeArray)){
												continue;
											}
											if(in_array($row['api_name'],$skipFieldArray)){
												continue;
											}
											
											if (isset($usedFieldListArray[$row['api_name']]) && $usedFieldListArray[$row['api_name']]){
												echo '<option data-input-type="'.$row['data_type'].'" value="'.$row['api_name'].'" disabled>'.$row['field_label'].' ('.ucwords($row['data_type']).')'.'</option>';
											}else{
												echo '<option data-input-type="'.$row['data_type'].'" value="'.$row['api_name'].'">'.$row['field_label'].' ('.ucwords($row['data_type']).')'.'</option>';
											}
										}
									?>
								</select>
							</div>
							<div class="form-group row">
								<label for="status" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Status', 'woocommerce-zoho-crm' ) ); ?></strong></label>
								<select id="status" name="status" class="col-sm-8">
									<option value="1"><?php echo esc_html( __( 'Active', 'woocommerce-zoho-crm' ) ); ?></option>
									<option value="0"><?php echo esc_html( __( 'Inactive', 'woocommerce-zoho-crm' ) ); ?></option>
								</select>
							</div>
							<div class="form-group row">
								<label for="description" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Description', 'woocommerce-zoho-crm' ) ); ?></strong></label>
								<textarea id="description" name="description" class="col-sm-8"></textarea>
							</div>
							<input type="hidden" id="woo_field_type" name="woo_field_type" value="">
							<input type="hidden" id="zoho_field_type" name="zoho_field_type" value="">
							<div class="form-group row">
								<div class="col-sm-12">
									<button name="save" class="btn btn-default btn-info float-right" type="submit" value="Save changes"><?php echo esc_html( __( 'Save changes', 'woocommerce-zoho-crm' ) ); ?></button>
								</div>
							</div>				
						</div>				
					</div>
				</form>
			</div>
			<div class="table-responsive">
				<form class="form-horizontal" action="" method="POST">
					<table id="table-fieldmapping" class="display table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th><?php echo esc_html( __( 'Id', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Zoho Field', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Woocommerce Field', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Status', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Type', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Description', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'PreDefined', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Action', 'woocommerce-zoho-crm' ) ); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($field_row as $fields){ ?>  
								<tr>
									<td><?= $fields->id ?></td>
									<td><?= $fields->zoho_field ?></td>
									<td><?= $fields->woocommerce_field ?></td>
									<td><?= $fields->status ?></td>
									<td><?= $fields->type ?></td>
									<td><?= $fields->description ?></td>
									<td><?= $fields->is_predefined ?></td>
									<td>
										<?php if($fields->is_predefined != 'Yes'):?>
										<button id="<?= $fields->id ?>" type="submit" name="btn-delete" value="<?= $fields->id ?>" class="btn btn-danger">Delete</button>
										<?php endif;?>	
									</td>
								</tr>		
							<?php   }	?>
						</tbody>
						<tfoot>
							<tr>
								<th><?php echo esc_html( __( 'Id', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Zoho Field', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Woocommerce Field', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Status', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Type', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Description', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'PreDefined', 'woocommerce-zoho-crm' ) ); ?></th>
								<th><?php echo esc_html( __( 'Action', 'woocommerce-zoho-crm' ) ); ?></th>
							</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</div>		
		<script type="text/javascript">
			function setTypeOnFieldChange(typeElementId,element){
				jQuery("#"+	typeElementId).val(jQuery(element).children("option:selected").data('input-type'));
			}
		</script>
<?php   
	}