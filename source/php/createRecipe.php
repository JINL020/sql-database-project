<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

//Grab variables from POST request
$title = '';
if (isset($_POST['title'])) {
    $title = $_POST['title'];
}

$preptime = '';
if (isset($_POST['preptime'])) {
    $preptime = $_POST['preptime'];
}

$description = '';
if (isset($_POST['description'])) {
    $description = $_POST['description'];
}

$writer = '';
if (isset($_POST['writer'])) {
    $writer = $_POST['writer'];
}
// Insert method
$success = $database->insertIntoRecipe($title, $preptime, $description, $writer);

// Check result
if ($success){
    echo "Recipe $title successfully posted!";
}
else{
    echo "Error can't post recipe!";
}
?>

<!-- link back to index page-->
<br>
<a href="addRecipeToCompilation.php">
    go back
</a>