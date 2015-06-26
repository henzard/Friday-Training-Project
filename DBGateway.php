<?php

// <editor-fold defaultstate="collapsed" desc="Error Handeling">
$logfile = realpath('.') . DIRECTORY_SEPARATOR . "sys.log";

function UpdateLog($string) {
  global $logfile;
  $fh = fopen($logfile, 'a');
  fwrite($fh, date("Y-m-d \| H:i:s") . " | " . $string . "\n");
  fclose($fh);
}

function ExceptionHandel($exception) {
  $error_msg = 'Fatal error: Uncaught exception \'' . get_class($exception) . '\' with message ';
  $error_msg .= $exception->getMessage() . '/n';
  $error_msg .= 'Stack trace:' . $exception->getTraceAsString() . '/n';
  $error_msg .= 'thrown in ' . $exception->getFile() . ':' . $exception->getLine();
  UpdateLog($error_msg);
}

function ErrorHandle($errno, $errstr, $errfile, $errline) {
  if (!(error_reporting() & $errno)) {
    $error_msg = "This error code is not included in error_reporting $errfile:$errline [$errno] $errstr\n";
    UpdateLog($error_msg);
    return;
  }
  switch ($errno) {
    case E_USER_ERROR:
      $error_msg = "E_USER_ERROR $errfile:$errline [$errno] $errstr\n";
      break;
    case E_USER_WARNING:
      $error_msg = "E_USER_WARNING $errfile:$errline [$errno] $errstr\n";
      break;
    case E_USER_NOTICE:
      $error_msg = "E_USER_NOTICE $errfile:$errline [$errno] $errstr\n";
      break;
    default:
      $error_msg = "Unknown error type $errfile:$errline [$errno] $errstr\n";
      break;
  }
  UpdateLog($error_msg);
}

function fatal_handler() {
  $error = error_get_last();

  if ($error !== NULL) {
    $error_msg = "Fatal error: $error[file]:$error[line] [$error[type]] $error[message]\n";
    UpdateLog($error_msg);
  }
}

set_error_handler("ErrorHandle", E_ALL | E_STRICT);
set_exception_handler("ExceptionHandel");
register_shutdown_function("fatal_handler");


// </editor-fold>
$hostname_novi = "localhost";
$username_novi = "root";
$password_novi = "";
$database_novi = "shoppinglist";

class DB {

  private $conn;

  public function __construct() {
    global $hostname_novi, $username_novi, $password_novi, $database_novi;
    $this->conn = new mysqli($hostname_novi, $username_novi, $password_novi, $database_novi);

    if (mysqli_connect_errno()) {
      $error_msg = "Database connection error in " . __FILE__ . " ";
      $error_msg .= mysqli_connect_error() . " / ";
      $error_msg .= mysqli_connect_errno();
      UpdateLog($error_msg);
      exit();
    }
  }

  function CreateRecord($table, $data) {
    $cols = "`" . implode('`,`', array_keys($data)) . "`";
    foreach (array_values($data) as $value) {
      isset($vals) ? $vals .= ',' : $vals = '';
      $vals .= '\'' . $this->conn->real_escape_string($value) . '\'';
    }
    $sql = 'INSERT INTO ' . $table . ' (' . $cols . ') VALUES (' . $vals . ')';
    $insert = $this->conn->real_query($sql);
    if (!$insert) {
      $error_msg = "Database insert error in " . __FILE__ . " ";
      $error_msg .= $this->conn->error;
      UpdateLog($error_msg . "[$sql]");
      return $this->conn->error;
    }
    return mysqli_insert_id($this->conn);
  }

  function UpdateRecord($table, $data, $whereclause) {
    foreach ($data as $key => $value) {
      isset($vals) ? $vals .= ',' : $vals = '';
      $vals .= '`' . $key . '` = \'' . $this->conn->real_escape_string($value) . '\'';
    }
    foreach ($whereclause as $key => $value) {
      isset($where) ? $where .= ' and ' : $where = '';
      $where .= $key . ' = \'' . $this->conn->real_escape_string($value) . '\'';
    }
    $update = $this->conn->real_query('UPDATE ' . $table . ' SET ' . $vals . ' WHERE ' . $where);
    if (!$update) {
      $error_msg = "Database update error in " . __FILE__ . " ";
      $error_msg .= $this->conn->error;
      UpdateLog($error_msg);
      return $this->conn->error;
    }
    return mysqli_affected_rows($this->conn);
  }

  private function Read($table, $whereclause) {
    foreach ($whereclause as $key => $value) {
      isset($where) ? $where .= ' and ' : $where = '';
      $where .= $key . ' = \'' . $this->conn->real_escape_string($value) . '\'';
    }
    $select = $this->conn->query('SELECT * FROM ' . $table . ($whereclause !== null ? ' WHERE ' . $where : ""));
    if (!$select) {
      $error_msg = "Database select error in " . __FILE__ . " ";
      $error_msg .= $this->conn->error;
      UpdateLog($error_msg);
      return $this->conn->error;
    }
    return $select;
  }

  function ReadRecord($table, $whereclause) {
    $select = $this->Read($table, $whereclause);
    if (gettype($select) !== 'object') {
      return;
    }
    return mysqli_fetch_assoc($select);
  }

  function ReadRecords($table, $whereclause = NULL) {
    $select = $this->Read($table, $whereclause);
    $result = array();
    if (gettype($select) !== 'object') {
      return;
    }
    while ($row = mysqli_fetch_assoc($select)) {
      if ($row !== null) {
        $result[] = $row;
      }
    }
    return $result;
  }

}
