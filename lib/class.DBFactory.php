<?php
  class DBFactory
  {
    public static function getPDO()
    {
      $db = new PDO('mysql:host=localhost; dbname=simple', 'root', '');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $db;
    }
  }
?>