<?php

include "DBGateway.php";
$request = filter_input_array(INPUT_GET);
$conn = new DB();
$conn->UpdateRecord("Items", ["Product Desc" => "Crab Apples"], ["ID" => 1]);
echo "<pre>" . print_r($conn->ReadRecords("Items", ["Isle" => 3]), TRUE) . "</pre>";

switch ($conn) {
  case $value:


    break;

  default:
    break;
}
