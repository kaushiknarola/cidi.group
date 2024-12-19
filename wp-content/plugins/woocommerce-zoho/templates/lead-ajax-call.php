<?php 
require_once("../../../../wp-load.php");

$contact_form_id = $_POST['woo_field_mapping_contactform'];
$mapping_fields = new wczcleadfieldmapping();
$contact_form_get_array = $wpdb->get_results($wpdb->prepare("select ID,post_content from $wpdb->posts where ID=%d", $contact_form_id));
$contactform_post_content = $contact_form_get_array[0]->post_content;
$contact_form_fields = $mapping_fields->wczcleadcontent($contactform_post_content);

$selectField = "SELECT contact_form_field FROM ".$wpdb->prefix."woo_zoho_crm_lead_field_mapping WHERE `type` = 'Leads' AND `contact_form`= '".$contact_form_id."'";
$usedFieldList = $wpdb->get_results($selectField);
$usedFieldListArray = array();
foreach($usedFieldList as $_usedFieldKey => $_usedFieldValue){
	$usedFieldListArray[$_usedFieldValue->contact_form_field] = $_usedFieldValue->contact_form_field;
}
	
foreach ($contact_form_fields as $contactform_key => $contactform_value) {
	if (preg_match('/\s/', $contactform_value)) {
		$contactform_final_arr = explode(' ', $contactform_value);
		$contact_form_labels[] = rtrim($contactform_final_arr[1], ']');
	}
}						
echo '<option value="">Select Field</option>';		   
foreach ($contact_form_labels as $contact_form_cont_id => $contact_form_cont_label) {	
	if (isset($usedFieldListArray[$contact_form_cont_label]) && $usedFieldListArray[$contact_form_cont_label]){
		echo '<option value="'.$contact_form_cont_label.'" disabled>' .str_replace("-"," ",$contact_form_cont_label). '</option>';
	}else{
		echo '<option value="'.$contact_form_cont_label.'">' .str_replace("-"," ",$contact_form_cont_label). '</option>';
	}	
}