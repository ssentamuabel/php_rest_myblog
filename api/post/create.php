<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instatiate the database and connect
$database = new Database();
$db = $database->connect();

// Instatiate the post object
$post = new Post($db);

// GET ROW POSTED DATA
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;


if($post->create())
{
    echo json_encode( array('message'=>'Post Created'));
}else
{
    echo json_encode( array('message'=>'Post NOt Created'));
}
