<?php
class SSL extends CI_Model
{
    private $secretKey = "BSAviationVA2024#";
    private $algo = "aes-256-cbc";

    public function __construct() { parent::__construct(); }

    public function encrypt(string $data): string
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->algo));
        $encrypted = openssl_encrypt($data, $this->algo, $this->secretKey, 0, $iv);
        return $encrypted . "::" . $iv;
    }
    public function decrypt(string $data): string 
    {
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, $this->algo, $this->secretKey, 0, $iv);
    }
}