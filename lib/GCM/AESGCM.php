<?php

namespace GCM;

use GCM\Cipher\AES\AESCipher;
use GCM\Exception\AuthenticationException;


/**
 * Implements AES-GCM encryption.
 */
abstract class AESGCM
{
	/**
	 * Encrypt plaintext.
	 *
	 * @param string $plaintext Plaintext to encrypt
	 * @param string $aad Additional authenticated data
	 * @param string $key Encryption key
	 * @param string $iv Initialization vector
	 * @return array Tuple of ciphertext and authentication tag
	 */
	public static function encrypt($plaintext, $aad, $key, $iv) {
		return self::_getGCM(strlen($key))->encrypt($plaintext, $aad, $key, $iv);
	}
	
	/**
	 * Decrypt ciphertext.
	 *
	 * @param string $ciphertext Ciphertext to decrypt
	 * @param string $auth_tag Authentication tag to verify
	 * @param string $aad Additional authenticated data
	 * @param string $key Encryption key
	 * @param string $iv Initialization vector
	 * @throws AuthenticationException If message authentication fails
	 * @return string Plaintext
	 */
	public static function decrypt($ciphertext, $auth_tag, $aad, $key, $iv) {
		return self::_getGCM(strlen($key))->decrypt($ciphertext, $auth_tag, 
			$aad, $key, $iv);
	}
	
	/**
	 * Get GCM instance.
	 *
	 * @param int $keylen Key length in bytes
	 * @return GCM
	 */
	protected static function _getGCM($keylen) {
		return new GCM(AESCipher::fromKeyLength($keylen));
	}
}
