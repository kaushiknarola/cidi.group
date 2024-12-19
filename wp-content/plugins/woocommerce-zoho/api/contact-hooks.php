<?php
require_once("../../../../wp-load.php");

require_once(plugin_dir_path(__DIR__) . '/api/api.php');

file_put_contents('abc.txt',json_encode($_POST,true));
$getdata = json_encode($_POST,true);
$getdata = json_decode($getdata);

    global $wpdb;
    $config_table=$wpdb->prefix.'woo_zoho_crm';	
    $config_row = $wpdb->get_row( "SELECT * FROM $config_table" );


    if($config_row->zoho_contact_sync == 'Yes')
    {
    	$zohoobj = new wczcMakeApiCall(); 

	    $url = $config_row->zoho_server_name. "/crm/v2/Contacts/".$getdata->id;				
	    $method = "GET";
	    $data = "";
	    					
	    $data_row = $zohoobj->makeApiCall($url,$method,$data);
			
	    $user = get_user_by( 'email', $getdata->email );    
	    $exists = email_exists( $getdata->email );	
		
		$mapping_table=$wpdb->prefix.'woo_zoho_crm_field_mapping';	
	    $mapping_datas = $wpdb->get_results( "SELECT * FROM $mapping_table WHERE type = 'Contacts' and status = '1'" );
		
		$woo_map_field = [];
		foreach($mapping_datas as $mapping_data){
			$woo_map_field[$mapping_data->woocommerce_field] = $mapping_data->zoho_field;		
		}
		foreach($data_row['data'] as $customer){		
			foreach($woo_map_field as $key => $value){
				if(array_key_exists($value,$customer)){
					$additionalArray[$key] = $customer[$value];
				} 			
			}
		}	
		if ( $exists ) {
	       	if($user->roles[0] == 'customer'){
				$user_id = $exists;
				$wooPostData = array(
					'ID' => $user_id,
					"user_email"=>$getdata->email
				);
				
				$wooPostData = array_merge($wooPostData,$additionalArray);
				wp_update_user($wooPostData);
				foreach($woo_map_field as $key => $value) {
					update_user_meta( $user_id, $key, $customer[$value] );
				}
			}	
			
	    } else {		
			$wooPostData = array(
				'user_login' => $getdata->email,
				"user_email" => $getdata->email,
				'user_pass'  => wp_generate_password( 10, true, true )
			);			
			$wooPostData = array_merge($wooPostData,$additionalArray);

			$id = wp_insert_user( $wooPostData ) ;
			
			wp_update_user( array ('ID' => $id, 'role' => 'customer') );
			
			foreach($woo_map_field as $key => $value) {
				add_user_meta( $id, $key, $customer[$value] );
			}
	    }
    }
			
	