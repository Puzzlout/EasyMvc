<?php

/**
 *
 * @package		Easy MVC Framework
 * @author		Jeremie Litzler
 * @copyright	Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Encryption Class
 *
 * @package     Library
 * @category	BL
 * @category	Security
 * @author      Jeremie Litzler
 * @link		
 */

namespace Library\Security;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed');
}

class Encryption {

  private $hashSalt = null;
  private $encryptionKey = null;
  private $encryptionType = MCRYPT_RIJNDAEL_128;
  private $encryptionMode = MCRYPT_MODE_CBC;
  private $iv = null;

  public function __construct(\Library\Core\Config $config) {
    $this->iv = mcrypt_create_iv(mcrypt_get_iv_size($this->encryptionType, $this->encryptionMode), MCRYPT_DEV_URANDOM);
    $this->encryptionKey = strrev($config->get(\Library\Enums\AppSettingKeys::EncryptionKey));
    $this->hashSalt = strrev($config->get(\Library\Enums\AppSettingKeys::PaswordSalt));
  }

  /**
   * <p> Hash some data using Sha1 method with the encryption key.
   * A dynamic salt generated at the request is used to create the hash.  </p>
   * 
   * @param string $dynamicSalt <p>
   * The value is stored in the Applications/CurrentApp/Config/appsettings.xml <p>
   * @param string $data <p>
   * The value to hash using sha1 method and the $publicKey. </p>
   * @return string
   */
  public function HashValue($dynamicSalt, $data, $hashLength = NULL) {
    $separator = "$%*{//}*%$";
    return
            is_null($hashLength) && is_int($hashLength) ?
            substr(sha1($this->encryptionKey . $separator . $dynamicSalt . $separator . $data), 0, $hashLength) :
            sha1($this->encryptionKey . $separator . $dynamicSalt . $separator . $data);
  }

  /**
   * <p> Encrypt a string using the MCRYPT_RIJNDAEL_128 encryption and 
   * MCRYPT_MODE_CBC and encode the result in a base64 string so it can be stored
   * in a database or file without the hassle of encoding. </p>
   * 
   * @param string $noncryptedData <p>
   * The string to encrypt. </p>
   * @return string <p>
   * The encrypted string encoded in base64 to allow safe storage. </p>
   */
  public function Encrypt($noncryptedData) {
    $encrypted = mcrypt_encrypt(
            $this->encryptionType, $this->encryptionKey, $noncryptedData, $this->encryptionMode, $this->iv);
    $encoded = base64_encode($encrypted);
    return $encoded;
  }
  
  /**
   * <p> Decrypt a encoded base64 string using the MCRYPT_RIJNDAEL_128 encryption and 
   * MCRYPT_MODE_CBC </p>
   * 
   * @param type $encryptedData <p>
   * The base64 encoded string to decrypt. </p>
   * @return string <p>
   * The decrypted string. </p>
   */
  public function Decrypt($encryptedData) {
    $decoded = base64_decode($encryptedData, TRUE);
    $decrypted = mcrypt_decrypt($this->encryptionType, $this->encryptionKey, $decoded, $this->encryptionMode, $this->iv);
    return $decrypted;
  }

}
