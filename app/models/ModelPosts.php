<?php

require_once 'app/core/Dbh.php';

class ModelPosts extends Dbh
{
    public function showPostlist()
    {
        $sql = "SELECT * from posts order by postDateTime DESC ;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function showPost($postId)
    {
        $sql = "SELECT * from posts where postId=? ;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
        $result = $stmt->fetch();
        return $result;
    }

    public function createPost($postTitle,  $postText, $postDateTime, $postCategory, $postAuthor, $postAuthorId,
                               $postImg ){
        $sql = "INSERT INTO posts (postTitle, postContent , postDateTime , postCategory , postAuthor , postAuthorId, postimg ) VALUES (?,?,?,?,?,?,?);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postTitle, $postText, $postDateTime, $postCategory, $postAuthor, $postAuthorId,$postImg]);
    }
    public function findPost($query){
        $sql = "SELECT postAuthor, postDateTime, postTitle, postContent FROM posts WHERE postAuthor like '%$query%' or postTitle like '%$query%' or postContent like '%$query%';";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$query]);
        $result = $stmt->fetchAll();
       
        if($result) {
            return $result;
        }
    }

    public function makeComment($commentAuthor , $commentText , $commentPost , $commentDate )
    {
        $sql = "INSERT INTO comments ( commentAuthor , commentText , commentToPost, commentDate) VALUES (?,?,?,?);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$commentAuthor , $commentText , $commentPost, $commentDate  ]);
    }

    public function showComments($postId)
    {
        $sql = "SELECT commentAuthor , commentText , commentToPost, commentDate FROM comments WHERE commentToPost=?;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);

        $result = $stmt->fetchAll();

        if($result){
            return $result;
        }
    }
}
