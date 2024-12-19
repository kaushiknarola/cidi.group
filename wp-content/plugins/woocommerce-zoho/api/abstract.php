<?php 
/* contact form 7 get id class */
class wczcleadfieldmapping {
	public function wczcleadcontent($post_content) {
		$data_type_array = array('text', 'email', 'date', 'checkbox', 'select', 'url', 'number', 'textarea', 'radio', 'quiz', 'file', 'acceptance', 'hidden', 'tel', 'dynamichidden');
		$contact_field_labels = array();
		foreach ($data_type_array as $dt_key => $dt_val) {
			$patternn = "(\[$dt_val(\s|\*\s)(.*)\])";
			preg_match_all($patternn, $post_content, $common_value);
			if (!empty($common_value[1])) {
				$contact_field_labels[] = $common_value[0];
			}
			$merge_array = array();
			foreach ($contact_field_labels as $contactformkey => $contactformvalue) {
				foreach ($contactformvalue as $contactform_get_key => $contactform_get_fields) {
					$merge_array[] = $contactform_get_fields;
				}
			}
		}
		return $merge_array;
	}
}		
/* end contact form 7 get id class */

class PrepareArray{
	protected $table;
	protected $zohoPostData;
	/* Contacts */
	public function prepareArrayForCustomer($id,$email){
		try{
			if($id != 0){
				global $wpdb;
				$this->table = $wpdb->prefix.'woo_zoho_crm_field_mapping';
				$CustomerArray = [];				
				$customerUserData = (array)get_userdata( $id );
				$customerUserMetdaData = get_user_meta( $id );
				
				if($customerUserMetdaData['first_name'][0] != '' && $customerUserMetdaData['last_name'][0] != ''){
					$this->zohoPostData = array(
						"Email"=>$customerUserData['data']->user_email,
						"First_Name"=>($customerUserMetdaData['first_name'][0]),
						"Last_Name"=>($customerUserMetdaData['last_name'][0])
					);
				}else if(isset($customerUserMetdaData['billing_first_name'][0]) && isset($customerUserMetdaData['billing_last_name'][0])){
					$this->zohoPostData = array(
						"Email"=>$customerUserData['data']->user_email,
						"First_Name"=>($customerUserMetdaData['billing_first_name'][0]),
						"Last_Name"=>($customerUserMetdaData['billing_last_name'][0])
					);
				}else{
					$this->zohoPostData = array(
						"Last_Name"=> $customerUserData['data']->user_nicename,
						"First_Name"=> $customerUserData['data']->user_nicename,						
						"Email"=>$customerUserData['data']->user_email,
					);
				}

				$records = $wpdb->get_results( "SELECT * FROM $this->table where `type`='Contacts' and status=1" );
				foreach($records as $record){
					$tempArray[$record->zoho_field] = $record->woocommerce_field;
				}

				$additionalArray = [];
				foreach($tempArray as $key => $value){
					if(array_key_exists($value,$customerUserMetdaData)){
						if(in_array($value,array('first_name','last_name')) && (!isset($customerUserMetdaData[$value][0]) || !$customerUserMetdaData[$value][0])){
							if(isset($customerUserMetdaData['billing_first_name'][0]) && isset($customerUserMetdaData['billing_last_name'][0])){
								$additionalArray[$key] = $customerUserMetdaData['billing_last_name'][0];
							}else{
								$additionalArray[$key] = $customerUserData['data']->user_nicename;
							}
						}else{
							$additionalArray[$key] = $customerUserMetdaData[$value][0];
						}
					}
				}
				$this->zohoPostData = array_merge($this->zohoPostData,$additionalArray);			
				$postData = json_encode(['data'=>[$this->zohoPostData]]);
				return $postData;
			}else{
				$get_order = array(
					'email' => $email,
				);
				$get_orderby_email = wc_get_orders( $get_order );
				foreach($get_orderby_email as $get_orderdata){
					$first_name = $get_orderdata->get_billing_first_name();
					$last_name = $get_orderdata->get_billing_last_name();
					$billing_email = $get_orderdata->get_billing_email();
				}
				if($billing_email != ''){
					$this->zohoPostData = array(
						"First_Name"=>$first_name,
						"Last_Name"=>$last_name,
						"Email"=>$billing_email,
					);
					$postData = json_encode(['data'=>[$this->zohoPostData]]);
					return $postData;
				}
			}
		}
		catch(\Exception $e){
			throw new Exception("Error PrepareArray for customer ".$e->getMessage());			
		}		
	}
	/* End Contacts */
	/* Products */
	public function prepareArrayForProducts($id){	
		try{
			$product = wc_get_product( $id );
			$productData = '';
			$productAdditionalData = [];
			$productData = [];
			$children_ids = $product->get_children();

			$productData = $product->get_data();
			$productAdditionalData = (array)get_post( $id );  
			$productData = array_merge($productData,$productAdditionalData);

			global $wpdb;
			$this->table = $wpdb->prefix.'woo_zoho_crm_field_mapping';		
			$records = $wpdb->get_results( "SELECT * FROM $this->table where `type`='Products' and status=1" );
	
			foreach($records as $record){
				$sub = substr($record->woocommerce_field, 0, 11);
				if($sub == 'custom_att-'){
					$originalKey = substr($record->woocommerce_field, 11);
					$productDataValue = $product->get_attribute('pa_'.$originalKey);
				}else{
					if(!isset($productData[$record->woocommerce_field])){
						continue;
					}
					$productDataValue = $productData[$record->woocommerce_field];
				}
				
				if($record->zoho_field_type == 'double'){
					$additionalArray[$record->zoho_field] = floatval($productData[$productDataValue]);
				}elseif($record->zoho_field_type == 'integer'){
					$additionalArray[$record->zoho_field] = intval($productData[$productDataValue]);
				}elseif($record->zoho_field_type == 'multiselectpicklist'){
					if(!is_array($productDataValue)){
						$productDataValueArray = explode(', ',$productDataValue);
					}else{
						$productDataValueArray = $productDataValue;
					}
					$additionalArray[$record->zoho_field] = $productDataValueArray;
				}elseif($record->zoho_field_type == 'picklist'){
					$additionalArray[$record->zoho_field] = strval($productData[$record->woocommerce_field]);
				}elseif($record->zoho_field_type == 'datetime'){
					$additionalArray[$record->zoho_field] = date_format($productDataValue,"Y-m-d\TH:i:sP");
				}elseif($record->zoho_field_type == 'date'){
					$additionalArray[$record->zoho_field] = date_format($productDataValue,"Y-m-d");
				}elseif($record->zoho_field_type == 'boolean'){
					$additionalArray[$record->zoho_field] = boolval($productData[$record->woocommerce_field]) ? 'true' : 'false';
				}else{
					$additionalArray[$record->zoho_field] = $productData[$record->woocommerce_field];
				}
			}				
			
			$this->zohoPostData = $additionalArray;				
			$postData = json_encode(['data'=>[$this->zohoPostData]]);
			return $postData;
		}
		catch(\Exception $e){
			throw new  Exception("Error PrepareArray for product ".$e->getMessage());			
		}
	}
	/* End Products */
	/* Order */
	public function prepareArrayForSalesOrder($id){
		try{				
			global $wpdb;
			$this->table = $wpdb->prefix.'woo_zoho_crm_field_mapping';
			$orderData = wc_get_order( $id )->get_data();	
	
			$orderFinalDatavalue = [];
			foreach($orderData as $key => $data){
				if(!is_array($data)){										
					$orderFinalDatavalue[$key] = $data;
				}else{
					foreach($data as $data_key => $data_value){
						$orderFinalDatavalue[$key.'_'.$data_key] = $data_value;
					}
				}
			}

			$customer_id ='';
			$customer_email = '';	
			$accountnm = '';		
			if($orderData['customer_id'] > 0){		
				$customerData = get_user_by('id',$orderData['customer_id']);	
				$customer_id = $customerData->data->ID;
				$customer_email = $customerData->data->user_email;
				$customer_name = $customerData->data->display_name;
				$accountnm = $customerData->data->user_nicename;
			}else{		
				$customer_id = $orderData['customer_id'];
				$customer_email = $orderData['billing']['email'];
				$customer_name = $orderData['billing']['first_name'].' '.$orderData['billing']['last_name'];
				$accountnm = $orderData['billing']['first_name'].' '.$orderData['billing']['last_name'];
			}			

			$customerObject = new Customer();
			$customerResponse = $customerObject->createOrUpdateCustomer($customer_id,$customer_email);
			$customerId = $customerResponse['data'][0]['details']['id'];
			
			$records = $wpdb->get_results( "SELECT * FROM $this->table where `type`='SalesOrders' and status=1" );
			$tempArray = [];
			$additionalArray = [];
			
			foreach($records as $record){				
				if(strpos($record->woocommerce_field, 'shipping_') !== false){
					$finalValue = $orderData['shipping'][str_replace("shipping_", "", $record->woocommerce_field)];
				}elseif(strpos($record->woocommerce_field, 'billing') !== false){
					$finalValue = $orderData['shipping'][str_replace("billing_", "", $record->woocommerce_field)];
				}elseif($record->woo_field_type == 'date'){
					$dateArray = json_decode(json_encode($orderData[$record->woocommerce_field]), true);					
					$finalValue = date('Y-m-d',strtotime($dateArray['date']));
				}elseif($record->woo_field_type == 'dateTime'){
					$dateArray = json_decode(json_encode($orderData[$record->woocommerce_field]), true);
					$finalValue = date('Y-m-d\TH:i:sP',strtotime($dateArray['date']));
				}else{
					$finalValue = $orderData[$record->woocommerce_field];
				}				
				if($record->zoho_field_type == 'double' || $record->zoho_field_type == 'currency'){
					$additionalArray[$record->zoho_field] = floatval($finalValue);
				}elseif($record->zoho_field_type == 'integer'){
					$additionalArray[$record->zoho_field] = intval($finalValue);
				}elseif($record->zoho_field_type == 'multiselectpicklist'){
					if(!is_array($orderData[$record->woocommerce_field])){
						$orderDataValueArray = explode(', ',$finalValue);
					}else{
						$orderDataValueArray = $finalValue;
					}
					$additionalArray[$record->zoho_field] = $orderDataValueArray;
				}elseif($record->zoho_field_type == 'picklist'){
					$additionalArray[$record->zoho_field] = strval($finalValue);
				}elseif($record->zoho_field_type == 'datetime'){
					$additionalArray[$record->zoho_field] = date('Y-m-d\TH:i:sP',strtotime($finalValue));
				}elseif($record->zoho_field_type == 'date'){
					$additionalArray[$record->zoho_field] = date("Y-m-d",strtotime($finalValue));
				}elseif($record->zoho_field_type == 'text'){
					$additionalArray[$record->zoho_field] = strval($finalValue);
				}else{
					$additionalArray[$record->zoho_field] = $finalValue;
				}
			}
			
			$accountObject = new Account();
			$accountResponse = $accountObject->createOrUpdateAccount($customer_id,$accountnm);//customer_email
			$mergeArray = [];			
			
			if($accountnm == $orderData['billing']['first_name'].' '.$orderData['billing']['last_name']){
				$mergeArray = array("Subject" => (string)$id,"Account_Name"=> array("name"=>$accountnm.'-'.$customer_email,"id"=> $accountResponse['data'][0]['details']['id']));	
			}else{
				$mergeArray = array("Subject" => (string)$id,"Account_Name"=> array("name"=>$accountnm, "id"=> $accountResponse['data'][0]['details']['id']));	
			}

			$additionalArray = array_merge($additionalArray,$mergeArray);
			$order1 = wc_get_order( $id );
			$items = $order1->get_items();
			$productObject = new Product();		

			foreach($items as $item){
				$product_id = $item->get_product_id();
				$sku = '';
				$id = '';
				$product_variation_id = $item->get_variation_id();//['variation_id'];

				if($product_variation_id == 0){
					$product = new WC_Product($item->get_product_id());								
					$product_name = $product->get_name();
					$sku = $product->get_sku();
					$qty = $item->get_quantity();
					$id = $product_id;
					$tax = $item->get_total_tax();
				}else{
					$productVariation = new WC_Product_Variation($product_variation_id);				
					$sku = get_post_meta( $product_variation_id, '_sku', true );
					$product_name = $productVariation->get_name();
					$qty = $item->get_quantity();
					$id = $product_variation_id;
					$tax = $item->get_total_tax();
				}

				if(!isset($sku)){
					continue; //returns an error
				}					
				
				$productResponse = $productObject->createOrUpdateProduct($id,$sku);
				$zohoProductId = $productResponse['data'][0]['details']['id'];	

				$zohoProductData[] = ["product" => [
					"Product_Code" => $sku,
					"name" => $product_name,
					"id" => $zohoProductId
					],
					"quantity" => $qty,
					"Tax" => $tax,
				];	
			}
			
			$additionalArray['Product_Details'] = $zohoProductData;
			$postData = json_encode(['data'=>[$additionalArray]]);
			return $postData;
		}
		catch(\Exception $e){
			throw new Exception("Error PrepareArray for Sales Order ".$e->getMessage());
		}
	}
	/* End Order */
	/* Account */
	public function prepareArrayForAccount($id,$accountName){
		try{
			$this->zohoPostData = array(
				"Account_Name"=>$accountName
			);		
			$postData = json_encode(['data'=>[$this->zohoPostData]]);
			return $postData;
		}
		catch(\Exception $e){
			throw new Exception("Error PrepareArray for Account ".$e->getMessage());			
		}
	}
	/* End Account */
	/* Leads */
	public function prepareArrayForLead($WPCF7_ContactForm){
		try{
			global $wpdb;
			$this->table = $wpdb->prefix.'woo_zoho_crm_lead_field_mapping';			
			$wpcf7 = WPCF7_ContactForm::get_current();
			// get current SUBMISSION instance
			$submission = WPCF7_Submission::get_instance();
			// Ok go forward
			
			$submitData = $submission->get_posted_data();
			if (empty($submitData)){
				return;
			}
			$form_id = $submitData['_wpcf7'];
			$records = $wpdb->get_results( "SELECT * FROM $this->table where `type`='Leads' and status=1 and contact_form=$form_id" );
			$tempArray = [];
			$additionalArray = [];
			
			foreach($records as $record){
				$tempArray[$record->zoho_field] = $record->contact_form_field;			
			}			
			foreach($tempArray as $key => $value){
				if(array_key_exists($value,$submitData)){
					$additionalArray[$key] = $submitData[$value];																	
				}
			}
			$this->zohoPostData = $additionalArray;			
			$postData = json_encode(['data'=>[$this->zohoPostData]]);
			return $postData;			
		}
		catch(\Exception $e){
			throw new Exception("Error PrepareArray for customer ".$e->getMessage());			
		}		
	}
	/* End Leads */
}