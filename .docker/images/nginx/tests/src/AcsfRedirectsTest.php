<?php

namespace GovCMSTests;

use PHPUnit\Framework\TestCase;

class AcsfRedirectsTest extends TestCase {

  /**
   * A list of common ACSF paths.
   *
   * @return array
   *   A list of paths.
   */
  public function provideAcsfPaths() {
    return [
      ['/sites/g/files/net12409/themes/site/mysite/autotest.jpg'],
      ['/sites/g/files/net1234/f/autotest.jpg'],
    ];
  }

  public function setUp(): void {

  }

  /**
   * Ensure that ACSF paths correctly redirect to new locations.
   *
   * @dataProvider provideAcsfPaths
   */
  public function testRedirect($acsf_path) {
    $headers = \get_curl_headers($acsf_path);
    $this->assertEquals(200, $headers['Status']);
  }

}
