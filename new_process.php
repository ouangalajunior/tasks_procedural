<?php


error_reporting(E_ALL);

// Helper function
function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }
  

//Post method for submission

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $task = [];
    $task['description'] = $_POST['description'] ?? '';
    $task['priority'] = $_POST['priority'] ?? '10';
    $task['complete'] = $_POST['complete'] ?? '0';
    $task['due_date'] = $_POST['due_date'] ?? '';

    //1. Create database
    $db = mysqli_connect("127.0.0.1", "root", "", "php_learning", 3308);

// Test if connection succeed
if (mysqli_connect_errno()) {
    $msg = "Database connection failed: ";
    $msg .= mysqli_connect_error();
    $msg .= " (" . mysqli_connect_error() . ")";
    exit($msg);
}
//2. Perform database query

/*
$sql = "INSERT INTO tasks(priority, description, complete, due_date) VALUES ";
$sql .= "(";
$sql .= "'" . mysqli_real_escape_string($db, $task['priority']) . "',";
$sql .= "'" . mysqli_real_escape_string($db, $task['description']) . "',";
$sql .= "'" . mysqli_real_escape_string($db, $task['due_date']) . "',";
$sql .= "'" . mysqli_real_escape_string($db, $task['complete']) . "'";
$sql .= ")";
*/
$sql = "INSERT INTO tasks(priority, description, complete, due_date) VALUES ";
$sql .= "(";
$sql .= "'" . mysqli_real_escape_string($db, $task['priority']) . "',";
$sql .= "'" . mysqli_real_escape_string($db, $task['description']) . "',";
$sql .= "'" . mysqli_real_escape_string($db, $task['complete']) . "',"; // Correct position for 'complete'
$sql .= "'" . mysqli_real_escape_string($db, $task['due_date']) . "'";  // Correct position for 'due_date'
$sql .= ")";

$result = mysqli_query($db, $sql);
//Test if quey succeeded
if(!$result){
    echo "Insert failed";
    exit;
}


//3. Use returned data if any
$new_id = mysqli_insert_id($db);
//4. Close db
mysqli_close($db);
redirect_to('show.php?id=' . $new_id);

}
?>