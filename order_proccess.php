<?php
    session_start();
    include 'database.php';

    $customer_id = $_SESSION['customer_id'];

    if($customer_id == NULL) {
        header("Location: login_cust.php");
    }

?>