<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

//Grab variables from POST request
$title = '';
if (isset($_POST['title'])) {
    $title = $_POST['title'];
}

$description = '';
if (isset($_POST['description'])) {
    $description = $_POST['description'];
}

$userID = '';
if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];
}
// Insert method
$success = $database->insertIntoCompilation($title, $description, $userID);

// Check result
if ($success){
    echo "Compilation $title successfully created!";
}
else{
    echo "Error can't create compilation!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>