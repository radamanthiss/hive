<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2/06/2018
 * Time: 4:33 PM
 */

$content = file_get_contents("json/recomended.json");
$item_data = json_decode($content,true);
$data = array();

print_r($data);