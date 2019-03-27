<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 11:19
 */

class CommentDAO extends DAO {

    private $conn = null;

    public function __construct()
    {
        $this->conn = parent::$conn;
    }

    function getImageComments($imageId)
    {

        $query = "SELECT * FROM comments where image_id = :imageId";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':imageId', $imageId);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $comments;

    }


    function addImageComment($comment)
    {

        $commentText = $comment->getComment();
        $authorId = $comment->getAuthorID();
        $imageId = $comment->getImageID();

        $query = "INSERT INTO comments(comment, image_id, user_id, post_date) VALUES(:comment, :image_id,:user_id, now());";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':comment', $commentText);
        $statement->bindParam(':image_id', $imageId);
        $statement->bindParam(':user_id', $authorId);
        // $statement->bindParam(':post_date', $time);
        $success = $statement->execute();

        return $success;

    }


}