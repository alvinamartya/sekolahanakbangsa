<?php
class AksiData {
  // Hold the class instance.
  private static $instance = [
      'nama' => 'Samodra'
  ];

  // The constructor is private
  // to prevent initiation with outer code.
  private function __construct()
  {
    // The expensive process (e.g.,db connection) goes here.
  }

  // The object is created from within the class itself
  // only if the class has no instance.
  public static function getInstance()
  {
    if (self::$instance == null)
    {
      self::$instance = new AksiData();
    }

    return self::$instance;
  }

  public static function setInstance($data) {
    self::$instance = $data;
  }
}