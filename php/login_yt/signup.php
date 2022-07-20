<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

<!-- Add User -->
<h2>Sign up: </h2>
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
<a href="login.php">Login</a>
</body>
</html>