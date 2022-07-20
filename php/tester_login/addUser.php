<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

//Grab variables from POST request
$nickname = '';
if (isset($_POST['nickname'])) {
    $nickname = $_POST['nickname'];
}

$password = '';
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}

$email = '';
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
// Insert method
$success = $database->insertIntoUsers($nickname, $password, $email);

// Check result
if ($success){
    echo "User $nickname successfully added!";
}
else{
    echo "Error can't insert User $nickname!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>