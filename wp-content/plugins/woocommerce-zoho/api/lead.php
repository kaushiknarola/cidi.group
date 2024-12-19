<?php 
class Lead extends PrepareArray{
	public function createOrUpdateLead($contact_form_id){
		/* get config data */
		global $wpdb;
		$config_table=$wpdb->prefix.'woo_zoho_crm';	
		$config_row = $wpdb->get_row( "SELECT * FROM $config_table" );
		/* end get config data */
		$data = $this->prepareArrayForLead($contact_form_id);
		if($data != ''){			
			$postData = json_decode($data,true);
			$email = $postData['data'][0]['Email'];
		}
		$zohoobj = new wczcMakeApiCall();
		$url = $config_row->zoho_server_name."/crm/v2/Leads/search?criteria=(Email:equals:".$email.")";
		$method = "GET";
		$response = $zohoobj->makeApiCall($url,$method);

		if(isset($response) && is_array($response) && isset($response['data'][0]['id'])){
			$url = $config_row->zoho_server_name."/crm/v2/Leads/".$response['data'][0]['id'];
			$method = "PUT";
			$contactResponse = $zohoobj->makeApiCall($url,$method,$data);
			return $contactResponse;
		}else{
			$url = $config_row->zoho_server_name."/crm/v2/Leads";
			$method = "POST";
			$contactResponse = $zohoobj->makeApiCall($url,$method,$data);
			return $contactResponse;
		}
	}
}