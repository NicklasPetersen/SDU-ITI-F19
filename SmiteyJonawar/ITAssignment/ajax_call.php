<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 21-03-2019
 * Time: 12:08
 */

require "db_manager.php";
    $result = really_good_ajax();
    for ($x = 0; $x < sizeof($result); $x++) {
        echo "User: ";
        echo $result[$x]["username"];
        echo "<br>";
    }
