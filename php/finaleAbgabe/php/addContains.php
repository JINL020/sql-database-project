<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

//Grab variables from POST request
$compilation = '';
if (isset($_POST['compilation'])) {
    $compilation = $_POST['compilation'];
}

$recipe = '';
if (isset($_POST['recipe'])) {
    $recipe = $_POST['recipe'];
}

// Insert method
$success = $database->insertIntoContains($compilation, $recipe);

// Check result
if ($success){
    echo "Recipe with ID $recipe sucessfully added to compilation with ID $compilation!";
}
else{
    echo "Recipe with ID $recipe could not be added to compilation with ID $compilation!";
}
?>

<!-- link back to index page-->
<br>
<a href="addRecipeToCompilation.php">
    go back
</a>