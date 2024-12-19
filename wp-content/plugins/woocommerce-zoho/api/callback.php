<?php
require_once("../../../../wp-load.php");

	global $wpdb;
	$config_table=$wpdb->prefix.'woo_zoho_crm';	
	$config_row = $wpdb->get_row( "SELECT * FROM $config_table" );
	if ($config_row->zoho_server_name == "https://crm.zoho.in"){
		$url = "zoho.in";
	}else if ($config_row->zoho_server_name == "https://crm.zoho.com"){
		$url = "zoho.com";
	}else if ($config_row->zoho_server_name == "https://crm.zoho.eu"){
		$url = "zoho.eu";
	}else if ($config_row->zoho_server_name == "https://crm.zoho.com.cn"){
		$url = "zoho.com.cn";
	}	
	
	if(isset($_GET['code'])){	
	
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://accounts.".$url."/oauth/v2/token?code=".$_GET['code']."&redirect_uri=".$config_row->zoho_callback_url."&client_id=".$config_row->zoho_client_id."&client_secret=".$config_row->zoho_client_secret_key."&grant_type=authorization_code",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 300,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",			  
			CURLOPT_POSTFIELDS => '',
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"cache-control: no-cache",
				"scope: ZohoCRM.modules.all,ZohoCRM.settings.fields.all,ZohoCRM.settings.all,ZohoCRM.users.ALL,crmapi"
			),
		));

		$response = json_decode(curl_exec($curl),true);
		
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {	
			$post_data=array(			
				'zoho_api_token' => $response['access_token'],
				'zoho_refresh_token' => $response['refresh_token'],
				'time' => current_time( 'mysql' )
			);
			$id = $config_row->id;
			$wpdb->update($config_table, $post_data, array('id'=>$id));
			
			header("Location: ".admin_url()."admin.php?page=wczc-menu");	
		}
	}
