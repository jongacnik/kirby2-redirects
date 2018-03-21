<?php

/**
 * KirbyRedirects
 *
 * Included blueprint field group:
 * redirects: redirects
 *
 * Add to header.php
 * $site->redirect();
 *
 */

namespace KirbyRedirects;
use site;
use header;

class KirbyRedirects {
  public static function register () {
    site::$methods['redirect'] = function ($site) {
      return self::redirect();
    };

    kirby()->set('blueprint', 'fields/redirects', __DIR__ . '/blueprints/redirects.yml');
  }

  public static function redirect () {
    $redirects = site()->redirects()->yaml();
    $current = $_SERVER['REQUEST_URI'];
    foreach ($redirects as $redirect) {
      if ($current == $redirect['oldurl']) {
        header::redirect($redirect['newurl'], 301);
      }
    }
  }
}

KirbyRedirects::register();