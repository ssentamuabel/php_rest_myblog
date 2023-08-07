<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instatiate the database and connect
$database = new Database();
$db = $database->connect();

// Instatiate the post object
$post = new Post($db);

// GET ID FROM THE URL
$post->id = isset($_GET['id']) ? $_GET['id'] : die();


// GET POST
$post->read_single();

// CREATE ARRAY
$post_arr = array( 
    'id'=> $post->id,
    'title'=> $post->title,
    'body'=> $post->body,
    'author'=>$post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
);

// MAKE JSON
print_r(json_encode($post_arr));