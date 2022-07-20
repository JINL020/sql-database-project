<?php

// Include DatabaseHelper.php file
require_once('DatabaseHelper.php');

// Instantiate DatabaseHelper class
$database = new DatabaseHelper();

$title = '';
if (isset($_GET['title'])) {
    $title = $_GET['title'];
}

$preptime = '';
if (isset($_GET['preptime'])) {
    $preptime = $_GET['preptime'];
}

$writer = '';
if (isset($_GET['writer'])) {
    $writer = $_GET['writer'];
}

//Fetch data from database
$recipe_array = $database->selectAllRecipe($title, $preptime, $writer);
?>

<html>
<head>
    <title>Search recipe</title>
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

<!-- Post Recipe -->
<h2>Post Recipe: </h2>
<form method="post" action="createRecipe.php">
    <!-- Title textbox -->
    <div>
        <label for="title">Titel:</label>
        <input id="title" name="title" type="text" placeholder = "Title" maxlength="50">
    </div>
    <br>

    <!-- preptime textbox -->
    <div>
        <label for="preptime">Preptime:</label>
        <input id="preptime" name="preptime" type="number" min="0" placeholder = "Preptime in minutes" required>
    </div>
    <br>

    <!-- describtion textbox -->
    <div>
        <label for="description">Description:</label>
        <input id="description" name="description" type="text" placeholder = "description" maxlength="200">
    </div>
    <br>

    <!-- writer textbox -->
    <div>
        <label for="writer">Author:</label>
        <input id="writer" name="writer" type="number" placeholder = "enter userID" min="o" required>
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
        Post Recipe
        </button>
    </div>
</form>
<br>
<hr>

<h2>Add recipe to compilation: </h2>
<form method="post" action="addContains.php">
    <!-- compilation textbox -->
    <div>
        <label for="compilation">CompilationID:</label>
        <input id="compilation" name="compilation" type="number" placeholder = "compilationID" required>
    </div>
    <br>

    <!-- recipe textbox -->
    <div>
    <label for="recipe">RecipeID:</label>
        <input id="recipe" name="recipe" type="number" placeholder = "recipeID" required>
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            add to compilation
        </button>
    </div>
</form>

<!-- Search form -->
<h2>Search recipe:</h2>
<form method="get">
    <!-- Title textbox -->
    <div>
        <label for="title">Titel:</label>
        <input id="title" name="title" type="text" value='<?php echo $title; ?>' placeholder = "Title" maxlength="50">
    </div>
    <br>

    <!-- preptime textbox -->
    <div>
        <label for="preptime">Preptime:</label>
        <input id="preptime" name="preptime" type="number" value='<?php echo $preptime; ?>' placeholder = "prepTime in minutes" min="0">
    </div>
    <br>

    <!-- writer textbox -->
    <div>
        <label for="writer">ID:</label>
        <input id="writer" name="writer" type="number" placeholder = "enter userID" value='<?php echo $writer; ?>' min="o">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
        Search recipe
        </button>
    </div>
</form>
<br>
<hr>

<!-- Search result -->
<h2>Recipe search result:</h2>
<table>
    <tr>
        <th>RecipeID</th>
        <th>Title</th>
        <th>Preptime</th>
        <th>Writer</th>
    </tr>
    <?php foreach ($recipe_array as $recipe_row) : ?>
        <tr>
            <td><?php echo $recipe_row['RECIPEID'];?> </td>
            <td><?php echo $recipe_row['TITLE']; ?></td>
            <td><?php echo $recipe_row['PREPTIME']; ?></td>
            <td><?php echo $recipe_row['WRITER']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>