<?php
//  header('Content-type: application/json');
session_start();
include "../database.php";

// echo $_POST['method'];
$amount       = 0;
foreach ($_POST['order_items'] as $key => &$item) {
    $amount += (int)$item['price'] * (int)$item['quantity'];
    $item['price'] = (int) $item['price'];
    $item['quantity'] = (int) $item['quantity'];
}

if($_POST['method'] !== "COD") {

    $apiKey       = 'DEV-Eqmo3pbHgq64JNZA9EhYJj2wGjCezhOIDoGLr3Lt';
    $privateKey   = 'ZNYw9-jwoLp-oVkNm-4YL0D-w5tns';
    $merchantCode = 'T3202';
    $merchantRef  = "INV-".substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,4)."-".rand(999,9999);
    
    // echo json_encode(json_decode(json_encode($_POST)));
    // die();
    
    $data = [
        'method'         => $_POST['method'],
        'merchant_ref'   => $merchantRef,
        'amount'         => $amount,
        'customer_name'  => $_POST['customer_name'],
        'customer_email' => $_POST['customer_email'],
        'customer_phone' => $_POST['customer_phone'],
        'order_items'    => $_POST['order_items'],
        'return_url'   => 'https://domainanda.com/redirect',
        'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
        'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
    ];
    
    // echo json_encode(json_decode(json_encode($data)));
    // echo json_encode($data, JSON_PRETTY_PRINT);
    
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_FRESH_CONNECT  => true,
        CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
        CURLOPT_FAILONERROR    => false,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => http_build_query($data),
        CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
    ]);
    
    $response = curl_exec($curl);
    $error = curl_error($curl);
    
    curl_close($curl);
    
    $res = json_decode($response);
} else {
    /** COD PAYMENT */
    $res = (object) [
        "data" => (object) [
            "payment_name" => "COD - Cash On Delivery",
            "payment_method" => "COD",
            "reference" => "",
            "merchant_ref" => "",
            "amount" => $amount,
            "pay_code" => "",
            "checkout_url" => "",
        ]
    ];
    // var_dump($res->data->amount, $amount);
}
// var_dump($res);
// die();
$cust_id = $_SESSION['customer_id'];

$total_pem = $res->data->amount + $_POST['shipment_price'];

mysqli_query($conn, "
    INSERT INTO `transaksi` (`id`, `id_pelanggan`, `total_harga`, `pembayaran`, `payment_method_code`, `reference`, `merchant_ref`, `amount`, `pay_code`, `checkout_url`,`paid_at`, `expired_at`, `status`, `updated_at`, `courier_name`, `shipment_description`, `shipment_duration`, `shipment_price`, `total_pembayaran`) VALUES (NULL, 
        '$cust_id',
        '{$res->data->amount}', 
        '{$res->data->payment_name}', 
        '{$res->data->payment_method}', 
        '{$res->data->reference}', 
        '{$res->data->merchant_ref}', 
        '{$res->data->amount}', 
        '{$res->data->pay_code}', 
        '{$res->data->checkout_url}', 
        NULL, 
        DATE_ADD(NOW(), INTERVAL -1 DAY), 
        'UNPAID', 
        NULL,
        '{$_POST['courier_name']}',
        '{$_POST['shipment_description']}',
        '{$_POST['shipment_duration']}',
        '{$_POST['shipment_price']}',
        '{$total_pem}'
    );
");
// die();

header("Location: ../invoice_proccess.php?metode_pembayaran={$_POST['method']}");

// var_dump($res->data->reference);
// echo $res['data'];

// echo $response;
// echo empty($error) ? json_decode(json_encode($response, JSON_PRETTY_PRINT), JSON_PRETTY_PRINT) : json_encode($error, JSON_PRETTY_PRINT);

?>