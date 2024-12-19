<?php
require_once("../../../../wp-load.php");

$salesObject = new SalesOrder();
$customerObject = new Customer();
$productObject = new Product();

/* Order */
if(isset($_GET['id'])){
	try{		
		$response = $salesObject->createOrUpdateSalesOrder($_GET['id']);		
		echo $response['data'][0]['status'];		
	}
	catch(\Exception $e){
		echo $e->getMessage();
	}
}

/* customer */
if(isset($_GET['cid']) && isset($_GET['email'])){
	try{		
		$response = $customerObject->createOrUpdateCustomer($_GET['cid'],$_GET['email']);	
		echo $response['data'][0]['status'];		
	}
	catch(\Exception $e){
		echo $e->getMessage();
	}
}

/* products */
if(isset($_GET['pid']) && isset($_GET['sku'])){
	try{		
		$response = $productObject->createOrUpdateProduct($_GET['pid'],$_GET['sku']);	
		echo $response['data'][0]['status'];		
	}
	catch(\Exception $e){
		echo $e->getMessage();
	}
}
?>