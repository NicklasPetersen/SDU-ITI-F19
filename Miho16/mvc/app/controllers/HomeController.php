<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:34
 */
namespace controllers;
use core\Controller;
use models\HomeModel;
class HomeController extends Controller {
    public function index () {
        $homeModel = new HomeModel();
        return $this->view("home/home", array("pictures" => $homeModel->get_20_posts()));
    }
    public function post_picture(){
        $homeModel = new HomeModel();
        $type = $_FILES["fileToUpload"]["type"];
        $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if(!$check) {
                return $this->view("home/Home", array("pictures" => $homeModel->get_20_posts(), "error_msg" => "File is not an image."));
            }
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            return $this->view("home/Home", array("pictures" => $homeModel->get_20_posts(), "error_msg" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."));
        }
        $username = $_SESSION['login_user'];
        $data = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
        $title = $_POST['title'];
        $description = $_POST['description'];
        $username_stripped = strip_tags($username,"<b>");
        $title_stripped = strip_tags($title,"<b>");
        $description_stripped = strip_tags($description,"<b>");
        $type_stripped = strip_tags($type, "<b>");
        $homeModel->upload_picture($username_stripped, $data, $title_stripped, $description_stripped, $type_stripped);
        return $this->view("home/Home", array("pictures" => $homeModel->get_20_posts()));
    }
    public function log_out(){
        session_destroy();
        header("location: /jonasr16/mvc/public/login");
    }
}
