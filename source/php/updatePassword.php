<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$userID = '';
if(isset($_POST['userID'])){
    $userID = $_POST['userID'];
}

$new_password = '';
if(isset($_POST['new_password'])){
    $new_password = $_POST['new_password'];
}

// update method
$success = $database->updatePassword($userID, $new_password);

// Check result
if ($success){
    echo "password successfully updated!";
}
else{
    echo "Error can't update password";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>