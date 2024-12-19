<?php 
if( !defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}	
	if ( current_user_can( 'activate_plugins' ) && current_user_can( 'update_core' ) ){
		$zohoobj = new wczcMakeApiCall();	
		$prepareArrayObject = new PrepareArray();
		$customrObject = new Customer();
		$productObject = new Product();
		$salesOrderObject = new SalesOrder();
		
		/* get config data */
		global $wpdb;
		$config_table=$wpdb->prefix.'woo_zoho_crm';	
		$config_row = $wpdb->get_row( "SELECT * FROM $config_table" );
		/* end get config data */
?>
		<!-- Modal -->
		<div id="myModal" class="modal fade">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">        
		        <h4 class="modal-title">Message</h4>
		      </div>
		      <div class="modal-body">
		        <strong id="sync-heading"></strong>
		        <p id="sync-message"></p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Modal -->

		<div class="wrap">
			<br/>
			<div class="row">
				<div class="col-sm-6">
					<?php echo "<br/><h4>" . __( 'Contacts Manual Sync', 'woocommerce-zoho-crm' ) . "</h4>"; ?>
				</div>
				<div class="col-sm-6">
					<button type="button" class="btn btn-info float-right" name="sync-all-customer" id="sync-all-customer">Sync All Customer</button>
				</div>			
			</div>
			<?php
				function usersFinalData($users_data){
					return $users_data['data'];
				}
				
				class Customers_List extends WP_List_Table {
					/** Class constructor */
					public function __construct() {
						parent::__construct( [
							'singular' => __( 'Customer', 'woocommerce-zoho-crm' ), //singular name of the listed records
							'plural'   => __( 'Customers', 'woocommerce-zoho-crm' ), //plural name of the listed records
							'ajax'     => true //does this table support ajax?
						] );
					}

					/**
					 * Retrieve customers data from the database
					 *
					 * @param int $per_page
					 * @param int $page_number
					 *
					 * @return mixed
					 */
					public static function get_customer( $per_page = 10, $page_number = 1) {
						if (isset($_REQUEST['orderby']) && $_REQUEST['orderby']){
							$orderby = $_REQUEST['orderby'];
						}else{
							$orderby = 'ID';
						}
						if(isset($_REQUEST['order']) && $_REQUEST['order']){
							$order = $_REQUEST['order'];									
						}else{
							$order = 'ASC';
						}
						
						$users = get_users( array( 
								'fields' => 'all',
								'role'   => 'customer',
								'offset' => ($page_number - 1 ) * $per_page,
								'number' => $per_page,
								'orderby' => $orderby,
								'order'  => $order
							) 
						);
						
						$result = json_decode(json_encode($users), true);						
						return array_map('usersFinalData', $result);
					}

					/**
					 * Returns the count of records in the database.
					 *
					 * @return null|string
					 */
					public static function record_count() {
						$users = get_users( array( 
								'fields' => 'all',
								'role'   => 'customer'
							) 
						);
						$total_users = count($users);
						return $total_users;
					}
					
					/** Text displayed when no customer data is available */
					public function no_items() {
						_e( 'No customers avaliable.', 'woocommerce-zoho-crm' );
					}

					/**
					 * Render a column when no column specific method exist.
					 *
					 * @param array $item
					 * @param string $column_name
					 *
					 * @return mixed
					 */
					public function column_default( $item, $column_name ) {
						switch ( $column_name ) {
							case 'ID':
							case 'user_email':
							case 'user_registered':
							case 'display_name':
							case 'woocommerce_name':
								return $item[ $column_name ];
							default:
								return print_r( $item, true ); //Show the whole array for troubleshooting purposes
						}
					}

					/**
					 * Method for name column
					 *
					 * @param array $item an array of DB data
					 *
					 * @return string
					 */
					function column_woocommerce_name( $item ) {							
						$title = '<strong>' . $item['display_name'] . '</strong>';
						return $title;
					}
					
					function column_action( $item ) {							
						$action = '<form action="" method="post">                      
								<input name="module" value="Contacts" type="hidden" />
								<input name="woo_id" value="'.$item['ID'].'" type="hidden" />
								<input name="woo_customer_email" value="'.$item['user_email'].'" type="hidden" />
								<button class="button" name="SynctoContacts" value="SynctoContacts" type="submit">Sync</button>
							</form>';
						return $action;
					}

					/**
					 *  Associative array of columns
					 *
					 * @return array
					 */
					function get_columns() {
						$columns = [
							'ID'    => __( 'Woocommerce Id', 'woocommerce-zoho-crm' ),
							'woocommerce_name'    => __( 'Woocommerce Name', 'woocommerce-zoho-crm' ),
							'user_email' => __( 'Email', 'woocommerce-zoho-crm' ),
							'user_registered' => __( 'Create Time', 'woocommerce-zoho-crm' ),
							'action'    => __( 'Action', 'woocommerce-zoho-crm' )
						];
						return $columns;
					}

					/**
					 * Columns to make sortable.
					 *
					 * @return array
					 */
					
					public function get_sortable_columns() {
						$sortable_columns = array(
							'ID' => array( 'ID', true ),
							'woocommerce_name' => array( 'display_name', true ),
							'user_email' => array( 'user_email', true ),
							'user_registered' => array( 'user_registered', true )
						);
						return $sortable_columns;
					}
					
					/**
					 * Handles data query and filter, sorting, and pagination.
					 */
					public function prepare_items() {
						$columns = $this->get_columns();
						$hidden = array();
						$sortable = $this->get_sortable_columns();
						$this->_column_headers = array($columns, $hidden, $sortable);
														
						/** Process bulk action */
						$this->process_bulk_action();
						$per_page     = $this->get_items_per_page( 'customers_per_page', 10 );
						$current_page = $this->get_pagenum();
						$total_items  = self::record_count();

						$this->set_pagination_args( [
							'total_items' => $total_items, //WE have to calculate the total number of items
							'per_page'    => $per_page //WE have to determine how many items to show on a page
						] );
						
						$this->items = self::get_customer( $per_page, $current_page );
					}
				}
				
				$Customers_List = new Customers_List();
				$Customers_List->prepare_items();
				$Customers_List->display(); 
			?>
		</div>			
		<?php			
			if(isset($_POST['SynctoContacts'])){
				if($_POST['module'] == 'Contacts'){
					try{
						$response = $customrObject->createOrUpdateCustomer($_POST['woo_id'],$_POST['woo_customer_email']);
					}
					catch(\Exception $e)
					{
						throw new Exception("Error Processing Request".$e->getMessage());			
					}		
				}
			}
			
			function getChunkSize(){
				global $wpdb;
				$config_table=$wpdb->prefix.'woo_zoho_crm_report';	

				/* customer chunk */
				$maxcustomerDate = $wpdb->get_results( "SELECT max(datetime) AS 'maxDate' FROM $config_table where `table_name`='Customer'" );
				
				if(isset($maxcustomerDate[0]->maxcustomerDate)){
					$fromxcustomerDate = $maxcustomerDate[0]->maxcustomerDate;
				}else{
					$fromxcustomerDate = date('2003-5-1 00:00:00');
				}
				
				$args = array(
					'role' => 'customer',
					'number' => -1,
					'date_query' => array(
						'after' => $fromxcustomerDate,
						'before' => date('Y-m-d H:i:s') 
					)
				);
				
				$users = get_users($args);

				$customerids = array();
				$i = 0;
				foreach($users as $user){
					$customerids[$i]['id'] = $user->ID;	
					$customerids[$i]['email'] = $user->user_email;			    
					$i++;
				}	
				$_SESSION['customer_ids'] = json_encode(array_chunk($customerids, 5),true);
				$_SESSION['chunkCustomerCount'] = count(array_chunk($customerids, 5));
			}	
			getChunkSize();

		?>

		<script>
			var chunkId = 0;
		
			var CustomerchunkCount = '<?php echo $_SESSION["chunkCustomerCount"]?>';
			var CustomerchunkIds = '<?php echo $_SESSION["customer_ids"]?>';
			
			jQuery('#sync-all-customer').click(function(){ 
				startProcess('contacts');
			});

			function startProcess(type){
				jQuery('#myModal').modal("show");
				
				/* customer chunk add data */
				if(type == 'contacts'){
					var url = "<?php echo site_url() . '/wp-content/plugins/woocommerce-zoho/api/temp.php' ?>";
					var ids = JSON.parse(CustomerchunkIds);	
					
					if(ids != ''){
						jQuery('#sync-heading').append('Sync started... Please Wait till process is complete.. ');
						var counter = 0;	

						for(i=0;i<ids.length;i++)
						{	
							jQuery.each(ids[i],function(key,value){					
								var data = (
									'cid=' +value.id+'&email=' +value.email
								);
								
								jQuery.ajax({
									url: url,
									type: 'GET',
									data: data,
									success: function(response){
										var message = 'Customer Number '+value.id+' is '+response+"<br>";
										jQuery('#sync-message').append(message);
									},
									error: function(xhr,error){
										var message = 'Customer Number '+value.id+' is '+xhr.responseText+"<br>";
										jQuery('#sync-message').append(message);
									}						
								});
							});		
						}	
					}
					else{
						$('#sync-heading').append('No Records To Sync !');
					}
				}
			}

			function processAjaxCall(currentProcess,url,total){
				var tempCurrentProcess = currentProcess;
				jQuery.ajax({
					url: url,
					type: 'GET',
					data: 'id='+total[currentProcess],
					success: function(response){
						var message = 'Item Number '+total[tempCurrentProcess]+' is '+response+"<br>";
						$('#sync-message').append(message);			
						var currentProcess = ++tempCurrentProcess;
						if(currentProcess < total.length){
							var message = 'Process Number '+currentProcess+' Working';
							jQuery('#sync-message').append(message);
							processAjaxCall(currentProcess,url,total);
						}
						else{
							var message = "All Process Completed.";
							jQuery('#sync-message').append(message);
						}
					},
					error: function(xhr,error){
						var message = 'Item Number '+total[tempCurrentProcess]+' is '+xhr.responseText+"<br>";
						jQuery('#sync-message').append(message);
					}						
				});
			}	
		</script>
<?php }