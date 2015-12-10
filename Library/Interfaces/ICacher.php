<?php

/**
 * An interface to manage the caching in the application.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ICacher
 */

namespace Library\Interfaces;

interface ICacher {

  /**
   * The instanciater of the cache class using the config instance in order to 
   * retrieve some default values for ttl and other caching settings.
   * 
   * @param \Library\Core\Config $config The instance of config class
   */
  public static function Init(\Library\Core\Config $config);
  
  /**
   * Check if the given $key exists in the cache store.
   * @param string $key The key to look up for.
   * @return bool Return the result of operation
   */
  public function KeyExists($key);
  /**
   * Store a $value in the cache store.
   * @param string $key The key in the cache store.
   * @param mixed $value The value to store, it can be a string, an array, an ArrayObject, etc...
   * @return bool Return the result of adding the cached value
   * @throws \Exception Throwns an exception when the key in the store is already
   * there. It means there is a code bug somewhere.
   */
  public function Create($key, $value);
  /**
   * Returns the $value of the $key from the cache store.
   * @param string $key The key to look up for.
   * @param mixed $default The default value if the key is not found in the store.
   * @return mixed Return the cached value for the $key
   */
  public function Read($key, $default);
  /**
   * Update a $value in the cache store for a given $key.
   * @param string $key The key in the cache store.
   * @param string $value The value to store.
   * @return bool Return the result of updating the cached value
   * @throws \Exception Throwns an exception when the key is not in the store.
   */
  public function Update($key, $value);
  /**
   * Removes the given $key.
   * @param string $key The key to look up for.
   * @return bool Return the result of removing the cached value
   */
  public function Remove($key);
}
