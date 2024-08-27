<?php 
// Helper function
function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }
  

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

//Post method for submission

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   

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

$sql = "DELETE FROM tasks ";
$sql .= "WHERE id= {$id} ";
$sql .= "LIMIT 1";


$result = mysqli_query($db, $sql);
//Test if quey succeeded
if(!$result){
    echo "Delete failed";
    exit;
}


//3. Use returned data if any
//no need
//4. Close db
mysqli_close($db);


}

redirect_to('index.php');
?>