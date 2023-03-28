<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

//Grab variable id from POST request
$userID = '';
if(isset($_POST['userID'])){
    $userID = $_POST['userID'];
}

// Delete method
$error_code = $database->deleteUser($userID);

// Check result
if ($error_code == 1){
    echo "User with ID: $userID successfully deleted!'";
}
else{
    echo "Error can't delete user with ID: $userID";
    echo "Errorcode: $error_code";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>