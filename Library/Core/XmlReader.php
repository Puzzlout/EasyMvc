<?php

namespace Library\Core;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

/**
 * Read xml files and return contents.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package XmlReader
 */
class XmlReader {

  private $filePath;
  private $currentFileTimeStamp;
  private $lastModifiedTimeStamp;

  public function __construct($filePath, $fileName = NULL) {
    $this->filePath = isset($fileName) ?
            $this->GetConfigurationFilePath($fileName) :
            $filePath;
    $this->currentFileTimeStamp = file_exists($this->filePath) ?
            filemtime($this->filePath) :
            0;
  }

  public function setCurrentFileTimeStamp() {
    $this->currentFileTimeStamp = filemtime($this->filePath);
  }

  public function setLastModifiedTimeStamp($lastModifiedTimeStamp) {
    $this->lastModifiedTimeStamp = $lastModifiedTimeStamp;
  }

  public function currentFileTimeStamp() {
    return $this->currentFileTimeStamp;
  }

  public function lastModifiedTimeStamp() {
    return $this->lastModifiedTimeStamp;
  }

  public function filePath() {
    return $this->filePath;
  }

  public function FileIsNewer() {
    return $this->currentFileTimeStamp > $this->lastModifiedTimeStamp;
  }

  /**
   * Builds the filePath to the configuration file.
   * 
   * @param string $fileName : the file name with .xml extension.
   * @return string
   */
  public function GetConfigurationFilePath($fileName) {
    return FrameworkConstants_RootDir . \Library\Enums\ApplicationFolderName::AppsFolderName . \Library\Helpers\CommonHelper::GetAppName() . '/Config/' . $fileName;
  }

  /**
   * Gets the content of a DOMDocument for a node name. 
   * 
   * @param string $filePath : the file path to load.
   * @param string $nodeName : the node name to find in the xml.
   * @return boolean|DOMNodeList
   */
  public function ReturnFileContents($nodeName) {
    if (file_exists($this->filePath)) {

      $xml = new \DOMDocument;
      $xml->load($this->filePath);

      return $xml->getElementsByTagName($nodeName);
    }
    return FALSE;
  }

}
