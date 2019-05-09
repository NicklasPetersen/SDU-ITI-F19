<?php
    include "../app/views/partials/header.php";


?>


<main>
    <script>
        function deleteImage(_id){


            $.ajax({
                url: '/sabah15/mvc/public/home/deleteImage',
                type: 'POST',
                data: { 'deleteId':_id },
                success: function(response){

                    if(response == 1){
                        // Remove image source

                        var image = document.getElementById(_id);
                        image.parentNode.removeChild(image);
                    }
                }


            });

        }
    </script>
    <?php
    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
        echo '<div class="row">
        <div class="container">
            <form action="/sabah15/mvc/public/home/uploadImage" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-25">
                        <label for="title">Image Title</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="title" name="imagetitle" placeholder="Title..">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="description">Image Description</label>
                    </div>
                    <div class="col-75">
                        <textarea id="desc" name="imagedesc" placeholder="Write a description.." style="height:100px"></textarea>
                    </div>
                </div>

                <div class="row">
                    <input type="file" name="image" >
                    <input type="hidden" name="userId" value=' .$userId.'>
                    <button type="submit" name="image-submit" >Upload</button>
                </div>
            </form>
        </div>
        </div>';
    }
    else {
        echo '<div class="row"><h1>Log in to upload images and to see your uploads</h1></div>';
    }
    ?>
    <div class="row">

        <div class="leftcolumn">
            <div class="card">
                <div class="flex-container">
                    <?php

                    if (isset($_SESSION['userId'])) {
                        foreach ($viewbag["images"] as $image) {
                            echo '<div class="gallery">
                                <!--<form action="/sabah15/mvc/public/home/deleteImage/'.$image->idGallery.'" method="post" enctype="multipart/form-data">-->
                                <h2>' . $image->imageTitle . '</h2>
                                <p>By:' . $image->userId . '</p>
                                <img src="/sabah15/mvc/public/resources/gallery/' . $image->imageName . '" id='.$image->idGallery.'">
                                <div class="desc">' . $image->imageDesc . '</div>
                                <button  onclick="deleteImage('.$image->idGallery.')" name="image-delete" type="submit" value="' . $image->imageName . '" >Delete</button>
                              </div>
                            <!--</form>-->';
                        }

                    }



                    ?>

                </div>
            </div>

        </div>
        <div class="rightcolumn">
            <div class="card">
                <h2>About Me</h2>
                <a target="_blank" href="/sabah15/mvc/public/resources/sam.jpg">
                    <img src="/sabah15/mvc/public/resources/sam.jpg" alt="Sam" style="width: 100%;">
                </a>
                <p>Some text..</p>
            </div>
        </div>
    </div>

</main>

<?php
    include "../app/views/partials/footer.php";
?>
