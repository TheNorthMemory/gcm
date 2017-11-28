<?php
/**
 * Decrypt a message generated by encrypt.php.
 *
 * php encrypt.php | php decrypt.php
 */

use Sop\GCM\AESGCM;

require dirname(__DIR__) . "/vendor/autoload.php";

// additional authenticated data
// this must be known by the receiver and equal to the one used when encrypting
$aad = "Additional info";
// encryption key
$key = "some 128 bit key";
// read ciphertext, authentication tag and initialization vector from the stdin
list($ciphertext, $auth_tag, $iv) = array_map("hex2bin",
    file("php://stdin", FILE_IGNORE_NEW_LINES));
// decrypt and authenticate
$plaintext = AESGCM::decrypt($ciphertext, $auth_tag, $aad, $key, $iv);
echo "$plaintext\n";
