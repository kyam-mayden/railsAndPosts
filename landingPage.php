<?php
session_start();

if($_SESSION['invalidInput']===true){
    echo "You entered an invalid input";
} else{}
?>


<h1> Posts and Rails exercise</h1>

<form method="GET" action="index.php">
    <label for="length">Length </label>
    <input type="number" step = "0.1" name="length">meters
    <input type="submit">
</form>
<form method="GET" action="index.php">
    <label for="posts">Posts</label>
    <input type ="number" name="posts">
    <label for="rails">Rails</label>
    <input type ="number" name="rails">
    <input type="submit">
</form>
