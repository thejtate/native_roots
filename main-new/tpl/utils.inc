<?php

class Utils {

  protected static $vars = array();

  public static function get($key) {
    return isset(Utils::$vars[$key]) ? Utils::$vars[$key] : true;
    return isset($vars[$key]) ? $vars[$key] : true;
  }

  public static function set($key, $value) {
    Utils::$vars[$key] = $value;
  }
}