<?php

include "DBGateway.php";
$request = filter_input_array(INPUT_GET); // http://www.henzard.co.za/list.php?type=me&action=done
$conn = new DB();
//$conn->UpdateRecord("Items", ["Product Desc" => "Crab Apples"], ["ID" => 1]);
//echo "<pre>" . print_r($conn->ReadRecords("Items", ["Isle" => 3]), TRUE) . "</pre>";

switch ($request["action"]) {
  case "Create":
    echo json_encode($conn->CreateRecord($request["table"], json_decode($request["data"])));
    break;

  case "Read":
    echo json_encode($conn->ReadRecords($request["table"], json_decode($request["where"])));
    break;

  case "Update":
    echo json_encode($conn->UpdateRecord($request["table"], json_decode($request["data"]), json_decode($request["where"])));
    break;

  case "Delete":


    break;

  default:
    echo json_encode(["error" => "No Action Selected"]);
    break;
}
