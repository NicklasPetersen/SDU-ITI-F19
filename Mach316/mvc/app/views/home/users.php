<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='../../app/css/general.css'>";?>

<h1>Users!</h1>
<form action="searchusers" method="post">
    <input type="text" name="searchparam"/>
    <input type="submit"/>
</form>
