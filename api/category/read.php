<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/category.php';

//Instantiate DB & connect

$database = new Database();
$db = $database->connect();

//Instantiate category object

$category = new Category($db);

//category query
$result = $category->read();
//get row count
$num = $result->rowCount();

//check if any category
if($num>0)
{
    //category array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $cate_item = array(
            'id' => $id,
            'name' => $name
        );
        //push to data
        array_push($cat_arr['data'], $cate_item);
    }
//turn to json
echo json_encode($cat_arr);

}else{
    //no category
    echo json_encode(
        array('message' => 'no posts found')
    );
}

?>