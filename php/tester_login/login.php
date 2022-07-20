<?php

// Include DatabaseHelper.php file
require_once('DatabaseHelper.php');

// Instantiate DatabaseHelper class
$database = new DatabaseHelper();

// Get parameter from GET Request (btw. you can see the parameters in the URL if they are set)
$userID = '';
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
}

$nickname = '';
if (isset($_GET['nickname'])) {
    $nickname = $_GET['nickname'];
}

$password = '';
if (isset($_GET['password'])) {
    $password = $_GET['password'];
}

$email = '';
if (isset($_GET['email'])) {
    $email = $_GET['email'];
}

//Fetch data from database
$user_array = $database->selectAllUsers($userID, $nickname , $email);
?>

<html>
<head>
    <title>Login</title>
</head>

<body>
<br>
<h1>My Cooking Dairy</h1>
<h2>Loginn</h2>
<!-- Add User -->
<h2>Add User: </h2>
<form method="post" action="addUser.php">
    <!-- Nickname textbox -->
    <div>
        <label for="new_nickname">Nickname:</label>
        <input id="new_nickname" name="nickname" type="text" placeholder="nickname" maxlength="30" required>
    </div>
    <br>

    <!-- password textbox -->
    <div>
        <label for="new_password">Password:</label>
        <input id="new_password" name="password" type="text" placeholder="at least 6 characters" maxlength="20" required>
    </div>
    <br>

    <!-- email textbox -->
    <div>
        <label for="new_email">Email:</label>
        <input id="new_email" name="email" type="email" placeholder="email" maxlength="50" required>
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Add User
        </button>
    </div>
</form>
<br>
<hr>
</body>
</html>