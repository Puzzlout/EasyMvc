<?php

namespace Library\Security;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

/**
 * Provides the methods to hash, encrypt and decrypt a value. 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package Protect 
 */
class Protect  {

  private $hashSalt = null;
  private $encryptionKey = null;
  private $encryptionType = MCRYPT_RIJNDAEL_128;
  private $encryptionMode = MCRYPT_MODE_CBC;
  private $iv = null;

  public function __construct(\Library\Core\Config $config) {
    $this->iv = mcrypt_create_iv(mcrypt_get_iv_size($this->encryptionType, $this->encryptionMode), MCRYPT_DEV_URANDOM);
    $this->encryptionKey = strrev($config->get(\Library\Enums\AppSettingKeys::EncryptionKey));
    $this->hashSalt = strrev($config->get(\Library\Enums\AppSettingKeys::PasswordSalt));
  }

  /**
   * Hash some data using Sha1 method with the encryption key.
   * A dynamic salt generated at the request is used to create the hash.  
   * 
   * @param string $dynamicSalt
   * The value is stored in the Applications/CurrentApp/Config/appsettings.xml
   * @param string $data
   * The value to hash using sha1 method and the $publicKey. 
   * @return string
   */
  public function HashValue($dynamicSalt, $data, $hashLength = NULL) {
    $separator = "$%*{//}*%$";
    return
            is_null($hashLength) && is_int($hashLength) ?
            substr(sha1($this->hashSalt . $separator . $dynamicSalt . $separator . $data), 0, $hashLength) :
            sha1($this->hashSalt . $separator . $dynamicSalt . $separator . $data);
  }

  /**
   * Encrypt a string using the MCRYPT_RIJNDAEL_128 encryption and 
   * MCRYPT_MODE_CBC and encode the result in a base64 string so it can be stored
   * in a database or file without the hassle of encoding. 
   * 
   * @param string $noncryptedData
   * The string to encrypt. 
   * @return string
   * The encrypted string encoded in base64 to allow safe storage. 
   */
  public function Encrypt($noncryptedData) {
    $encrypted = mcrypt_encrypt(
            $this->encryptionType, $this->encryptionKey, $noncryptedData, $this->encryptionMode, $this->iv);
    $encoded = base64_encode($encrypted);
    return $encoded;
  }
  
  /**
   * Decrypt a encoded base64 string using the MCRYPT_RIJNDAEL_128 encryption and 
   * MCRYPT_MODE_CBC 
   * 
   * @param type $encryptedData
   * The base64 encoded string to decrypt. 
   * @return string
   * The decrypted string. 
   */
  public function Decrypt($encryptedData) {
    $decoded = base64_decode($encryptedData, TRUE);
    $decrypted = mcrypt_decrypt($this->encryptionType, $this->encryptionKey, $decoded, $this->encryptionMode, $this->iv);
    return $decrypted;
  }

}
