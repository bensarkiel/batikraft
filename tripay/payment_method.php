<?php

    include "../database.php";

    $apiKey = 'DEV-Eqmo3pbHgq64JNZA9EhYJj2wGjCezhOIDoGLr3Lt';

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_FRESH_CONNECT  => true,
    CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/payment/channel',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER         => false,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
    CURLOPT_FAILONERROR    => false,
    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
    ));

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    if(!empty($error)) {   
        die("ERROR:001");
    }

    // var_dump(json_decode($response, true)['data'][0]['payment'][0]['code']);
    $res = json_decode($response, true);
    // var_dump($res);
    
    foreach ($res['data'] as $key => $group) {
        foreach ($group['payment'] as $key1 => $payment_method) {

            $group = $res['data'][$key]['group_name'];
            $code = $payment_method['code'];
            $name = $payment_method['name'];
            $fee_flat = $payment_method['fee']['flat'];
            $fee_percent = $payment_method['fee']['percent'];

            $cek = mysqli_fetch_array(mysqli_query($conn, "select id from payment_methods where code = '$group'"));
            
            if(!$cek) {
                $sql = "INSERT INTO payment_methods (`group`, `code`, `name`, `deactived_at`, `created_at`, `updated_at`, `icon_url`, `fee_flat`, `fee_percent`) VALUES (
                    '$group', 
                    '$code', 
                    '$name', 
                    NULL, 
                    NULL, 
                    NULL, 
                    '-', 
                    '$fee_flat', 
                    '$fee_percent' 
                )";

                echo "\n".$sql."\n";
    
                $create = mysqli_query($conn, $sql);
            }

        }
    }

    echo "Sukses Sync";

?>