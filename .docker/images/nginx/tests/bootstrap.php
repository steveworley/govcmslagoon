<?php

/**
 * PHPUnit Bootstrap file.
 */

include_once __DIR__ . '/vendor/autoload.php';

function get_curl_headers($path = "/", $opts = NULL) {
  $uri = getenv('LOCALDEV_URL') ?: 'http://govcmslagoon.docker.amazee.io';

  $response = null;

  $path = '/' . ltrim($path, '/');

  exec("curl {$uri}{$path} -I {$opts}", $response);

  if (empty($response)) {
    return [];
  }

  $response = array_map('trim', $response);

  foreach ($response as $line) {
    if (strpos($line, 'HTTP') !== false) {
      $part = explode(' ', $line);
      $headers['Status'] = trim($part[1]);
      continue;
    }
    $part = explode(':', $line);
    if (count($part) == 2) {
      $headers[$part[0]] = trim($part[1]);
    }
  }

  return $headers;
}
