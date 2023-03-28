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

//Fetch data from database
$user_array = $database->selectAllUsers($userID, $nickname);
?>

<html>
<head>
    <title>Search User</title>
    <nav class="nav">
        <ul>
            <li><a href="index.php"> Home </a></li>
            <li><a href="searchUser.php"> Search user and make friends </a></li>
            <li><a href="addRecipeToCompilation.php"> Search recipe and add to compilation </a></li>
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
        <input id="userID" name="userID" type="number" value='<?php echo $userID; ?>' min="0" placeholder = "enter userID">
    </div>
    <br>

    <!-- Nickname textbox:-->
    <div>
        <label for="nickname">Name:</label>
        <input id="nickname" name="nickname" type="text" class="form-control input-md" value='<?php echo $nickname; ?>' maxlength="30" placeholder = "user name">
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

<h2>Make Friends: </h2>
<form method="post" action="addFriend.php">
    <!-- UserID_1 textbox -->
    <div>
        <label for="userID_1">User1:</label>
        <input id="userID_1" name="userID_1" type="number" placeholder = "enter userID" required>
    </div>
    <br>

    <!-- UserID_2 textbox -->
    <div>
    <label for="userID_2">User2:</label>
        <input id="userID_2" name="userID_2" type="number" placeholder = "enter userID" required>
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            make friends
        </button>
    </div>
</form>

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