<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

//Grab variables from POST request
$userID_1 = '';
if (isset($_POST['userID_1'])) {
    $userID_1 = $_POST['userID_1'];
}

$userID_2 = '';
if (isset($_POST['userID_2'])) {
    $userID_2 = $_POST['userID_2'];
}

// Insert method
$success = $database->insertIntoFriend($userID_1, $userID_2);

// Check result
if ($success){
    echo "User with ID $userID_1 is now friends with User with ID $userID_2";
}
else{
    echo "friends request denied!";
}
?>

<!-- link back to index page-->
<br>
<a href="searchUser.php">
    go back
</a>