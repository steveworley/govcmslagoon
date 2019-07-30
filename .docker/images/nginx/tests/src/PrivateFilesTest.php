<?php

namespace GovCMSTests;

use PHPUnit\Framework\TestCase;

/**
 * Ensure that the private files are restricted.
 */
class PrivateFilesTest extends TestCase {

  /**
   * Return a list of files to test.
   *
   * @return array
   *    File list.
   */
  public function filesProvider() {
    $path = dirname(__DIR__);
    return [
      ["autotest.jpg", "$path/resources/"],
      ["autotest.pdf", "$path/resources/"],
      ["autotest.rtf", "$path/resources/"],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    $dir = dirname(__DIR__, 5);
    is_dir($dir . '/files/private') ?: mkdir("$dir/files/private");
    foreach ($this->filesProvider() as $parts) {
      list($file, $path) = $parts;
      `cp {$path}{$file} ../../../../files/private/`;
    }
  }

  /**
   * Ensure that private files are restricted.
   *
   * @dataProvider filesProvider
   */
  public function testFileAccess($file) {
    $path = "/sites/default/files/private/$file";
    $headers = \get_curl_headers($path);
    $this->assertEquals(404, $headers['Status'], "[$path] is publicly accessible");
  }

}
