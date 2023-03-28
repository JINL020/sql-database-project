<?php

// Include DatabaseHelper.php file
require_once('DatabaseHelper.php');

// Instantiate DatabaseHelper class
$database = new DatabaseHelper();

?>

<html>
<head>
    <title>DBS Project WS2020</title>
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

<!-- Add User -->
<h2>Sign up: </h2>
<form method="post" action="addUser.php">
    <!-- Nickname textbox -->
    <div>
        <label for="new_nickname">Nickname:</label>
        <input id="new_nickname" name="nickname" type="text" maxlength="30" placeholder = "nickname" required>
    </div>
    <br>

    <!-- password textbox -->
    <div>
        <label for="new_password">Password:</label>
        <input id="new_password" name="password" type="text" placeholder = "at least 6 characters" maxlength="20" required>
    </div>
    <br>

    <!-- email textbox -->
    <div>
        <label for="new_email">Email:</label>
        <input id="new_email" name="email" type="email" placeholder = "name@email.com" maxlength="50" required>
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Sign up
        </button>
    </div>
</form>
<br>
<hr>

<!-- Delete User -->
<h2>Delete User: </h2>
<form method="post" action="delUser.php">
    <!-- ID textbox -->
    <div>
        <label for="userID">ID:</label>
        <input id="userID" name="userID" type="number" placeholder = "enter userID" min="0" required>
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Delete User
        </button>
    </div>
</form>
<br>
<hr>

<!-- Update password -->
<h2>Update password: </h2>
<form method="post" action="updatePassword.php">
    <!-- ID textbox -->
    <div>
        <label for="userID">ID:</label>
        <input id="userID" name="userID" type="number" placeholder = "enter userID" min="o" required>
    </div>
    <br>

    <div>
        <label for="new_password">new password:</label>
        <input id="new_password" name="new_password" type="text" placeholder = "at least 6 characters" min="6" required>
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Update password
        </button>
    </div>
</form>
<br>
<hr>

<!-- create compilation -->
<h2>create compilation: </h2>
<form method="post" action="addCompilation.php">
    <!-- Title textbox -->
    <div>
        <label for="title">Titel:</label>
        <input id="title" name="title" type="text" placeholder = "Title" maxlength="50">
    </div>
    <br>

    <!-- describtion textbox -->
    <div>
        <label for="description">Description:</label>
        <input id="description" name="description" type="text" placeholder = "description" maxlength="200">
    </div>
    <br>

    <!-- userID textbox -->
    <div>
        <label for="userID">Creator:</label>
        <input id="userID" name="userID" type="number" placeholder = "enter userID" min="o" required>
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
        create compilation
        </button>
    </div>
</form>
<br>
<hr>

</body>
</html>