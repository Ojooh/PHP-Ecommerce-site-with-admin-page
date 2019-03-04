<?php

$items = array();
$items[] = array(
  array("id"=>"31","size"=>"Large L","quantity"=>"1"),
  array("id"=>"34","size"=>"N/A","quantity"=>"1"),
  array("id"=>"29","size"=>"N/A","quantity"=>"1")
);

$edit_id ="29";
$edit_size = "N/A";
foreach($items as $item ){
  // if($item['id'] != $edit_id && $item['size'] != $edit_size){
  //   $updated_items[] = $item;
  // }
  var_dump($item["id"]);
}



//var_dump($updated_items);
