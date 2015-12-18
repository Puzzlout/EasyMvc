<?php

/**
 * Test class for LinkControl.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package LinkControlTest
 */

namespace Tests;

class LinkControlTest extends \PHPUnit_Framework_TestCase {

  public function testInitMethod() {
    $result = UC\LinkControl::Init();
    $this->assertInstanceOf('Library\UC\LinkControl', $result);
  }
}
