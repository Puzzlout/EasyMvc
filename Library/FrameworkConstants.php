<?php

class FrameworkConstants {

  const FrameworkConstants_Name_AppName = "FrameworkConstants_Name_AppName";
  const FrameworkConstants_Name_BaseUrl = "FrameworkConstants_Name_BaseUrl";
  const FrameworkConstants_Name_EnableBenchmark = "FrameworkConstants_Name_EnableBenchmark";
  const FrameworkConstants_Name_ExecutionAccessRestriction = "FrameworkConstants_Name_ExecutionAccessRestriction";
  const FrameworkConstants_Name_RootDir = "FrameworkConstants_Name_RootDir";
  const FrameworkConstants_Name_TestAppName = "FrameworkConstants_Name_TestAppName";
  const FrameworkConstants_Name_Version = "FrameworkConstants_Name_Version";

  const FrameworkConstants_AppName = "FrameworkConstants_AppName";
  const FrameworkConstants_BaseUrl = "FrameworkConstants_BaseUrl";
  const FrameworkConstants_EnableBenchmark = "FrameworkConstants_EnableBenchmark";
  const FrameworkConstants_ExecutionAccessRestriction = "FrameworkConstants_ExecutionAccessRestriction";
  const FrameworkConstants_RootDir = "FrameworkConstants_RootDir";
  const FrameworkConstants_TestAppName = "FrameworkConstants_TestAppName";
  const FrameworkConstants_Version = "FrameworkConstants_Version";
  
  static function SetNamedConstants($arrayOfCustomValues = array()) {
    $arrayOfValuesToUse = self::SetNamedConstantsValues($arrayOfCustomValues);

    /**
     * Version number global variable definition
     * It is used to allow automatic client refresh of the JavaScript and CSS files.
     */
    define(FrameworkConstants::FrameworkConstants_Version, "1.0.2");
    /**
     * To enable benckmarking of the scripts.
     */
    define(FrameworkConstants::FrameworkConstants_EnableBenchmark, $arrayOfValuesToUse[self::FrameworkConstants_Name_EnableBenchmark]);
    /**
     * Allows this file to execute the autoload.
     */
    define(FrameworkConstants::FrameworkConstants_ExecutionAccessRestriction, $arrayOfValuesToUse[self::FrameworkConstants_Name_ExecutionAccessRestriction]);
    /**
     * Declare the full directory path where the application resides.
     */
    define(FrameworkConstants::FrameworkConstants_RootDir, $arrayOfValuesToUse[self::FrameworkConstants_Name_RootDir]);
    /**
     * The application name which needs to match the folder name in Applications 
     * folder.
     * It also is the prefix for the Application class found in 
     * Applications/YourAppName/YourAppNameApplication.php
     * 
     * The correct tree structure should be: Applications/YourAppName/..
     */
    define(FrameworkConstants::FrameworkConstants_AppName, $arrayOfValuesToUse[self::FrameworkConstants_Name_AppName]);
    /**
     * The test application name which needs to match the folder name in Applications 
     * folder.
     * It also is the prefix for the Application class found in 
     * Applications/TestAppName/TestAppNameApplication.php
     * 
     * The correct tree structure should be: Applications/TestAppName/..
     */
    if (!is_null($arrayOfValuesToUse[self::FrameworkConstants_Name_TestAppName])) {
      define(FrameworkConstants::FrameworkConstants_TestAppName, $arrayOfValuesToUse[self::FrameworkConstants_Name_TestAppName]);
    }
    /**
     * Depending on the server setup and where the application resides,
     * FrameworkConstants_BaseUrl will need to be updated.
     * 
     * Examples:
     *  1) if your website root url is http://mydomain.net/MyApp/, then 
     * FrameworkConstants_BaseUrl will be "/MyApp/"
     * 
     *  2) if your website root url is http://mydomain.net/, then 
     * FrameworkConstants_BaseUrl will be "/"
     * 
     */
    define(FrameworkConstants::FrameworkConstants_BaseUrl, $arrayOfValuesToUse[self::FrameworkConstants_Name_BaseUrl]);
  }

