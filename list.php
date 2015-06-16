<?php
switch (filter_input(INPUT_GET, "Type"))
{
  case "Fruit":
    echo json_encode(["Apple", "Pear", "Orange"]);
    return;
  case "Vegetables":
    echo json_encode(["Spinage", "Carrot", "Tomato"]);
    return;
  default: 
    echo json_encode(["One", "Two", "Three"]);
    return;
    
}
