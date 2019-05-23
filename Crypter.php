<?php

/*
| $key = openssl_random_pseudo_bytes(32);
| $cbc = openssl_random_pseudo_bytes(16);
|
| $encryptedData = Crypter::init($key, $cbc)->encrypt($data);
| $decryptedData = Crypter::init($key, $cbc)->decrypt($data);
 */

class Crypter
{
    /**
     * Encryption method.
     */
    const CIPHER = 'AES-256-CBC';

    /**
     * Encryption block size.
     */
    const BLOCK_SIZE = 16;

    /**
     * Secret key.
     *
     * $cbc = openssl_random_pseudo_bytes(32);
     *
     * @var string
     */
    private $key = '';

    /**
     * Initializing vector.
     *
     * $cbc = openssl_random_pseudo_bytes(16);
     *
     * @var string
     */
    private $cbc = '';

    /**
     * @param string $key Security key
     * @param string $cbc Initializing vector
     */
    public static function init(string $key, string $cbc)
    {
        self::$key = $key;

        self::$cbc = $cbc;

        return new static();
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function encrypt(string $data): string
    {
        return openssl_encrypt($this->pad($data, self::BLOCK_SIZE), self::CIPHER, $this->key, 0, $this->cbc);
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function decrypt(string $data): string
    {
        return $this->unpad(openssl_decrypt($data, self::CIPHER, $this->key, 0, $this->cbc));
    }

    /**
     * We have to pad our data to the block size.
     *
     * @param string $data
     * @param int $blockSize
     *
     * @return string
     */
    private function pad(string $data, int $blockSize): string
    {
        $len = $blockSize - strlen($data) % $blockSize;

        return $data . str_repeat(chr($len), $len);
    }

    /**
     * We have to unpad our data.
     *
     * @param string $data
     *
     * @return string
     */
    private function unpad(string $data): string
    {
        return substr($data, 0, -ord($data[strlen($data) - 1]));
    }
}
