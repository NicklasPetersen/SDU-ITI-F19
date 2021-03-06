<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
     integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
     crossorigin="anonymous">
    <link rel="stylesheet" href="/dpete17/mvc/app/views/main-style.css">
    <link rel="stylesheet" href="/dpete17/mvc/app/views/dashboard/dashboard-style.css">
    <title>Project A01</title>
</head>
<body>
    <div class="container">
        <header class="dashboard-header">
            <h1>Project A01</h1>
            <ul>
                <li><a class="active" href="">Your Images</a></li>
                <li><a href="images">Uploaded Images</a></li>
                <li><a href="accounts">View All Accounts</a></li>
                <li><a href="logout">Logout</a></li>
            </ul>
            <?php 
                echo "<h4>{$viewbag['username']}</h4>";
            ?>
        </header>
        <div class="dashboard-body">
            <div style="text-align: center;"><span id="message">
                <?php

                    if(isset($_SESSION['MESSAGE'])) {
                        echo $_SESSION['MESSAGE'];
                        unset($_SESSION['MESSAGE']);
                    }

                ?>
            </span></div>
            <form action="upload" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="Title" name="header" id="upload-header" required>
                <br>
                <textarea name="content" placeholder="Content" cols="30" rows="10" id="upload-content" disable></textarea>
                <br>
                <input type="file" name="image" required>
                <button type="submit">Submit Picture!</button>
            </form>
            <hr>
            <div class="image-container">
                <?php
                    foreach ($viewbag['images'] as $image) {
                        if(substr($image -> base64, 0, strlen('data') != 'data')) {
                            $src = '<img src="data:'.$image -> getMimeType().';base64,'.$image -> base64.'" alt="Error.." >';
                        } else {
                            $src = '<img src=";base64,'.$image -> base64.'" alt="Error.." >';
                        }
                    
                        echo '<div><h2>'.$image -> header.'</h2><span>'.$image -> content.'</span><br>'.$src.'</div>';
                        echo '<hr>';
                    }
                ?>
            </div>
        </div>

        <?php include('../app/views/partials/main-footer.php'); ?>
    </div>
</body>
</html>