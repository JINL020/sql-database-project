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
    <title>Search User</title>
    <nav class="nav">
        <ul>
            <li><a href="index.php"> Home </a></li>
            <li><a href="searchUser.php"> Search User </a></li>
        </ul>
    </nav>
</head>

<body>
<br>
<h1>My Cooking Dairy</h1>

<!-- Search form -->
<h2>Search User:</h2>
<form method="get">
    <!-- ID textbox:-->
    <div>
        <label for="userID">USER ID:</label>
        <input id="userID" name="userID" type="number" value='<?php echo $userID; ?>' min="0">
    </div>
    <br>

    <!-- Nickname textbox:-->
    <div>
        <label for="nickname">Name:</label>
        <input id="nickname" name="nickname" type="text" class="form-control input-md" value='<?php echo $nickname; ?>' maxlength="30">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Search
        </button>
    </div>
</form>
<br>
<hr>

<!-- Search result -->
<h2>User Search Result:</h2>
<table>
    <tr>
        <th>UserID</th>
        <th>Nickname</th>
        <th>Email</th>
    </tr>
    <?php foreach ($user_array as $user) : ?>
        <tr>
            <td><?php echo $user['USERID']; ?>  </td>
            <td><?php echo $user['NICKNAME']; ?>  </td>
            <td><?php echo $user['EMAIL']; ?>  </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>