<?php
function sendData()
{
    $ch = curl_init();
    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: 8a30e764f40044a40d599d212ac2f34e'
    );
    curl_setopt($ch, CURLOPT_URL, "https://www.zohoapis.com/crm/v2/Leads");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $body = '{}';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $authToken = curl_exec($ch);
    $response = json_decode($authToken);
    debugA($response);
}


//add_action('woocommerce_checkout_create_order', 'before_checkout_create_order', 90,2);
//function before_checkout_create_order( $order, $data ) {
//    debugA($order->get_data());
////    debugA($data);
////    $items = $order->get_items()['new:line_items0'];
////    $product_id = $items->legacy_values['product_id'];
////    $product = wc_get_product($product_id);
////    $parameters = [
////        "Order_Status" => $order->get_status(),
////        "Order_Date" => $order->get_date_created(),
////        "Order_Completion_Date" => "",
////        "Payment Method" => $order->get_payment_method(),
////        "Order_Total_Amount" => $order->get_total(),
////        "Category" => $product->get_type(),
////        "Product_ID" => $product_id,
////        "Product_Variation" => $items->legacy_values['variation']['attribute_amount'],
////        "SKU" => $product->get_sku(),
////        "Item_Name" => $product->get_name(),
////        "Quantity" => $items->legacy_values['quantity'],
////        "Item_Cost" => $order->get_total(),
////        "Product_Duration" => $items->legacy_values['thwepof_options']['duration']['value'],
////        "Rate_of_Return" => $items->legacy_values['thwepof_options']['interest_rate']['value']
////    ];
//}

add_action("woocommerce_checkout_order_processed", 'before_checkout_create_order', 90,3 );
function before_checkout_create_order($order_id, $posted_data, $order){
    debugA($order->get_items());
    debugA($posted_data);
    debugA($order_id);
}

function debugA($var)
{
    $data = [];
    if (gettype($var) !== 'object' && gettype($var) !== 'array') {
        $data['data'] = $var;
    } else {
        $data = $var;
    }

    $ch = curl_init("http://adev.synapseteam.pro/api.php/u-nikita");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_exec($ch);
}