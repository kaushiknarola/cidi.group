<?php 
if( !defined( 'ABSPATH' ) ) exit;
 
	/* get config data */
	global $wpdb;
	$config_table=$wpdb->prefix.'woo_zoho_crm';	
	$config_row = $wpdb->get_row( "SELECT * FROM $config_table" );
	/* end get config data */
	if ( current_user_can( 'activate_plugins' ) && current_user_can( 'update_core' ) ) {
?>
		<div class="wrap">
			<?php
				if ( !is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) { 
					echo '<div class="notice error my-acf-notice">
								<p><strong>'.esc_html( __( 'WooCommerce Zoho CRM Plugin requires Contact Form 7 for Sync Lead', 'woocommerce-zoho-crm' ) ).'</strong></p>
							</div>';
				}else{				 	
					echo "<h2>" . esc_html( __( 'Field Mapping', 'woocommerce-zoho-crm' ) ) . "</h2>";
					$field_table = $wpdb->prefix.'woo_zoho_crm_lead_field_mapping';
					$field_row = $wpdb->get_results( "SELECT * FROM $field_table" );
							
					if(isset($_POST['btn-delete'])){	
						$id = sanitize_text_field($_POST['btn-delete']);
						$field_table = $wpdb->prefix.'woo_zoho_crm_lead_field_mapping';
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
							'contact_form' => sanitize_text_field($_POST['woo_field_mapping_contactform']),
							'contact_form_field' => sanitize_text_field($_POST['woo_field_mapping']),
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
									<label for="zoho_module" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Zoho Module', 'woocommerce-zoho-crm' ) ); ?></strong></label>
									<select id="zoho_module" name="zoho_module" class="col-sm-8" required>
										<option value="Leads"><?php echo esc_html( __( 'Leads', 'woocommerce-zoho-crm' ) ); ?></option>
									</select>
								</div>	
								<?php
									$zohoobj = new wczcMakeApiCall();
									$method = "GET";
									$data = "";	
								?>
								<div class="row form-group Leads">
									<label for="woo_field_mapping_contactform" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Contact Form', 'woocommerce-zoho-crm' ) ); ?></strong></label>
									<select name="woo_field_mapping_contactform" id="woo_user_meta" class="field-meta col-sm-8" required>
										<option value=''>Select Contact Form</option>
										<?php
											$contactForm = get_posts( array( 
												'post_type' => 'wpcf7_contact_form',
												'posts_per_page'    => -1,
											) );
											foreach ( $contactForm as $contactFormItem ) {
												echo '<option value="'.$contactFormItem->ID.'">' .$contactFormItem->post_title. '</option>';
											}
										?>		
									</select>
								</div>
								<script>
									jQuery(document).ready(function(){										
										jQuery("select[name='woo_field_mapping_contactform']").change(function() {
											var value = jQuery(this).val();
											jQuery.ajax({
												url: "../wp-content/plugins/woocommerce-zoho/templates/lead-ajax-call.php", 
												type : "POST",
												data : {woo_field_mapping_contactform : value},
												success: function(result){
													jQuery("#contact_form_meta").html(result);
												}
											});										
											if (value != ''){
												jQuery('.fields').show();
												jQuery(".fields select").prop('disabled', false);
											}else{
												jQuery('.fields').hide();
												jQuery(".fields select").prop('disabled', true);
											}									
										});
										
									});									
								</script>
								<div class="row form-group fields" id="contact_form_7">
									<label for="woo_field_mapping" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Contact Form Field', 'woocommerce-zoho-crm' ) ); ?></strong></label>
									<select name="woo_field_mapping" id="contact_form_meta" class="field-meta col-sm-8" required>															
									</select>								
									<label for="zoho_field_mapping" class="col-sm-4 col-form-label"><strong><?php echo esc_html( __( 'Zoho Field', 'woocommerce-zoho-crm' ) ); ?></strong></label>
									<select name="zoho_field_mapping" id="zoho_contact_field_mapping" class="zoho-field col-sm-8" required>
										<?php
											$url = $config_row->zoho_server_name. "/crm/v2/settings/fields?module=Leads";															
											$data_row = $zohoobj->makeApiCall($url,$method,$data);	
											foreach($data_row['fields'] as $row){
												echo '<option value="'.$row['api_name'].'">'.$row['field_label'].'</option>';
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
								<div class="col-sm-12">
									<button name="save" class="btn btn-default btn-info float-right" type="submit" value="Save changes"><?php echo esc_html( __( 'Save changes', 'woocommerce-zoho-crm' ) ); ?></button>
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
									<th><?php echo esc_html( __( 'Contact Form Id', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Contact Form Field', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Status', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Type', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Description', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Action', 'woocommerce-zoho-crm' ) ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($field_row as $fields){ ?>  
									<tr>
										<td><?= $fields->id ?></td>
										<td><?= $fields->zoho_field ?></td>
										<td><?= $fields->contact_form ?></td>
										<td><?= $fields->contact_form_field ?></td>
										<td><?= $fields->status ?></td>
										<td><?= $fields->type ?></td>
										<td><?= $fields->description ?></td>									
										<td><button id="<?= $fields->id ?>" type="submit" name="btn-delete" value="<?= $fields->id ?>" class="btn btn-danger">Delete</button></td>
									</tr>		
								<?php   }	?>
							</tbody>
							<tfoot>
								<tr>
									<th><?php echo esc_html( __( 'Id', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Zoho Field', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Contact Form Id', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Contact Form Field', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Status', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Type', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Description', 'woocommerce-zoho-crm' ) ); ?></th>
									<th><?php echo esc_html( __( 'Action', 'woocommerce-zoho-crm' ) ); ?></th>
								</tr>
							</tfoot>
						</table>
					</form>
				</div>
			<?php } ?> 
		</div>
<?php
	}