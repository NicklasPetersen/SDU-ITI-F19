<?php


namespace app\view\partials;


use app\model\Picture;

class PicturePartial
{
    public static function show(Picture $picture, bool $showDelete = false)
    {
        $username = $picture->user->username;
        $fName = $picture->user->firstName;
        $lName = $picture->user->lastName;
        echo <<<EOL
<div class="card">
  <div class="card-image">
    <figure class="image is-4by3">
      <img src="data:image/png;base64, $picture->imageData" alt="An image">
    </figure>
  </div>
  <div class="card-content">
    <div class="media">
      <div class="media-left">
        <figure class="image is-48x48">
          <img src="https://robohash.org/$username" alt="">
        </figure>
      </div>
      <div class="media-content">
        <p class="title is-4">$fName $lName</p>
        <p class="subtitle is-6">@$username</p>
      </div>
    </div>

    <div class="content">
      $picture->description
      <br>
      <time>$picture->formattedUploadDate</time>
    </div>
  </div>
</div>
EOL;

    }
}