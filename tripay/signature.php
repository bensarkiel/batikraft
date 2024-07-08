<?php
    function signature($merchantCode, $merchantRef, $amount) {
        $privateKey   = 'ZNYw9-jwoLp-oVkNm-4YL0D-w5tns';
        $signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);
        return $signature;
    }
?>