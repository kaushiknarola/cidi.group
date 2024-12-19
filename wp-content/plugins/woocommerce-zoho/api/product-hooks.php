<?php
require_once("../../../../wp-load.php");

require_once(plugin_dir_path(__DIR__) . '/api/api.php');

file_put_contents('abc.txt',json_encode($_POST,true));

$getdata = json_encode($_POST,true);
$getdata = json_decode($getdata);

	global $wpdb;
    $config_table=$wpdb->prefix.'woo_zoho_crm';	
    $config_row = $wpdb->get_row( "SELECT * FROM $config_table" );
	
    if($config_row->zoho_product_sync == 'Yes'){
    	$zohoobj = new wczcMakeApiCall(); 
	    $url = $config_row->zoho_server_name. "/crm/v2/Products/".$getdata->id;				
	    $method = "GET";
	    $data = "";
	    					
	    $data_row = $zohoobj->makeApiCall($url,$method,$data);
		
		$mapping_table=$wpdb->prefix.'woo_zoho_crm_field_mapping';	
	    $mapping_datas = $wpdb->get_results( "SELECT * FROM $mapping_table WHERE type = 'Products' and status = '1' " );
		
		$woo_map_field = [];
		foreach($mapping_datas as $mapping_data)
		{
			$woo_map_field[$mapping_data->woocommerce_field] = $mapping_data->zoho_field;		
		}
		foreach($data_row['data'] as $product_data){
			foreach($woo_map_field as $key => $value){
				if(array_key_exists($value,$product_data)){
					$additionalArray[$key] = $product_data[$value];
				} 
				
			}
		}
		$product_id = wc_get_product_id_by_sku($getdata->Product_Code);	
		
		$product = wc_get_product( $product_id );
		
		if ($product_id){		
			$wooGetData = array(
				'ID'           => $product_id,
				'post_author' => $user_id,
				'post_content' => $product_data['Description'],
				'post_status' => "publish",
				'post_title' => $product_data['Product_Name'],
				'post_parent' => '',
				'post_type' => "product",
			); 
			$product_id = wp_update_post( $wooGetData );
			foreach($woo_map_field as $key => $value) {
				update_post_meta($product_id, '_'.$key, $product_data[$value]);
			}		
		}else{
			$wooGetData = array(				
				'post_author' => $user_id,
				'post_content' => $product_data['Description'],
				'post_status' => "publish",
				'post_title' => $product_data['Product_Name'],
				'post_parent' => '',
				'post_type' => "product",
			);					
			$product_id = wp_insert_post( $wooGetData, $wp_error );		
			foreach($woo_map_field as $key => $value) {
				update_post_meta($product_id, '_'.$key, $product_data[$value]);
			}
		}	
    }

	