  /**
   * Get the values to use for each named constants, using the custom values
   * given if it exists otherwise, it uses the default values.
   * 
   * @param array $arrayOfCustomValues : the values set to use. It can be some 
   * of the named constants value.
   * @return array : the named constants values to use
   */
  static function SetNamedConstantsValues($arrayOfCustomValues) {
    $arrayOfDefaultValues = self::DefaultNamedConstantValues();
    $valuesToUse = array();

    $valuesToUse[FrameworkConstants::FrameworkConstants_Name_AppName] = array_key_exists(FrameworkConstants::FrameworkConstants_Name_AppName, $arrayOfCustomValues) ?
            $arrayOfCustomValues[FrameworkConstants::FrameworkConstants_Name_AppName] :
            $arrayOfDefaultValues[FrameworkConstants::FrameworkConstants_Name_AppName];
    
    $valuesToUse[FrameworkConstants::FrameworkConstants_Name_BaseUrl] = array_key_exists(FrameworkConstants::FrameworkConstants_Name_BaseUrl, $arrayOfCustomValues) ?
            $arrayOfCustomValues[FrameworkConstants::FrameworkConstants_Name_BaseUrl] :
            $arrayOfDefaultValues[FrameworkConstants::FrameworkConstants_Name_BaseUrl];
    
    $valuesToUse[FrameworkConstants::FrameworkConstants_Name_EnableBenchmark] = array_key_exists(FrameworkConstants::FrameworkConstants_Name_EnableBenchmark, $arrayOfCustomValues) ?
            $arrayOfCustomValues[FrameworkConstants::FrameworkConstants_Name_EnableBenchmark] :
            $arrayOfDefaultValues[FrameworkConstants::FrameworkConstants_Name_EnableBenchmark];
    
    $valuesToUse[FrameworkConstants::FrameworkConstants_Name_ExecutionAccessRestriction] = array_key_exists(FrameworkConstants::FrameworkConstants_Name_ExecutionAccessRestriction, $arrayOfCustomValues) ?
            $arrayOfCustomValues[FrameworkConstants::FrameworkConstants_Name_ExecutionAccessRestriction] :
            $arrayOfDefaultValues[FrameworkConstants::FrameworkConstants_Name_ExecutionAccessRestriction];
    
    $valuesToUse[FrameworkConstants::FrameworkConstants_Name_RootDir] = array_key_exists(FrameworkConstants::FrameworkConstants_Name_RootDir, $arrayOfCustomValues) ?
            $arrayOfCustomValues[FrameworkConstants::FrameworkConstants_Name_RootDir] :
            $arrayOfDefaultValues[FrameworkConstants::FrameworkConstants_Name_RootDir];
    
    $valuesToUse[FrameworkConstants::FrameworkConstants_Name_TestAppName] = array_key_exists(FrameworkConstants::FrameworkConstants_Name_TestAppName, $arrayOfCustomValues) ?
            $arrayOfCustomValues[FrameworkConstants::FrameworkConstants_Name_TestAppName] :
            $arrayOfDefaultValues[FrameworkConstants::FrameworkConstants_Name_TestAppName];
        
    return $valuesToUse;
  }

  static function DefaultNamedConstantValues() {
    $DefaultAppName = "EasyMvc";
    return array(
        FrameworkConstants::FrameworkConstants_Name_AppName => $DefaultAppName,
        FrameworkConstants::FrameworkConstants_Name_BaseUrl => "/" . $DefaultAppName . "/",
        FrameworkConstants::FrameworkConstants_Name_EnableBenchmark => FALSE,
        FrameworkConstants::FrameworkConstants_Name_ExecutionAccessRestriction => TRUE,
        FrameworkConstants::FrameworkConstants_Name_RootDir => dirname(dirname(__FILE__)) . "/",
        FrameworkConstants::FrameworkConstants_Name_TestAppName => NULL,
    );
  }
}
