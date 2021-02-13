<?php
class Database
{
  private $host;
  private $user;
  private $pass;
  private $database;
  public $con;

  function __construct($host, $user, $pass, $database)
  {
    $this->host = $host;
    $this->user = $user;
    $this->pass = $pass;
    $this->database = $database;

    $this->con = new mysqli($this->host, $this->user, $this->pass, $this->database) or die(mysqli_error());
    if ($this->con) {
      return false;
    } else {
      return false;
    }
  }
}
