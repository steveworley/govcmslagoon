<?php

namespace GovCMSTests;

use PHPUnit\Framework\TestCase;

class FilesCacheTest extends TestCase {

  /**
   * Return a list of files to test.
   *
   * @return array
   *   File list.
   */
  public function filesProvider() {
    $path = dirname(__DIR__);
    return [
      ["autotest.jpg", "$path/resources/", 'public, max-age=2628001'],
      ["autotest.pdf", "$path/resources/", 'max-age=1800'],
      ["autotest.rtf", "$path/resources/", 'max-age=2628001'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    $dir = dirname(__DIR__, 5);
    foreach ($this->filesProvider() as $parts) {
      list($file, $path) = $parts;
      `cp {$path}{$file} ../../../../files`;
    }
  }

  /**
   * Ensure that expires headers are correctly set.
   *
   * @dataProvider filesProvider
   */
  public function testHeader($file, $path, $expected) {
    $path = "/sites/default/files/$file";
    $headers = \get_curl_headers($path);
    $this->assertEquals($expected, $headers['Cache-Control']);
  }

}
