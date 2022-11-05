<?php

// https://bhoover.com/using-php-openssl_encrypt-openssl_decrypt-encrypt-decrypt-data/

function sslCrypt(string $str)
{  
    $ivlen = openssl_cipher_iv_length(SSL_CIPHER);
    $iv    = openssl_random_pseudo_bytes($ivlen);
    $encrypted = openssl_encrypt($str, SSL_CIPHER, base64_decode(SSL_KEY), 0, $iv, $tag);

    $token = base64_encode($encrypted . '::' . $iv);

    return $token;
}

function sslDecrypt(string $token): string
{
    list($encrypted_data, $iv) = explode('::', base64_decode($token), 2);

    return openssl_decrypt($encrypted_data, SSL_CIPHER, base64_decode(SSL_KEY), 0, $iv);
}
